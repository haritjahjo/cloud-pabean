<?php

namespace App\Filament\Resources\TopicResource\Pages;

use Filament\Pages\Actions;
use App\Filament\Resources\TopicResource;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\TopicResource\Widgets\StatsOverview;

class CreateTopic extends CreateRecord
{
    protected static string $resource = TopicResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
    // protected function getHeaderWidgets(): array
    // {
    //     return [
    //         StatsOverview::class,
    //     ];
    // }
}
