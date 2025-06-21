<?php
include("../Classe/Conexao.php");

try {
    $pdo = Db::conexao();

    // Coleta os dados do formulário
    $id = $_POST['id'] ?? null;
    $nome_aluno = $_POST['nome_aluno'] ?? null;
    $dia_refeicao = $_POST['dia_refeicao'] ?? null;
    $tipo_refeicao = $_POST['tipo_refeicao'] ?? null;
    $horario_refeicao = $_POST['horario_refeicao'] ?? null;
    $descricao = $_POST['descricao'] ?? null;

    // Verifica se o ID foi enviado
    if (!$id) {
        http_response_code(400);
        echo "ID da dieta não informado.";
        exit;
    }

    // Prepara e executa o UPDATE
    $sql = "UPDATE dieta SET 
                nome_aluno = :nome_aluno,
                dia_refeicao = :dia_refeicao,
                tipo_refeicao = :tipo_refeicao,
                horario_refeicao = :horario_refeicao,
                descricao = :descricao
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $id,
        ':nome_aluno' => $nome_aluno,
        ':dia_refeicao' => $dia_refeicao,
        ':tipo_refeicao' => $tipo_refeicao,
        ':horario_refeicao' => $horario_refeicao,
        ':descricao' => $descricao
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo "Erro ao editar: " . $e->getMessage();
}
