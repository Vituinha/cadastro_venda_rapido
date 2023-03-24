<!-- Cadastro de Pedido -->
<div class="modal fade" id="modalNovoPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Novo Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="cliente" class="col-form-label">Cliente:</label>
                    <input type="text" class="form-control" id="cliente" name="cliente" maxlength="100">
                </div>
                <div class="form-group">
                    <label for="descricao_prod" class="col-form-label">Produto:</label>
                    <table>
                        <tr>
                            <td>
                                <input type="text" class="form-control" id="descricao_prod" name="descricao_prod" maxlength="100">
                            </td>
                            <td>
                                <button type="button" class="btn btn-secondary" onclick="adicionarVenda();">Adicionar</button>
                            </td>
                        </tr>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick='adicionarVenda();'>Salvar</button>
            </div>
        </div>
    </div>
</div>