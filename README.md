# 🛒 Sistema de Ponto de Vendas (PDV) - Avançado

Este projeto é um Sistema de Vendas estruturado com a arquitetura **MVC** e **Design Patterns**, desenvolvido para gerenciar clientes, processar vendas (carrinho) e emitir relatórios de forma escalável e manutenível.

## 🏗️ Arquitetura MVC Adotada
O projeto segue estritamente o padrão **Model-View-Controller (MVC)** para separação de responsabilidades:
*   **Model (`/app/Models` & `/app/Repositories`):** Responsável por abstrair o acesso ao banco de dados e as regras de negócio. Utilizamos o *Repository Pattern* para centralizar as queries, mantendo os Models limpos.
*   **View (`/app/Views`):** Camada de apresentação. Páginas em HTML/PHP responsáveis apenas por exibir os dados ao usuário final (Telas de Clientes, Vendas e Relatórios).
*   **Controller (`/app/Controllers`):** O intermediário que recebe as requisições do usuário (rotas), processa a lógica chamando os Repositórios e Factories, e devolve a View correspondente.

## 🧩 Design Patterns Implementados
Para resolver problemas comuns de design de software e garantir a nota no requisito de "Patterns", aplicamos os seguintes padrões:

1.  **Strategy (`PaymentStrategy.php`)**: Permite que o sistema alterne dinamicamente entre diferentes formas de pagamento (Pix, Cartão de Crédito, Dinheiro) sem encher o código de `if/else`.
2.  **Factory Method (`PaymentFactory.php` e `ReportFactory.php`)**: Usado para instanciar os objetos corretos de processamento de pagamento e de geração de relatórios com base na escolha do usuário, encapsulando a lógica de criação.
3.  **Repository (`ClienteRepository.php`, etc.)**: Abstrai a persistência de dados. O Controller não faz chamadas SQL diretas; ele pede os dados ao Repositório, facilitando futuras trocas de banco de dados.