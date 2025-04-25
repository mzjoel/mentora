<?php

namespace App\Filament\Resources\AdvisoryResource\Pages;

use App\Filament\Resources\AdvisoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAdvisory extends ViewRecord
{
    protected static string $resource = AdvisoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
