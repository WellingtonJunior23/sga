<?php 
/*

include_once($_SERVER['DOCUMENT_ROOT'].'/SGA/componentes/config.php');

$Mail = new PHPMailer();

$Mail->IsSMTP();


$Mail->Host = 'mail.staycorp.com.br';

$Mail->Port = 587;
$Mail->SMTPAuth = true;
$Mail->Username = 'marcio@staycorp.com.br';
$Mail->Password = 'q1w2e3mrs@.$';


$Mail->From = 'marcio@staycorp.com.br';

$Mail->FromName = 'M�rcio Ramos';

$Mail->AddAddress('marcio@staycorp.com.br');
$Mail->AddAddress('marciomrs4@gmail.com');
$Mail->AddAddress('marciomrs4@hotmail.com');

//$Mail->CharSet # Padr�o ISO-8859-1

$Mail->IsHTML(true);

$Mail->Subject = 'E-mail de TESTE';
$Mail->Body = 'Este � um envio de teste que deve ser testado';

$erro = $Mail->Send();

$Mail->ClearAllRecipients();

if($erro)
{
	echo 'Enviado com sucesso!';
}else {
	echo 'N�o foi possivel enviar';
	echo $Mail->ErrorInfo;
}

*/