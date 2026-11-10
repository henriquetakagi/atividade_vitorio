<?php
interface PaymentStrategy { public function calcular(float $total): float; public function nome(): string; }
class PixPayment implements PaymentStrategy { public function calcular(float $total): float { return $total * 0.98; } public function nome(): string { return 'Pix (2% de desconto)'; } }
class CashPayment implements PaymentStrategy { public function calcular(float $total): float { return $total * 0.97; } public function nome(): string { return 'Dinheiro (3% de desconto)'; } }
class CardPayment implements PaymentStrategy { public function calcular(float $total): float { return $total; } public function nome(): string { return 'Cartão'; } }
