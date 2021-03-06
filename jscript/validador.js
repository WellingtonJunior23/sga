/**
 * maxlength( length ): M?ximo de caracteres
rangelength( range ): Faz com que o elemento requer um intervalo de valores dado
max( value ): Valor m?ximo permitido
url( ): URL v?lida
date( ): Data v?lida
dateISO( ): Data ISO v?lida
number( ): Campo num?rico
digits( ): S? aceita d?gitos
creditcard( ): Um n?mero de cart?o de cr?dito
equalTo( other ): igual ? um determinado valor
 */

var $valida = jQuery.noConflict();


/*
var usuario  = 'Utilizador';
var problema = 'Servi?o';
var ramal = 'Extens?o';
var senha = 'Palavra-passe';
*/


var usuario  = 'Usu�rio';
var problema = 'Problema';
var ramal = 'Ramal';
var senha = 'Senha';

function submitForm(form){			
	
	
	$valida("#botaoSave").hide();
	$valida(".botaoSave").css("visibility","visible");

	form.submit();
	
	}


$valida(document).ready( function() 
{
	
	$valida("#meuproblema").validate({
		/* REGRAS DE VALIDA??O DO FORMUL?RIO */
		rules:{
			pro_descricao:{
				required: true, /* Campo obrigat?rio */
				minlength: 5    /* No m?nimo 5 caracteres */
			},
			dep_codigo_problema:{
				required: true
			}
		},
		/* DEFINI??O DAS MENSAGENS DE ERRO */
		messages:{
			pro_descricao:{
				required: "Preencha o campo <u>" +problema+ "</u>",
				minlength: "O campo <u>" +problema+ "</u> deve conter no m�nimo 5 caracteres"
			},
			dep_codigo_problema:{
				required: "Campo Departamento � Obrigadorio"
			}
		}
	});

	$valida("#projeto").validate({

		rules:{
			pro_titulo:{
				required: true, /* Campo obrigat?rio */
				minlength: 5    /* No m?nimo 5 caracteres */
			},
			pro_descricao:{
				required: true
			}
		},
		messages:{
			pro_titulo:{
				required: "Preencha o campo <u>Titulo</u>",
				minlength: "O campo <u>Projeto</u> deve conter no m�nimo 5 caracteres"
			},
			pro_descricao:{
				required: "Campo Descri��o do projeto � Obrigadorio"
			}
		},
		
		submitHandler: function(form){
			submitForm(form);
		}
	});
	
		/*Inicio de valida??o do formul?rio de solicitacao*/
		$valida("#solicitacao").validate({
			/* REGRAS DE VALIDA??O DO FORMUL?RIO */
			rules:{
				dep_codigo:{
					required: true
				},
				pro_codigo:{
					required: true
				},
				sol_descricao_solicitacao:{
					required: true,
					minlength: 20
				}
			},
			/* DEFINI??O DAS MENSAGENS DE ERRO */
			messages:{
				dep_codigo:{
					required: "O campo departamento � obrigat�rio"
				},
				pro_codigo:{
					required: "O campo " +problema+ " � obrigat�rio"
				},
				sol_descricao_solicitacao:{
					required: "O Campo Descri��o � obrigat�rio",
					minlength: "O Campo Descri��o deve possuir no minimo 20 caracteres"
				}
				
			},
			
			submitHandler: function(form){			
				submitForm(form);
			}
			});
		/*Fim de valida??o do formul?rio de solicitacao*/
	
		/*Inicio de valida??o do formul?rio de assentamento*/
		$valida("#Assentamento").validate({
			/* REGRAS DE VALIDA??O DO FORMUL?RIO */
			rules:{
				
				ass_descricao:{
					required: true,
					minlength: 10
				}
			},
			/* DEFINI??O DAS MENSAGENS DE ERRO */
			messages:{
				ass_descricao:{
					required: "O campo Descri��o do Assentamento � obrigat�rio",
					minlength: "O campo Descri��o do Assentamento precisa de ao menos 10 caracteres"
				}
			},
			submitHandler: function(form){
				submitForm(form);	
			}
		});
		/*Fim de valida??o do formul?rio de assentamento*/	
		
		/*Inicio de valida??o do formul?rio do relatorio de solucao*/
		$valida("#relatoriosolucao").validate({
			/* REGRAS DE VALIDA??O DO FORMUL?RIO */
			
			
			rules:{
				
				hora_ini:{
					required: true
				}
			},
			/* DEFINI??O DAS MENSAGENS DE ERRO */
			messages:{
				hora_ini:{
					required: "O campo inicio � obrigat�rio"
				}
			},
			submitHandler: function(form){
				submitForm(form);	
			}
		});
		/*Fim de valida??o do formul?rio do relatorio de solucao*/	
		
		/*Inicio de valida??o do formul?rio do relatorio de Abertura de melhoria*/
		$valida("#solicitacaoMelhoria").validate({
			/* REGRAS DE VALIDA??O DO FORMUL?RIO */
			
			
			rules:{
				
				sis_codigo:{
					required: true
				},
				
				som_descricao:{
						required: true,
						minlength: 20
				}
			},
			/* DEFINI??O DAS MENSAGENS DE ERRO */
			messages:{
				
				sis_codigo: {
						required: "O campo sistema, � obrigat�rio"
				},
				
				som_descricao:{
					required: "O campo descri��o � obrigat�rio",
					minlength: "� necess�rio ao menos 20 caracteres"
				}
			},
			submitHandler: function(form){
				submitForm(form);	
			}
		});
		/*Fim de valida??o do formul?rio do relatorio de Abertura de melhoria*/	
		
		/*Inicio de valida??o do formul?rio do relatorio de Apontamento de melhoria*/
		$valida("#ApontamentoMelhoria").validate({
			/* REGRAS DE VALIDA??O DO FORMUL?RIO */
			
			rules:{
				
				apm_descricao:{
					required: true
				},
				
				stm_codigo:{
						required: true
				}
			},
			/* DEFINI??O DAS MENSAGENS DE ERRO */
			messages:{
				
				apm_descricao: {
						required: "O campo descri��o, � obrigat�rio"
				},
				
				stm_codigo:{
					required: "O campo status � obrigat�rio"
				}
			},
			submitHandler: function(form){
				submitForm(form);	
			}
		});
		/*Fim de valida??o do formul?rio do relatorio de Apontamento de melhoria*/	
		
		
		/*Inicio de valida??o do formul?rio de Atividade*/
		$valida("#atividade").validate({
			/* REGRAS DE VALIDA??O DO FORMUL?RIO */
			rules:{
				
				at_previsao_inicio:{
					required: true
				},
				
				at_previsao_fim:{
					required: true
				},
				
				usu_codigo_responsavel:{
					required: true
				},
				pro_codigo:{
					required: true
				},
				at_descricao:{
					required: true,
					minlength: 10
				}
			},
			/* DEFINI??O DAS MENSAGENS DE ERRO */
			messages:{
				
				at_previsao_inicio:{
					required: "O campo Previs�o de Inicio � obrigat�rio"
				},
				
				at_previsao_fim:{
					required: "O campo Previs�o de Fim � obrigat�rio"
				},
				
				usu_codigo_responsavel:{
					required: "O campo Usu�rio Executor � obrigat�rio"
				},
				pro_codigo:{
					required: "O campo Projeto � obrigat�rio"
				},
				at_descricao:{
					required: "O campo Descri��o da atividade � obrigat�rio",
					minlength: "O campo Descri��o da atividade precisa de ao menos 10 caracteres"
				}
			}
		});
		/*Fim de valida??o do formul?rio de Atividade*/

    $valida("#EnvioTerceiro").validate({
        /* REGRAS DE VALIDA??O DO FORMUL?RIO */


        rules:{

            sot_descricao_inclusao:{
                required: true,
                minlength: 10
            },

            sot_descricao_remocao:{
                required: true,
                minlength: 10
            },

            ter_codigo:{
                required: true

            }
        },
        /* DEFINI??O DAS MENSAGENS DE ERRO */
        messages:{

            sot_descricao_inclusao: {
                required: "O campo Descricao, � obrigat�rio",
                minlength: "� necess�rio ao menos 10 caracteres"
            },

            sot_descricao_remocao: {
                required: "O campo Descricao, � obrigat�rio",
                minlength: "� necess�rio ao menos 10 caracteres"
            },

            ter_codigo:{
                required: "O campo terceiro � obrigat�rio"

            }
        },
        submitHandler: function(form){
            submitForm(form);
        }
    });


	$valida("#Apontamento").validate({

		rules:{

			ap_descricao:{
				required: true,
				minlength: 10
			}
		},
		/* DEFINI??O DAS MENSAGENS DE ERRO */
		messages:{

			ap_descricao: {
				required: "O campo Descricao do apontamento, � obrigat�rio",
				minlength: "� necess�rio ao menos 10 caracteres"
			}
		},
		submitHandler: function(form){
			submitForm(form);
		}
	});

	$valida("#associarocorrencia").validate({

		rules:{

			nc_codigo:{
				required: true
			}
		},
		/* DEFINI??O DAS MENSAGENS DE ERRO */
		messages:{

			nc_codigo: {
				required: "O campo RNC, � obrigat�rio",
				}
		},
		submitHandler: function(form){
			submitForm(form);
		}
	});

	$valida("#versao").validate({

		rules:{

			sis_codigo:{
				required: true
			},
			vso_versao: {
				required: true
			},
			vso_aprovador: {
				required: true
			},
			vso_data: {
				required: true
			},
			vso_novas_instalacoes: {
				required: true
			}
		},
		/* DEFINI??O DAS MENSAGENS DE ERRO */
		messages:{

			sis_codigo: {
				required: "O campo Sistema � obrigat�rio",
			},
			vso_versao: {
				required: "O campo Vers�o � obrigat�rio",
			},
			vso_aprovador: {
				required: "O campo Aprovador � obrigat�rio",
			},
			vso_data: {
				required: "O campo Data � obrigat�rio",
			},
			vso_novas_instalacoes: {
				required: "O campo Data � obrigat�rio",
			}

		},
		submitHandler: function(form){
			submitForm(form);
		}
	});


});