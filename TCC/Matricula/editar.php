<?php

include("../Classe/Conexao.php");

$id = isset($_POST["id"]) ? $_POST["id"] : NULL;
$nome = isset($_POST["nome"]) ? $_POST["nome"] : NULL;
$data_nascimento = isset($_POST["data_nascimento"]) ? $_POST["data_nascimento"] : NULL;
$cpf = $_POST["cpf"] ?? NULL;
$telefone = isset($_POST["telefone"]) ? $_POST["telefone"] : NULL;
$endereco = isset($_POST["endereco"]) ? $_POST["endereco"] : NULL;
$frequencia = isset($_POST["frequencia"]) ? $_POST["frequencia"] : NULL;
$objetivo = isset($_POST["objetivo"]) ? $_POST["objetivo"] : NULL;
$data_matricula = isset($_POST["data_matricula"]) ? $_POST["data_matricula"] : NULL;
$ativo = isset($_POST["ativo"]) ? $_POST["ativo"] : 1;

// Validação de cpf 
if (strlen($cpf) !== 11) {
    echo "<script>alert('CPF deve conter exatamente 11 dígitos.'); history.back();</script>";
    exit;
}

// Validação de telefone 
if (strlen($telefone) !== 11) {
    echo "<script>alert('Telefone deve conter exatamente 11 digitos.'); history.back();</script>";
    exit;
}

// Verificar duplicidade
$verificar = Db::conexao()->prepare("
    SELECT COUNT(*) 
    FROM (
        SELECT cpf FROM aluno WHERE cpf = :cpf AND id != :id
        UNION
        SELECT cpf FROM funcionario WHERE cpf = :cpf AND id != :id
    ) AS resultado
");
$verificar->bindParam(':cpf', $cpf);
$verificar->bindParam(':id', $id);
$verificar->execute();


$sql = ("UPDATE `aluno` 
            SET
                `nome` = :nome, 
                `data_nascimento` = :data_nascimento, 
                `cpf` = :cpf,
                `telefone` = :telefone, 
                `endereco` = :endereco, 
                `frequencia` = :frequencia, 
                `objetivo` = :objetivo, 
                `data_matricula` = :data_matricula,
                `ativo` = :ativo
            WHERE 
                `id` = :id
        ");

$executar = Db::conexao()->prepare($sql);

$executar->bindValue(":id", $id, PDO::PARAM_INT);
$executar->bindValue(":nome", $nome, PDO::PARAM_STR);
$executar->bindValue(":data_nascimento", $data_nascimento, PDO::PARAM_STR);
$executar->bindValue(":cpf", $cpf, PDO::PARAM_STR);
$executar->bindValue(":telefone", $telefone, PDO::PARAM_STR);
$executar->bindValue(":endereco", $endereco, PDO::PARAM_STR);
$executar->bindValue(":frequencia", $frequencia, PDO::PARAM_INT);
$executar->bindValue(":objetivo", $objetivo, PDO::PARAM_STR);
$executar->bindValue(":data_matricula", $data_matricula, PDO::PARAM_STR);
$executar->bindValue(":ativo", $ativo, PDO::PARAM_INT);

$executar->execute();

header("Location: index.php");