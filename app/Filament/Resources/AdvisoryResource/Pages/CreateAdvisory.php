<?php

namespace App\Filament\Resources\AdvisoryResource\Pages;

use App\Filament\Resources\AdvisoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateAdvisory extends CreateRecord
{
    protected static string $resource = AdvisoryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['student_id'] = Auth::id();
        $data['response'] = 'pending';

        return $data;
    }
}
