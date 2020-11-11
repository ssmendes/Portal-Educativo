// FunÃ§Ã£o que adicionar outros inputs na tabela de cadastro
function addSerie() {

    var tr = `
        <tr>
            <td>
                <input type="text" name="descricao_serie[]" class="form-control" required>
            </td>
            <td>
                <button class="btn btn-danger removeSerie">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    `;

    $('#tableSerieBody').append(tr);

}

$('.removeSerie').live('click', function() {
    $(this).parent().parent().remove();
});