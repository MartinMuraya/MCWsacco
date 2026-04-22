<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoanProductResource\Pages;
use App\Filament\Resources\LoanProductResource\RelationManagers;
use App\Models\LoanProduct;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LoanProductResource extends Resource
{
    protected static ?string $model = LoanProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Website Management';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('interest_type')
                    ->required(),
                Forms\Components\TextInput::make('interest_rate')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('min_amount')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('max_amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('min_period_months')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\TextInput::make('max_period_months')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('processing_fee_percent')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('insurance_fee_percent')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\Toggle::make('requires_guarantors')
                    ->required(),
                Forms\Components\TextInput::make('max_guarantors')
                    ->required()
                    ->numeric()
                    ->default(3),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('interest_type'),
                Tables\Columns\TextColumn::make('interest_rate')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('min_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('min_period_months')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_period_months')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('processing_fee_percent')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('insurance_fee_percent')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('requires_guarantors')
                    ->boolean(),
                Tables\Columns\TextColumn::make('max_guarantors')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
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
            'index' => Pages\ListLoanProducts::route('/'),
            'create' => Pages\CreateLoanProduct::route('/create'),
            'edit' => Pages\EditLoanProduct::route('/{record}/edit'),
        ];
    }
}
