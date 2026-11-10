<?php
require_once __DIR__ . '/../Repositories/VendaRepository.php';
require_once __DIR__ . '/../Patterns/ReportFactory.php';

class RelatorioController {
    public function index() {
        require __DIR__ . '/../Views/relatorios/index.php';
    }

    // READ (Gerar relatórios de vendas filtrados)
    public function gerar($tipo, $dataInicio, $dataFim) {
        $repositorio = new VendaRepository();
        $dados = $repositorio->buscarVendasPorPeriodo($dataInicio, $dataFim);

        // Factory Pattern para exportar em diferentes formatos (PDF, Excel, HTML)
        $relatorio = ReportFactory::criar($tipo);
        return $relatorio->exportar($dados);
    }
}