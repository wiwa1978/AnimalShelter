<?php

namespace App\Filament\App\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Organization;
use App\Enums\OrganizationType;
use Filament\Facades\Filament;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Actions\DeleteBulkAction;
use Tapp\FilamentInvite\Actions\InviteAction;
use Filament\Infolists\Components\Actions\Action;
use App\Filament\App\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\App\Resources\UserResource\Pages\EditUser;
use App\Filament\App\Resources\UserResource\Pages\ListUsers;
use App\Filament\App\Resources\UserResource\Pages\CreateUser;
use App\Filament\App\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 1;

    protected static ?string $tenantOwnershipRelationshipName = 'organizations';

    //Auth::user()->organization_type == 'Organization' || Auth::user()->organization_type == 'Shelter') {

    public static function shouldRegisterNavigation(): bool
    {

        //return Auth::user()->organization_type == 'Individual' ? false : true;
        return Auth::user()->organization_type == OrganizationType::INDIVIDUAL->value ? false : true;

    }

    public static function getNavigationGroup(): ?string
    {
        return __('users_back.user_management');
    }

    public static function getNavigationLabel(): string
    {
        return  __('users_back.users_overview');
    }

    public static function getModelLabel(): string
    {
        return __('users_back.user');
    }

    public static function getPluralModelLabel(): string
    {
        return __('users_back.users_overview');
    }

    public static function getNavigationBadge(): ?string
    {
        // return User::count();
        $userCount = Filament::getTenant()->users()->count();
        return $userCount;
    }



    // public static function canCreate(): bool
    // {
    //     $organization = Organization::find(2);
    //     $plan = $organization->getPlan();

    //     // if the user count is higher than the plan limit, then disable the button
    //     // if the organization is not free forever (hence is billable), then disable the create button
    //     if ($organization->users->count() >= $plan->options['users'] && !$organization->isFreeForever()) {
    //         // Notification::make()
    //         // ->title('Cannot perform action')
    //         // ->success()
    //         // ->send();
    //         return false;
    //     }


    //     else {
    //         return true;
    //     }
    // }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('users_back.name'))
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label(__('users_back.email'))
                    ->email()
                    ->required()
                    ->maxLength(255),

                Placeholder::make('organization_type')
                    ->label(__('users_back.organization_type'))
                    ->content(
                        fn (User $record): string =>
                        $record->organization_type == OrganizationType::SHELTER ? __('animals_back.shelter') : __('animals_back.organization')
                    ),


                Placeholder::make('invited_by')
                    ->label(__('users_back.invited_by'))
                    ->content(
                        fn (User $record): string =>
                        $record->invited_by ? User::find($record->invited_by)->name : 'NA'
                    ),

                Placeholder::make('added_at')
                    ->label(__('users_back.member_since'))
                    ->content(
                        fn (User $record): string =>
                        //$record->created_at->format('d-m-Y H:i')
                        $record->created_at->since()
                    ),



            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('users_back.name'))
                    ->searchable(),

                TextColumn::make('email')
                    ->label(__('users_back.email'))
                    ->searchable(),

                TextColumn::make('invited_at')
                    ->label(__('users_back.invited_at'))
                    ->placeholder(__('users_back.is_not_invited'))
                    ->dateTime('d-m-Y H:i')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('users_back.added_at'))
                    ->dateTime('d-m-Y H:i')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label(__('users_back.updated_at'))
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->color('secondary')
                        ->visible(fn ($record) => $record->id == Auth::id()),

                    Tables\Actions\ViewAction::make()
                        ->color('secondary'),

                ])
                //->label(__('animals_back.actions'))
                //->button()
                //->icon('heroicon-m-ellipsis-horizontal')
                ->color('primary')
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl(
                //fn (User $record): string => Pages\ViewUser::getUrl([$record->id]),
                null
            )
            ->recordAction(Tables\Actions\ViewAction::class)
        ;
    }

    // public static function infolist(Infolist $infolist): Infolist
    // {


    //     return $infolist
    //         ->schema([
    //             TextEntry::make('name'),
    //             TextEntry::make('email'),
    //             TextEntry::make('organization_type'),
    //             // TextEntry::make('notes')
    //             //     ->columnSpanFull(),
    //         ]);

    // }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            //'view' => Pages\ViewUser::route('/{record}'),
            //'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
