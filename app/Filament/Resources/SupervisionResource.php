<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupervisionResource\Pages;
use App\Filament\Resources\SupervisionResource\RelationManagers;
use App\Models\LectureActivity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use App\Models\User;

class SupervisionResource extends Resource
{
    protected static ?string $model = LectureActivity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('student_id')->label('Pilih Mahasiswa')->relationship('student', 'name')->searchable()->preload()->options(fn() =>User::where('role', 'students')->pluck('name', 'id'))->required(),
                Forms\Components\TextInput::make('notes')->label('Catatan')->required()->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.name')->label('Mahasiswa'),
                TextColumn::make('notes')->label('Catatan'),
            ])
            ->filters([
                //Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListSupervisions::route('/'),
            'create' => Pages\CreateSupervision::route('/create'),
            'view' => Pages\ViewSupervision::route('/{record}'),
            'edit' => Pages\EditSupervision::route('/{record}/edit'),
        ];
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'lectures';
    }

    public static function getEloquentQuery(): Builder{
        $user = auth()->user();
        return parent::getEloquentQuery()->where('lecture_id', $user->id);
    }
}
