<?php

namespace App\Filament\Resources\WhyFaqResource\Pages;

use App\Filament\Resources\WhyFaqResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWhyFaq extends CreateRecord
{
    protected static string $resource = WhyFaqResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
