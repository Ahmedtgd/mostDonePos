<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;


class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\TextInput::make('password')->required(),
                Forms\Components\TextInput::make('phone')->required(),
                Forms\Components\TextInput::make('address')->required(),
                // ...
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('title'),
               Tables\Columns\TextColumn::make('name'),
               Tables\Columns\TextColumn::make('email'),
               Tables\Columns\TextColumn::make('password'),
               Tables\Columns\TextColumn::make('phone'),
            ])
            ->filters([
              
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCustomers::route('/'),
        ];
    }    
}
