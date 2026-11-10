<?php
class ClienteRepository {
    public function __construct(private PDO $db) {}
    public function todos(): array { return $this->db->query('SELECT * FROM clientes ORDER BY nome')->fetchAll(); }
    public function buscar(int $id): ?array { $s=$this->db->prepare('SELECT * FROM clientes WHERE id=?'); $s->execute([$id]); return $s->fetch() ?: null; }
    public function salvar(array $d): void {
        $s=$this->db->prepare('INSERT INTO clientes (nome,cpf,telefone,email) VALUES (?,?,?,?)');
        $s->execute([$d['nome'],$d['cpf'] ?: null,$d['telefone'] ?: null,$d['email'] ?: null]);
    }
    public function atualizar(int $id,array $d): void {
        $s=$this->db->prepare('UPDATE clientes SET nome=?,cpf=?,telefone=?,email=? WHERE id=?');
        $s->execute([$d['nome'],$d['cpf'] ?: null,$d['telefone'] ?: null,$d['email'] ?: null,$id]);
    }
    public function excluir(int $id): void { $s=$this->db->prepare('DELETE FROM clientes WHERE id=?'); $s->execute([$id]); }
}
