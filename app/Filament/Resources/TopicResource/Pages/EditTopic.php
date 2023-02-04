<?php

namespace App\Filament\Resources\TopicResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\TopicResource;
use App\Filament\Resources\TopicResource\Widgets\StatsOverview;

class EditTopic extends EditRecord
{
    protected static string $resource = TopicResource::class;

    protected function getActions(): array
    {
        return [
           // Actions\DeleteAction::make(),
        ];
    }

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
