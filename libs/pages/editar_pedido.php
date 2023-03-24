<!-- Edição de Pedidos -->
<div class="modal fade" id="modalEditarPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <table>
                        <tr>
                            <td>
                                <label for="valor_ped" class="col-form-label">Valor do Pedido:</label>
                                <input type="text" class="form-control" id="valor_ped" name="valor_ped" maxlength="100" readonly>
                            </td>
                            <td>
                                <label for="data_ped" class="col-form-label">Data Cadastro:</label>
                                <input type="text" class="form-control" id="data_ped" name="data_ped" maxlength="100" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="cliente_ped" class="col-form-label">Cliente:</label>
                                <input type="text" class="form-control" id="cliente_ped" name="cliente_ped" maxlength="100" readonly>
                            </td>
                        </tr>
                    </table>                    
                </div>
                <div class="form-group">
                    <label for="descricao" class="col-form-label">Produto:</label>
                    <table>
                        <tr>
                            <td>
                                <input type="text" class="form-control" id="descricao_prod_ped" name="descricao_prod_ped" maxlength="100">
                            </td>
                            <td>
                                <button type="button" class="btn btn-secondary" onclick="adicionarItemEd();">Adicionar</button>
                            </td>
                        </tr>
                    </table>
            </div>
            <div class="form-group">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Produtos</th>
                        <th scope="col">Nome do Produto</th>
                        <th scope="col">Excluir</th>
                        <th scope="col">Dados</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>ID</td>
                        <td>DESCRICAO</td>
                        <td>
                            <a class="btn btn-sm btn-danger" href="#" onclick="wExcluir();"><i class="fas fa-trash-alt"></i> Deletar</a>    
                        </td>
                        <td><a class="btn btn-sm btn-info" href="#" onclick="wDetalhes();"><i class="fas fa-info-circle"></i> Detalhes</a> </td>
                    </tr>
                    <tbody id="produtos_ed"></tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick='adicionarVenda();'>Salvar</button>
            </div>
        </div>
    </div>
    <input type="hidden" name="id_ped" id="id_ped">
</div>
</div>