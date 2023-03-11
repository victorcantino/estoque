CREATE TABLE estoque (
    id INTEGER PRIMARY KEY,
    nome TEXT,
    status TEXT
);
CREATE TABLE produto (
    id INTEGER PRIMARY KEY,
    id_estoque INTEGER,
    nome TEXT,
    status TEXT,
    saldo INTEGER,
    FOREIGN KEY (id_estoque) REFERENCES estoque (id)
);

