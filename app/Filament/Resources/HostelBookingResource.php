<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HostelBookingResource\Pages;
use App\Filament\Resources\HostelBookingResource\RelationManagers;
use App\Models\HostelBooking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HostelBookingResource extends Resource
{
    protected static ?string $model = HostelBooking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('booking_reference')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('room_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('student_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('student_phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('student_email')
                    ->email()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('student_id_number')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('university_registration_number')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('intake_period')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('academic_year')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('check_in_date'),
                Forms\Components\DatePicker::make('check_out_date'),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\TextInput::make('payment_status')
                    ->required(),
                Forms\Components\TextInput::make('amount_due')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('amount_paid')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('payment_reference')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('confirmed_by')
                    ->numeric()
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('booking_reference')
                    ->searchable(),
                Tables\Columns\TextColumn::make('room_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('student_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('student_phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('student_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('student_id_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('university_registration_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('intake_period')
                    ->searchable(),
                Tables\Columns\TextColumn::make('academic_year')
                    ->searchable(),
                Tables\Columns\TextColumn::make('check_in_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('check_out_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('payment_status'),
                Tables\Columns\TextColumn::make('amount_due')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount_paid')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_reference')
                    ->searchable(),
                Tables\Columns\TextColumn::make('confirmed_by')
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
            'index' => Pages\ListHostelBookings::route('/'),
            'create' => Pages\CreateHostelBooking::route('/create'),
            'edit' => Pages\EditHostelBooking::route('/{record}/edit'),
        ];
    }
}
