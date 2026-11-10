<?php
session_start();
require_once __DIR__.'/config/database.php';
require_once __DIR__.'/app/Repositories/ClienteRepository.php';
require_once __DIR__.'/app/Repositories/ProdutoRepository.php';
require_once __DIR__.'/app/Repositories/VendaRepository.php';
// Carregamento explícito das classes de padrões e controladores.
require_once __DIR__.'/app/Patterns/PaymentStrategy.php';
require_once __DIR__.'/app/Patterns/PaymentFactory.php';
require_once __DIR__.'/app/Patterns/ReportFactory.php';
require_once __DIR__.'/app/Controllers/ClienteController.php';
require_once __DIR__.'/app/Controllers/ProdutoController.php';
require_once __DIR__.'/app/Controllers/VendaController.php';
require_once __DIR__.'/app/Controllers/RelatorioController.php';
function e($v): string { return htmlspecialchars((string)($v ?? ''), ENT_QUOTES, 'UTF-8'); }
function money($v): string { return 'R$ '.number_format((float)$v,2,',','.'); }
function flash(?string $message=null): ?string { if($message!==null){$_SESSION['flash']=$message;return null;} $m=$_SESSION['flash']??null;unset($_SESSION['flash']);return $m; }
function redirect(string $url): never { header('Location: '.$url); exit; }
$clienteRepo=new ClienteRepository($pdo); $produtoRepo=new ProdutoRepository($pdo); $vendaRepo=new VendaRepository($pdo);
$pagina=$_GET['pagina']??'inicio'; $acao=$_GET['acao']??'index';
try {
 if($pagina==='clientes'){ $c=new ClienteController($clienteRepo); if($acao==='salvar' && $_SERVER['REQUEST_METHOD']==='POST') $c->salvar(); elseif($acao==='excluir' && $_SERVER['REQUEST_METHOD']==='POST') $c->excluir(); else $c->index(); }
 elseif($pagina==='produtos'){ $c=new ProdutoController($produtoRepo); if($acao==='salvar' && $_SERVER['REQUEST_METHOD']==='POST') $c->salvar(); elseif($acao==='excluir' && $_SERVER['REQUEST_METHOD']==='POST') $c->excluir(); else $c->index(); }
 elseif($pagina==='vendas'){ $c=new VendaController($pdo,$produtoRepo,$clienteRepo,$vendaRepo); if($acao==='finalizar' && $_SERVER['REQUEST_METHOD']==='POST') $c->finalizar(); else $c->index(); }
 elseif($pagina==='relatorios'){ (new RelatorioController($vendaRepo))->index(); }
 else { $titulo='Painel inicial'; require __DIR__.'/app/Views/layouts/header.php'; echo '<section class="hero"><span class="eyebrow">PAINEL DE CONTROLE</span><h1>Bem-vindo ao Vitrine PDV</h1><p>Gerencie clientes, produtos, vendas e acompanhe seus resultados em um só lugar.</p><div class="actions"><a class="button" href="?pagina=vendas">Iniciar uma venda</a><a class="button secondary-link" href="?pagina=relatorios">Ver relatórios</a></div></section><div class="cards"><a class="metric link-card" href="?pagina=clientes"><span>Cadastros</span><strong>Clientes</strong><small>Adicionar e consultar clientes</small></a><a class="metric link-card" href="?pagina=produtos"><span>Estoque</span><strong>Produtos</strong><small>Gerenciar catálogo e estoque</small></a><a class="metric link-card" href="?pagina=vendas"><span>Operação</span><strong>Vendas</strong><small>Montar carrinho e finalizar</small></a></div>'; require __DIR__.'/app/Views/layouts/footer.php'; }
} catch(Throwable $e){ http_response_code(400); $titulo='Ocorreu um problema'; require __DIR__.'/app/Views/layouts/header.php'; echo '<div class="alert error">'.e($e->getMessage()).'</div><a href="javascript:history.back()">Voltar</a>'; require __DIR__.'/app/Views/layouts/footer.php'; }
