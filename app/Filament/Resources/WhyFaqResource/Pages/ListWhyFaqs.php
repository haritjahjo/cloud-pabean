<?php

namespace App\Filament\Resources\WhyFaqResource\Pages;

use App\Filament\Resources\WhyFaqResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWhyFaqs extends ListRecords
{
    protected static string $resource = WhyFaqResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
