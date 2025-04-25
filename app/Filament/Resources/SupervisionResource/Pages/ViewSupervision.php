<?php

namespace App\Filament\Resources\SupervisionResource\Pages;

use App\Filament\Resources\SupervisionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSupervision extends ViewRecord
{
    protected static string $resource = SupervisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
