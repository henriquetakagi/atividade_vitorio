# Procedimento Operacional Padrão (POP) - Implantação do Sistema PDV

**Objetivo:** Padronizar e guiar a instalação e configuração do Sistema de Vendas no ambiente de produção ou desenvolvimento local.

## 📌 Pré-requisitos
*   PHP 8.0 ou superior.
*   Servidor Web (Apache/Nginx) ou CLI do PHP para testes locais.
*   MySQL ou MariaDB (SGBD).
*   Composer (Opcional, para gestão de dependências futuras).

## 🚀 Passo a Passo de Instalação

1. **Clonagem do Repositório**
   Abra o terminal e execute:
   `git clone [LINK_DO_SEU_GITHUB]`
   `cd UTIMA-AULA-main`

2. **Configuração do Banco de Dados**
   * Acesse o seu SGBD (ex: phpMyAdmin, DBeaver) e crie um banco de dados chamado `sistema_vendas`.
   * Importe o arquivo de estrutura localizado em: `database/schema.sql`.
   * Renomeie o arquivo `.env.example` (se houver) para `.env` e configure as credenciais do banco (usuário e senha) ou ajuste diretamente em `config/database.php`.

3. **Execução do Servidor Local**
   No terminal, dentro da pasta raiz do projeto, inicie o servidor embutido do PHP:
   `php -S localhost:8000`

4. **Acesso ao Sistema**
   Abra o navegador e acesse: `http://localhost:8000`. O sistema estará pronto para cadastro de clientes, processamento do carrinho de vendas e emissão de relatórios.