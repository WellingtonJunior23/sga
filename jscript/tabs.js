/*
<!-- 
   fun��o para ativar a funcionalide
   das tabs.
 -->
<script>


  $(function() {
    $( "#tabs" ).tabs();
    $(".campoData").mask("99/99/9999");
  });
</script>
*/

var $mas = jQuery.noConflict();

$mas(document).ready(function(){
	$mas("#telausuarioatividade").css('background','#E0FFFF');
	
$mas("#usuarioatividade").toggle(
		function(){
	          
		       $mas("#esconder").hide('fast');
		       $mas("#usuarioatividade").html('<a href="#">Informa��es da Atividade [Mostrar]</a>').css("color","#06C");
		       
	        },
	    function(){
		       $mas("#esconder").show('slow');
		       $mas("#usuarioatividade").html('<a href="#">Informa��es da Atividade [Ocultar]</a>').css("color","#06C");
		       
	        });
})(jQuery);