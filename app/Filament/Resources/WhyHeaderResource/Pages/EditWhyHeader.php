<?php

namespace App\Filament\Resources\WhyHeaderResource\Pages;

use App\Filament\Resources\WhyHeaderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWhyHeader extends EditRecord
{
    protected static string $resource = WhyHeaderResource::class;

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
