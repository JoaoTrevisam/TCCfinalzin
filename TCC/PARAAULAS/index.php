<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../Sidebar/style.css">
    <script src="../Login/inactivity.js"></script>
    <title>ÁREA DE CADASTRO DE FICHA</title>

    <link rel="stylesheet" href="style.css">
    <style>
        .table-responsive {
            overflow-x: auto;
        }
        .conteudo-esconder-pdf {
            display: block !important;
        }
        @media print {
            .conteudo-esconder-pdf {
                display: none !important;
            }
        }
    </style>
</head>
<body>
<?php include("../Classe/Conexao.php") ?>

<?php include("../Sidebar/index.php"); ?>

    <div class="container">
        <?php $nome_aulas = Db::conexao()->query("SELECT * FROM `criar_aula` ORDER BY `nome_aula` ASC")->fetchAll(PDO::FETCH_OBJ);?>
        <?php $alunos = Db::conexao()->query("SELECT * FROM `aluno` ORDER BY `nome` ASC")->fetchAll(PDO::FETCH_OBJ);?>
        <?php $exercicios = Db::conexao()->query("SELECT * FROM `exercicio` ORDER BY `nome` ASC")->fetchAll(PDO::FETCH_OBJ);?>
        <?php $aulas = Db::conexao()->query("SELECT ca.*, GROUP_CONCAT(a.nome SEPARATOR ', ') as alunos_nomes FROM `criar_aula` ca INNER JOIN `evento_aluno` ea ON ca.id = ea.evento_id INNER JOIN `aluno` a ON ea.aluno_id = a.id GROUP BY ca.id ORDER BY ca.nome_aula ASC")->fetchAll(PDO::FETCH_OBJ); ?>

