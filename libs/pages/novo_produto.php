<!-- Cadastro de Produtos -->
<form name="formProdutoNovo" id="formProdutoNovo">
    <div class="modal fade" id="modalNovo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="descricao" class="col-form-label">Descrição:</label>
                        <input type="text" class="form-control" id="descricao" name="descricao" maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="observacao" class="col-form-label">Observação:</label>
                        <textarea class="form-control" id="observacao" name="observacao"></textarea>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="recipient-name" class="col-form-label">Valor Venda:</label>
                            <input type="text" class="form-control" name="valor" id="valor"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                        <div class="col">
                            <label for="recipient-name" class="col-form-label">Estoque:</label>
                            <input type="text" class="form-control" name="estoque" id="estoque"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                    </div>
                    <br>
                    <label for="recipient-name" class="col-form-label">Imagens:</label>
                    <input type="file" id="files" name="files[]" accept="image/png, image/gif, image/jpeg" multiple><br><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onclick='if(verificaNovo()){$("#formProdutoNovo").submit();}'>Salvar</button>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="acao" value="1">
</form>