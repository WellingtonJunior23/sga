<?php
include_once 'componentes/TopoRnc.php';

$buca = new Busca();

$buca->setValueGet($_GET,'nc_codigo');


$tbRnc = new TbCadastroRnc();

$_SESSION['rncGestor'] = $tbRnc->getFormRnc($buca->getValueGet('nc_codigo'));

if($_SESSION['rncGestor']['nc_edicao_gestor'] == 1) {
    ?>

    <div class="container-fluid">
        <div class="col-xs-12">

            <!-- DESCRI??O RESUMIDA DA RNC -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-info-sign"></span> Informa��o</h3>
                </div>
                <div class="panel-body">
                    <div class="col-xs-12">
                        <div class="alert alert-success" role="alert">Esta RNC j� foi respondida.
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <?php
}else{
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
                        <label class="text-info">DESCRI��O DA N�O
                            CONFORMIDADE:</label> <?php echo $_SESSION['rncGestor']['nc_descricaocompleta']; ?>
                        <br>
                    </div>

                    <div class="col-xs-12">
                        <label class="text-info">LOCAL DA
                            OCORR�NCIA:</label> <?php echo $_SESSION['rncGestor']['nc_local_ocorrencia']; ?>
                        <br>
                    </div>

                    <div class="col-xs-12">
                        <label class="text-info">DATA DA
                            OCORR�NCIA:</label> <?php echo ValidarDatas::dataCliente($_SESSION['rncGestor']['nc_data_ocorrencia']); ?>
                        <br>
                    </div>
                    <div class="col-xs-12">
                        <label class="text-info">A��O
                            IMEDIATA:</label> <?php echo $_SESSION['rncGestor']['nc_acao_imediata']; ?>
                        <br>
                    </div>

                </div>
            </div>
            <!-- END DESCRI??O RESUMIDA DA RNC -->

            <!-- GESTOR -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-th-list"></span> RESPOSTA DO
                        DEPARTAMENTO</h3>
                </div>
                <div class="panel-body">

                    <form name="rncGestor" method="post" action="action/rncResposta.php">

                        <?php if ($_SESSION['erro']): ?>
                            <div class="alert alert-danger" role="alert"><?php echo $_SESSION['erro']; ?></div>
                        <?php endif; ?>

                        <?php if ($_SESSION['mensagem']): ?>
                            <div class="alert alert-success" role="alert"><?php echo $_SESSION['mensagem']; ?></div>
                        <?php endif; ?>

                        <input type="hidden" name="nc_codigo"
                               value="<?php echo $_SESSION['rncGestor']['nc_codigo']; ?>">

                        <div class="col-xs-12">
                            <label class="text-info">CAUSAS:</label>
                                <textarea class="form-control" rows="3" name="nc_causas"
                                          placeholder="CAUSA DA OCORR�NCIA"></textarea>

                            <br>
                        </div>

                        <div class="col-xs-12">
                            <label class="text-info">A��O DE MELHORIA:</label>
                                <textarea class="form-control" rows="3" name="nc_acao_melhoria"
                                          placeholder="MELHORIA"></textarea>

                            <br>
                        </div>
                        <div class="col-xs-4">
                            <label class="text-info">PRAZO DE IMPLANTA��O:</label>
                            <input type="text" class="form-control" name="nc_prazo_implatacao"
                                   placeholder="PRAZO PARA IMPLANTA��O">

                        </div>
                        <div class="col-xs-4">
                            <label class="text-info">RESPONS�VEL IMPLANTA��O:</label>
                            <input type="text" class="form-control" name="nc_resp_implantacao"
                                   placeholder="RESPONS�VEL PELA IMPLANTA��O">

                        </div>
                        <div class="col-xs-4">
                            <label class="text-info">DATA DA IMPLANTA��O:</label>
                            <input type="date" class="form-control" name="nc_data_implantacao" placeholder="DATA"
                                   title="DATA DA IMPLANTA��O">

                            <br>
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary"> Responder</button>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="panel-footer"></div>
            </div>
            <!-- END GESTOR -->
        </div>
    </div>

    <?php
}
Sessao::finalizarSessao();
include_once 'componentes/footerRnc.php';
?>