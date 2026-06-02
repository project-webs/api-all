<?php

namespace App\Filament\Resources\Transactions\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TransactionStats extends BaseWidget
{
    protected function getStats(): array
    {
        $income = Transaction::where('type', 'income')->sum('amount');
        $expense = Transaction::where('type', 'expense')->sum('amount');
        $balance = $income - $expense;

        return [
            Stat::make('Total Uang Masuk', 'Rp ' . number_format($income, 0, ',', '.'))
                ->description('Total penerimaan kas')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Total Uang Keluar', 'Rp ' . number_format($expense, 0, ',', '.'))
                ->description('Total pengeluaran kas')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Saldo Akhir', 'Rp ' . number_format($balance, 0, ',', '.'))
                ->description('Sisa kas saat ini')
                ->descriptionIcon('heroicon-m-calculator')
                ->color($balance >= 0 ? 'success' : 'danger'),
        ];
    }
}
