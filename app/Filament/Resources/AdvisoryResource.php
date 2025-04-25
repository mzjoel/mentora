<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdvisoryResource\Pages;
use App\Filament\Resources\AdvisoryResource\RelationManagers;
use App\Models\Advisory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use App\Models\User;


class AdvisoryResource extends Resource
{
    protected static ?string $model = Advisory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('topic')->label('Topic Bimbingan')->required(),
                Select::make('advisor_id')->label('Pilih Dosen Pembimbing')->relationship('advisor', 'name')->searchable()->preload()->options(fn() =>User::where('role', 'lectures')->pluck('name', 'id'))->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('topic')->label('Topik Bimbingan'),
                TextColumn::make('response')->label('Response'),
                TextColumn::make('advisor.name')->label('Dosen Pembimbing'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
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

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        return parent::getEloquentQuery()->where('student_id', $user->id);
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'students';
    }

    public static function getRelations(): array
    {
        return [
            
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdvisories::route('/'),
            'create' => Pages\CreateAdvisory::route('/create'),
            'view' => Pages\ViewAdvisory::route('/{record}'),
            'edit' => Pages\EditAdvisory::route('/{record}/edit'),
        ];
    }

}
