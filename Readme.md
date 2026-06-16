# SISTASK

O **SISTASK** é um sistema web para o gerenciamento de tarefas, desenvolvido com foco na prática de rotas e na organização de arquivos.

## 🛠️ Tecnologias Utilizadas

* **Linguagem:** PHP 5.6.31
* **Banco de Dados:** MySQL
* **Arquitetura:** Padrão estrutural baseado em MVC (Model-View-Controller), implementado de forma simplificada sem a camada de *Model*
* **Roteamento:** Sistema de rotas dinâmicas customizado

---

## 📁 Estrutura de Pastas

```text
SISTASKS/
├── app/
│   ├── conexao/
│   │   ├── Conexao.php
│   │   └── script.sql
│   ├── Controllers/
│   │   ├── EmpresaController.php
│   │   └── LoginController.php
│   ├── Core/
│   │   ├── Controller.php
│   │   └── Router.php
│   └── Helpers/
│       └── helpers.php
├── public/
│   ├── bootstrap-5.3.8/
│   │   ├── css/
│   │   └── js/
│   ├── imges/
│   ├── index.php
│   ├── jquery-3.7.1.min.js
│   ├── jQuery.js
│   ├── jquery.mask.min.js
│   ├── script.js
│   └── styles.css
├── view/
│   ├── cadastrarEmpresa.php
│   ├── criarConta.php
│   ├── login.php
│   └── painel.php
├── .htaccess
├── Readme.md
├── routes.php
└── web.config
```

## 💻 Ambientes de Execução e Servidores

Este projeto foi testado e executado com sucesso em dois ambientes de servidor diferentes. Para garantir que o sistema de rotas funcione corretamente em ambos, a estrutura inclui arquivos de configuração específicos para reescrita de URL:

### 1. Servidor Apache (ou Servidor Interno do PHP)
* Utiliza o arquivo `.htaccess` incluído na raiz do projeto para o gerenciamento das rotas.

### 2. IIS (Internet Information Services - Windows)
* Utiliza o arquivo `web.config` incluído na raiz do projeto.
* **Nota de Configuração:** Para que o arquivo `web.config` funcione e processe as rotas corretamente no IIS, é obrigatório ter o módulo **URL Rewrite** instalado no servidor.

---

## 🚀 Como Executar o Projeto

1. Clone este repositório em seu diretório de servidores (ex: `www`, `htdocs` ou `inetpub/wwwroot`).
2. Configure o banco de dados 