<?php
class ProdutoController {
    public function __construct(private ProdutoRepository $repo) {}
    public function index(): void { $produtos=$this->repo->todos(); $edit=isset($_GET['editar'])?$this->repo->buscar((int)$_GET['editar']):null; $titulo='Produtos'; require __DIR__.'/../Views/produtos/index.php'; }
    public function salvar(): void { $d=['nome'=>trim($_POST['nome']??''),'descricao'=>trim($_POST['descricao']??''),'preco'=>(float)($_POST['preco']??0),'estoque'=>(int)($_POST['estoque']??0)]; if(!$d['nome']||$d['preco']<=0||$d['estoque']<0) throw new RuntimeException('Informe nome, preço maior que zero e estoque válido.'); if(!empty($_POST['id'])) $this->repo->atualizar((int)$_POST['id'],$d); else $this->repo->salvar($d); flash('Produto salvo com sucesso.'); redirect('?pagina=produtos'); }
    public function excluir(): void { $this->repo->excluir((int)$_POST['id']); flash('Produto removido da listagem.'); redirect('?pagina=produtos'); }
}
