<?php

namespace App\Filament\Resources;

use App\Actions\CalculateCourseProgressAction;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Filament\Resources\UserResource\Pages\ViewUser;
use App\Models\User;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['enrollments.lessons', 'lessonProgress']);
    }

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 3;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                IconColumn::make('is_admin')
                    ->boolean(),
            ])
            ->actions([
                ViewAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('User Details')
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('email'),
                        IconEntry::make('is_admin')->boolean(),
                    ])->columns(2),

                Section::make('Enrolled Courses Progress')
                    ->schema([
                        RepeatableEntry::make('enrollments')
                            ->label('')
                            ->schema([
                                TextEntry::make('title')
                                    ->label('Course'),
                                TextEntry::make('progress')
                                    ->getStateUsing(function ($record, $component) {
                                        $userRecord = $component->getInfolist()->getRecord();
                                        return app(CalculateCourseProgressAction::class)($userRecord, $record) . '%';
                                    })
                                    ->badge()
                                    ->color(fn (string $state): string => match (true) {
                                        $state === '100%' => 'success',
                                        $state === '0%' => 'danger',
                                        default => 'warning',
                                    }),
                            ])->columns(2),
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'view' => ViewUser::route('/{record}'),
        ];
    }
}
