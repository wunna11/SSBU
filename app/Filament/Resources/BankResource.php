<?php

namespace App\Filament\Resources;

use App\Enums\BankStatus;
use App\Filament\Resources\BankResource\Pages;
use App\Filament\Resources\BankResource\RelationManagers;
use App\Models\Bank;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class BankResource extends Resource
{
    protected static ?string $model = Bank::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Split::make([
                            Section::make([
                                Forms\Components\TextInput::make('bank')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('name')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('account')
                                    ->maxLength(255),
                            ]),
                            Section::make([
                                Forms\Components\FileUpload::make('image')
                                    ->image()
                                    ->directory('images/banks'),
                                Forms\Components\TextInput::make('rank')
                                    ->numeric(),
                                Select::make('status')
                                    ->options([
                                        BankStatus::Local => 'Local',
                                        BankStatus::Foreign => 'Foreign',
                                    ]),
                            ])
                        ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bank')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('account')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('rank')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->formatStateUsing(function ($state) {
                        $status = BankStatus::coerce($state);
                        if ($status) {
                            return $status->is(BankStatus::Local) ? 'Local' : 'Foreign';
                        }
                        return 'Unknown';
                    }),
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
                Tables\Actions\DeleteAction::make()
                    ->action(function ($record) {
                        if(Storage::exists(('/public/' . $record->image))) {
                            Storage::delete('/public/' . $record->image);
                        }
                        $record->delete();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                if (Storage::exists(('/public/' . $record->image))) {
                                    Storage::delete('/public/' . $record->image);
                                }
                                $record->delete();
                            }
                        }),
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
            'index' => Pages\ListBanks::route('/'),
            'create' => Pages\CreateBank::route('/create'),
            'edit' => Pages\EditBank::route('/{record}/edit'),
        ];
    }
}
