<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Topic;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Livewire\TemporaryUploadedFile;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Widgets\StatsOverviewWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TopicResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationGroup;
use App\Filament\Resources\TopicResource\RelationManagers;
use App\Filament\Resources\TopicResource\Widgets\StatsOverview;

class TopicResource extends Resource
{
    protected static ?string $model = Topic::class;

    protected static ?string $recordTitleAttribute = 'title';
    protected static ?string $navigationIcon = 'heroicon-o-collection';



    public static function form(Form $form): Form
    {
        return $form
            ->columns(columns:12)
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->columnSpan(span:12)
                    ->required()
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('description')
                    ->columnSpan(span:12)
                    ->required()
                    ->maxLength(65535),
                Forms\Components\Select::make('tags')
                    ->multiple()
                    ->relationship('tags', 'name')
                    ->preload(condition:true)
                    ->columnSpan(span:6),
                Forms\Components\SpatieMediaLibraryFileUpload::make('file_name')
                    ->image()
                    ->collection(collection:'topics')    
                    ->getUploadedFileNameForStorageUsing(function(TemporaryUploadedFile $file):string{
                        return (string) str($file->getClientOriginalName())->prepend('topic-');
                    })
                    ->columnSpan(span:6),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()->sortable()
                    ->limit(30)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getLimit()) {
                            return null;
                        }

                        // Only render the tooltip if the column contents exceeds the length limit.
                        return $state;
                    }),
                Tables\Columns\TextColumn::make('description')
                    ->limit(30)
                        ->tooltip(function (TextColumn $column): ?string {
                            $state = $column->getState();

                            if (strlen($state) <= $column->getLimit()) {
                                return null;
                            }

                            // Only render the tooltip if the column contents exceeds the length limit.
                            return $state;
                        }),
                Tables\Columns\SpatieMediaLibraryImageColumn::make(name: 'file_name')
                    ->collection(collection:'topics')
                    ->conversion(conversion:'topic')
                    ->width(width:80)
                    ->height(height:60),
                Tables\Columns\TextColumn::make(name:'tags.name'),
            ])
            ->filters([
                SelectFilter::make('tag')->relationship('tags', 'name'),
                Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            RelationGroup::make('Topics', [
                RelationManagers\QuestionsRelationManager::class,
                //RelationManagers\TagsRelationManager::class,
            ]),
        ];
        // return [
        //     RelationManagers\QuestionsRelationManager::class,
        // ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTopics::route('/'),
            'create' => Pages\CreateTopic::route('/create'),
            'edit' => Pages\EditTopic::route('/{record}/edit'),
        ];
    }    

    public static function getWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }

}
