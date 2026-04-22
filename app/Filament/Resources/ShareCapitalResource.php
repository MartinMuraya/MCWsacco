<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShareCapitalResource\Pages;
use App\Filament\Resources\ShareCapitalResource\RelationManagers;
use App\Models\ShareCapital;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShareCapitalResource extends Resource
{
    protected static ?string $model = ShareCapital::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('member_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('shares_count')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('amount_per_share')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('total_value')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('recorded_by')
                    ->numeric()
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('member_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('shares_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount_per_share')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_value')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('recorded_by')
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
            'index' => Pages\ListShareCapitals::route('/'),
            'create' => Pages\CreateShareCapital::route('/create'),
            'edit' => Pages\EditShareCapital::route('/{record}/edit'),
        ];
    }
}
