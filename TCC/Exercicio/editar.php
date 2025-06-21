<?php

include("../Classe/Conexao.php");

$id = isset($_POST["id"]) ? $_POST["id"] : NULL;
$nome = isset($_POST["nome"]) ? $_POST["nome"] : NULL;
$tipo_exercicio = isset($_POST["tipo_exercicio"]) ? $_POST["tipo_exercicio"] : NULL;
$grupo_muscular = isset($_POST["grupo_muscular"]) ? $_POST["grupo_muscular"] : NULL;


$sql = ("UPDATE `exercicio` 
            SET
               `nome` = :nome, 
                `tipo_exercicio` = :tipo_exercicio, 
                `grupo_muscular` = :grupo_muscular
            WHERE 
                `id` = :id
        ");

$executar = Db::conexao()->prepare($sql);

$executar->bindValue(":id", $id, PDO::PARAM_INT);
$executar->bindValue(":nome", $nome, PDO::PARAM_STR);
$executar->bindValue(":tipo_exercicio", $tipo_exercicio, PDO::PARAM_STR);
$executar->bindValue(":grupo_muscular", $grupo_muscular, PDO::PARAM_STR);

$executar->execute();

header("Location: index.php");