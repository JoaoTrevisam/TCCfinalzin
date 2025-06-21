<?php
include("../Classe/Conexao.php");

$id = isset($_POST["id"]) && is_numeric($_POST["id"]) ? (int)$_POST["id"] : null;
if ($id !== null && 
    isset($_POST["nome_aula"], $_POST["dia_aula"], $_POST["horario_aula"], $_POST["professor_aula"], $_POST["local_aula"])) {
    
    $nome_aula = trim($_POST["nome_aula"]);
    $dia_aula = trim($_POST["dia_aula"]);
    $horario_aula = trim($_POST["horario_aula"]);
    $professor_aula = trim($_POST["professor_aula"]);
    $local_aula = trim($_POST["local_aula"]);

    if (empty($nome_aula) || empty($dia_aula) || empty($horario_aula) || empty($professor_aula || empty($local_aula))) {
        die("<script>alert('Todos os campos são obrigatórios!'); history.back();</script>");
    }

    try {
        $sql = "UPDATE `criar_aula` 
                SET 
                    `nome_aula` = :nome_aula,
                    `dia_aula` = :dia_aula,
                    `horario_aula` = :horario_aula,
                    `professor_aula` = :professor_aula,
                    `local_aula` = :local_aula
                WHERE `id` = :id";

        $conexao = Db::conexao();
        $stmt = $conexao->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":nome_aula", $nome_aula, PDO::PARAM_STR);
        $stmt->bindValue(":dia_aula", $dia_aula, PDO::PARAM_STR);
        $stmt->bindValue(":horario_aula", $horario_aula, PDO::PARAM_STR);
        $stmt->bindValue(":professor_aula", $professor_aula, PDO::PARAM_STR);
        $stmt->bindValue(":local_aula", $local_aula, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // Redireciona com mensagem de sucesso
            header("Location: index.php?success=1");
            exit;
        } else {
            throw new Exception("Erro ao executar a atualização");
        }
        
    } catch (PDOException $e) {
        // Log do erro (em produção, grave em um arquivo de log)
        error_log("Erro ao atualizar aula: " . $e->getMessage());
        
        // Mensagem amigável para o usuário
        die("<script>alert('Erro ao atualizar a aula. Por favor, tente novamente.'); history.back();</script>");
    }
} else {
    // Campos faltando ou ID inválido
    die("<script>alert('Dados incompletos ou inválidos!'); history.back();</script>");
}