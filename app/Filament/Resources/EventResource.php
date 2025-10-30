<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Eventos';

    protected static ?string $modelLabel = 'Evento';

    protected static ?string $pluralModelLabel = 'Eventos';

    protected static ?string $navigationGroup = 'Gerenciamento';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informações do Evento')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Descrição')
                            ->required()
                            ->rows(3),
                        Forms\Components\DatePicker::make('event_date')
                            ->label('Data do Evento')
                            ->required(),
                        Forms\Components\TimePicker::make('start_time')
                            ->label('Horário de Início')
                            ->required(),
                        Forms\Components\TimePicker::make('end_time')
                            ->label('Horário de Término')
                            ->required(),
                    ])->columns(2),
                
                Forms\Components\Section::make('Localização')
                    ->schema([
                        Forms\Components\TextInput::make('location')
                            ->label('Local')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('city')
                            ->label('Cidade')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('state')
                            ->label('Estado')
                            ->options([
                                'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas',
                                'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo',
                                'GO' => 'Goiás', 'MA' => 'Maranhão', 'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul',
                                'MG' => 'Minas Gerais', 'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná',
                                'PE' => 'Pernambuco', 'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
                                'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima', 'SC' => 'Santa Catarina',
                                'SP' => 'São Paulo', 'SE' => 'Sergipe', 'TO' => 'Tocantins'
                            ])
                            ->required(),
                    ])->columns(3),
                
                Forms\Components\Section::make('Conteúdo')
                    ->schema([
                        Forms\Components\Textarea::make('about_text')
                            ->label('Sobre o Evento')
                            ->required()
                            ->rows(4),
                        Forms\Components\Textarea::make('kit_description')
                            ->label('Descrição do Kit')
                            ->required()
                            ->rows(3),
                        Forms\Components\TextInput::make('kit_limit')
                            ->label('Limite de Kits')
                            ->numeric()
                            ->default(2000)
                            ->required(),
                    ]),
                
                Forms\Components\Section::make('Configurações')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Evento Ativo')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('event_date')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->label('Local')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->label('Cidade')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Ativo')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('Todos')
                    ->trueLabel('Ativos')
                    ->falseLabel('Inativos'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('event_date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can('view-events');
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can('create-events');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()->can('edit-events');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()->can('delete-events');
    }
}

                                'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo',
                                'GO' => 'Goiás', 'MA' => 'Maranhão', 'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul',
                                'MG' => 'Minas Gerais', 'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná',
                                'PE' => 'Pernambuco', 'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
                                'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima', 'SC' => 'Santa Catarina',
                                'SP' => 'São Paulo', 'SE' => 'Sergipe', 'TO' => 'Tocantins'
                            ])
                            ->required(),
                    ])->columns(3),
                
                Forms\Components\Section::make('Conteúdo')
                    ->schema([
                        Forms\Components\Textarea::make('about_text')
                            ->label('Sobre o Evento')
                            ->required()
                            ->rows(4),
                        Forms\Components\Textarea::make('kit_description')
                            ->label('Descrição do Kit')
                            ->required()
                            ->rows(3),
                        Forms\Components\TextInput::make('kit_limit')
                            ->label('Limite de Kits')
                            ->numeric()
                            ->default(2000)
                            ->required(),
                    ]),
                
                Forms\Components\Section::make('Configurações')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Evento Ativo')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('event_date')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->label('Local')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->label('Cidade')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Ativo')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('Todos')
                    ->trueLabel('Ativos')
                    ->falseLabel('Inativos'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('event_date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can('view-events');
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can('create-events');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()->can('edit-events');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()->can('delete-events');
    }
}
