<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('date')
                    ->label('Tanggal Transaksi')
                    ->default(now())
                    ->required(),
                Select::make('type')
                    ->label('Jenis Transaksi')
                    ->options([
                        'income' => 'Uang Masuk (Debit)',
                        'expense' => 'Uang Keluar (Kredit)',
                    ])
                    ->default('income')
                    ->required(),
                TextInput::make('amount')
                    ->label('Nominal')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
                TextInput::make('description')
                    ->label('Keterangan')
                    ->required(),
                Textarea::make('notes')
                    ->label('Catatan')
                    ->columnSpanFull(),
            ]);
    }
}
