CREATE TABLE tecnologias (
    -> id         INT AUTO_INCREMENT PRIMARY KEY,
    -> nome       VARCHAR(100) NOT NULL,
    -> categoria  VARCHAR(50) NOT NULL,
    -> descricao  TEXT,
    -> ano_criacao INT,
    -> criado_em   TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    -> );
Query OK, 0 rows affected (0.071 sec)

MariaDB [dwii_db]> SHOW TABLES;
+-------------------+
| Tables_in_dwii_db |
+-------------------+
| tecnologias       |
+-------------------+
1 row in set (0.000 sec)

MariaDB [dwii_db]> DESCRIBE tecnologias;
+-------------+--------------+------+-----+---------------------+----------------+
| Field       | Type         | Null | Key | Default             | Extra          |
+-------------+--------------+------+-----+---------------------+----------------+
| id          | int(11)      | NO   | PRI | NULL                | auto_increment |
| nome        | varchar(100) | NO   |     | NULL                |                |
| categoria   | varchar(50)  | NO   |     | NULL                |                |
| descricao   | text         | YES  |     | NULL                |                |
| ano_criacao | int(11)      | YES  |     | NULL                |                |
| criado_em   | timestamp    | YES  |     | current_timestamp() |                |
+-------------+--------------+------+-----+---------------------+----------------+
6 rows in set (0.001 sec)

MariaDB [dwii_db]> INSERT INTO tecnologias (nome, categoria, descricao, ano_criacao) VALUES
    -> ('HTML',       'Frontend',  'Linguagem de marcação para estrutura de páginas web.', 1993),
    -> ('CSS',        'Frontend',  'Linguagem de estilos para apresentação visual de páginas.', 1996),
    -> ('PHP',        'Backend',   'Linguagem server-side amplamente usada para web dinâmica.', 1994),
    -> ('MariaDB',    'Banco de Dados', 'Sistema de gerenciamento de banco de dados relacional open-source.', 2009),
    -> ('JavaScript', 'Frontend',  'Linguagem de programação para interatividade no navegador.', 1995),
    -> ('Git',        'DevOps',    'Sistema de controle de versão distribuído.', 2005);