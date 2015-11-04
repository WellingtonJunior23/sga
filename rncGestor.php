<?php
include_once 'componentes/TopoRnc.php';

$buca = new Busca();

$buca->setValueGet($_GET,'nc_codigo');


$tbRnc = new TbCadastroRnc();

$_SESSION['rncGestor'] = $tbRnc->getFormRnc($buca->getValueGet('nc_codigo'));

//print_r($_SESSION['rncGestor']);

?>    


<div class="container-fluid">   
    <div class="col-xs-12">
        
        <!-- DESCRI��O RESUMIDA DA RNC -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-check"></span> DESCRI��O DA RNC</h3>
            </div>
            <div class="panel-body">
                
                <div class="col-xs-12">
                    <label class="text-info">N�MERO DA RNC:</label> <?php echo $_SESSION['rncGestor']['nc_codigo']; ?>                    
                    <br>
                </div>
                
                <div class="col-xs-12">
                    <label class="text-info">C�DIGO DO PRODUTO:</label> <?php echo $_SESSION['rncGestor']['nc_codigo_pro']; ?>                    
                    <br>
                </div>
                
                <div class="col-xs-12">
                    <label class="text-info">LOTE:</label> <?php echo $_SESSION['rncGestor']['nc_lote']; ?>                    
                    <br>
                </div>
                
                <div class="col-xs-12">
                    <label class="text-info">OC N�:</label> <?php echo $_SESSION['rncGestor']['nc_oc']; ?>                    
                    <br>
                </div>
                
                <div class="col-xs-12">
                    <label class="text-info">DESCRI��O:</label> <?php echo $_SESSION['rncGestor']['nc_descricao']; ?>                    
                    <br>
                </div>
                
                <div class="col-xs-12">
                    <label class="text-info">QUANTIDADE:</label> <?php echo $_SESSION['rncGestor']['nc_quantidade']; ?>                    
                    <br>
                </div>
                
                <div class="col-xs-12">
                    <label class="text-info">DESCRI��O DA N�O COMFORMIDADE:</label> <?php echo $_SESSION['rncGestor']['nc_descricaocompleta']; ?>                    
                    <br>
                </div>
                
                <div class="col-xs-12">
                    <label class="text-info">LOCAL DA OCORR�NCIA:</label> <?php echo $_SESSION['rncGestor']['nc_local_ocorrencia']; ?>                    
                    <br>
                </div>
                
                <div class="col-xs-12">
                    <label class="text-info">DATA DA OCORR�NCIA:</label> <?php echo $_SESSION['rncGestor']['nc_data_ocorrencia']; ?>                    
                    <br>
                </div>
                
            </div>
        </div>
        <!-- END DESCRI��O RESUMIDA DA RNC -->
        
        <!-- GESTOR -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> GESTOR</h3>
            </div>
            <div class="panel-body"> 
                
                <form name="rncGestor" method="post" action="action/rncResposta.php">
                                        
                    <?php if($_SESSION['erro']):?>
                        <div class="alert alert-danger" role="alert"><?php echo $_SESSION['erro']; ?></div>
                    <?php endif;?>
                        
                    <?php if($_SESSION['mensagem']):?>
                        <div class="alert alert-success" role="alert"><?php echo $_SESSION['mensagem']; ?></div>
                    <?php endif;?>
                
                 <div class="col-xs-12">                    
                    <input type="hidden" class="form-control" name="nc_codigo" placeholder="RESPONS�VEL PELA IMPLANTA��O"
                    value="<?php echo $_SESSION['rncGestor']['nc_codigo']; ?>">
                    <br>
                </div>
                        
                <div class="col-xs-12">
                    <label class="text-info">CAUSAS:</label>
                    <textarea class="form-control" rows="3" name="nc_causas" placeholder="CAUSA DA OCORR�NCIA"></textarea>
                              
                    <br>
                </div>

                <div class="col-xs-12">
                    <label class="text-info">A��O DE MELHORIA:</label>
                    <textarea class="form-control" rows="3" name="nc_acao_melhoria" placeholder="MELHORIA"></textarea>
                              
                    <br>
                </div>
                <div class="col-xs-4">
                    <label class="text-info">PRAZO DE IMPLANTA��O:</label>
                    <input type="text" class="form-control" name="nc_prazo_implatacao" placeholder="PRAZO PARA IMPLANTA��O">
                           
                </div>
                <div class="col-xs-4">
                    <label class="text-info">RESPONS�VEL IMPLANTA��O:</label>
                    <input type="text" class="form-control" name="nc_resp_implantacao" placeholder="RESPONS�VEL PELA IMPLANTA��O">
                           
                </div>
                <div class="col-xs-4">
                    <label class="text-info">DATA DA IMPLANTA��O:</label>
                    <input type="date" class="form-control" name="nc_data_implantacao" placeholder="DATA" title="DATA DA IMPLANTA��O">
                          
                    <br>                    
                </div>
                                
                <div class="form-group">
                    <div class="col-sm-offset-9 col-sm-10">
                        <button type="submit" class="btn btn-primary"> Responder</button>
                        <button type="submit" class="btn btn-primary"> Cancelar</button>
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
Sessao::finalizarSessao();
include_once 'componentes/footerRnc.php';
?>