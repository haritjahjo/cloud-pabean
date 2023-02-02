<?php

namespace App\Filament\Resources\WhyFaqResource\Pages;

use App\Filament\Resources\WhyFaqResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWhyFaq extends EditRecord
{
    protected static string $resource = WhyFaqResource::class;

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
