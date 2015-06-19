<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/sga/componentes/config.php');

$ControleAcesso = new ControleDeAcesso();

$ControleAcesso->permitirAcesso(array(ControleDeAcesso::$Tecnico,ControleDeAcesso::$TecnicoADM));

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/script.php");

$busca = new Busca();

$busca->validarPost($_POST);


echo"<div class='sub_menu_principal'>";
Texto::criarTitulo('Checklist');
echo "</div>";
?>

<form name="verificarchecklist" action="" method="post">
<fieldset>
	<legend>Executar CheckList</legend>
<table>
<tr>
	<td>Selecione Checklist:
	</td>
	<td>
<?php 

#Mostra (Lista) os CheckList para ser executado baseado se s�o do Departamento do
#Usuario, se est�o ativos e se est�o naquele dia da semana 
FormComponente::selectOption('che_codigo',$busca->listarExecutarCheckList(),true,$_SESSION['post']);

?>
	</td>

	<td>
		<input type="submit" class="button-tela" value="Executar">
	</td>
</tr>
</table>
</fieldset>
</form>
<hr/>
<?php 

$formcomponente = new FormComponente();

$formcomponente->objpdo = $busca->listarExecutarItemCheckList();

Texto::mostrarMensagem($_SESSION['erro']);

$formcomponente->montarFormularioCheckList($busca->getDados('che_codigo'));


Sessao::finalizarSessao();

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/menusecundario.php");
include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/rodape.php");

?>