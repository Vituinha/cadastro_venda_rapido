function produtos(){
    $.post('../libs/control_pages.php',
    {
        id: 1,
    }, function(data){
        location.reload();
    });
}

function pedidos(){
    $.post('../libs/control_pages.php',
    {
        id: 2,
    }, function(data){
        location.reload();
    });
}

function wEditar(){
    Swal.fire(
        'Editar',
        'Clique neste botão em um produto para que possa editar seu cadastro.',
        'question'
      )
}

function wExcluir(){
    Swal.fire(
        'Deletar',
        'Clique neste botão em um produto para que possa excluí-lo permanentemente.',
        'question'
      )
}

function wvEditar(){
    Swal.fire(
        'Editar',
        'Clique neste botão em uma venda para que possa editar seu seus produtos.',
        'question'
      )
}

function wvExcluir(){
    Swal.fire(
        'Deletar',
        'Clique neste botão em uma venda para que possa excluí-la permanentemente.',
        'question'
      )
}

function wDetalhes(){
    Swal.fire(
        'Detalhes',
        'Clique neste botão em um produto para que possa exibir todas as informações cadastradas junto de suas fotos.',
        'question'
      )
}

function editar(id){
    $.post("../libs/proc.php",
    {acao: 4,
    id: id},
    function(data){
        $("#descricao_ed").val(data.descricao);
        $("#observacao_ed").val(data.observacao);
        $("#valor_ed").val(data.valor_venda);
        $("#estoque_ed").val(data.estoque);
        $("#id_prod").val(id);
        if(data.qtde > 0){
            var i = 0;
            var html = "<table style=\"width: 100%;\"><tr>";
            while(i < data.qtde){
                if(i > 2 && i % 3 == 0){
                    html += "</tr><tr><td><div onclick=\"deleteImg(" + id + ", '" + data.fotos[i] + "')\" class=\"image_c\" style=\"background-image: url(../libs/images/" + id + "/" + data.fotos[i] +");\"></div></td>";
                } else {
                    html += "<td><div onclick=\"deleteImg(" + id + ", '" + data.fotos[i] + "')\" class=\"image_c\" style=\"background-image: url(../libs/images/" + id + "/" + data.fotos[i] +");\"></div></td>";
                }
                i = i + 1;
            }
            html += "</tr></table>";
        } else {
            var html = "";
        }
        $("#imgs").html(html);    
        var Modal = new bootstrap.Modal(document.getElementById("modalEditada"));
        Modal.show();
    },
    "json");
}

function detalhes(id){
    $.post("../libs/proc.php",
    {acao: 4,
    id: id},
    function(data){
        $("#descricao_de").val(data.descricao);
        $("#observacao_de").val(data.observacao);
        $("#valor_de").val(data.valor_venda);
        $("#estoque_de").val(data.estoque);
        $("#id_prod").val(id);
        if(data.qtde > 0){
            var i = 0;
            var html = "<table style=\"width: 100%;\"><tr>";
            while(i < data.qtde){
                if(i > 2 && i % 3 == 0){
                    html += "</tr><tr><td><div class=\"image_c\" style=\"background-image: url(../libs/images/" + id + "/" + data.fotos[i] +");\"></div></td>";
                } else {
                    html += "<td><div class=\"image_c\" style=\"background-image: url(../libs/images/" + id + "/" + data.fotos[i] +");\"></div></td>";
                }
                i = i + 1;
            }
            html += "</tr></table>";
        } else {
            var html = "";
        }
        $("#imgs_de").html(html);    
        var Modal = new bootstrap.Modal(document.getElementById("modalDetalhes"));
        Modal.show();
    },
    "json");
}

function excluir(id){
    $.post("../libs/proc.php",
    {acao: 3,
    id: id},
    function(data){
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Produto Excluído Com Sucesso!',
            showConfirmButton: false,
            timer: 1500
          }).then((value) => {
            location.reload();
          })
    });
}

function deleteImg(id, img){
    $.post("../libs/proc.php",
    {
        id: id,
        img: img,
        acao: 5
    }, function(data){
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Imagem Deletada Com Sucesso!',
            showConfirmButton: false,
            timer: 1500
          }).then((value) =>{
            $("#modal .close").click();
            editar(id);
        });
    });
}

function error(msg){
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: msg,
      })
}

