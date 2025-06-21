<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../Sidebar/style.css">
    <script src="../Login/inactivity.js"></script>
    <link rel="stylesheet" href="sidebar-fix.css">

    <title>ALUNOS</title>
    
</head>
<body>

<?php include("../Sidebar/index.php"); ?>
<?php include("../Classe/Conexao.php") ?>

<section class="p-3">

<?php $pesquisa = isset($_GET["pesquisa"]) ? $_GET["pesquisa"] : NULL; ?>
<?php $ordenar = isset($_GET["ordenar"]) ? $_GET["ordenar"] : "ASC"; ?>

   
    <form method="get" class="mb-2 conteudo-esconder-pdf">
    <div class="row">
        <div class="col-md-4">
            <div class="input-group">
                <input type="hidden" name="ordenar" value="<?php echo $ordenar; ?>">
                <input name="pesquisa" value="<?php echo $pesquisa; ?>" type="text" class="form-control" placeholder="Buscar por nome...">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
        </div>
    </div>
</form>

    <div class="col-12 text-end conteudo-esconder-pdf">
        <div class="d-inline">
            <button class="btn btn-danger botao-gerar-pdf">
                <i class="bi bi-file-earmark-pdf"></i> GERAR PDF
            </button>
        </div>
        <div class="d-inline">
            <div class="dropdown d-inline">
                <button class="btn btn-warning dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">ORDENAR</button>
                <ul class="dropdown-menu filtro-opcoes" aria-labelledby="filterDropdown">
                    <li><a class="dropdown-item" href="?pesquisa=<?php echo $pesquisa; ?>&ordenar=DESC">ALUNOS ATIVOS</a></li>
                    <li><a class="dropdown-item" href="?pesquisa=<?php echo $pesquisa; ?>&ordenar=ASC">ALUNOS INATIVOS</a></li>
                </ul>
            </div>
        </div>
    </div>
        
    <table class="table table-striped table-hover mt-3 text-center table-bordered table-sm">
        <thead>
        <tr>
            <th style="width: 50px;">STATUS</th>
            <th style="width: 200px;">NOME</th>
            <th style="width: 120px;">DATA DE NASCIMENTO</th>
            <th style="width: 40px;">CPF</th>
            <th style="width: 120px;">TELEFONE</th>
            <th style="width: 180px;">ENDEREÇO</th>
            <th style="width: 50px;">FREQUÊNCIA</th>
            <th style="width: 150px;">OBJETIVO</th>
            <th style="width: 120px;">DATA MATRÍCULA</th>
            <th class="conteudo-esconder-pdf" style="width: 180px;">AJUSTES</th>
        </tr>
        </thead>

        <?php include("../Listagem/cadastroSql.php"); ?>
    
    </table>

</section>

<!-- EDITAR -->
<form method="POST" id="formulario-editar" action="editar.php">
    <input type="hidden" name="id" class="form-control">
    <div class="modal fade" id="editar" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">EDITAR</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nome Completo:</label>
                            <input type="text" name="nome" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Data Nascimento:</label>
                            <input type="date" name="data_nascimento" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>CPF:</label>
                            <input type="text" name="cpf" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Telefone:</label>
                            <input type="text" name="telefone" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Endereço:</label>
                            <input type="text" name="endereco" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Frequência:</label>
                            <input type="number" name="frequencia" min="2" max="6" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Objetivo:</label>
                            <input type="text" name="objetivo" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Data de Início:</label>
                            <input type="date" name="data_matricula" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Status:</label>
                            <select name="ativo" class="form-control" required>
                                <option value="1">ATIVO</option>
                                <option value="0">INATIVO</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">FECHAR</button>
                    <button type="submit" class="btn btn-success submit">SALVAR</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="app.js"></script>
</body>
</html>

