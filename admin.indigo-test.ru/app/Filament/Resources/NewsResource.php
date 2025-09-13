<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    // Изменение названия в навигации
    protected static ?string $navigationLabel = 'Новости сайта';

    // Изменение заголовка в breadcrumbs
    protected static ?string $title = 'Управление новостями';

    // Множественное число
    protected static ?string $pluralModelLabel = 'Новости';

    // Единственное число
    protected static ?string $modelLabel = 'Новость';

    // Иконка в навигации
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    // Позиция в навигации
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description'),
                Forms\Components\Toggle::make('is_published')
                    ->label('Опубликовано')
                    ->default(true) // значение по умолчанию
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->label('Изображение')
                    ->image()
                    ->disk('shared_images') // Используем общий диск
                    ->directory('news') // Папка внутри общей директории
                    ->visibility('public')
                    ->maxSize(2048)
                    ->imagePreviewHeight(200)
                    ->required()
                    ->helperText('Изображение будет доступно по адресу: http://indigo-test.ru/shared_images/news/'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
