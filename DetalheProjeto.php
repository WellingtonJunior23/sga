<?php
include_once 'componentes/TopoDescricaoProjeto.php';

$buscar = new Busca();

$tbAtividade = new TbAtividade();

$buscar->setValueGet($_GET,'pro_codigo');

$pro_codigo = $buscar->getValueGet('pro_codigo');

$tbProjeto = new TbProjeto();

$dadosProjeto = $tbProjeto->getInfoDetalhePainelProjeto($pro_codigo);

$planejamentoAtividade = $tbAtividade->getPlanejamentoAtividade($pro_codigo);

$tbAtaReuniao = new TbAtaReuniao();

/*echo '<pre>';
print_r($tbAtividade->listarAtividadeByProjeto($pro_codigo));
echo '</pre>';*/

?>

    <div class="container-fluid">
        <div class="col-xs-12">

            <!-- DESCRI??O RESUMIDA DA RNC -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;PROJETO: <?php echo $dadosProjeto['pro_titulo']; ?></h3>
                </div>
                <div class="panel-body">


                    <div class="col-xs-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">

                            </div>
                            <div class="panel-body">

                                <!-- Detalhes do projeto -->
                                <div class="col-xs-12">
                                    <label class="text-warning">Solicitante:</label> <?php echo $dadosProjeto['solicitante']; ?>
                                    <br>
                                </div>
                                <div class="col-xs-12">
                                    <label class="text-warning">Respons�vel:</label> <?php echo $dadosProjeto['responsavel']; ?>
                                    <br>
                                </div>
                                <div class="col-xs-12">
                                    <label class="text-warning">Departamento Respons�vel:</label> <?php echo $dadosProjeto['departamento']; ?>
                                    <br>
                                </div>
                                <div class="col-xs-12">
                                    <label class="text-warning">Status:</label> <?php echo $dadosProjeto['pro_status']; ?>
                                    <br>
                                </div>
                                <div class="col-xs-12">
                                    <label class="text-warning">Previs�o Inicio:</label>
                                    <?php echo ValidarDatas::dataCliente($dadosProjeto['pro_previsao_inicio']); ?>
                                    <br>
                                </div>
                                <div class="col-xs-12">
                                    <label class="text-warning">Previs�o de Finaliza��o:</label>
                                    <?php echo ValidarDatas::dataCliente($dadosProjeto['pro_previsao_fim']); ?>
                                </div>
                                <div class="col-xs-12">
                                    <label class="text-warning">Quantide de dias do projeto:</label>
                                    <?php
                                    $incio = new DateTime($dadosProjeto['pro_previsao_inicio']);
                                    $final = new DateTime($dadosProjeto['pro_previsao_fim']);

                                    echo $incio->diff($final)->days;
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-xs-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">

                            </div>
                            <div class="panel-body">

                                <!-- Detalhes do projeto -->
                                <div class="col-xs-12">
                                    <label class="text-warning">Descri��o:</label> <?php echo $dadosProjeto['pro_descricao']; ?>
                                    <br>
                                </div>
                                <div class="col-xs-12">
                                    <label class="text-warning">Atividades Planejadas:</label> <?php echo $planejamentoAtividade['0']['0']; ?>
                                    <br>
                                </div>

                                <div class="col-xs-12">
                                    <label class="text-warning">Atividades N�o Planejadas:</label> <?php echo $planejamentoAtividade['1']['0']; ?>
                                </div>

                                <div class="col-xs-12">
                                    <label class="text-warning">Quantidade de Atividades:</label>
                                    <?php
                                    echo $planejamentoAtividade['0']['0'] + $planejamentoAtividade['1']['0'];
                                    ?>
                                </div>

                                <ul class="list-group">

                                    <div class="col-xs-12">
                                        <li class="list-group-item">
                                            <button value="<?php echo $pro_codigo; ?>" type="button" class="btn btn-primary btn-xs" id="apontamento" data-toggle="modal" data-target="#myModal" title="Apontamento do projeto">
                                                <span class="glyphicon glyphicon-hand-right"></span> Apontamento(s) do Projeto
                                            </button>
                                        </li>
                                    </div>

                                    <div class="col-xs-12">
                                        <li class="list-group-item">
                                            <button value="<?php echo $pro_codigo; ?>" type="button" class="btn btn-primary btn-xs" id="files" data-toggle="modal" data-target="#myModal" title="Apontamento do projeto">
                                                <span class="glyphicon glyphicon-hand-right"></span> Arquivos(s) do Projeto
                                            </button>
                                        </li>
                                    </div>


                                </ul>
                                <!--
                                <div class="col-xs-12">
                                    <label class="text-warning">Status :</label> Em Andamento
                                </div>-->

                            </div>
                        </div>
                    </div>

                    <div class="col-xs-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"></h3>
                            </div>
                            <div class="panel-body">

                                <!-- Detalhes do projeto -->
                                <div class="col-xs-12">

                                    <ul class="list-group">
                                        <?php
                                        foreach($tbAtaReuniao->listarPauta($pro_codigo)->fetchAll(\PDO::FETCH_ASSOC) as $ata):

                                            $form = unserialize($ata['form_ata_reuniao']);

                                            ?>
                                            <li class="list-group-item">
                                                <button value="<?php echo $ata['ata_codigo']; ?>" id="ata" type="button" class="btn btn-primary btn-xs"
                                                        data-toggle="modal" data-target="#myModal" title="Ata reuni�o">
                                                    <span class="glyphicon glyphicon-book"></span>
                                                        Ata: <?php echo $form['ata_assunto']?>

                                                </button>
                                            </li>
                                            <?php
                                        endforeach;
                                        ?>
                                    </ul>

                                </div>

                            </div>
                        </div>
                    </div>


                    <!-- Detalhes do projeto -->

                    <!-- Lista de atividades -->
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title"><span class="glyphicon glyphicon-cog"></span> ATIVIDADES DO PROJETO</div>
                            </div>

                            <div class="panel-body">
                                <p class="text-center">
                                    LEGENDA DAS ATIVIDADES:
                                    <span class="label label-success"> &nbsp;</span>&nbsp; Dentro do prazo &nbsp;
                                    <span class="label label-warning"> &nbsp;</span>&nbsp; Estourando o prazo &nbsp;
                                    <span class="label label-danger"> &nbsp;</span>&nbsp; Fora do prazo &nbsp;

                                </p>

                                <?php
                                foreach($tbAtividade->listarAtividadeByProjeto($pro_codigo) as $atividade):

                                    $calculatePercent = new CalculatePercent($atividade['previsao_inicio'],
                                        $atividade['previsao_fim'],
                                        $atividade['atual']);

                                    ?>
                                    <div class="col-xs-6">
                                        <div class="panel panel-<?php echo $calculatePercent->getColor(); ?>">
                                            <div class="panel-heading">
                                                <div class="panel-title">

                                                    <button value="<?php echo $atividade['at_codigo']; ?>" id="atividade" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" title="Ver Atividade">
                                                        <span class="glyphicon glyphicon-eye-open"></span>
                                                    </button>

                                                    <a>Atividade: <?php echo $atividade['at_codigo']; ?> |
                                                        Respons�vel: <?php echo $atividade['responsavel']; ?> |
                                                        Status: <?php echo $atividade['status']; ?> </a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endforeach;
                                ?>

                            </div>
                        </div>
                    </div>
                    <!-- Fim Lista de atividades -->


                    <div class="col-xs-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h3 class="panel-title">
                                        <span class="glyphicon glyphicon-picture"></span>
                                        Quantidade de Atividade por Status
                                    </h3>
                                </div>
                            </div>

                            <div class="panel-body">

                                <span id="graficoAtividade1"></span>

                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h3 class="panel-title">
                                        <span class="glyphicon glyphicon-picture"></span>
                                        Porcentagem de Atividade Dentro e Fora do Prazo
                                    </h3>
                                </div>
                            </div>

                            <div class="panel-body">

                                <span id="graficoAtividade2"></span>

                            </div>
                        </div>
                    </div>



                </div>
                <div class="panel-footer"></div>
            </div>
        </div>
    </div>

<?php
include_once 'componentes/footerPainel.php';
?>