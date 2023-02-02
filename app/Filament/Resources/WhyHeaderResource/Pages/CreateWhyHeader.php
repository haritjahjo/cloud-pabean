<?php

namespace App\Filament\Resources\WhyHeaderResource\Pages;

use App\Filament\Resources\WhyHeaderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWhyHeader extends CreateRecord
{
    protected static string $resource = WhyHeaderResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
