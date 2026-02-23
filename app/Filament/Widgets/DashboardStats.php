<?php

namespace App\Filament\Widgets;

use App\Models\Course;
use App\Models\CourseCompletion;
use App\Models\Enrollment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Published Courses', Course::published()->count())
                ->description('Active courses available for enrollment')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),
            Stat::make('Total Enrollments', Enrollment::count())
                ->description('Total user enrollments across all courses')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),
            Stat::make('Total Completions', CourseCompletion::count())
                ->description('Number of users who have completed a course')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('warning'),
            Stat::make('Avg. Completion Rate', function () {
                $totalEnrollments = Enrollment::count();
                if ($totalEnrollments === 0) return '0%';
                $completions = CourseCompletion::count();
                return round(($completions / $totalEnrollments) * 100, 1) . '%';
            })
                ->description('Percentage of enrollments that resulted in completion')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('info'),
        ];
    }
}
