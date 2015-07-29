<?php
include_once($_SERVER['DOCUMENT_ROOT']."/sga/componentes/config.php");


ControleDeAcesso::permitirAcesso(array(ControleDeAcesso::$TecnicoADM,ControleDeAcesso::$Tecnico));

include($_SERVER['DOCUMENT_ROOT']."/{$Projeto}/componentes/bootstrap.php");
 
echo '<div class="jumbotron">';


$busca = new Busca();

$busca->validarPost($_POST);

//print_r($_SESSION);

$cabecalho = array('','N�mero','Data Inicio','Data Fim','Tempo',
				   'Problema Tecnico','SLA Tecnico','Status','Prioridade','SLA Atend.','Atendente',
				   'DIFF - Tecnico','Tempo Util',' Tempo Terceiro ','�til Real',' % SLA - Porcentagem');

//Obtem o tempo de entrada, saida, almoco e sabado do Departamento
$TbDepartamento = new TbDepartamento();
$TempoDepartamento = $TbDepartamento->getAllHours($_SESSION['dep_codigo']);

//Hora inicio do Departamento
$hora_ini = ($busca->getDados('hora_ini') == '') ? $TempoDepartamento['dep_hora_inicio']  : $busca->getDados('hora_ini');
//Hora Fim do departamento
$hora_fim = ($busca->getDados('hora_fim') == '') ? $TempoDepartamento['dep_hora_fim']     : $busca->getDados('hora_fim');
//Hora de almoco departamento
$meio_dia = ($busca->getDados('meio_dia') == '') ? $TempoDepartamento['dep_hora_almoco']  : $busca->getDados('meio_dia');
//Carga horaria de sabado departamento
$sabado =   ($busca->getDados('sabado') == '')   ? $TempoDepartamento['dep_carga_sabado'] : $busca->getDados('sabado');

?>

<form action="" method="post" id="relatoriosolucao">
<fieldset>
	<legend>
            <span style="cursor: pointer" id="docRelatorioTempoTerceiro" class="glyphicon glyphicon-question-sign" title="Ajuda ?"></span>
              Pesquisar Chamado
            </legend>
<table border="0">
	<tr>	
		<td>
			Status:
			<?php 
		    $tbStatus = new TbStatus();

            $FormStatus = new SelectOption();
            $FormStatus->setOptionEmpty('TODOS')
                       ->setSelectedItem($busca->getDados('sta_codigo'))
                       ->setSelectName('sta_codigo')
                       ->setStmt($tbStatus->selectStatusNaoAberto())
                       ->listOption();

            ?>
		    
		    Prioridade: 
		    <?php 
		    
		    $tbPrioridade = new TbPrioridade();

            $FormPrioridade = new SelectOption();
            $FormPrioridade->setStmt($tbPrioridade->selectPrioridadesDepartamento($_SESSION['dep_codigo']))
                            ->setSelectedItem($busca->getDados('pri_codigo'))
                            ->setSelectName('pri_codigo')
                            ->setOptionEmpty('TODOS')
                            ->listOption();
		    
		    ?>
		    
		    Usu�rio:
		    <?php 
		    $tbUsuario = new TbUsuario();

            $FormCodigoAtendente = new SelectOption();
            $FormCodigoAtendente->setStmt($tbUsuario->selectUsuarioPorDepartamento($_SESSION['dep_codigo']))
                                ->setOptionEmpty('TODOS')
                                ->setSelectName('usu_codigo_atendente')
                                ->setSelectedItem($busca->getDados('usu_codigo_atendente'))
                                ->listOption();
		    
		    ?>
		    	
		Per�odo: De <input type="date" name="data1" value="<?php echo($busca->getDados('data1'));?>">
		� 			<input type="date" name="data2" value="<?php echo($busca->getDados('data2'));?>">
		</td>				
		
	</tr>
	<tr>

        <td>
            Problema:
            <?php
            $TbProblema = new TbProblema();

            $FormProblema = new SelectOption();
            $FormProblema->setStmt($TbProblema->listarProblemasTecnicos($_SESSION['dep_codigo']))
                         ->setOptionEmpty('TODOS')
                         ->setSelectName('pro_codigo')
                         ->setSelectedItem($busca->getDados('pro_codigo'))
                         ->listOption();

            ?>

		 Hor�rio de trabalho Inicio:
		 		  <input type="text" name="hora_ini" class="doisdigitos" size="3" value="<?php echo $hora_ini; ?>">
		 		� <input type="text" name="hora_fim" class="doisdigitos" size="3" value="<?php echo $hora_fim; ?>">

		Almo�o: <input type="text" name="meio_dia" class="doisdigitos" size="3" value="<?php echo $meio_dia; ?>">

		Carga hor�ria de S�bado: <input type="text" name="sabado" class="doisdigitos" size="3" value="<?php echo $sabado; ?>">
		</td>
	</tr>
	<tr>
		<td>
          <input type="submit" class="button-tela" id="botaoSave" value="Pesquisar" name="Pesquisar" />
	      <span class="botaoSave" style="visibility: hidden"><img src="./css/images/299.GIF"></span>
		</td>
	</tr>
	
