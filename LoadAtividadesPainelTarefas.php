<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/sga/componentes/config.php');

//resolve o problema de acentos
header('Content-Type: text/html; charset=ISO-8859-1');

$tbAtividade = new TbAtividade();

$dados['usu_codigo_responsavel'] = $_SESSION['usu_codigo'];
$dados['sta_codigo'] = 2;


echo '<ul class="list-group">';

    foreach($tbAtividade->listarAtividadePainelTarefas($dados)->fetchAll(\PDO::FETCH_OBJ) as $atividade):

        echo '<li class="list-group-item">' . $atividade->atividade . '</li>';

    endforeach;

echo '</ul>';
?>