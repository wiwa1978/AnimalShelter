<?php

namespace App\Livewire\Animals;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Animal;
use App\Models\Message;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Events\MessageEvent;
use App\Models\Conversation;
use App\Models\Organization;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


#[Layout('layouts.app')]
class AnimalDetail extends Component
{

    public $isAnimalBelongsToShelter;
    public $isAnimalBelongsToOrganization;
    public $isAnimalBelongsToIndividual;
    public $days_adoptable;
    public $animal;
    public $photos;
    public $youtube_links;
    public $organization;
    public $animal_status;
    public $photos_http;
    public $photos_media;
    public $animal_adopted = false;
    public $animal_not_adoptable = false;
    public $animal_reserved = false;

    public $name;

    public $subject;
    public $email;
    public $telephone;
    public $question;
 
    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
        'subject' => 'required',
    ];
    
    protected $messages = [
        'email.required' => 'Het email adres is verplicht.',
        'email.email' => 'Het email adres is ongeldig.',
        'subject.required' => 'HHet onderwerp is verplicht.',
    ];

    public function mount(Animal $animal)
    {
        $dateAdded = Carbon::parse($animal->date_added); // assuming $date_added is your date
        $now = Carbon::now();
        
        
        $this->animal = $animal;
        $this->animal_status = $animal->status->value;
        $this->animal_status = $animal->increment('total_clicks');

        if ($this->animal_status == 'Adopted') {
            $this->animal_adopted = true;
        } elseif ($this->animal_status == 'Not adoptable') {
            $this->animal_not_adoptable = true;
        } elseif ($this->animal_status == 'Reserved') {
            $this->animal_reserved = true;
        }


        $this->organization=$animal->organization;
       
        $this->isAnimalBelongsToShelter = Organization::isShelter($this->organization->id)->exists();
        $this->isAnimalBelongsToOrganization = Organization::isOrganization($this->organization->id)->exists();
        $this->isAnimalBelongsToIndividual = Organization::isIndividual($this->organization->id)->exists();

        //dd($this->isAnimalBelongsToIndividual);

        $this->days_adoptable = (int) $dateAdded->diffInDays($now);
        
        //$this->photos = collect($this->animal->photos_additional)->take(3);

        $this->photos_http = collect($this->animal->photos_additional)
            ->filter(function ($photo) {
                return Str::startsWith($photo, 'http');
            })
            ->take(3);

        $this->photos_media = collect($this->animal->photos_additional)
            ->filter(function ($photo) {
                return Str::startsWith($photo, 'media');
            })
            ->take(3);

        //dd($this->photos_http);
        //$this->youtube_links = $this->animal->youtube_links;
        //$this->youtube_links = explode(' ', $this->youtube_links);
        if ($this->animal->youtube_links && is_array($this->animal->youtube_links)) {
            $this->youtube_links = array_column($this->animal->youtube_links, 'youtube_links');
        } else {
            $this->youtube_links = [];
        }
        //dd($this->youtube_links);

        Log::debug("Retrieving details for animal {$animal->id}, belonging to organization {$animal->organization->id}");

    }

    public function render()
    {
        return view('components.animals.animal-detail');
    }

    
    public function viewAnimalsByOrganization($organizationId)
    {
        $this->redirect(route('show-animal-organization', ['organization' => $organizationId]));
    }

    public function redirectLogin()
    {
        $this->redirectRoute('filament.app.resources.messages.create', ['tenant' => Auth::user()->id]);
    }

    public function redirectRegister()
    {
        $this->redirectRoute('filament.app.auth.register');
    }

    public function sendMessageToOrganization(Animal $animal)
    {
            Log::debug("Message sent to organization {$animal->organization->id} for animal {$animal->id}");
   
            $this->validate();

            $conversation =Conversation::create([
                'subject' => $this->subject,
            ]); 

            $message = Message::create([
                'organization_id' => $animal->organization->id,
                'conversation_id' => $conversation->id,
                'animal_id' => $animal->id,
                //'sender_id' => Auth::user() ? Auth()->id(): null,
                'sender_email' =>  $this->email,
                'receiver_email' => $animal->organization->users()->first()->email,
                'name' => $this->name,
                'email' => $this->email,
                'telephone' => $this->telephone,
                'content' => $this->question,
            ]);
            
            $conversation->messages()->save($message);
    
            MessageEvent::dispatch($message);
    
            $this->dispatch('close-modal');
    
            session()->flash('message', 'Message successfully sent.');
     
        
 
    }

    

}
