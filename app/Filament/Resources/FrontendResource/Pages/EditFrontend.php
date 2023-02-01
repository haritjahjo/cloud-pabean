<?php

namespace App\Filament\Resources\FrontendResource\Pages;

use App\Filament\Resources\FrontendResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFrontend extends EditRecord
{
    protected static string $resource = FrontendResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
