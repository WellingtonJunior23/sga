<?php 

$tbAtareuniao = new TbAtaReuniao();
$dadosAtaReuniao = $tbAtareuniao->getForm(base64_decode($_SESSION['valorform']));

$tbProjeto = new TbProjeto();
$projetoTitulo = $tbProjeto->getDescricaoProjeto($dadosAtaReuniao['pro_codigo_projeto']);

$dadosAtaForm = unserialize($dadosAtaReuniao['form_ata_reuniao']);

?>

<form name="ApontamentoProjeto" id="ApontamentoProjeto" enctype="multipart/form-data" method="post" action="../<?php echo($_SESSION['projeto']); ?>/action/AtaReuniao.php">
<fieldset>
	<legend><b>Ata de reuni�o</b></legend>
  <table width="300" border="0">
    <tr>
      <td colspan="2">	
      <?php Texto::mostrarMensagem($_SESSION['erro']);?>
    </td>
    </tr>

    <tr>
      <th nowrap="nowrap">Titulo do Projeto:</th>
      <td>
      	    <?php echo $projetoTitulo['pro_titulo']; ?>
      </td>
    </tr>

    <tr>
      <td colspan="2">
        &nbsp;
    </td>
    </tr>

     <tr>
      <th width="119" align="left" nowrap="nowrap">Assunto:</th>
      <td>
      	<input name="ata_assunto" type="text" size="40" maxlength="255" value="<?php echo($dadosAtaForm['ata_assunto']); ?>" />
      <input type="hidden" name="ata_codigo" value="<?php echo($dadosAtaReuniao['ata_codigo']); ?>">
      <input type="hidden" name="pro_codigo" value="<?php echo($dadosAtaReuniao['pro_codigo_projeto']); ?>">
      </td>
    </tr>

     <tr>
      <th width="119" align="left" nowrap="nowrap">Data:</th>
      <td>
      	<input name="ata_data" class="data" id="data-id" type="text" value="<?php echo($dadosAtaForm['ata_data']); ?>" />
      </td>
    </tr>

    <tr>
      <th width="119" align="left" nowrap="nowrap">Respons�vel:</th>
      <td>
      	<input name="ata_responsavel" type="text" size="40" maxlength="255" value="<?php echo($dadosAtaForm['ata_responsavel']); ?>" />
      </td>
    </tr>

     <tr>
      <th width="119" align="left" nowrap="nowrap">Dura��o:</th>
      <td>
      	<input name="ata_duracao" type="text" class="hora" size="40" maxlength="255" value="<?php echo($dadosAtaForm['ata_duracao']); ?>" />
      </td>
    </tr>

     <tr>
      <th width="119" align="left" nowrap="nowrap">Emitida por:</th>
      <td>
      	<input name="ata_emissao" type="text" size="40" maxlength="255" value="<?php echo($dadosAtaForm['ata_emissao']); ?>" />
      </td>
    </tr>

    <tr>
      <th width="119" align="left" nowrap="nowrap">Local:</th>
      <td>
      	<input name="ata_local" type="text" size="40" maxlength="255" value="<?php echo($dadosAtaForm['ata_local']); ?>" />
      </td>
    </tr>

    <tr>
      <th width="119" align="left" nowrap="nowrap">Pauta:</th>
      <td>
      	<input name="ata_pauta" type="text" size="40" maxlength="255" value="<?php echo($dadosAtaForm['ata_pauta']); ?>" />
      </td>
    </tr>

    <tr>
      <th>Participantes: <span id="adcionarparticipante">Adcionar</span></th> </th>
      <td>
      	<textarea name="ata_participantes" cols="55" rows="7"><?php echo($dadosAtaForm['ata_participantes']); ?></textarea>
      </td>
    </tr>

    <span id="inserirparticipante">

    </span>

    <tr>
      <th nowrap="nowrap">Resumo tratado:</th>
      <td>
        <textarea name="ata_resumo_tratado" cols="55" rows="7"><?php echo($dadosAtaForm['ata_resumo_tratado']); ?></textarea>
      </td>
    </tr>

    <tr>
      <th nowrap="nowrap">Pend�ncia para pr�xima reuni�o:
      <td>
          <textarea name="ata_acoes_pendencias" cols="55" rows="7"><?php echo($dadosAtaForm['ata_acoes_pendencias']); ?></textarea>
      </td>
    </tr>

    <tr>
      <td colspan="2" align="left">
	      <input type="submit" name="salvar" class="button-tela" value="Salvar" />
	  </td>
    </tr>

  </table>
</form>
 </fieldset>
<?php 
unset($_SESSION['cadastrar/AtaReuniao']);?>