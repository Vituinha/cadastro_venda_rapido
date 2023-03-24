<!-- Detalhes do Produtos -->
<div class="modal fade" id="modalDetalhes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalhes Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="descricao" class="col-form-label">Descrição:</label>
                    <input type="text" class="form-control" id="descricao_de" name="descricao" maxlength="100" readonly>
                </div>
                <div class="form-group">
                    <label for="observacao" class="col-form-label">Observação:</label>
                    <textarea class="form-control" id="observacao_de" name="observacao" readonly></textarea>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="recipient-name" class="col-form-label">Valor Venda:</label>
                        <input type="text" class="form-control" name="valor" id="valor_de"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" readonly>
                    </div>
                    <div class="col">
                        <label for="recipient-name" class="col-form-label">Estoque:</label>
                        <input type="text" class="form-control" name="estoque" id="estoque_de"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" readonly>
                    </div>
                </div>
                <br>
                <div id="imgs_de"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="acao" value="2">
<input type="hidden" name="id_prod" id="id_prod" value="">