function verificaEditado(){
    if($("#descricao_ed").val() == ""){
        error("É necessário preencher o campo \"Descrição\" para seguir com o cadastro!");
        $("#descricao_ed").focus();
        return false;
    }
    if($("#valor_ed").val() == ""){
        error("É necessário preencher o campo \"Valor\" para seguir com o cadastro!");
        $("#valor_ed").focus();
        return false;
    }
    if($("#estoque_ed").val() == ""){
        error("É necessário preencher o campo \"Estoque\" para seguir com o cadastro!");
        $("#estoque_ed").focus();
        return false;
    }
    return true;
}

function verificaNovo(){
    if($("#descricao").val() == ""){
        error("É necessário preencher o campo \"Descrição\" para seguir com o cadastro!");
        $("#descricao").focus();
        return false;
    }
    if($("#valor").val() == ""){
        error("É necessário preencher o campo \"Valor\" para seguir com o cadastro!");
        $("#valor").focus();
        return false;
    }
    if($("#estoque").val() == ""){
        error("É necessário preencher o campo \"Estoque\" para seguir com o cadastro!");
        $("#estoque").focus();
        return false;
    }
    return true;
}

function editarPedidos(id_ped){
    $.post("../libs/proc.php",
    {
        acao: 8,
        id: id_ped
    }, function(data){
        $("#produtos_ed").html(data.grid);
        $("#cliente_ped").val(data.cliente);
        $("#data_ped").val(data.cadastro);
        $("#valor_ped").val(data.valor);
        $("#id_ped").val(id_ped);
        var Modal = new bootstrap.Modal(document.getElementById("modalEditarPedido"));
        Modal.show();
    }, 'json');
}

function adicionarItemEd(){
    $.post("../libs/proc.php",
    {
        acao: 9,
        id: $("#id_ped").val(),
        prod: $("#descricao_prod_ped").val()
    }, function(data){
        if(data == '1'){
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Produto Incluído Com Sucesso!',
                showConfirmButton: false,
                timer: 1500
              }).then((value) => {
                location.reload();
                editarPedidos(ped);
              });
        } else {
            error("Produto Não Encontrado!");
        }
    })
}

function excluirItem(id, pedido){
    $.post("../libs/proc.php",
    {
        acao: 10,
        id: id,
        ped: pedido
    });
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Produto Excluído Com Sucesso!',
        showConfirmButton: false,
        timer: 1500
      }).then((value) => {
        location.reload();
        editarPedidos(ped);
      });
}

function excluirPedidos(id){
    $.post("../libs/proc.php",
    {
        acao: 11,
        id: id
    });
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Venda Excluída Com Sucesso!',
        showConfirmButton: false,
        timer: 1500
      }).then((value) => {
        location.reload();
      });
}

function adicionarVenda(){
    if($("#cliente").val() == ""){
        error("Preencha o campo cliente para adicionar um novo produto!");
        return;
    }
    if($("#descricao_prod").val() != ""){
        $.post("../libs/proc.php",
        {
            acao: 6,
            prod: $("#descricao_prod").val(),
            cliente: $("#cliente").val()
        }, function(data){
            if(data.res == "1"){
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Venda Criada Com Produto e Salva Com Sucesso!',
                    showConfirmButton: false,
                    timer: 1500
                  }).then((value) => {
                    location.reload();
                    editarPedidos(data.id_ped);
                  });
            } else {
                error("Produto Não Localizado!");
            }
        }, 'json')
    } else {
        $.post("../libs/proc.php",
        {
            acao: 7,
            prod: $("#descricao_prod").val(),
            cliente: $("#cliente").val()
        }, function(data){
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Venda Criada Com Sucesso!',
                showConfirmButton: false,
                timer: 1500
              }).then((value) => {
                location.reload();
                editarPedidos(data.id_ped);
            });
        }, 'json')
    }
}

$(document).ready(function (e) {    
    $("#formProdutoNovo").on('submit',(function(e) {
        e.preventDefault();
        $.ajax({
            url: "../libs/proc.php",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
                cache: false,
            processData:false,
            success: function(data) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Produto Salvo Com Sucesso!',
                    showConfirmButton: false,
                    timer: 1500
                  }).then((value) => {
                    location.reload();
                  })
            }
        });
    }));

    $("#formProdutoEditado").on('submit',(function(e) {
        e.preventDefault();
        $.ajax({
            url: "../libs/proc.php",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
                cache: false,
            processData:false,
            success: function(data) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Produto Editado Com Sucesso!',
                    showConfirmButton: false,
                    timer: 1500
                  }).then((value) => {
                    location.reload();
                  })
            }
        });
    }));
});