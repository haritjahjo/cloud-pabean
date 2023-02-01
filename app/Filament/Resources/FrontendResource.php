<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Frontend;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FrontendResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FrontendResource\RelationManagers;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Livewire\TemporaryUploadedFile;

class FrontendResource extends Resource
{
    protected static ?string $model = Frontend::class;

    protected static ?string $navigationIcon = 'heroicon-o-annotation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('excerpt')
                    ->maxLength(255),
                Forms\Components\Toggle::make(name: 'is_visible')->inline(),
                SpatieMediaLibraryFileUpload::make(name:'file_name')
                    ->image()
                    ->collection(collection:'frontend')    
                    ->getUploadedFileNameForStorageUsing(function(TemporaryUploadedFile $file):string{
                        return (string) str($file->getClientOriginalName())->prepend('front-');
                    })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable()
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getLimit()) {
                            return null;
                        }

                        // Only render the tooltip if the column contents exceeds the length limit.
                        return $state;
                    }),

                IconColumn::make('is_visible')
                    ->boolean()
                    ->label(label:'Visible?')
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle'),
                
                SpatieMediaLibraryImageColumn::make(name: 'file_name')->label(label:'Frontend Image')
                    ->collection(collection:'frontend')
                    ->conversion(conversion:'front')
                    ->width(width:80)
                    ->height(height:60),

                Tables\Columns\TextColumn::make('excerpt')
                    ->extraAttributes(['class' => 'bg-gray-200'])
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getLimit()) {
                            return null;
                        }

                        // Only render the tooltip if the column contents exceeds the length limit.
                        return $state;
                    }),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()->dateTime('d-m-Y H:i'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFrontends::route('/'),
            'create' => Pages\CreateFrontend::route('/create'),
            'edit' => Pages\EditFrontend::route('/{record}/edit'),
        ];
    }
}
