<?php
include_once "includes.php";

$sql    = "SELECT * FROM produtos";
$result = $mysqli->query($sql);
$grid   = "";
while($v = $result->fetch_object()){
    $grid .= "<tr>
                <td>" . $v->id . "</td>
                <td>" . $v->descricao . "</td>
                <td>
                    <a class=\"btn btn-sm btn-primary\" href=\"#\" onclick=\"editar(" . $v->id . ")\"><i class=\"far fa-edit\"></i> Editar</a>
                    <a class=\"btn btn-sm btn-danger\" href=\"#\" onclick=\"excluir(" . $v->id . ")\"><i class=\"fas fa-trash-alt\"></i> Deletar</a>
                </td>
                <td><a class=\"btn btn-sm btn-info\" href=\"#\" onclick=\"detalhes(" . $v->id . ")\"><i class=\"fas fa-info-circle\"></i> Detalhes</a> </td>
             </tr>";
}
echo $grid;
?>