<?php

$sol_codigo = base64_decode($_SESSION['valorform']);

?>

<fieldset>
    <legend>Associar Ocorr�ncia</legend>
    <form name="associarocorrencia" id="associarocorrencia" method="post" enctype="multipart/form-data" action="../<?php echo($_SESSION['projeto']); ?>/action/associarRnc.php">
        <table border="0">

            <?php
            if($_SESSION['erro']) {
                ?>
                <tr>
                    <th nowrap="nowrap">

                    </th>
                    <td>
                        <?php

                        echo Erro::validarChamadoInRnc($_SESSION['erro']);

                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>

            <tr>
                <th nowrap="nowrap">
                    N�mero da ocorr�ncia:
                </th>
                <td>
                    <?php echo $sol_codigo; ?>
                    <input type="hidden" name="sol_codigo" value="<?php echo $sol_codigo; ?>">
                </td>
            </tr>

            <tr>
                <th nowrap="nowrap">
                    Descria��o da ocorr�ncia:
                </th>
                <td>
                    <?php
                    $tbSolicitacao = new TbSolicitacao();

                    echo $tbSolicitacao->getDescricaoSolicitacao($sol_codigo);

                    ?>
                </td>
            </tr>

            <tr>
                <th>
                    RNC:
                </th>
                <td>
                    <?php
                    $tbRNc = new TbCadastroRnc();

                    $RncSelect = new SelectOption();

                    $RncSelect->setStmt($tbRNc->listarRncNaoFechadas())
                        ->setOptionEmpty('Selecione')
                        ->setSelectName('nc_codigo')
                        ->setSelectedItem()
                        ->listOption();

                    ?>
                </td>
            </tr>

            <tr>
                <td>
                    &emsp;
                </td>
            </tr>

            <tr>
                <td>
                    <input type="submit" name="salvar" class="button-tela" id="botaoSave" value="Salvar" />
                    <span class="botaoSave" style="visibility: hidden"><img src="./css/images/299.GIF"></span>
                </td>
                <td>
                    <a href="action/formcontroler.php?<?php echo base64_encode('alterar/Solicitacao') . base64_encode($sol_codigo); ?>">
                        <span class="button-tela">Voltar</span>
                    </a>
                </td>
            </tr>

        </table>

<?php

$tbOcorrenciaRnc = new TbOcorrenciaRnc();

$GridOcorrencia = new DataGrid(array('RNC','Chamado'),$tbOcorrenciaRnc->listarRncChamado($sol_codigo));

$GridOcorrencia->acao = 'alterar/Ocorrencia';
$GridOcorrencia->colunaoculta = 1;

$GridOcorrencia->mostrarDatagrid(1);

?>

</fieldset>

<?php unset($_SESSION['cadastrar/Ocorrencia']);?>