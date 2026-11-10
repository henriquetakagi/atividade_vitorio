<?php
class ProdutoRepository {
    public function __construct(private PDO $db) {}
    public function todos(): array { return $this->db->query('SELECT * FROM produtos WHERE ativo=1 ORDER BY nome')->fetchAll(); }
    public function buscar(int $id): ?array { $s=$this->db->prepare('SELECT * FROM produtos WHERE id=? AND ativo=1'); $s->execute([$id]); return $s->fetch() ?: null; }
    public function salvar(array $d): void { $s=$this->db->prepare('INSERT INTO produtos(nome,descricao,preco,estoque) VALUES(?,?,?,?)'); $s->execute([$d['nome'],$d['descricao'],$d['preco'],$d['estoque']]); }
    public function atualizar(int $id,array $d): void { $s=$this->db->prepare('UPDATE produtos SET nome=?,descricao=?,preco=?,estoque=? WHERE id=?'); $s->execute([$d['nome'],$d['descricao'],$d['preco'],$d['estoque'],$id]); }
    public function excluir(int $id): void { $s=$this->db->prepare('UPDATE produtos SET ativo=0 WHERE id=?'); $s->execute([$id]); }
}
