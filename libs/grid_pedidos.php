<?php
include_once "includes.php";

$sql    = "SELECT * FROM vendas";
$result = $mysqli->query($sql);
$grid   = "";
while($v = $result->fetch_object()){
    $grid .= "<tr>
                <td>" . $v->id . "</td>
                <td>" . $v->id . ' - ' . $v->cliente . "</td>
                <td>
                    <a class=\"btn btn-sm btn-danger\" href=\"#\" onclick=\"excluirPedidos(" . $v->id . ")\"><i class=\"fas fa-trash-alt\"></i> Deletar</a>
                </td>
                <td><a class=\"btn btn-sm btn-info\" href=\"#\" onclick=\"editarPedidos(" . $v->id . ")\"><i class=\"fas fa-info-circle\"></i> Editar</a> </td>
             </tr>";
}
echo $grid;
?>