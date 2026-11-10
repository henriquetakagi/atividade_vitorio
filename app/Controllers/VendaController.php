<?php
require_once __DIR__ . '/../Repositories/VendaRepository.php';
require_once __DIR__ . '/../Patterns/PaymentFactory.php';

class VendaController {
    private $repository;

    public function __construct() {
        $this->repository = new VendaRepository();
    }

    // READ (Exibir Carrinho)
    public function index() {
        $carrinho = $_SESSION['carrinho'] ?? [];
        require __DIR__ . '/../Views/vendas/index.php';
    }

    // CREATE (Finalizar Venda com Pattern Factory)
    public function checkout($metodoPagamento, $dadosCliente) {
        $carrinho = $_SESSION['carrinho'] ?? [];
        
        // Uso do Design Pattern
        $pagamento = PaymentFactory::criar($metodoPagamento);
        $status = $pagamento->processar(array_sum(array_column($carrinho, 'preco')));

        if ($status) {
            $this->repository->registrarVenda($dadosCliente, $carrinho);
            $_SESSION['carrinho'] = []; // Limpa carrinho
        }
    }
}