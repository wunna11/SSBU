<?php

namespace App\Filament\Resources\CourseResource\Widgets;

use App\Models\Course;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class UnitsWithCourseId extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            // ->query(fn () => Course::all())
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
            ]);
    }
}
