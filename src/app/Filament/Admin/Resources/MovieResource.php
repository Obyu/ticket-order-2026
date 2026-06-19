<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MovieResource\Pages;
use App\Filament\Admin\Resources\MovieResource\RelationManagers;
use App\Models\Movie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class MovieResource extends Resource
{
    protected static ?string $model = Movie::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
         ->schema([

            TextInput::make('title')
            ->required()
            ->live(onBlur: true)
            ->afterStateUpdated(
                fn (Set $set, ?string $state) =>
                $set('slug', Str::slug($state))
            ),

            TextInput::make('slug')
            ->required()
            ->readOnly(),

            FileUpload::make('poster')
                ->image()
                ->directory('movies/posters'),

            FileUpload::make('banner')
                ->image()
                ->directory('movies/banners'),

            TextInput::make('trailer_url')
                ->url(),

            TextInput::make('duration')
                ->numeric()
                ->required(),

            Select::make('rating')
            ->options([
                'SU' => 'SU',
                '13+' => '13+',
                '17+' => '17+',
                '21+' => '21+',
            ]),

            Toggle::make('is_showing')
                ->default(true),

            Select::make('genres')
                ->relationship('genres', 'name')
                ->multiple()
                ->preload(),

            RichEditor::make('synopsis')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                ImageColumn::make('poster')->square(),
                ImageColumn::make('banner')->square(),
                TextColumn::make('trailer_url'),
                TextColumn::make('duration'),
                TextColumn::make('rating'),
                IconColumn::make('is_showing')
                    ->boolean(),
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
            'index' => Pages\ListMovies::route('/'),
            'create' => Pages\CreateMovie::route('/create'),
            'edit' => Pages\EditMovie::route('/{record}/edit'),
        ];
    }
}