</table>
</fieldset>
</form>
<br />
<?php 
try 
{
	

	$diaUtil = new dateOpers();
	
	$grid = new Grid();
	
	$grid->setCabecalho($cabecalho);
	
	$grid->setDados($busca->listarChamadoPorTempoDeSolucaoEnvioTerceiro());
	
	
	$grid->addFunctionColumn(function ($var) use ($diaUtil, $busca)
	{
		$data = explode('|', $var);
		
		$data1 = $data['0'];
		$data2 = $data['1'];

		#Hora Inicial
		$hora_ini = $busca->getDados('hora_ini');
		#Hora Final
		$hora_fim = $busca->getDados('hora_fim');
		
		#At? o esse horario do almo?o
		$meio_dia = $busca->getDados('meio_dia');
		#Horas de sabados
		$sabado   = $busca->getDados('sabado');
		
		#Tipo de Saida em horas
		$saida    = 'H';
		
		return $diaUtil->tempo_valido($data1, $data2, $hora_ini, $hora_fim, $meio_dia, $sabado, $saida);
		
		
	}, 11);

$option = new GridOption();
$option->setIco('edit')->setName('Ver chamado');

$grid->addOption($option);

//Funcao que retorna as horas em segundos
function getHourToSecunds($hora)
{
	$horaParte = explode(':', $hora);

	$horasEmSegundo = ($horaParte['0'] * 3600) + ($horaParte['1'] * 60) + $horaParte['2'];

	return $horasEmSegundo;
}

//Funcao que retorna os segundos em horas
function getSecundToHours($segundos){

        $hours = floor($segundos / 3600);
        $segundos -= $hours * 3600;
        $minutes = floor($segundos / 60);
        $segundos -= $minutes * 60;

        return "$hours:$minutes:$segundos";

}

//Funcao que retorna a porcentagem do tempo ou facered se ultrapassar 100%
function getPercent($horaTecnica, $tempoChamado)
{
    $percent = ($tempoChamado / $horaTecnica) * 100;

    if($percent > 100){
        return '<img src="css/images/status/face2.png">';
    }else {

        $valor = sprintf('%.2f', $percent) . '%';

        if ($percent <= 50) {
            $style = 'progress-bar-success progress-bar-striped';
        } elseif ($percent > 50 and $percent <= 90) {
            $style = 'progress-bar-warning progress-bar-striped';
        } elseif ($percent > 90) {
            $style = 'progress-bar-danger progress-bar-striped';
        }

        $retorno = '<div class="progress">
              <div class="' . $style . '"
                   role="progressbar"
                   aria-valuenow="' . $valor . '"
                   aria-valuemin="0"
                   aria-valuemax="100"
                   style="width: ' . $valor . ';">
                        <span style="color: #000000">' . $valor . '</span>
              </div>
             </div>';

        return $retorno;
    }
}

$grid->addFunctionColumn(function($var) use ($diaUtil, $busca){

    //Estas variaveis sao globais para uso no incluse GraficoTempoSolucao
	global $totalChamado, $chamadoDentro, $chamadoFora;
	
	$chamadoDentro = ($chamadoDentro == 0) ? 0 : $chamadoDentro;
	$chamadoFora = ($chamadoFora == 0) ? 0 : $chamadoFora;
	
	$tempo = explode('|', $var);
	
	$data1 = trim($tempo['0']);
	$data2 = trim($tempo['1']);
	
	$tempoProblema = trim($tempo['2']);

    //Tempo util do terceiro
    $tempoUtilTerceiro = trim($tempo['3']);
	
	#Hora Inicial
	$hora_ini = $busca->getDados('hora_ini');
	#Hora Final
	$hora_fim = $busca->getDados('hora_fim');
		
	#At? o esse horario do almo?o
	$meio_dia = $busca->getDados('meio_dia');
	#Horas de sabados
	$sabado   = $busca->getDados('sabado');
		
	#Tipo de Saida em horas
	$saida = 'H';
	
	$horaUtil = $diaUtil->tempo_valido($data1, $data2, $hora_ini, $hora_fim, $meio_dia, $sabado, $saida);

    $tempoUtilTerceiroEmSegundos = getHourToSecunds($tempoUtilTerceiro);


	#Converte para secundos as horas 
	$horaUtil = getHourToSecunds($horaUtil);
	$tempoProblema = getHourToSecunds($tempoProblema);

    $tempoUtilFinal = $horaUtil - $tempoUtilTerceiroEmSegundos;


    $percent = getPercent($tempoProblema,$tempoUtilFinal);


 	if($tempoUtilFinal <= $tempoProblema){
		
		$totalChamado++;
		$chamadoDentro++;
		
		return getSecundToHours($tempoUtilFinal) .'
		                        <td>' . $percent . '</td>';

	}else {
		$totalChamado++;
		$chamadoFora++;

		return getSecundToHours($tempoUtilFinal) .'
		                        <td>' . $percent . '</td>';
}
	
	
}, 13);

$grid->id = null;

$Painel = new Painel();
$Painel->addGrid($grid)
       ->setPainelTitle('<a href="#">Resultado <span class="glyphicon glyphicon-resize-small"></span></a>')
       ->setPainelColor('default')
       ->show();


} catch (\Exception $e)
{
	echo $e->getMessage();
}

include_once "GraficoTempoSolucaoMontagem.php";

Sessao::finalizarSessao();

?>