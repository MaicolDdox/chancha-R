window.reservationState = function (options) {
    return {
        zone: options.zone || null,
        taxRate: options.taxRate || 0,
        reservation: {
            start_at: options.startAt || '',
            hours: options.hours || 1,
            customer_name: options.customerName || '',
            customer_phone: options.customerPhone || '',
            notes: options.notes || '',
        },
        get subtotal() {
            if (!this.zone) {
                return 0;
            }
            return Number(this.zone.price_per_hour) * Number(this.reservation.hours || 0);
        },
        get taxes() {
            return this.subtotal * Number(this.taxRate || 0);
        },
        get total() {
            return this.subtotal + this.taxes;
        },
        formatMoney(value) {
            return '$' + Number(value || 0).toFixed(2);
        },
    };
};
