$(document).ready(function() {
    let alunosSelecionados = [];

    // Função para renderizar a tabela de alunos
    function renderAlunosTabela(alunos, tabelaId) {
        let html = "";
        
        if (alunos.length === 0) {
            html = `<tr><td colspan="2">Nenhum aluno adicionado</td></tr>`;
        } else {
            for (let aluno of alunos) {
                html += `<tr>`;
                html += `<td>${aluno.nome}</td>`;
                html += `<td><button type="button" class="btn btn-danger btn-sm excluir-aluno" data-id="${aluno.id}">Excluir</button></td>`;
                html += `</tr>`;
            }
        }
        
        $(tabelaId).html(html);
    }

    // Botão para adicionar aluno no cadastro
    $(".botao-cadastro-alunos").on("click", function(){
        let aluno_id = $("#formulario-cadastrar-aluno-evento select[name='aluno_id']").val();
        let aluno_nome = $("#formulario-cadastrar-aluno-evento select[name='aluno_id']").find(":selected").text();

        if(!aluno_id){ 
            alert("Selecione um aluno"); 
            return; 
        }

        // Verificar se o aluno já foi adicionado
        if(alunosSelecionados.find(a => a.id == aluno_id)){
            alert("Este aluno já foi adicionado");
            return;
        }

        let obj = {
            id: aluno_id,
            nome: aluno_nome
        };

        alunosSelecionados.push(obj);
        renderAlunosTabela(alunosSelecionados, "#cadastro-alunos");
        
        // Limpar o select
        $("#formulario-cadastrar-aluno-evento select[name='aluno_id']").val("");
    });

    // Botão para adicionar aluno na edição
    $(".botao-editar-alunos").on("click", function(){
        let aluno_id = $("#formulario-editar-aluno-evento select[name='aluno_id']").val();
        let aluno_nome = $("#formulario-editar-aluno-evento select[name='aluno_id']").find(":selected").text();

        if(!aluno_id){ 
            alert("Selecione um aluno"); 
            return; 
        }

        // Verificar se o aluno já foi adicionado
        if(alunosSelecionados.find(a => a.id == aluno_id)){
            alert("Este aluno já foi adicionado");
            return;
        }

        let obj = {
            id: aluno_id,
            nome: aluno_nome
        };

        alunosSelecionados.push(obj);
        renderAlunosTabela(alunosSelecionados, "#editar-alunos");
        
        // Limpar o select
        $("#formulario-editar-aluno-evento select[name='aluno_id']").val("");
    });

    // Excluir aluno da lista
    $(document).on("click", ".excluir-aluno", function () {
        let id = $(this).data("id");
        
        // Verifica se vai ficar sem alunos após a exclusão
        if (alunosSelecionados.length === 1) {
            if (!confirm("Você está prestes a remover todos os alunos desta aula. Deseja continuar?")) {
                return; // Cancela a exclusão se o usuário não confirmar
            }
        }
        
        alunosSelecionados = alunosSelecionados.filter(a => a.id != id);
        
        // Re-renderizar a tabela apropriada
        if($("#cadastrar").hasClass("show")){
            renderAlunosTabela(alunosSelecionados, "#cadastro-alunos");
        } else {
            renderAlunosTabela(alunosSelecionados, "#editar-alunos");
        }
    });

    // Limpar lista ao abrir modal de cadastro
    $('#cadastrar').on('shown.bs.modal', function () {
        alunosSelecionados = [];
        $("#cadastro-alunos").empty();
        $("#formulario-cadastrar-aluno-evento")[0].reset();
    });

    // Submit do formulário de cadastro
    $("#formulario-cadastrar-aluno-evento").on("submit", function(e){
        e.preventDefault();
        
        let evento_id = $(this).find("select[name='aula_id']").val();
        
        if(!evento_id){
            alert("Selecione uma aula");
            return;
        }
        
        if(alunosSelecionados.length === 0){
            alert("Adicione pelo menos um aluno");
            return;
        }

        let dados = {
            evento_id: evento_id,
            alunos: alunosSelecionados.map(a => a.id)
        };

        $.ajax({
            url: "cadastrar.php",
            method: "POST",
            contentType: "application/json",
            data: JSON.stringify(dados),
            success: function(response) {
                location.reload();
            },
            error: function(xhr) {
                let erro = JSON.parse(xhr.responseText);
                alert("Erro: " + erro.erro);
            }
        });
    });

    // Botão para editar aula
    $(".botao-selecionar-aula").on("click", function () {
        let { id, nome_aula, dia_aula, horario_aula, professor } = $(this).data();

        $("#editar").modal("show");
        alunosSelecionados = [];

        $("#formulario-editar-aluno-evento input[name='id']").val(id);
        $("#formulario-editar-aluno-evento select[name='aula_id']").val(id);

        // Buscar alunos já matriculados nesta aula
        $.ajax({
            url: "buscar_alunos.php",
            type: "POST",
            data: { evento_id: id },
            dataType: "json",
            success: function(response) {
                if(response.alunos) {
                    alunosSelecionados = response.alunos;
                    renderAlunosTabela(alunosSelecionados, "#editar-alunos");
                }
            },
            error: function() {
                console.log("Erro ao buscar alunos matriculados");
            }
        });
    });

    // Submit do formulário de edição
    $("#formulario-editar-aluno-evento").on("submit", function(e){
        e.preventDefault();
        
        let evento_id = $(this).find("input[name='id']").val();
        
        // Verifica se está tentando salvar sem alunos
        if (alunosSelecionados.length === 0) {
            if (!confirm("Você está prestes a remover TODOS os alunos desta aula. Esta ação não pode ser desfeita. Deseja continuar?")) {
                return; // Cancela o submit se o usuário não confirmar
            }
        }
        
        let dados = {
            id: evento_id,
            alunos: alunosSelecionados.map(aluno => aluno.id)
        };

        $.ajax({
            url: "editar.php",
            method: "POST",
            contentType: "application/json",
            data: JSON.stringify(dados),
            success: function(response) {
                location.reload();
            },
            error: function(xhr) {
                let erro = JSON.parse(xhr.responseText);
                alert("Erro: " + erro.erro);
            }
        });
    });
});