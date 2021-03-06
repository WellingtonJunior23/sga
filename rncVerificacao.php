<?php
include_once 'componentes/TopoRnc.php';

$buca = new Busca();

$buca->setValueGet($_GET,'nc_codigo');

$tbRnc = new TbCadastroRnc();

$_SESSION['rncGestor'] = $tbRnc->getFormRnc($buca->getValueGet('nc_codigo'));
?>

    <div class="container-fluid">
        <div class="col-xs-12">

            <!-- DESCRI??O RESUMIDA DA RNC -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-check"></span> DESCRI��O DA RNC</h3>
                </div>
                <div class="panel-body">

                    <div class="col-xs-12">
                        <label class="text-info">
                            N�MERO DA RNC:
                        </label>
                        <?php echo $_SESSION['rncGestor']['nc_codigo'] . '/' .
                            date('y',strtotime($_SESSION['rncGestor']['nc_data_criacao'])); ?>
                    </div>


                    <div class="col-xs-12">
                        <label class="text-info">
                            DESCRI��O DA N�O CONFORMIDADE:
                        </label>
                        <?php echo $_SESSION['rncGestor']['nc_descricaocompleta']; ?>
                    </div>

                    <div class="col-xs-12">
                        <label class="text-info">
                            LOCAL DA OCORR�NCIA:
                        </label>
                        <?php echo $_SESSION['rncGestor']['nc_local_ocorrencia']; ?>
                    </div>

                    <div class="col-xs-12">
                        <label class="text-info">
                            DATA DA OCORR�NCIA:
                        </label>
                        <?php echo ValidarDatas::dataCliente($_SESSION['rncGestor']['nc_data_ocorrencia']); ?>
                    </div>

                    <div class="col-xs-12">
                        <label class="text-info">
                            A��O IMEDIATA:
                        </label>
                        <?php echo $_SESSION['rncGestor']['nc_acao_imediata']; ?>
                    </div>

                </div>
            </div>
            <!-- END DESCRI??O RESUMIDA DA RNC -->

            <!-- GESTOR -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-th-list"></span>
                        RESPOSTA DO DEPARTAMENTO
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="col-xs-12">
                        <label class="text-info">
                            CAUSAS:
                        </label>
                        <?php echo $_SESSION['rncGestor']['nc_causas']; ?>
                    </div>

                    <div class="col-xs-12">
                        <label class="text-info">
                            A��O DE MELHORIA:
                        </label>
                        <?php echo $_SESSION['rncGestor']['nc_acao_melhoria']; ?>
                    </div>
                    <div class="col-xs-12">
                        <label class="text-info">
                            PRAZO DE IMPLANTA��O:
                        </label>
                        <?php echo $_SESSION['rncGestor']['nc_prazo_implatacao']; ?>
                    </div>
                    <div class="col-xs-12">
                        <label class="text-info">
                            RESPONS�VEL IMPLANTA��O:
                        </label>
                        <?php echo $_SESSION['rncGestor']['nc_resp_implantacao']; ?>
                    </div>
                    <div class="col-xs-12">
                        <label class="text-info">
                            RESPONDIDO EM:
                        </label>
                        <?php echo ValidarDatas::dataCliente($_SESSION['rncGestor']['nc_data_resposta_gestor']); ?>
                    </div>
                </div>
            </div>

            <?php

            if(($_SESSION['rncGestor']['snc_codigo'] == 2) or ($_SESSION['rncGestor']['snc_codigo'] == 3)) {

            ?>

                <!-- Verifica��o qualidade -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-check"></span> VERIFICAC�O</h3>
                    </div>
                    <div class="panel-body">

                        <?php if ($_SESSION['erro']): ?>
                            <div class="alert alert-danger" role="alert"><?php echo $_SESSION['erro']; ?></div>
                        <?php endif; ?>

                        <?php if ($_SESSION['mensagem']): ?>
                            <div class="alert alert-success" role="alert"><?php echo $_SESSION['mensagem']; ?></div>
                        <?php endif; ?>

                        <form id="rncVerificacao" name="rncVerificacao" method="post" action="action/rncVerificacao.php">
                            <input type="hidden" name="nc_codigo"
                                   value="<?php echo($_SESSION['rncGestor']['nc_codigo']); ?>">

                            <div class="col-xs-4">
                                <label class="text-info">Eficaz ?</label>
                                    <?php
                                    $tbRncEficaz = new TbRncEficaz();

                                    $selectDescricao = new SelectOption();

                                    $selectDescricao->setStmt($tbRncEficaz->listRncEficaz())
                                        ->isRequire(true)
                                        ->setClass('form-control')
                                        ->setOptionEmpty('SELECIONE')
                                        ->setSelectName('efi_codigo')
                                        ->listOption();
                                    ?>
                            </div>

                            <div class="col-xs-4">
                                <label class="text-info">Encerrar NC ?</label>
                                    <?php
                                    $array = array(array(1, 'SIM'),
                                        array(2, 'N�O'));

                                    $SelectEncerrarNC = new SelectOption();

                                    $SelectEncerrarNC->setOptionEmpty('SELECIONE')
                                        ->setSelectName('ver_encerrado')
                                        ->setStmt($array)
                                        ->isRequire(true)
                                        ->setClass('form-control')
                                        ->listOption();

                                    ?>
                            </div>

                            <div class="col-xs-4">
                                <label class="text-info">Previs�o Encerramento:</label>

                                    <input type="date" name="nc_previsao_encerramento" class="form-control" >

                            </div>


                            <div class="col-xs-12">
                                <hr>
                                <label class="text-info">PARECER DA QUALIDADE:</label>
                                <textarea class="form-control" rows="2" name="ver_parecer_qualidade"
                                          placeholder="PARECER QUALIDADE"></textarea>
                                <br>
                            </div>

                            <div class="col-xs-12">
                                    <button type="submit" class="btn btn-primary" id="botaoSave"> Verificar</button>
                                    <div id="loadprocessar"></div>
                            </div>

                        </form>


                        <?php
                        $tbRncVerificacao = new TbRncVerificacao();

                        if($tbRncVerificacao->countVerificacaoByRnc($buca->getValueGet('nc_codigo')) >= 1) {

                            ?>
                            <!-- Verificacoes -->
                            <hr>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        Verifica��es Anteriores
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <?php

                                    $DataGrid = new Grid(array('Eficaz', 'Data', 'Encerrado', 'Parecer Qualidade'),
                                        $tbRncVerificacao->listarVerificaoByRnc($buca->getValueGet('nc_codigo'))
                                                         ->fetchAll(\PDO::FETCH_ASSOC));

                                    $DataGrid->colunaoculta = 1;
                                    $DataGrid->show(true);
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <!-- fim verifica��es -->


                    </div>
                    <div class="panel-footer"></div>
                </div>
                <?php
            }elseif($_SESSION['rncGestor']['snc_codigo'] == 4){
                $tbRncVerificacao = new TbRncVerificacao();
                $Verificacao = $tbRncVerificacao->getUltimaRncVerificacao($buca->getValueGet('nc_codigo'));
            ?>

                <!-- Verificado -->

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-check"></span> VERIFICAC�O</h3>
                    </div>
                    <div class="panel-body">

                        <div class="col-xs-6">
                            <label class="text-info">
                                EFICAZ:
                            </label>
                            <?php echo($Verificacao['efi_descricao']); ?>
                        </div>

                        <div class="col-xs-6">
                            <label class="text-info">
                                ENCERRAR NC:
                            </label>
                            <?php echo($Verificacao['ver_encerrado']); ?>
                        </div>

                        <div class="col-xs-12">
                            <label class="text-info">PARECER DA QUALIDADE:</label>
                            <?php echo  $Verificacao['ver_parecer_qualidade']; ?>
                            <br>
                        </div>

                        <div class="col-xs-12">
                            <label class="text-info">DATA DA VERIFICA��O:</label>
                            <?php echo  $Verificacao['ver_data_resposta']; ?>
                            <br>
                        </div>


                        </form>
                    </div>
                    <div class="panel-footer"></div>
                </div>

            <?php
            }


            ?>


        </div>
    </div>

<?php
include_once 'componentes/footerRnc.php';
?>