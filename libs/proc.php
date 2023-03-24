<?php
include_once "includes.php";

$acao = $_POST['acao'];

switch($acao){
    case 1:
        //SALVA O PRODUTO
        $images = array();

        $desc = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
        $obs  = filter_input(INPUT_POST, 'observacao', FILTER_SANITIZE_SPECIAL_CHARS);
        $val  = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_SPECIAL_CHARS);
        $est  = filter_input(INPUT_POST, 'estoque', FILTER_SANITIZE_SPECIAL_CHARS);
        
        $imgs = "";
        foreach($_FILES['files']['name'] AS $k => $v){
            $imgs .= $v . "|";
            $images[$k]['name'] = $v;
        }
        foreach($_FILES['files']['tmp_name'] AS $k => $v){
            $images[$k]['tmp_name'] = $v;
        }
        print_r($images);
        $imgs = rtrim($imgs, '|');
        $sql = "INSERT INTO produtos (descricao,
                                      observacao,
                                      fotos,
                                      valor_venda,
                                      estoque
                                     ) VALUES (
                                      '$desc',
                                      '$obs',
                                      '$imgs',
                                      $val,
                                      $est);";
        $result = $mysqli->query($sql);
        $sql    = "SELECT MAX(id) AS id FROM produtos";
        $result = $mysqli->query($sql);
        $res_b  = $result->fetch_object();
        $id     = $res_b->id;
        $dir = '../libs/images/' . $id;
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        foreach($images AS $v){
            if (move_uploaded_file($v['tmp_name'], "$dir/".$v["name"])) { 
                echo "Arquivo enviado com sucesso!";
            }
        }
        break;
    case 2:
        //EDITA O PRODUTO
        //SALVA O PRODUTO
        $images = array();
        $id   = filter_input(INPUT_POST, 'id_prod', FILTER_SANITIZE_NUMBER_INT);
        $desc = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
        $obs  = filter_input(INPUT_POST, 'observacao', FILTER_SANITIZE_SPECIAL_CHARS);
        $val  = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_SPECIAL_CHARS);
        $est  = filter_input(INPUT_POST, 'estoque', FILTER_SANITIZE_SPECIAL_CHARS);
        
        $imgs = "";
        foreach($_FILES['files']['name'] AS $k => $v){
            if(!is_file($v)){
                $imgs .= $v . "|";
            }
            $images[$k]['name'] = $v;
        }
        foreach($_FILES['files']['tmp_name'] AS $k => $v){
            $images[$k]['tmp_name'] = $v;
        }
        print_r($images);
        $imgs = rtrim($imgs, '|');
        $sql = "UPDATE produtos SET descricao   = '$desc',
                                    observacao  = '$obs',
                                    fotos       = (SELECT CASE WHEN fotos != '' AND fotos IS NOT NULL THEN  CONCAT(fotos, '|', 'DM.png') ELSE 'DM.png' end AS fotos FROM produtos WHERE id = $id),
                                    valor_venda = $val,
                                    estoque     = $est
                WHERE id = $id;";
        $result = $mysqli->query($sql);
        $sql    = "SELECT MAX(id) AS id FROM produtos";
        $result = $mysqli->query($sql);
        $res_b  = $result->fetch_object();
        $id     = $res_b->id;
        $dir = '../libs/images/' . $id;
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        foreach($images AS $v){
            if(!is_file($v["name"])){
                if (move_uploaded_file($v['tmp_name'], "$dir/".$v["name"])) { 
                    echo "Arquivo enviado com sucesso!";
                }
            }
        }
        break;
    case 3:
        //DELETA O PRODUTO
        $id  = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $dir = '../libs/images/' . $id;
        $files = glob($dir . '/*');
        foreach($files as $file){
            if(is_file($file)){
                unlink($file);
            }
        }
        rmdir($dir);
        $sql = "DELETE FROM produtos
                WHERE id=$id;";
        $result = $mysqli->query($sql);
        break;
    case 4:
        //COLETA INFORMAÇÕES SOBRE O PRODUTO
        $id     = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $sql    = "SELECT * FROM produtos WHERE id = $id";
        $result = $mysqli->query($sql);
        $v      = $result->fetch_object();
        if($v->fotos != ""){
            $fotos = explode("|", $v->fotos);
            $qtde_fotos = count($fotos);
        } else {
            $fotos = "";
            $qtde_fotos = 0;
        }
        $result = array("id" => $v->id, "descricao" => $v-> descricao, "observacao" => $v->observacao,
        "fotos" => $fotos, "valor_venda" => $v->valor_venda, "estoque" => $v->estoque, "qtde" => $qtde_fotos);

        echo json_encode($result);
        break;
    case 5:
        //DELETA IMAGEM DO PRODUTO
        $id   = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $img  = filter_input(INPUT_POST, 'img', FILTER_SANITIZE_SPECIAL_CHARS);
        $file = '../libs/images/' . $id . "/" . $img;
        if(is_file($file)){
            unlink($file);
        }
        $sql    = "SELECT * FROM produtos WHERE id = $id";
        $result = $mysqli->query($sql);
        $v      = $result->fetch_object();
        $msg    = rtrim(ltrim(str_replace('||', '|', str_replace($img, '', $v->fotos)), '|'), '|');
        echo "$msg";
        $sql    = "UPDATE produtos SET fotos = '$msg' WHERE id = $id";
        $result = $mysqli->query($sql);
        break;
    case 6:
        //CRIA NOVA VENDA ADICIONANDO UM PRODUTO
        $prod    = filter_input(INPUT_POST, 'prod', FILTER_SANITIZE_SPECIAL_CHARS);
        $cliente = filter_input(INPUT_POST, 'cliente', FILTER_SANITIZE_SPECIAL_CHARS);
        
        $sql    = "SELECT * FROM produtos WHERE descricao LIKE '%$prod%' LIMIT 1";
        $result = $mysqli->query($sql);
        if($result->num_rows > 0){
            $v      = $result->fetch_object();
            $sql = "INSERT INTO vendas (valor,
                                        cliente,
                                        data_cadastro
                                       ) VALUES (
                                        $v->valor_venda,
                                        '$cliente',
                                        NOW());";
            $result = $mysqli->query($sql);
            $sql = "INSERT INTO venda_item (id_produto,
                                            id_pedido,
                                            valor_item
                                            ) VALUES (
                                             $v->id,
                                             (SELECT MAX(id) AS id FROM vendas),
                                             $v->valor_venda);";
            $result = $mysqli->query($sql);
            echo json_encode(array("res" => 1, "id_ped" => $v->id));
        } else {
            echo json_encode(array("res" => 2));
        }
        break;
    case 7:
        //CRIAR NOVA VENDA SEM ADICIONAR UM NOVO PRODUTO
        $cliente = filter_input(INPUT_POST, 'cliente', FILTER_SANITIZE_SPECIAL_CHARS);
        $sql = "INSERT INTO vendas (valor,
                                    cliente,
                                    data_cadastro
                                    ) VALUES (
                                    0,
                                    '$cliente',
                                    NOW());";
        $result = $mysqli->query($sql);
        $sql = "SELECT MAX(id) AS id FROM vendas";
        $result = $mysqli->query($sql);
        $obj = $result->fetch_object();
        echo json_encode(array("res" => 1, "id_ped" => $obj->id));
        break;
    case 8:
        //RETORNAR DADOS DA VENDA
        $id  = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $sql = "SELECT * FROM vendas WHERE id = $id";
        $res = $mysqli->query($sql);
        $obj = $res->fetch_object();
        $cliente = $obj->cliente;
        $data_cd = $obj->data_cadastro;
        $valor_p = $obj->valor;
        $sql = "SELECT p.*
                FROM venda_item vi
                JOIN produtos p ON p.id = vi.id_produto
                WHERE vi.id_pedido = $id";
        $result = $mysqli->query($sql);
        $grid   = "";
        if($result->num_rows > 0){
            while($v = $result->fetch_object()){
                $grid .= "<tr>
                            <td>" . $v->id . "</td>
                            <td>" . $v->descricao . "</td>
                            <td>
                                <a class=\"btn btn-sm btn-danger\" href=\"#\" onclick=\"excluirItem(" . $v->id . ", $id)\"><i class=\"fas fa-trash-alt\"></i> Deletar</a>
                            </td>
                            <td><a class=\"btn btn-sm btn-info\" href=\"#\" onclick=\"detalhes(" . $v->id . ")\"><i class=\"fas fa-info-circle\"></i> Detalhes</a> </td>
                        </tr>";
            }
        }
        $return = array("cliente"=>$cliente, "cadastro"=>$data_cd, "grid"=>$grid, "valor"=>$valor_p);
        echo json_encode($return);
        break;
    case 9:
        //ADICIONAR PRODUTO NA VENDA
        $prod    = filter_input(INPUT_POST, 'prod', FILTER_SANITIZE_SPECIAL_CHARS);
        $id  = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $sql    = "SELECT * FROM produtos WHERE descricao LIKE '%$prod%' LIMIT 1";
        $result = $mysqli->query($sql);
        if($result->num_rows > 0){
            $v      = $result->fetch_object();
            $sql = "INSERT INTO venda_item (id_produto,
                                            id_pedido,
                                            valor_item
                                            ) VALUES (
                                             $v->id,
                                             $id,
                                             $v->valor_venda);";
            $result = $mysqli->query($sql);
            $sql = "UPDATE vendas SET valor = (SELECT SUM(valor_item) AS vi FROM venda_item WHERE id_pedido = $id)
                    WHERE id = $id";
            $result = $mysqli->query($sql);
            echo "1";
        } else {
            echo "2";
        }
        break;
    case 10:
        //DELETAR PRODUTO DA VENDA
        $id  = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $pd  = filter_input(INPUT_POST, 'ped', FILTER_SANITIZE_NUMBER_INT);
        $sql = "DELETE FROM venda_item WHERE id_produto = $id AND id_pedido = $pd";
        $result = $mysqli->query($sql);
        break;
    case 11:
        //DELETAR A VENDA
        $id  = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $sql = "DELETE FROM venda_item WHERE id_pedido = $id;";
        $result = $mysqli->query($sql);
        $sql = "DELETE FROM vendas WHERE id = $id;";
        $result = $mysqli->query($sql);
        break;
}
