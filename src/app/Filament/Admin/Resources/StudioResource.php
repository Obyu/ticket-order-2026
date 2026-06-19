<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\StudioResource\Pages;
use App\Filament\Admin\Resources\StudioResource\RelationManagers;
use App\Models\Studio;
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
use App\Models\Seat;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class StudioResource extends Resource
{
    protected static ?string $model = Studio::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
           ->schema([

                TextInput::make('name')
                    ->required(),
                TextInput::make('capacity')
                    ->numeric()
                    ->required(),
                TextInput::make('rows')
                    ->numeric()
                    ->required()
                    ->default(10),

                TextInput::make('seats_per_row')
                    ->numeric()
                    ->required()
                    ->default(10),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('capacity'),
            ])
            ->filters([
                //
            ])
            ->actions([

    Tables\Actions\EditAction::make(),

    Tables\Actions\Action::make('generateSeats')

        ->label('Generate Seats')

        ->icon('heroicon-o-squares-2x2')

        ->requiresConfirmation()

        ->action(function ($record) {

            Seat::where(
                'studio_id',
                $record->id
            )->delete();

            for ($row = 1; $row <= $record->rows; $row++) {

                $letter = chr(64 + $row);

                for (
                    $seat = 1;
                    $seat <= $record->seats_per_row;
                    $seat++
                ) {

                    Seat::create([
                        'studio_id' => $record->id,
                        'code' => $letter . $seat,
                        'row' => $letter,
                        'number' => $seat,
                    ]);
                }
            }

                        Notification::make()
                            ->title('Seats generated')
                            ->success()
                            ->send();
                    }),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return 
        [
            RelationManagers\SeatsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudios::route('/'),
            'create' => Pages\CreateStudio::route('/create'),
            'edit' => Pages\EditStudio::route('/{record}/edit'),
        ];
    }
}
