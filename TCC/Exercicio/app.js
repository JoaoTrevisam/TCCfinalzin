$(document).on("click", ".botao-selecionar-exercicio", function () {
    const { id, nome, tipo_exercicio, grupo_muscular } = $(this).data();

    $("#editar").modal("show");

    $("#formulario-editar input[name='id']").val(id);
    $("#formulario-editar input[name='nome']").val(nome);
    $("#formulario-editar select[name='tipo_exercicio']").val(tipo_exercicio);
    $("#formulario-editar select[name='grupo_muscular']").val(grupo_muscular);
});


$(".botao-gerar-pdf").on("click", function () {
    const element = document.body; // ou qualquer outro seletor, como: document.getElementById("seu-conteudo")

    html2canvas(element).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF("p", "mm", "a4");
        const imgProps = pdf.getImageProperties(imgData);
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

        pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
        pdf.save("exercicios.pdf");
    });
});
