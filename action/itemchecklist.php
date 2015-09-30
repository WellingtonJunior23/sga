<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/sga/componentes/config.php');

if($_POST)
{
	if ($_SESSION['validacaoform'] == base64_encode(date('d-m-Y')))
	{


		$acao = base64_decode($_SESSION['acaoform']);

		switch ($acao)
		{
			case 'cadastrar/Itemchecklist' :
				
				$cadastro = new Cadastro();

				try
				{
					$cadastro->setDados($_POST);

					$cadastro->cadastrarItemChecklist($_FILES['arquivo']);
	
					$cadastro->finalizarApp('cadastrar/ItemChecklist');

				}catch (Exception $e)
				{
					ClasseException::throwException($e,$_POST,'cadastrar/ItemChecklist');
				}
				break;

			case 'alterar/Itemchecklist' :
				
				$alteracao = new Alteracao();

				try
				{

					$alteracao->setDados($_POST);
					
					$alteracao->alterarItemChecklist($_FILES['arquivo']);
	
					$alteracao->finalizarApp();

				}catch (Exception $e)
				{
					ClasseException::throwException($e);
				}
				break;

			default:
				Sessao::destroiSessao();
				break;
					
		}

	}else
	{
		Sessao::destroiSessao();
	}
}else
{
	Sessao::destroiSessao();
}


?>
