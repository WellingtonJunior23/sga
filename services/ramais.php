<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/sga/componentes/config.php');


if($_GET['id'] == base64_encode(date('d-m-Y').'M')) {


    $TbUsuario = new TbUsuario();

    $lista = array();

    foreach ($TbUsuario->listarRamaisIntranet()->fetchAll(\PDO::FETCH_ASSOC) as $array)
    {
        $lista[] = array_map('utf8_encode', $array);
    }

 echo json_encode($lista);

}
?>

