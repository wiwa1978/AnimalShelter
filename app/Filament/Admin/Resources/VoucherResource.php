<?php

namespace App\Filament\Admin\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Voucher;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Enums\VoucherDiscounts;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\VoucherResource\Pages;
use App\Filament\Admin\Resources\VoucherResource\RelationManagers;

class VoucherResource extends Resource
{
    protected static ?string $model = Voucher::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('General Information')
                    ->schema([]),
                Section::make('Product Information')
                    ->schema([])

            ])->columns(2);
    }


    //  Section::make('Voucher Information')
    //                 ->schema([

    //                     Forms\Components\TextInput::make('code')
    //                         ->required()
    //                         ->maxLength(32)
    //                         ->extraInputAttributes(['readonly' => true])
    //                         ->default(function () {
    //                             return 'CODE-' . strtoupper(Str::random(15));
    //                         }),

    //                     Select::make('discount')
    //                         ->options(VoucherDiscounts::class)
    //                         ->native(false)
    //                         ->preload()
    //                         ->required(),
    //                     Forms\Components\DateTimePicker::make('expires_at'),
    //                     Forms\Components\Select::make('user_id')
    //                         ->relationship('user', 'name')
    //                         ->required(),
    //                     Forms\Components\Select::make('animal_id')
    //                         ->relationship('animal', 'name')
    //                         ->required(),
    //                 ])


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->formatStateUsing(fn (string $state): string => ucfirst("{$state}"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('discount')
                    ->searchable(),
                Tables\Columns\TextColumn::make('expires_at')
                    //->dateTime()
                    ->since()
                    ->sortable(),
                Tables\Columns\TextColumn::make('redeemed_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('animal.name')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

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
            'index' => Pages\ListVouchers::route('/'),
            'create' => Pages\CreateVoucher::route('/create'),
            'view' => Pages\ViewVoucher::route('/{record}'),
            'edit' => Pages\EditVoucher::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return Voucher::count();
    }
}
