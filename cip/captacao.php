<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Capta��o'));

require("cab_cip.php");
require($include."sisdoc_menus.php");

require("../_class/_class_captacao.php");
$cap = new captacao;

echo $cap->resumo_captacao('');

$menu = array();
/////////////////////////////////////////////////// MANAGERS
//array_push($menu,array('Capta��o de Recursos','Capta��o de recursos geral','captacao_geral.php'));
//array_push($menu,array('Capta��o de Recursos','Bonifi��es','captacao_bonificacao.php'));
echo '<h3>Operacionaliza��o</h3>';
array_push($menu,array('Cadastros','Cadastro de Ag�ncias de Fomento','agencia_de_fomento.php'));

array_push($menu,array('Cadastros','Cadastro de Editais de Fomento','agencia_editais.php'));
array_push($menu,array('Cadastros','Cadastro de Isen��es/Bonifica��es','bonificacao.php'));

array_push($menu,array('Capta��o de projetos','Registro de capta��es','captacao_lista.php')); 
//array_push($menu,array('Capta��o de projetos','Enviar e-mail de Atualiza��o','captacao_lista_email.php'));
array_push($menu,array('Capta��o de projetos','�ltimas Atualiza��es (data)','captacao_lista_update.php'));

array_push($menu,array('Capta��o de projetos','Resumo dos status dos indicadores','captacao_status.php'));

array_push($menu,array('Capta��o de recursos','Resumo das capta��es','captacao_resumo.php'));

//array_push($menu,array('Capta��o de projetos (indicadores)','Capta��o por Vig�ncia / Ano / Ag�ncia','captacao_ano_metodo_1.php'));
//array_push($menu,array('Capta��o de projetos (indicadores)','Capta��o por Ano','captacao_ano_inicio.php'));
//array_push($menu,array('Capta��o de projetos (indicadores)','Capta��o por Ag�ncias / ano','captacao_ano_agencia.php'));
//array_push($menu,array('Capta��o de projetos (indicadores)','Capta��o por programas','captacao_programas.php'));
//array_push($menu,array('Ag�ncias de fomento','Demandas de editais','agencia_editais_demandas.php'));
//array_push($menu,array('Ag�ncias de fomento','Convenios de Fomento','agencia_de_fomento.php'));


array_push($menu,array('Bonifica��o','Resumo de bonifica��es/capta��o/isen��o','captacao_bonificacao.php'));
//array_push($menu,array('Bonifica��o','Resumo de bonifica��es (validados)','captacao_bonificacao.php?dd1=10'));
//array_push($menu,array('Bonifica��o','Resumo de bonifica��es (validados pelo coordenador)','captacao_bonificacao.php?dd1=1'));

array_push($menu,array('Bonifica��o','Gerar Bonifica��o','bonificacao_fomento_gerar.php'));
//array_push($menu,array('Bonifica��o','Gerar Bonifica��o (2)','bonificacao_fomento_gerar_2.php'));


if ($perfil->valid('#CPS'))
	{ 
	array_push($menu,array('Bonifica��o - Processos','Valida��o para gerar bonifica��o (Administra��o)','bonificacao_@.php'));
	array_push($menu,array('Bonifica��o - Processos','__Desmembrar pagamento de bonifica��o','bonificacao_@A.php'));
	array_push($menu,array('Bonifica��o - Processos','__Cancelar pagamento de bonifica��o','bonificacao_@X.php'));
	array_push($menu,array('Bonifica��o - Processos','Comunica��o ao professor','bonificacao_A.php'));
	} 
//array_push($menu,array('Bonifica��o - Processos','__Bonificados','bonificacao_B.php'));

array_push($menu,array('Bonifica��o - Relat�rio','Relat�rio de bonifica��o','bonificacao_rel.php')); 
array_push($menu,array('Bonifica��o - Relat�rio','Relat�rio de isen��o','bonificacao_rel_isencao.php'));


//$sql = "delete from bonificacao where bn_codigo = '00162'";
//$rlt = db_query($sql);
 
?>
<TABLE width="710" align="center" border="0">
<TR>
<?
	$tela = menus($menu,"3");
?>
<? require("../foot.php");	?>