<?php
define('HOST', 'localhost');
define('USUARIO', 'epiz_33720729');
define('SENHA', '9KlPjRNdvRR6');
define('DB', 'epiz_33720729_oxigenio');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar'.HOST. USUARIO. SENHA.DB);