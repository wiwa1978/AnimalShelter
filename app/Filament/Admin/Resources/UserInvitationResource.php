<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\UserInvitation;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\UserInvitationResource\Pages;
use App\Filament\Admin\Resources\UserInvitationResource\RelationManagers;

class UserInvitationResource extends Resource
{
    protected static ?string $model = UserInvitation::class;


    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 2;

    protected static ?string $tenantOwnershipRelationshipName = 'organizations';



    public static function getNavigationGroup(): ?string
    {
        return __('users_back.user_management');
    }

    public static function getNavigationLabel(): string
    {
        return  __('users_back.invitations_overview');
    }

    public static function getModelLabel(): string
    {
        return __('users_back.invitation');
    }

    public static function getPluralModelLabel(): string
    {
        return __('users_back.invitations');
    }

    public static function getNavigationBadge(): ?string
    {
       // return User::count();
        $userInvitationCount = UserInvitation::count();
        return $userInvitationCount;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email')
                    ->searchable(),

                TextColumn::make('organization_type')
                    ->searchable(),

                TextColumn::make('organization_id')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserInvitations::route('/'),
            'create' => Pages\CreateUserInvitation::route('/create'),
            'edit' => Pages\EditUserInvitation::route('/{record}/edit'),
        ];
    }
}
