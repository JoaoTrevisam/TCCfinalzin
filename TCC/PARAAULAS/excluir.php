<?php
include("../Classe/Conexao.php");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo "Método não permitido";
    exit;
}

$id = isset($_GET["id"]) ? $_GET["id"] : NULL;

if (!$id) {
    http_response_code(400);
    echo "ID é obrigatório";
    exit;
}

try {
    $conexao = Db::conexao();
    
    // Excluir a relação aluno-evento
    $executarEventoAluno = $conexao->prepare("DELETE FROM `evento_aluno` WHERE `evento_id` = :id");
    $executarEventoAluno->bindValue(":id", $id, PDO::PARAM_INT); 
    $executarEventoAluno->execute();
    
    header("Location: ./");
} catch (Exception $e) {
    http_response_code(500);
    echo "Erro ao excluir: " . $e->getMessage();
}
?>