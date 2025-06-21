<?php

include("../Classe/Conexao.php");

$nome = $_POST["nome"] ?? NULL;
$data_nascimento = $_POST["data_nascimento"] ?? NULL;
$cpf = $_POST["cpf"] ?? NULL;
$telefone = $_POST["telefone"] ?? NULL;
$endereco = $_POST["endereco"] ?? NULL;
$frequencia = $_POST["frequencia"] ?? NULL;
$objetivo = $_POST["objetivo"] ?? NULL;
$data_matricula = $_POST["data_matricula"] ?? NULL;

// Validação de cpf 
if (strlen($cpf) !== 11) {
    echo "<script>alert('CPF deve conter exatamente 11 números.'); history.back();</script>";
    exit;
}

// Validação de telefone 
if (strlen($telefone) !== 11) {
    echo "<script>alert('Telefone deve conter exatamente 11 números.'); history.back();</script>";
    exit;
}

// Verificar duplicidade
$verificar = Db::conexao()->prepare("
    SELECT COUNT(*) FROM (
        SELECT cpf FROM aluno WHERE cpf = :cpf
        UNION
        SELECT cpf FROM funcionario WHERE cpf = :cpf
    ) AS resultado
");

$verificar->bindValue(":cpf", $cpf, PDO::PARAM_STR);
$verificar->execute();
$total = $verificar->fetchColumn();

if ($total > 0) {
    echo "<script>alert('CPF já cadastrado!'); history.back();</script>";
exit;

}

$sql = ("INSERT INTO aluno 
    (nome, data_nascimento, cpf, telefone, endereco, frequencia, objetivo, data_matricula)
    VALUES 
    (:nome, :data_nascimento, :cpf, :telefone, :endereco, :frequencia, :objetivo, :data_matricula)");

$executar = Db::conexao()->prepare($sql);

$executar->bindValue(":nome", $nome, PDO::PARAM_STR);
$executar->bindValue(":data_nascimento", $data_nascimento, PDO::PARAM_STR);
$executar->bindValue(":cpf", $cpf, PDO::PARAM_STR);
$executar->bindValue(":telefone", $telefone, PDO::PARAM_STR);
$executar->bindValue(":endereco", $endereco, PDO::PARAM_STR);
$executar->bindValue(":frequencia", $frequencia, PDO::PARAM_INT);
$executar->bindValue(":objetivo", $objetivo, PDO::PARAM_STR);
$executar->bindValue(":data_matricula", $data_matricula, PDO::PARAM_STR);

$executar->execute();

header("Location: index.php");
