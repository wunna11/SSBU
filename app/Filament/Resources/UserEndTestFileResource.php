<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Enums\FileStatus;
use Filament\Tables\Table;
use App\Models\UserEndTestFile;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserEndTestFileResource\Pages;
use App\Filament\Resources\UserEndTestFileResource\RelationManagers;

class UserEndTestFileResource extends Resource
{
    protected static ?string $model = UserEndTestFile::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name'),
                Forms\Components\Textarea::make('file_1')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('file_2')
                    ->columnSpanFull(),
                Forms\Components\Select::make('result')
                    ->options([
                        FileStatus::Pending => 'Pending',
                        FileStatus::Approved => 'Approved',
                        FileStatus::Reject => 'Reject'
                    ]),
                Forms\Components\Select::make('course_id')
                    ->relationship('course', 'title'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('course.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\SelectColumn::make('result')
                    ->searchable()
                    ->options([
                        FileStatus::Pending => 'Pending',
                        FileStatus::Approved => 'Approve',
                        FileStatus::Reject => 'Reject',
                    ]),
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
                SelectFilter::make('result')
                    ->options([
                        FileStatus::Pending => 'Pending',
                        FileStatus::Approved => 'Approve',
                        FileStatus::Reject => 'Reject',
                    ])
                    ->searchable()
                    ->preload()
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListUserEndTestFiles::route('/'),
            'create' => Pages\CreateUserEndTestFile::route('/create'),
            'edit' => Pages\EditUserEndTestFile::route('/{record}/edit'),
        ];
    }
}
