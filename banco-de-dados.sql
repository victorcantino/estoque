DROP TABLE IF EXISTS estoques;

DROP TABLE IF EXISTS produtos;

DROP TABLE IF EXISTS movimentos;

CREATE TABLE estoques (
    id INTEGER PRIMARY KEY,
    nome TEXT,
    status TEXT DEFAULT 'ATIVADO',
    criadoEm TEXT,
    atualizadoEm TEXT
);

CREATE TABLE produtos (
    id INTEGER PRIMARY KEY,
    id_estoque INTEGER,
    nome TEXT,
    status TEXT DEFAULT 'ATIVADO',
    saldo REAL,
    criadoEm TEXT,
    atualizadoEm TEXT,
    FOREIGN KEY (id_estoque) REFERENCES estoques (id)
);

CREATE TABLE movimentos (
    id INTEGER PRIMARY KEY,
    id_estoque INTEGER,
    id_produto INTEGER,
    nome TEXT,
    status TEXT DEFAULT 'ATIVADO',
    quantidade REAL,
    criadoEm TEXT,
    atualizadoEm TEXT,
    FOREIGN KEY (id_estoque) REFERENCES estoques (id),
    FOREIGN KEY (id_produto) REFERENCES produtos (id)
);