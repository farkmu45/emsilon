<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PredictionResource\Pages;
use App\Models\Prediction;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PredictionResource extends Resource
{
    protected static ?string $model = Prediction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('species.name')
                    ->label('Species')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('ems_concentration')
                    ->label('EMS concentration')
                    ->suffix('%')
                    ->sortable(),
                TextColumn::make('first_soak_duration')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, '.', '.'))
                    ->sortable()
                    ->suffix(' mins'),
                TextColumn::make('second_soak_duration')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, '.', '.'))
                    ->sortable()
                    ->suffix(' mins'),
                TextColumn::make('lowest_temperature')
                    ->suffix(' °C')
                    ->sortable(),
                TextColumn::make('highest_temperature')
                    ->suffix(' °C')
                    ->sortable(),
                IconColumn::make('result')
                    ->label('Suitable')
                    ->boolean(),
            ])
            ->filters([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePredictions::route('/'),
        ];
    }
}
