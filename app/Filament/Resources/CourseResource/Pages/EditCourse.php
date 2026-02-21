<?php

namespace App\Filament\Resources\CourseResource\Pages;

use Filament\Actions\DeleteAction;
use App\Traits\HandlesImageCollections;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\CourseResource;
use Illuminate\Database\Eloquent\Model;

class EditCourse extends EditRecord
{
    use HandlesImageCollections;

    protected static string $resource = CourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load existing images from database
        $imageData = $this->loadExistingImages($this->record, ['image'], true);

        return array_merge($data, $imageData);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Extract image fields from form data
        return $this->extractImageFields($data, ['image']);
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // First, update the record normally
        $record->update($data);

        // Handle logo (single image) - only update if changed
        if ($this->hasImageCollectionChanged('image')) {
            $this->saveImageCollections($record, ['image'], true);
        }

        return $record;
    }
}
