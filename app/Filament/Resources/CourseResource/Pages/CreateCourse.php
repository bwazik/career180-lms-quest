<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Traits\HandlesImageCollections;
use App\Filament\Resources\CourseResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateCourse extends CreateRecord
{
    use HandlesImageCollections;

    protected static string $resource = CourseResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Extract image fields from form data
        return $this->extractImageFields($data, ['image']);
    }

    protected function handleRecordCreation(array $data): Model
    {
        // First, create the store record
        $record = static::getModel()::create($data);

        // Handle image (single image)
        $this->saveImageCollections($record, ['image'], true);

        return $record;
    }
}
