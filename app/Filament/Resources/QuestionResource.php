<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Question;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\QuestionResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\QuestionResource\RelationManagers;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;
    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(columns:12)
            ->schema([
                Forms\Components\Select::make('topic_id')
                    ->columnSpan(span:12)
                    ->relationship(relationshipName:'Topic', titleColumnName:'title')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->columnSpan(span:12)
                    ->required()
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('answer')
                    ->columnSpan(span:12)
                    ->required()
                    ->maxLength(65535),
                Forms\Components\Toggle::make('is_visible')
                    ->columnSpan(span:6)
                    ->inline()
                    ->required()
                    ->default(state:true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('topic_id'),
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
                Tables\Columns\TextColumn::make('answer')
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
                Tables\Columns\IconColumn::make('is_visible')
                    ->boolean()
                    ->label(label:'Visible?')
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle'),
            ])
            ->filters([
                Filter::make('Visible')->default()
                    ->query(fn (Builder $query): Builder => $query->where('is_visible', true)),
                Filter::make('NotVisible')
                    ->query(fn (Builder $query): Builder => $query->where('is_visible', false)),
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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }    
}
