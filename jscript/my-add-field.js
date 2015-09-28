/**
 * Created by marcio on 21/08/15.
 */

$(document).ready(function(){

    //alert('Carregou');
});


$(document).on('click','#criaracesso',function(event){

    //event.preventDefault();
    //alert('Teste');

    var dados = $('#formsolicitacaoacesso').serialize();

   /* $.post('receberform.php',{data: dados },function(data){
        $('#loadform').html(data);
    });
*/
    $.ajax({
        type: "POST",
        url: "receberform.php",
        data: dados,

        beforeSend: function()
        {

            $("#criaracesso").hide();

        },

        complete: function()
        {
            //alert('Complete');

        },

        success: function(data)
        {
            //alert('Sucess');
            $('#loadform').html(data);
            $("#criaracesso").show();

        },

        error: function(){
            alert("Houve um erro na Requisicao");
        }
    });

    return false;

});

var x = 0;

validarPermissoes = function(){
    if(x < 1){
        alert('Voc� deve selecionar ao menos uma permiss�o!');
        return false;
    }
};

$(document).on('click','#incluir',function(event){

    event.preventDefault();

    servico =  $('select[name="servico"]').val();
    perfil = $('select[name="perfil"]').val();

    if((servico =='') || (perfil=='')){
        alert('Por favor Selecione Servico e Perfil!');
        return false;
    }



    if(x >=5){
        alert('Limite m�ximo por solicita��o atingido!!!');
    }else {

       var servico =  $('select[name="servico"]').val();
       var perfil = $('select[name="perfil"]').val();

        $.post('forms/solicitacaoacessoservicos.php',
                {post_servico: servico, post_perfil: perfil},
            function (data) {
                $('#insercao').append(data);
        });

        x++;
    }
});

$(document).on('click','.remover',function(event){

    x--;
    event.preventDefault();
    $(this).parent().parent().remove();
});



$(document).on('change','select[name="servico"]',function(){

    var valor = $(this).val();

  $.post('forms/solicitacaoacessoperfil.php',
        {post_service: valor}, function (data) {
        $('select[name="perfil"]').html(data);
    });

});
