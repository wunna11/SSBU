<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Filament\Resources\CourseResource\RelationManagers\QuizzesRelationManager;
use App\Filament\Resources\CourseResource\RelationManagers\UnitsRelationManager;
use App\Models\Course;
use Filament\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Filament\Support\Enums\FontWeight;
use Filament\Notifications\Notification;


class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Data';

    protected static ?int $navigationSort = 1;

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
                                Forms\Components\RichEditor::make('outline')
                                    ->columnSpanFull(),
                                Forms\Components\FileUpload::make('image')
                                    ->image()
                                    ->directory('images/courses'),
                            ]),
                            Section::make([
                                Forms\Components\Select::make('teacher_id')
                                    ->relationship(name: 'teacher', titleAttribute: 'name'),
                                Forms\Components\Select::make('batch_id')
                                    ->relationship(name: 'batch', titleAttribute: 'name'),
                                Forms\Components\TextInput::make('rank')
                                    ->numeric(),
                                Forms\Components\TextInput::make('endtest_status')
                                    ->required()
                                    ->numeric()
                                    ->default(0),
                                Forms\Components\Toggle::make('public')
                                    ->required(),
                            ])
                        ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\ImageColumn::make('image')
                        ->height('100%')
                        ->width('100%'),
                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\TextColumn::make('title')
                            ->weight(FontWeight::Bold)
                            ->sortable(),
                        Tables\Columns\TextColumn::make('teacher.name')
                            ->sortable(),
                        Tables\Columns\TextColumn::make('batch.name')
                            ->sortable(),
                    ]),
                ])->space(3),
                Tables\Columns\Layout\Panel::make([
                    Tables\Columns\Layout\Split::make(
                        [
                            Tables\Columns\TextColumn::make('rank')
                                ->icon('heroicon-o-star')
                                ->numeric()
                                ->sortable(),
                            Tables\Columns\IconColumn::make('public')
                                ->boolean(),
                            Tables\Columns\TextColumn::make('endtest_status')
                                ->numeric()
                                ->sortable(),
                        ]
                    ),
                    Tables\Columns\Layout\Stack::make(
                        [
                            Tables\Columns\TextColumn::make('created_at')
                                ->dateTime()
                                ->sortable()
                                ->toggleable(isToggledHiddenByDefault: true),
                            Tables\Columns\TextColumn::make('updated_at')
                                ->dateTime()
                                ->sortable()
                                ->toggleable(isToggledHiddenByDefault: true),
                        ]
                    )
                ])->collapsible(),
            ])
            ->filters([
                //
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->paginated([
                18,
                36,
                72,
                'all',
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->action(function () {
                            Notification::make()
                                ->title('Now, now, don\'t be cheeky, leave some records for others to play with!')
                                ->warning()
                                ->send();
                        }),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            UnitsRelationManager::class,
            QuizzesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
            'detail' => Pages\UnitWithCourseID::route('/course-id')
        ];
    }
}
