<?php
require_once __DIR__ . '/../Repositories/ClienteRepository.php';

class ClienteController {
    private $repository;

    public function __construct() {
        $this->repository = new ClienteRepository();
    }

    // CREATE
    public function store($data) {
        $this->repository->salvar($data['nome'], $data['email'], $data['cpf']);
        header('Location: /clientes');
    }

    // READ
    public function index() {
        $clientes = $this->repository->listarTodos();
        require __DIR__ . '/../Views/clientes/index.php'; // Carrega a View
    }

    // UPDATE
    public function update($id, $data) {
        $this->repository->atualizar($id, $data);
        header('Location: /clientes');
    }

    // DELETE
    public function delete($id) {
        $this->repository->deletar($id);
        header('Location: /clientes');
    }
}