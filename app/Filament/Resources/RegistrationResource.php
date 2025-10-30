<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegistrationResource\Pages;
use App\Models\Registration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RegistrationResource extends Resource
{
    protected static ?string $model = Registration::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Inscrições';

    protected static ?string $modelLabel = 'Inscrição';

    protected static ?string $pluralModelLabel = 'Inscrições';

    protected static ?string $navigationGroup = 'Gerenciamento';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informações Pessoais')
                    ->schema([
                        Forms\Components\TextInput::make('full_name')
                            ->label('Nome Completo')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('cpf')
                            ->label('CPF')
                            ->required()
                            ->maxLength(14)
                            ->mask('999.999.999-99'),
                        Forms\Components\TextInput::make('email')
                            ->label('E-mail')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Telefone')
                            ->required()
                            ->maxLength(20)
                            ->mask('(99) 99999-9999'),
                        Forms\Components\DatePicker::make('birth_date')
                            ->label('Data de Nascimento')
                            ->required(),
                        Forms\Components\Select::make('gender')
                            ->label('Sexo')
                            ->options([
                                'masculino' => 'Masculino',
                                'feminino' => 'Feminino',
                                'outro' => 'Outro',
                            ])
                            ->required(),
                        Forms\Components\Select::make('shirt_size')
                            ->label('Tamanho da Camiseta')
                            ->options([
                                'PP' => 'PP',
                                'P' => 'P',
                                'M' => 'M',
                                'G' => 'G',
                                'GG' => 'GG',
                                'XG' => 'XG',
                            ])
                            ->required(),
                    ])->columns(2),
                
                Forms\Components\Section::make('Endereço')
                    ->schema([
                        Forms\Components\TextInput::make('zip_code')
                            ->label('CEP')
                            ->required()
                            ->maxLength(9)
                            ->mask('99999-999'),
                        Forms\Components\TextInput::make('address')
                            ->label('Endereço')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('number')
                            ->label('Número')
                            ->required()
                            ->maxLength(10),
                        Forms\Components\TextInput::make('neighborhood')
                            ->label('Bairro')
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
                        Forms\Components\TextInput::make('country')
                            ->label('País')
                            ->default('Brasil')
                            ->maxLength(255),
                    ])->columns(3),
                
                Forms\Components\Section::make('Configurações')
                    ->schema([
                        Forms\Components\Select::make('event_id')
                            ->label('Evento')
                            ->relationship('event', 'title')
                            ->required(),
                        Forms\Components\Toggle::make('has_kit')
                            ->label('Possui Kit'),
                        Forms\Components\Toggle::make('terms_accepted')
                            ->label('Termos Aceitos')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cpf')
                    ->label('CPF')
                    ->searchable()
                    ->formatStateUsing(fn (string $state): string => preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $state)),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telefone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('event.title')
                    ->label('Evento')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('has_kit')
                    ->label('Kit')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Inscrito em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('event_id')
                    ->label('Evento')
                    ->relationship('event', 'title'),
                Tables\Filters\TernaryFilter::make('has_kit')
                    ->label('Possui Kit')
                    ->placeholder('Todos')
                    ->trueLabel('Com Kit')
                    ->falseLabel('Sem Kit'),
                Tables\Filters\SelectFilter::make('gender')
                    ->label('Sexo')
                    ->options([
                        'masculino' => 'Masculino',
                        'feminino' => 'Feminino',
                        'outro' => 'Outro',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('export')
                        ->label('Exportar')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->action(function ($records) {
                            // Implementar exportação
                        }),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegistrations::route('/'),
            'create' => Pages\CreateRegistration::route('/create'),
            'edit' => Pages\EditRegistration::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can('view-registrations');
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can('create-registrations');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()->can('edit-registrations');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()->can('delete-registrations');
    }
}

                                'PP' => 'PP',
                                'P' => 'P',
                                'M' => 'M',
                                'G' => 'G',
                                'GG' => 'GG',
                                'XG' => 'XG',
                            ])
                            ->required(),
                    ])->columns(2),
                
                Forms\Components\Section::make('Endereço')
                    ->schema([
                        Forms\Components\TextInput::make('zip_code')
                            ->label('CEP')
                            ->required()
                            ->maxLength(9)
                            ->mask('99999-999'),
                        Forms\Components\TextInput::make('address')
                            ->label('Endereço')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('number')
                            ->label('Número')
                            ->required()
                            ->maxLength(10),
                        Forms\Components\TextInput::make('neighborhood')
                            ->label('Bairro')
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
                        Forms\Components\TextInput::make('country')
                            ->label('País')
                            ->default('Brasil')
                            ->maxLength(255),
                    ])->columns(3),
                
                Forms\Components\Section::make('Configurações')
                    ->schema([
                        Forms\Components\Select::make('event_id')
                            ->label('Evento')
                            ->relationship('event', 'title')
                            ->required(),
                        Forms\Components\Toggle::make('has_kit')
                            ->label('Possui Kit'),
                        Forms\Components\Toggle::make('terms_accepted')
                            ->label('Termos Aceitos')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cpf')
                    ->label('CPF')
                    ->searchable()
                    ->formatStateUsing(fn (string $state): string => preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $state)),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telefone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('event.title')
                    ->label('Evento')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('has_kit')
                    ->label('Kit')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Inscrito em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('event_id')
                    ->label('Evento')
                    ->relationship('event', 'title'),
                Tables\Filters\TernaryFilter::make('has_kit')
                    ->label('Possui Kit')
                    ->placeholder('Todos')
                    ->trueLabel('Com Kit')
                    ->falseLabel('Sem Kit'),
                Tables\Filters\SelectFilter::make('gender')
                    ->label('Sexo')
                    ->options([
                        'masculino' => 'Masculino',
                        'feminino' => 'Feminino',
                        'outro' => 'Outro',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('export')
                        ->label('Exportar')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->action(function ($records) {
                            // Implementar exportação
                        }),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegistrations::route('/'),
            'create' => Pages\CreateRegistration::route('/create'),
            'edit' => Pages\EditRegistration::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can('view-registrations');
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can('create-registrations');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()->can('edit-registrations');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()->can('delete-registrations');
    }
}
