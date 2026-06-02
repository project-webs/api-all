<?php

namespace App\Filament\Resources\Contributions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ContributionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('member_id')
                    ->label('Anggota')
                    ->relationship('member', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                DatePicker::make('period')
                    ->label('Periode Bulan')
                    ->native(false)
                    ->displayFormat('F Y')
                    ->format('Y-m-d')
                    ->default(now()->startOfMonth())
                    ->required(),
                TextInput::make('amount')
                    ->label('Jumlah Iuran')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->default(20000),
                DatePicker::make('payment_date')
                    ->label('Tanggal Bayar')
                    ->default(now()),
                Select::make('status')
                    ->label('Status Pembayaran')
                    ->options([
                        'paid' => 'Lunas',
                        'unpaid' => 'Belum Lunas',
                    ])
                    ->required()
                    ->default('paid'),
                Textarea::make('notes')
                    ->label('Catatan')
                    ->columnSpanFull(),
            ]);
    }
}
