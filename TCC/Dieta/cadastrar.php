<?php
include("../Classe/Conexao.php");

try {
    $pdo = Db::conexao();

    // Recebendo os dados via POST
    $nome_aluno = $_POST['nome_aluno'] ?? null;
    $dia_refeicao = $_POST['dia_refeicao'] ?? null;
    $tipo_refeicao = $_POST['tipo_refeicao'] ?? $_POST['tipo_refeicao'] ?? null; // cuidado: tem dois 'dia_treino'
    $horario_refeicao = $_POST['horario_refeicao'] ?? null;
    $descricao = $_POST['descricao'] ?? null;

    if (!$nome_aluno || !$dia_refeicao || !$tipo_refeicao || !$horario_refeicao) {
        http_response_code(400);
        echo "Campos obrigatórios não preenchidos!";
        exit;
    }

    $sql = "INSERT INTO dieta (nome_aluno, dia_refeicao, tipo_refeicao, horario_refeicao, descricao) 
            VALUES (:nome_aluno, :dia_refeicao, :tipo_refeicao, :horario_refeicao, :descricao)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome_aluno' => $nome_aluno,
        ':dia_refeicao' => $dia_refeicao,
        ':tipo_refeicao' => $tipo_refeicao,
        ':horario_refeicao' => $horario_refeicao,
        ':descricao' => $descricao,
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo "Erro ao cadastrar: " . $e->getMessage();
}
