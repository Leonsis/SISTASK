CREATE DATABASE SisTasks;
USE SisTasks; 

DROP TABLE IF EXISTS TASKS;
DROP TABLE IF EXISTS USERS;
DROP TABLE IF EXISTS EMPRESA;

CREATE TABLE EMPRESA (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    CNPJ VARCHAR(14) NOT NULL UNIQUE, -- UNIQUE para garantir que não haja duplicidade de CNPJ
    RAZAO_SOCIAL VARCHAR(255) NOT NULL,
    NOME_FANTASIA VARCHAR(255) NOT NULL,
    DATA_ABERTURA DATETIME NULL,
    SITUACAO_CADASTRAL TINYINT NOT NULL DEFAULT 1,  -- 1 - Ativo | 0 - Inativo
    DATA_CADASTRO DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE USERS (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    NOME VARCHAR(100) NOT NULL,
    EMPRESA_ID INT NOT NULL,
    FOREIGN KEY (EMPRESA_ID) REFERENCES EMPRESA(ID),
    TIP_USUARIO TINYINT NOT NULL DEFAULT 1, -- 1 - Usuario Responsavel pelo chamado | 0 - Usuario que solicita o chamado
    CPF VARCHAR(11) NOT NULL UNIQUE, -- UNIQUE para garantir que não haja duplicidade de CPF
    TELEFONE VARCHAR(20) NOT NULL,
    EMAIL VARCHAR(100) NOT NULL,
    PASSWORD VARCHAR(255) NOT NULL,
    SITUACAO_CADASTRAL TINYINT NOT NULL DEFAULT 1,  -- 1 - Ativo | 0 - Inativo
    DATA_CADASTRO DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

/* 
 * O TIP_USUARIO define se o usurio é responsavel por reslver o chamado ou por solicitar o chamado. 
 * O usuario que for responsavel pode ver os chamados de todas as empresas no qual foi relacionado e criar chamados.
 * 
 * Se uma Empresa e desativada, então todos os usuarios relacionados a quela empresa tambem serão
 * 
 * Todo usuario é uma pessoa fisica, que é relacionada a uma empresa.
*/

CREATE TABLE TASKS (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    EMPRESA_SOLICI_ID INT NOT NULL,
    FOREIGN KEY (EMPRESA_SOLICI_ID) REFERENCES EMPRESA(ID),
    USER_SOLICI_ID INT NOT NULL,
    FOREIGN KEY (USER_SOLICI_ID) REFERENCES USERS(ID),
    USER_RESPO_ID INT NOT NULL,
    FOREIGN KEY (USER_RESPO_ID) REFERENCES USERS(ID),
    NOME_CHAMADO VARCHAR(200) NOT NULL UNIQUE,
    TITULO VARCHAR(200) NOT NULL,
    DESCRICAO VARCHAR(5000) NULL,
    DETALHES JSON,
    DATA_CRIACAO DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    DATA_INICIO DATETIME NULL,
    DATA_ENTREGA DATETIME NULL,
    STATUS INT NOT NULL DEFAULT 1 -- 0 - Cancelado | 1 - Não iniciado | 2 - iniciado | 3 - Finalizado
);

/*
 * Se uma empresa estiver com a situação cadastral igual a ) então o status das taks será igual a 0(Cancelado)
 *
 * A coluna detalhes é um array para que sejá possivel guardar varias informações em um unico bloco de detalhe 
 * a respeito da task
*/