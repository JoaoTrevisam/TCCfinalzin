<?php
include("../Classe/Conexao.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido"]);
    exit;
}

$dados = json_decode(file_get_contents("php://input"), true);

// Validando os dados
if (!isset($dados['evento_id']) || !isset($dados['alunos']) || !is_array($dados['alunos'])) {
    http_response_code(400);
    echo json_encode(["erro" => "Dados inválidos"]);
    exit;
}

$evento_id = $dados['evento_id'];
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

    // Verificar se a aula já tem alunos cadastrados
    $stmtVerificaAula = $conexao->prepare("SELECT COUNT(*) FROM evento_aluno WHERE evento_id = :evento_id");
    $stmtVerificaAula->bindValue(":evento_id", $evento_id, PDO::PARAM_INT);
    $stmtVerificaAula->execute();
    
    if ($stmtVerificaAula->fetchColumn() > 0) {
        throw new Exception("Esta aula já possui alunos cadastrados. Use a função de edição para adicionar mais alunos.");
    }

    foreach ($alunos as $aluno_id) {
        $stmt = $conexao->prepare("INSERT INTO evento_aluno (evento_id, aluno_id) VALUES (:evento_id, :aluno_id)");
        $stmt->bindValue(":evento_id", $evento_id, PDO::PARAM_INT);
        $stmt->bindValue(":aluno_id", $aluno_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    $conexao->commit();

    echo json_encode(["mensagem" => "Alunos cadastrados com sucesso"]);

} catch (Exception $e) {
    $conexao->rollBack();
    http_response_code(500);
    echo json_encode(["erro" => "Erro ao cadastrar: " . $e->getMessage()]);
}
?>
