<?php
class VendaRepository {
    public function __construct(private PDO $db) {}
    public function registrar(?int $clienteId,array $itens,string $pagamento,float $total): int {
        $this->db->beginTransaction();
        try {
            $s=$this->db->prepare('INSERT INTO vendas(cliente_id,total,forma_pagamento) VALUES(?,?,?)');
            $s->execute([$clienteId,$total,$pagamento]); $vendaId=(int)$this->db->lastInsertId();
            $item=$this->db->prepare('INSERT INTO itens_venda(venda_id,produto_id,quantidade,preco_unitario,subtotal) VALUES(?,?,?,?,?)');
            $estoque=$this->db->prepare('UPDATE produtos SET estoque=estoque-? WHERE id=? AND estoque>=?');
            foreach($itens as $i){
                $item->execute([$vendaId,$i['id'],$i['quantidade'],$i['preco'],$i['subtotal']]);
                $estoque->execute([$i['quantidade'],$i['id'],$i['quantidade']]);
                if($estoque->rowCount()!==1) throw new RuntimeException('Estoque insuficiente para: '.$i['nome']);
            }
            $this->db->commit(); return $vendaId;
        } catch(Throwable $e){ $this->db->rollBack(); throw $e; }
    }
    public function todas(): array {
        return $this->db->query('SELECT v.*, c.nome AS cliente_nome FROM vendas v LEFT JOIN clientes c ON c.id=v.cliente_id ORDER BY v.data_venda DESC')->fetchAll();
    }
    public function itens(int $id): array { $s=$this->db->prepare('SELECT iv.*,p.nome FROM itens_venda iv JOIN produtos p ON p.id=iv.produto_id WHERE venda_id=?'); $s->execute([$id]); return $s->fetchAll(); }
    public function resumo(): array {
        return $this->db->query("SELECT COUNT(*) AS quantidade, COALESCE(SUM(total),0) AS faturamento FROM vendas WHERE DATE(data_venda)=CURDATE()")->fetch();
    }
}
