<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Filament\Resources\RoomResource\RelationManagers;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';
    protected static ?string $navigationGroup = 'Website Management';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('hostel_id')
                    ->relationship('hostel', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('room_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('room_type')
                    ->options([
                        'SINGLE' => 'Single',
                        'DOUBLE' => 'Double',
                        'TRIPLE' => 'Triple',
                        'STUDIO' => 'Studio',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('floor')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('capacity')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('price_per_semester')
                    ->required()
                    ->numeric()
                    ->prefix('KES'),
                Forms\Components\TagsInput::make('amenities')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hostel.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('room_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('room_type'),
                Tables\Columns\TextColumn::make('floor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('capacity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price_per_semester')
                    ->money('KES')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
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
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
