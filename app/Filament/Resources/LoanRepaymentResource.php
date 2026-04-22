<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoanRepaymentResource\Pages;
use App\Filament\Resources\LoanRepaymentResource\RelationManagers;
use App\Models\LoanRepayment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LoanRepaymentResource extends Resource
{
    protected static ?string $model = LoanRepayment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('loan_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('repayment_schedule_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('payment_method'),
                Forms\Components\TextInput::make('reference')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('recorded_by')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('journal_entry_id')
                    ->numeric()
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('loan_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('repayment_schedule_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method'),
                Tables\Columns\TextColumn::make('reference')
                    ->searchable(),
                Tables\Columns\TextColumn::make('recorded_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('journal_entry_id')
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
            'index' => Pages\ListLoanRepayments::route('/'),
            'create' => Pages\CreateLoanRepayment::route('/create'),
            'edit' => Pages\EditLoanRepayment::route('/{record}/edit'),
        ];
    }
}
