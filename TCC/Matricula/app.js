$(document).ready(function () {
    $(".botao-selecionar-matricula").on("click", function () {
        let {
            id,
            nome,
            data_nascimento,
            cpf,
            telefone,
            endereco,
            frequencia,
            objetivo,
            data_matricula,
            ativo
        } = $(this).data();

        $("#editar").modal("show");

        $("#formulario-editar input[name='id']").val(id);
        $("#formulario-editar input[name='nome']").val(nome);
        $("#formulario-editar input[name='data_nascimento']").val(data_nascimento);
        $("#formulario-editar input[name='cpf']").val(cpf);
        $("#formulario-editar input[name='telefone']").val(telefone);
        $("#formulario-editar input[name='endereco']").val(endereco);
        $("#formulario-editar input[name='frequencia']").val(frequencia);
        $("#formulario-editar input[name='objetivo']").val(objetivo);
        $("#formulario-editar input[name='data_matricula']").val(data_matricula);
        $("#formulario-editar select[name='ativo']").val(ativo);
    });

    document.querySelector('.botao-gerar-pdf').addEventListener('click', function() {
        // Importando jsPDF
        const { jsPDF } = window.jspdf;

        // Criando uma nova instância do jsPDF
        const doc = new jsPDF();

        // Definindo a cor do texto
        doc.setTextColor(255, 0, 0); // Vermelho
        doc.text("Este é um texto em vermelho!", 10, 10);

        // Definindo a cor de fundo
        doc.setFillColor(0, 255, 0); // Verde
        doc.rect(10, 20, 180, 100, 'F'); // Desenha um retângulo preenchido

        // Adicionando mais texto
        doc.setTextColor(0, 0, 255); // Azul
        doc.text("Este é um texto em azul sobre um fundo verde!", 15, 50);

        // Salvando o PDF
        doc.save("documento.pdf");
    });
});
