<?php

namespace App\Filament\Resources\FrontendResource\Pages;

use App\Filament\Resources\FrontendResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFrontend extends CreateRecord
{
    protected static string $resource = FrontendResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
