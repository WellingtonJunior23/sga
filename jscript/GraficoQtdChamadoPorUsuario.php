<?php
include_once($_SERVER['DOCUMENT_ROOT']."/sga/componentes/config.php");
?>

var $grafico = jQuery.noConflict();

$grafico(document).ready(function(){
	
	
	$grafico('#containerAqueleDoGrafico').highcharts({
	
			credits:{
			enabled: false
		},
	
	
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        
        title: {
            text: 'Quantidade de Chamado por Atendente'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                },
                showInLegend: true
            }
        },
        series: [{
            type: 'pie',
            name: 'Quantidade',
            data: [
					<?php 
						$tbUsuario = new TbUsuario();
						
						$dados;
						$dados['dep_codigo'] = $_SESSION['dep_codigo'];
						$dados['sta_codigo'] = 2;
						$dados['ace_ativo'] = 'S';
						
						$tbUsuario->graficoChamadoPorUsuario($dados);
						?>
            	  ]
        		}]
    });
})(jQuery);
