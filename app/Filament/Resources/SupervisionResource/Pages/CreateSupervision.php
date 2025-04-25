<?php

namespace App\Filament\Resources\SupervisionResource\Pages;

use App\Filament\Resources\SupervisionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateSupervision extends CreateRecord
{
    protected static string $resource = SupervisionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['lecture_id'] = Auth::id();

        return $data;
    }
}
