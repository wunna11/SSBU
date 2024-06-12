<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExerciseResource\Pages;
use App\Filament\Resources\ExerciseResource\RelationManagers\QuizzesRelationManager;
use App\Models\Exercise;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExerciseResource extends Resource
{
    protected static ?string $model = Exercise::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationGroup = 'Data';

    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return number_format(static::getModel()::count());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Split::make([
                            Section::make([
                                Forms\Components\TextInput::make('title')
                                    ->maxLength(255),
                                Forms\Components\Select::make('unit_id')
                                    ->relationship(name: 'unit', titleAttribute: 'title'),
                                Forms\Components\TextInput::make('time')
                                    ->numeric()
                                    ->default(0),
                            ]),
                            Section::make([
                                Forms\Components\TextInput::make('rank')
                                    ->numeric()
                                    ->default(0),
                                Forms\Components\TextInput::make('pass_percentage')
                                    ->numeric()
                                    ->default(0),
                                Forms\Components\TextInput::make('quantity')
                                    ->numeric()
                                    ->default(0),
                            ])
                        ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit.title')
                    ->sortable(),
                Tables\Columns\TextColumn::make('time')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rank')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pass_percentage')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
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
                Filter::make('unit_id')
                    ->query(function ($query, $data) {
                        if ($data['value'] !== null) {
                            return $query->where('unit_id', $data['value']);
                        }
                        return $query;
                    })
                    ->form([
                        Forms\Components\TextInput::make('value')
                            ->label('Unit ID')
                            ->required()
                            ->hidden(fn ($livewire) => $livewire->tableFilters['unit_id'] !== null),
                    ]),
                SelectFilter::make('unit')
                    ->relationship('unit', 'title')
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            QuizzesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExercises::route('/'),
            'create' => Pages\CreateExercise::route('/create'),
            'edit' => Pages\EditExercise::route('/{record}/edit'),
        ];
    }
}
