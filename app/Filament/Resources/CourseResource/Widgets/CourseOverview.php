<?php

namespace App\Filament\Resources\CourseResource\Widgets;

use App\Models\Course;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class CourseOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $courses = Course::count();
        $public_courses = Course::where('public', 1)->count();


        return [
            Stat::make('Total Courses', Number::format($courses))
                ->description('The total number of courses')
                ->icon('heroicon-o-book-open'),

            Stat::make('Published Posts', Number::format($public_courses))
                ->description('The total number of published posts')
                ->icon('heroicon-o-check-circle'),
        ];
    }
}
