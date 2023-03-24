<?php
session_start();
  if(!isset($_SESSION['page']) || $_SESSION['page'] == 'prod'){
    $actv_prod = "active";
    $grid_prod = TRUE;
    $actv_ped  = "";
    $grid_ped  = FALSE;
  } else {
    $actv_prod = "";
    $grid_prod = FALSE;
    $actv_ped  = "active";
    $grid_ped  = TRUE;
  }
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!------ Fim da Head ---------->
<link rel="stylesheet" href="style.css"><body>
<header>
  <div class="container bg-info p-5 ">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link <?php echo $actv_prod; ?>" href="#" onclick="produtos();" >Produtos <span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link <?php echo $actv_ped; ?>" href="#" onclick="pedidos();">Pedidos</a>
          <a class="nav-item nav-link" href="../portifolio/index.html" target="_blank">Participante</a>
        </div>
      </div>
    </nav>
  </div>
</header>
<main>
<div class="container my-5">
       <div class="card-body text-center">
    <h4 class="card-title title">Make Money Gain Honey ;D</h4>
  </div>
    <div class="card" id="produtos">
  <?php if($grid_prod){ ?>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNovo">
      Cadastrar Novo Produto
    </button>
    <!-- GRID DE PRODUTOS -->
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Produtos</th>
                <th scope="col">Nome do Produto</th>
                <th scope="col">Editar/Excluir</th>
                <th scope="col">Dados</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>ID</td>
                <td>DESCRICAO</td>
                <td>
                    <a class="btn btn-sm btn-primary" href="#" onclick="wEditar();"><i class="far fa-edit"></i> Editar</a>
                    <a class="btn btn-sm btn-danger" href="#" onclick="wExcluir();"><i class="fas fa-trash-alt"></i> Deletar</a>    
                </td>
                <td><a class="btn btn-sm btn-info" href="#" onclick="wDetalhes();"><i class="fas fa-info-circle"></i> Detalhes</a> </td>
              </tr>
              <?php include_once "../libs/grid_produtos.php"; ?>
            </tbody>
          </table>
    <!-- FIM DA GRID DE PRODUTOS -->
  <?php } ?>

  <?php if($grid_ped){ ?>
    <!-- GRID DE PEDIDOS -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNovoPedido">
      Cadastrar Novo Pedido
    </button>
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Pedidos</th>
                <th scope="col">Nome do Cliente</th>
                <th scope="col">Excluir</th>
                <th scope="col">Editar</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>ID</td>
                <td>DESCRICAO</td>
                <td>
                    <a class="btn btn-sm btn-danger" href="#" onclick="wvExcluir();"><i class="fas fa-trash-alt"></i> Deletar</a>    
                </td>
                <td><a class="btn btn-sm btn-info" href="#" onclick="wvEditar();"><i class="fas fa-info-circle"></i> Editar</a> </td>
              </tr>
              <?php include_once "../libs/grid_pedidos.php"; ?>
            </tbody>
          </table>
    <!-- FIM DA GRID DE PEDIDOS -->
  <?php } ?>
    </div>

  <?php
    include_once "../libs/pages/novo_produto.php";
    include_once "../libs/pages/editar_produto.php";
    include_once "../libs/pages/editar_pedido.php";
    include_once "../libs/pages/detalhes_produto.php";
    include_once "../libs/pages/novo_pedido.php";
  ?>
</body>
<script src="script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
