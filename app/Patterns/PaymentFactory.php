<?php
class PaymentFactory {
    public static function create(string $type): PaymentStrategy {
        return match($type) { 'pix'=>new PixPayment(), 'dinheiro'=>new CashPayment(), default=>new CardPayment() };
    }
}
