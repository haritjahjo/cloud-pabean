<?php

namespace App\Filament\Resources\WhyHeaderResource\Pages;

use App\Filament\Resources\WhyHeaderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWhyHeaders extends ListRecords
{
    protected static string $resource = WhyHeaderResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
