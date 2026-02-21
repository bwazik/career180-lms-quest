<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use App\Actions\CalculateCourseProgressAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EnrollmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'enrollments';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->modifyQueryUsing(fn (Builder $query) => $query->with(['user.lessonProgress']))
            ->columns([
                TextColumn::make('user.name')
                    ->label('User Name')
                    ->searchable(),
                TextColumn::make('enrolled_at')
                    ->label('Enrolled At')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('progress')
                    ->label('Progress')
                    ->state(fn ($record) => app(CalculateCourseProgressAction::class)($record->user, $this->getOwnerRecord()) . '%')
                    ->badge()
                    ->color(fn (string $state): string => match (true) {
                        $state === '100%' => 'success',
                        $state === '0%' => 'danger',
                        default => 'warning',
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }
}