<section class="p-3" style="margin-left:85px;"></section>

        <br>
        <div class="text-end conteudo-esconder-pdf">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#cadastrar">
            CADASTRAR <i class="bi bi-people"></i>
        </button>
        </div>   
        <br>
        
        <div class="col-12 text-end conteudo-esconder-pdf">
            <div class="d-inline">
                <button class="btn btn-danger botao-gerar-pdf">
                    <i class="bi bi-file-earmark-pdf"></i> GERAR PDF
                </button>
            </div>
        </div>

        <div class="table-responsive">
        <table class="table table-striped table-hover mt-3 text-center table-bordered">
            <thead>
                <tr>
                    <th>NOME DA AULA</th>
                    <th>ALUNOS</th>
                    <th>DIA DA AULA</th>
                    <th>HORÁRIO DA AULA</th>
                    <th>PROFESSOR</th>
                    <th class="conteudo-esconder-pdf">AJUSTES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($aulas as $aula) { ?>
                    <tr>
                        <td><?php echo $aula->nome_aula; ?></td>
                        <td><?php echo $aula->alunos_nomes; ?></td>
                        <td><?php echo $aula->dia_aula; ?></td>
                        <td><?php echo $aula->horario_aula; ?></td>
                        <td><?php echo $aula->professor_aula; ?></td>
                        <td class="conteudo-esconder-pdf">
                            <button 
                                class="btn btn-primary btn-sm botao-selecionar-aula me-1"
                                data-id="<?php echo $aula->id; ?>"
                                data-nome_aula="<?php echo $aula->nome_aula; ?>"
                                data-dia_aula="<?php echo $aula->dia_aula; ?>"
                                data-horario_aula="<?php echo $aula->horario_aula; ?>"
                                data-professor="<?php echo $aula->professor_aula; ?>"
                                data-alunos="<?php echo $aula->alunos_nomes; ?>"
                                >
                                <i class=""></i> EDITAR
                            </button>
                            <button 
                                class="btn btn-danger btn-sm gerar-pdf-aula"
                                data-nome_aula="<?php echo $aula->nome_aula; ?>"
                                data-dia_aula="<?php echo $aula->dia_aula; ?>"
                                data-horario_aula="<?php echo $aula->horario_aula; ?>"
                                data-professor="<?php echo $aula->professor_aula; ?>"
                                data-alunos="<?php echo $aula->alunos_nomes; ?>"
                                >
                                <i class="bi bi-file-earmark-pdf"></i> PDF
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>

        <form method="POST" id="formulario-cadastrar-aluno-evento">
            <div class="modal fade" id="cadastrar" data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">MATRICULA PARA AULA</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label>AULA</label>
                                    <select name="aula_id" class="form-control" required>
                                        <option value="">SELECIONE...</option>
                                        <?php foreach($nome_aulas as $nome_aula) { ?>
                                            <option value="<?php echo $nome_aula->id; ?>"><?php echo $nome_aula->nome_aula; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>          
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label>ALUNO</label>
                                    <div class="input-group">
                                        <select name="aluno_id" class="form-control" >
                                            <option value="">SELECIONE...</option>
                                            <?php foreach($alunos as $aluno) { ?>
                                                <option value="<?php echo $aluno->id; ?>"><?php echo $aluno->nome; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary botao-cadastro-alunos">ADICIONAR ALUNO</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2 bg-light pt-2 pb-2">
                                <div class="col-md-12">
                                    <table class="table table-sm table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Alunos:</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cadastro-alunos"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">FECHAR</button>
                            <button type="submit" class="btn btn-success submit">CADASTRAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form method="POST" id="formulario-editar-aluno-evento">
            <input type="hidden" name="id">
            <div class="modal fade" id="editar" data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">EDITAR MATRICULA PARA AULA</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label>AULA</label>
                                    <select name="aula_id" class="form-control" required disabled>
                                        <option value="">SELECIONE...</option>
                                        <?php foreach($nome_aulas as $nome_aula) { ?>
                                            <option value="<?php echo $nome_aula->id; ?>"><?php echo $nome_aula->nome_aula; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>          
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label>ALUNO</label>
                                    <div class="input-group">
                                        <select name="aluno_id" class="form-control" >
                                            <option value="">SELECIONE...</option>
                                            <?php foreach($alunos as $aluno) { ?>
                                                <option value="<?php echo $aluno->id; ?>"><?php echo $aluno->nome; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary botao-editar-alunos">ADICIONAR ALUNO</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2 bg-light pt-2 pb-2">
                                <div class="col-md-12">
                                    <table class="table table-sm table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Alunos:</th>
                                            </tr>
                                        </thead>
                                        <tbody id="editar-alunos"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">FECHAR</button>
                            <button type="submit" class="btn btn-success submit">EDITAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
$(document).ready(function() {
    // Variáveis de armazenamento temporário
    let alunosCadastro = [];
    let alunosEdicao = [];
    let ultimoExcluido = null;

    // Inicializar modal de cadastro
    $('#cadastrar').on('shown.bs.modal', function() {
        alunosCadastro = [];
        $("#formulario-cadastrar-aluno-evento")[0].reset();
        $("#cadastro-alunos").empty();
    });

    // Inicializar modal de edição
    $('#editar').on('shown.bs.modal', function() {
        alunosEdicao = [];
        $("#formulario-editar-aluno-evento")[0].reset();
        $("#editar-alunos").empty();
    });

    // Adicionar aluno no cadastro
    $(".botao-cadastro-alunos").on("click", function() {
        const alunoSelect = $("#formulario-cadastrar-aluno-evento select[name='aluno_id']");
        const alunoId = alunoSelect.val();
        const alunoNome = alunoSelect.find("option:selected").text();
        
        if(!alunoId) {
            alert("Selecione um aluno!");
            return;
        }

        if(alunosCadastro.some(a => a.id === alunoId)) {
            alert("Este aluno já foi adicionado!");
            return;
        }

        alunosCadastro.push({ id: alunoId, nome: alunoNome });
        renderAlunosTabela(alunosCadastro, "#cadastro-alunos");
        alunoSelect.val('');
    });

    // Adicionar aluno na edição
    $(".botao-editar-alunos").on("click", function() {
        const alunoSelect = $("#formulario-editar-aluno-evento select[name='aluno_id']");
        const alunoId = alunoSelect.val();
        const alunoNome = alunoSelect.find("option:selected").text();
        
        if(!alunoId) {
            alert("Selecione um aluno!");
            return;
        }

        if(alunosEdicao.some(a => a.id === alunoId)) {
            alert("Este aluno já foi adicionado!");
            return;
        }

        alunosEdicao.push({ id: alunoId, nome: alunoNome });
        renderAlunosTabela(alunosEdicao, "#editar-alunos");
        alunoSelect.val('');
    });

    // Abrir modal de edição
    $(document).on("click", ".botao-selecionar-aula", function() {
        const aulaId = $(this).data('id');
        const nomeAula = $(this).data('nome_aula');
        const diaAula = $(this).data('dia_aula');
        const horarioAula = $(this).data('horario_aula');
        const professor = $(this).data('professor');
        const alunos = $(this).data('alunos');

        // Limpar e preparar modal
        alunosEdicao = [];
        $("#formulario-editar-aluno-evento")[0].reset();
        $("#editar-alunos").empty();

        // Preencher dados da aula
        $("#formulario-editar-aluno-evento input[name='id']").val(aulaId);
        $("#formulario-editar-aluno-evento select[name='aula_id']").val(aulaId);
        
        // Preencher lista de alunos
        if(alunos && alunos.length > 0) {
            alunos.split(', ').forEach(alunoNome => {
                const aluno = <?php echo json_encode($alunos); ?>.find(a => a.nome === alunoNome.trim());
                if(aluno) {
                    alunosEdicao.push({ id: aluno.id, nome: aluno.nome });
                }
            });
            renderAlunosTabela(alunosEdicao, "#editar-alunos");
        }

        $("#editar").modal("show");
    });

    // Excluir aluno da lista (edição)
    $(document).on("click", ".excluir-aluno-editar", function() {
        const alunoId = $(this).data('id');
        alunosEdicao = alunosEdicao.filter(a => a.id !== alunoId);
        renderAlunosTabela(alunosEdicao, "#editar-alunos");
    });

    // Excluir aluno da lista (cadastro)
    $(document).on("click", ".excluir-aluno-cadastro", function() {
        const alunoId = $(this).data('id');
        alunosCadastro = alunosCadastro.filter(a => a.id !== alunoId);
        renderAlunosTabela(alunosCadastro, "#cadastro-alunos");
    });

    // Submeter formulário de cadastro
    $("#formulario-cadastrar-aluno-evento").on("submit", function(e) {
        e.preventDefault();
        
        const aulaId = $(this).find("select[name='aula_id']").val();
        if(!aulaId) {
            alert("Selecione uma aula!");
            return;
        }

        if(alunosCadastro.length === 0) {
            alert("Adicione pelo menos um aluno!");
            return;
        }

        const formData = $(this).serialize();
        
        $.ajax({
            url: "cadastrar_aula.php",
            method: "POST",
            data: formData + "&alunos=" + JSON.stringify(alunosCadastro),
            success: function(response) {
                // Recarregar a página após o cadastro
                location.reload();
            },
            error: function() {
                alert("Erro ao cadastrar. Tente novamente.");
            }
        });
    });

    // Submeter formulário de edição
    $("#formulario-editar-aluno-evento").on("submit", function(e) {
        e.preventDefault();
        
        const aulaId = $(this).find("input[name='id']").val();
        if(!aulaId) {
            alert("Aula inválida!");
            return;
        }

        if(alunosEdicao.length === 0) {
            alert("Adicione pelo menos um aluno!");
            return;
        }

        const formData = $(this).serialize();
        
        $.ajax({
            url: "editar_aula.php",
            method: "POST",
            data: formData + "&alunos=" + JSON.stringify(alunosEdicao),
            success: function(response) {
                // Recarregar a página após a edição
                location.reload();
            },
            error: function() {
                alert("Erro ao editar. Tente novamente.");
            }
        });
    });

    // Função auxiliar para renderizar tabela de alunos
    function renderAlunosTabela(alunos, seletorTabela) {
        let html = '';
        alunos.forEach(aluno => {
            html += `
                <tr>
                    <td>${aluno.nome}</td>
                    <td class="text-end">
                        <button type="button" class="btn btn-danger btn-sm ${seletorTabela === '#editar-alunos' ? 'excluir-aluno-editar' : 'excluir-aluno-cadastro'}" 
                                data-id="${aluno.id}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
        });
        $(seletorTabela).html(html);
    }

    // PDF Generation Functions
    $(".botao-gerar-pdf").on("click", function() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        let y = 10;

        doc.setFont("helvetica", "bold");
        doc.setFontSize(16);
        doc.text("Relatório de Alunos frequentadores de aulas", 10, y);
        y += 12;

        const tableBody = document.querySelectorAll("table tbody tr");

        doc.setFont("helvetica", "normal");
        doc.setFontSize(12);

        tableBody.forEach((row, idx) => {
            if (y > doc.internal.pageSize.height - 90) {
                doc.addPage();
                y = 10;
            }

            const startY = y;
            const nomeAula = row.children[0]?.innerText.trim() || "";
            const alunos = row.children[1]?.innerText.trim() || "";
            const diaAula = row.children[2]?.innerText.trim() || "";
            const horarioAula = row.children[3]?.innerText.trim() || "";
            const professor = row.children[4]?.innerText.trim() || "";

            doc.setFont("helvetica", "bold");
            doc.setFontSize(12);
            doc.text(`Aula: ${nomeAula}`, 15, y); y += 7;
            doc.text(`Dia: ${diaAula} às ${horarioAula}`, 15, y); y += 7;
            doc.text(`Professor: ${professor}`, 15, y); y += 7;
            doc.text(`Alunos Matriculados:`, 15, y); y += 6;

            doc.setFont("helvetica", "normal");
            alunos.split(', ').forEach(aluno => {
                if (y > doc.internal.pageSize.height - 20) {
                    doc.addPage();
                    y = 10;
                }
                doc.text(`- ${aluno.trim()}`, 20, y);
                y += 6;
            });

            const endY = y + 2;

            // Desenha um retângulo ao redor da ficha
            doc.setDrawColor(0);
            doc.setLineWidth(0.3);
            doc.rect(10, startY - 10, 190, endY - startY + 15, "S");

            y = endY + 10;
        });

        // Rodapé
        const date = new Date();
        const formattedDate = date.toLocaleString("pt-BR", {
            day: "2-digit",
            month: "2-digit",
            year: "numeric",
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit",
        });

        const pageCount = doc.internal.getNumberOfPages();
        for (let i = 1; i <= pageCount; i++) {
            doc.setPage(i);
            doc.setFontSize(10);
            doc.text(formattedDate, 10, doc.internal.pageSize.height - 10);
            const pageText = `Página ${i} de ${pageCount}`;
            const pageTextWidth = doc.getTextWidth(pageText);
            doc.text(
                pageText,
                doc.internal.pageSize.width - pageTextWidth - 10,
                doc.internal.pageSize.height - 10
            );
        }
        doc.save("Relatório Geral de Alunos.pdf");

    });

    $(document).on("click", ".gerar-pdf-aula", function() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        let y = 10;

        const nomeAula = $(this).data('nome_aula');
        const diaAula = $(this).data('dia_aula');
        const horarioAula = $(this).data('horario_aula');
        const professor = $(this).data('professor');
        const alunos = $(this).data('alunos');

        doc.setFont("helvetica", "bold");
        doc.setFontSize(16);
        doc.text(`Professor: ${professor}`, 10, y);
        y += 12;
        doc.text(`Nome da aula: ${nomeAula}`, 10, y);
        y += 12;

        const startY = y;

        doc.setFontSize(12);
        doc.setFont("helvetica", "bold");
        doc.text(`Dia: ${diaAula}`, 15, y);
        doc.text(`Horário: ${horarioAula}`, 60, y);
        y += 10;

        doc.text(`Alunos Matriculados:`, 15, y);
        y += 7;

        doc.setFont("helvetica", "normal");
        alunos.split(', ').forEach(aluno => {
            if (y > doc.internal.pageSize.height - 20) {
                doc.addPage();
                y = 10;
            }
            doc.text(`- ${aluno.trim()}`, 20, y);
            y += 7;
        });

        const endY = y + 2;
        doc.setDrawColor(0);
        doc.setLineWidth(0.3);
        doc.rect(10, startY - 10, 190, endY - startY + 15, "S");
        y = endY + 10;

        // Rodapé
        const date = new Date();
        const formattedDate = date.toLocaleString("pt-BR", {
            day: "2-digit",
            month: "2-digit",
            year: "numeric",
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit",
        });

        const pageCount = doc.internal.getNumberOfPages();
        for (let i = 1; i <= pageCount; i++) {
            doc.setPage(i);
            doc.setFontSize(10);
            doc.text(formattedDate, 10, doc.internal.pageSize.height - 10);
            const pageText = `Página ${i} de ${pageCount}`;
            const pageTextWidth = doc.getTextWidth(pageText);
            doc.text(
                pageText,
                doc.internal.pageSize.width - pageTextWidth - 10,
                doc.internal.pageSize.height - 10
            );
        }

        doc.save(`aula de ${nomeAula.replace(/ /g, '_')}.pdf`);
    });
});

</script>

</body>
</html>
