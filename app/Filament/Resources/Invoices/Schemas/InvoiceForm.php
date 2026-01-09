<?php

namespace App\Filament\Resources\Invoices\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('reservation_id')
                    ->relationship('reservation', 'id')
                    ->required(),
                TextInput::make('invoice_number')
                    ->required(),
                TextInput::make('subtotal')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('taxes')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('total')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Select::make('status')
                    ->options(['pendiente' => 'Pendiente', 'pagada' => 'Pagada', 'anulada' => 'Anulada'])
                    ->default('pendiente')
                    ->required(),
                Select::make('payment_method')
                    ->options([
            'efectivo' => 'Efectivo',
            'tarjeta' => 'Tarjeta',
            'transferencia' => 'Transferencia',
            'pse' => 'Pse',
        ]),
                DateTimePicker::make('paid_at'),
                TextInput::make('pdf_path'),
                TextInput::make('payload'),
            ]);
    }
}
