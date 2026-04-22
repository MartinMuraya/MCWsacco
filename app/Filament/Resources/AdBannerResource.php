<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdBannerResource\Pages;
use App\Filament\Resources\AdBannerResource\RelationManagers;
use App\Models\AdBanner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdBannerResource extends Resource
{
    protected static ?string $model = AdBanner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image_path')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('link_url')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('target_audience')
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
                Forms\Components\DateTimePicker::make('display_start'),
                Forms\Components\DateTimePicker::make('display_end'),
                Forms\Components\TextInput::make('priority')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_path'),
                Tables\Columns\TextColumn::make('link_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('target_audience'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('display_start')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('display_end')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('priority')
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
            'index' => Pages\ListAdBanners::route('/'),
            'create' => Pages\CreateAdBanner::route('/create'),
            'edit' => Pages\EditAdBanner::route('/{record}/edit'),
        ];
    }
}
