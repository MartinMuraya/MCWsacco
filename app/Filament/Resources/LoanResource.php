<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoanResource\Pages;
use App\Filament\Resources\LoanResource\RelationManagers;
use App\Models\Loan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LoanResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('loan_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('loan_application_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('member_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('loan_product_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('principal')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('interest_rate')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('period_months')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('monthly_payment')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('total_interest')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('total_payable')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('outstanding_balance')
                    ->required()
                    ->numeric(),
                Forms\Components\DateTimePicker::make('disbursed_at'),
                Forms\Components\TextInput::make('disbursed_by')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\TextInput::make('account_id')
                    ->numeric()
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('loan_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('loan_application_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('member_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('loan_product_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('principal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('interest_rate')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('period_months')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('monthly_payment')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_interest')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_payable')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('outstanding_balance')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('disbursed_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('disbursed_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('account_id')
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
            'index' => Pages\ListLoans::route('/'),
            'create' => Pages\CreateLoan::route('/create'),
            'edit' => Pages\EditLoan::route('/{record}/edit'),
        ];
    }
}
