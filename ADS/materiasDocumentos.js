$(document).ready(function () {
    $('#divTableDocumentos').css("display", "none");
    $('#nova_materia_form').css("display", "none");
});

// Busca as matÃ©rias da sÃ©rie
$(document).on('click', '.lista_materias_button', function () {
    $('#tableMateriasBody').html('');

    var serie_id = $(this).attr('id');

    $('#serie_id_input').val(serie_id);
    $('#id_serie').val(serie_id);
    
    // Chamada da funÃ§Ã£o que obtem as matÃ©rias
    getMaterias();
});

$('.btn_nova_materia').on('click', function() {
    $('#id_serie').val($(this).attr('id'));
});

// Busca os documentos da matÃ©ria
$(document).on('click', '.materia_id_button', function () {
    $('#materia_id_input').remove();

    $('#materia_id_input').val($(this).attr('id'));

    var materia_id = $(this).attr('id');

    $('#novo_documento_form').append(`
        <input type="hidden" name="materia_id" id="materia_id_input" value="${materia_id}">
    `);

    // Bloco para manipulaÃ§Ã£o do Layout
    $('#tableDocumentosBody').html('');
    $('#divTableMaterias').removeClass('col-md-12');
    $('#divTableMaterias').addClass('col-md-6');
    $('#divTableDocumentos').css("display", "block");
    $('#tableDocumentosBody').html('');

    // Chamada da funÃ§Ã£o que recupera os documentos
    getDocumentos(materia_id);
});

function getDocumentos(materia_id) {

    $.get('http://portaleducativo.cidadedecamboriu.sc.gov.br/documentos/get_documentos/' + materia_id, function (response) {

        var documentos = response;

        $.each(documentos, function (key, documento) {
            var tr = `
                <tr>
                    <td>
                        <a href="${documento.link}" id="${documento.id}" class="documento_id_button">${documento.nome}</a>
                    </td>
                    <td>
                        <a  href="http://portaleducativo.cidadedecamboriu.sc.gov.br/documentos/edit_documento/${documento.id}">
                            <i class="fa fa-edit text-primary"></i>
                        </a>

                        <a  href="http://portaleducativo.cidadedecamboriu.sc.gov.br/documentos/delete_documento/${documento.id}">
                            <i class="fa fa-trash text-danger"></i>
                        </a>
                    </td>
                </tr>
            `;

            $('#tableDocumentosBody').append(tr);
        });
    });
}

function closeModalMaterias() {
    $('#divTableMaterias').removeClass('col-md-6');
    $('#divTableMaterias').addClass('col-md-12');
    
    $('#divTableDocumentos').css("display", "none");
    $('#tableDocumentosBody').html('');
}

// FunÃ§Ã£o que obtem as matÃ©rias
function getMaterias() {

    var serie_id = $('#serie_id_input').val();

    $.get('http://portaleducativo.cidadedecamboriu.sc.gov.br/materias/get_materias/' + serie_id, function (response) {
        console.log(response.materias);
        var materias = response.materias;

        $.each(materias, function (key, materia) {
            var tr = `
            <tr>
                <td>
                    <a href="#" id="${materia.id}" class="materia_id_button">${materia.nome}</a>
                </td>
                <td>
                    <a href="http://portaleducativo.cidadedecamboriu.sc.gov.br/materias/edit_materia/${materia.id}">
                        <i class="fa fa-edit text-primary"></i>
                    </a>
                    <a href="http://portaleducativo.cidadedecamboriu.sc.gov.br/materias/delete_materia/${materia.id}">
                        <i class="fa fa-trash text-danger"></i>
                    </a>
                </td>
            </tr>
            `

            $('#tableMateriasBody').append(tr);
        });
    });
}

function insereValorInput(id) {
    $('#id_serie').val(id);
}