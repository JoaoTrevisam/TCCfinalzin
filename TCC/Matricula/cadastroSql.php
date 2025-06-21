<?php function formatarCPFSeguro($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    return substr($cpf, 0, 3) . '.*.*-' . substr($cpf, -2);
}?> 
<?php
function formatarTelefone($telefone) {
    // Remove tudo que não for número
    $telefone = preg_replace('/[^0-9]/', '', $telefone);
    // Se tiver 11 dígitos (com DDD e 9 dígitos no número)
    if (strlen($telefone) == 11) {
        return '('.substr($telefone, 0, 2).')'.substr($telefone, 2, 5).'-'.substr($telefone, 7);
    }
    // Se tiver 10 dígitos (com DDD e 8 dígitos no número)
    elseif (strlen($telefone) == 10) {
        return '('.substr($telefone, 0, 2).')'.substr($telefone, 2, 4).'-'.substr($telefone, 6);
    }
    // Caso não se encaixe, retorna o original
    return $telefone;
}
?>

<tbody>
    <?php 
    $sql = ("SELECT * FROM `aluno`"); 

    if($pesquisa){
        $sql .= (" WHERE `nome` LIKE '%{$pesquisa}%'");
    }

    if($ordenar == "ASC"){
        $sql .= (" ORDER BY `ativo` ASC");
    }else if($ordenar == "DESC"){
        $sql .= (" ORDER BY `ativo` DESC");
    }

    $executar = Db::conexao()->query($sql);

    $alunos = $executar->fetchAll(PDO::FETCH_OBJ);
    ?>
    <?php foreach ($alunos as $aluno) { ?>
    <tr>
        <td>
            <?php if($aluno->ativo == 1) { ?>
                <span class="badge bg-success">ATIVO</span>
            <?php } else { ?>
                <span class="badge bg-danger">INATIVO</span>
            <?php } ?>
        </td>
        <td><?php echo $aluno->nome; ?></td>
        <td>
            <?php if($aluno->data_nascimento) { ?>
                <?php echo date('d/m/Y', strtotime($aluno->data_nascimento)); ?>
            <?php } else { ?>
                --
            <?php } ?>
        </td>
        <td><?php echo formatarCPFSeguro($aluno->cpf); ?></td>
        <td><?php echo formatarTelefone($aluno->telefone); ?></td>
        <td><?php echo $aluno->endereco; ?></td>
        <td><?php echo $aluno->frequencia; ?></td>
        <td><?php echo $aluno->objetivo; ?></td>
        <td><?php echo date('d/m/Y', strtotime($aluno->data_matricula)); ?></td>
    </tr>
<?php } ?>