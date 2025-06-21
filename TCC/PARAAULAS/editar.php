<?php
include("../Classe/Conexao.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido"]);
    exit;
}

$dados = json_decode(file_get_contents("php://input"), true);

if (!isset($dados['id']) || !isset($dados['alunos']) || !is_array($dados['alunos'])) {
    http_response_code(400);
    echo json_encode(["erro" => "Dados incompletos ou inválidos."]);
    exit;
}

$evento_id = $dados['id'];
$alunos = $dados['alunos'];

try {
    $conexao = Db::conexao();

    $conexao->beginTransaction();

    // Verificar se o evento existe
    $stmtVerifica = $conexao->prepare("SELECT id FROM criar_aula WHERE id = :evento_id");
    $stmtVerifica->bindValue(":evento_id", $evento_id, PDO::PARAM_INT);
    $stmtVerifica->execute();
    
    if (!$stmtVerifica->fetch()) {
        throw new Exception("Aula não encontrada");
    }

    // Remove os alunos antigos
    $stmtExcluir = $conexao->prepare("DELETE FROM evento_aluno WHERE evento_id = :evento_id");
    $stmtExcluir->bindValue(":evento_id", $evento_id, PDO::PARAM_INT);
    $stmtExcluir->execute();

    // Insere os novos
    foreach ($alunos as $aluno) {
        $aluno_id = isset($aluno['id']) ? $aluno['id'] : $aluno;
        
        $stmtInserir = $conexao->prepare("INSERT INTO evento_aluno (evento_id, aluno_id) VALUES (:evento_id, :aluno_id)");
        $stmtInserir->bindValue(":evento_id", $evento_id, PDO::PARAM_INT);
        $stmtInserir->bindValue(":aluno_id", $aluno_id, PDO::PARAM_INT);
        $stmtInserir->execute();
    }

    $conexao->commit();

    echo json_encode(["mensagem" => "Alunos atualizados com sucesso"]);
} catch (Exception $e) {
    $conexao->rollBack();
    http_response_code(500);
    echo json_encode(["erro" => "Erro ao editar alunos: " . $e->getMessage()]);
}
?>
