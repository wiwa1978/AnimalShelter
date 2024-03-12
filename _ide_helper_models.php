<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property int $user_id
 * @property \App\Enums\AnimalType $animal_type
 * @property \App\Enums\AnimalLocation $location
 * @property string $age
 * @property string $gender
 * @property \App\Enums\AnimalStatus $status
 * @property string $size
 * @property string $description
 * @property string $breed
 * @property string $reason_adoption
 * @property int $sterilized
 * @property bool $chipped
 * @property bool $passport
 * @property bool $vaccinated
 * @property bool $rabies
 * @property bool $medicins
 * @property bool $special_food
 * @property bool $behavioural_problem
 * @property int $kids_friendly_6y
 * @property int $kids_friendly_14y
 * @property int $cats_friendly
 * @property int $dogs_friendly
 * @property string $environment
 * @property bool $well_behaved
 * @property bool $playful
 * @property bool $everybody_friendly
 * @property bool $affectionate
 * @property int $needs_garden
 * @property int $potty_trained
 * @property int $car_friendly
 * @property int $home_alone
 * @property int $knows_commands
 * @property int $experience_required
 * @property string|null $photo_featured
 * @property array|null $photos_additional
 * @property array|null $videos
 * @property array|null $youtube_links
 * @property string $published_state
 * @property string|null $published_at
 * @property string|null $unpublished_at
 * @property string|null $unpublish_reason
 * @property int $published
 * @property int $featured
 * @property \App\Enums\ApprovalState $approval_state
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Enums\AnimalPublishState $publish_state
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Animal belongsToIndividual()
 * @method static \Illuminate\Database\Eloquent\Builder|Animal belongsToOrganization()
 * @method static \Illuminate\Database\Eloquent\Builder|Animal cats()
 * @method static \Illuminate\Database\Eloquent\Builder|Animal dogs()
 * @method static \Illuminate\Database\Eloquent\Builder|Animal draft()
 * @method static \Database\Factories\AnimalFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Animal featured()
 * @method static \Illuminate\Database\Eloquent\Builder|Animal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Animal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Animal notFeatured()
 * @method static \Illuminate\Database\Eloquent\Builder|Animal others()
 * @method static \Illuminate\Database\Eloquent\Builder|Animal published()
 * @method static \Illuminate\Database\Eloquent\Builder|Animal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereAffectionate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereAnimalType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereApprovalState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereBehaviouralProblem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereBreed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereCarFriendly($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereCatsFriendly($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereChipped($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereDogsFriendly($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereEnvironment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereEverybodyFriendly($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereExperienceRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereHasMark(\Maize\Markable\Mark $mark, \Illuminate\Database\Eloquent\Model $user, ?string $value = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereHomeAlone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereKidsFriendly14y($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereKidsFriendly6y($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereKnowsCommands($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereMedicins($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereNeedsGarden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal wherePassport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal wherePhotoFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal wherePhotosAdditional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal wherePlayful($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal wherePottyTrained($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal wherePublishedState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereRabies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereReasonAdoption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereSpecialFood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereSterilized($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereUnpublishReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereUnpublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereVaccinated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereVideos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereWellBehaved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereYoutubeLinks($value)
 */
	class Animal extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property int|null $organization
 * @property string|null $organization_name
 * @property string|null $website
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Animal> $animals
 * @property-read int|null $animals_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User regularUsers()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User superAdmins()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOrganization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOrganizationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutRole($roles, $guard = null)
 */
	class User extends \Eloquent {}
}

