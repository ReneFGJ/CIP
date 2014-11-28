<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captação'));

require("cab_cip.php");
require($include."sisdoc_menus.php");

require("../_class/_class_captacao.php");
$cap = new captacao;

echo $cap->resumo_captacao('');

$menu = array();
/////////////////////////////////////////////////// MANAGERS
//array_push($menu,array('Captação de Recursos','Captação de recursos geral','captacao_geral.php'));
//array_push($menu,array('Captação de Recursos','Bonifições','captacao_bonificacao.php'));
echo '<h3>Operacionalização</h3>';
array_push($menu,array('Cadastros','Cadastro de Agências de Fomento','agencia_de_fomento.php'));

array_push($menu,array('Cadastros','Cadastro de Editais de Fomento','agencia_editais.php'));
array_push($menu,array('Cadastros','Cadastro de Isenções/Bonificações','bonificacao.php'));

array_push($menu,array('Captação de projetos','Registro de captações','captacao_lista.php')); 
//array_push($menu,array('Captação de projetos','Enviar e-mail de Atualização','captacao_lista_email.php'));
array_push($menu,array('Captação de projetos','Últimas Atualizações (data)','captacao_lista_update.php'));

array_push($menu,array('Captação de projetos','Resumo dos status dos indicadores','captacao_status.php'));

array_push($menu,array('Captação de recursos','Resumo das captações','captacao_resumo.php'));

//array_push($menu,array('Captação de projetos (indicadores)','Captação por Vigência / Ano / Agência','captacao_ano_metodo_1.php'));
//array_push($menu,array('Captação de projetos (indicadores)','Captação por Ano','captacao_ano_inicio.php'));
//array_push($menu,array('Captação de projetos (indicadores)','Captação por Agências / ano','captacao_ano_agencia.php'));
//array_push($menu,array('Captação de projetos (indicadores)','Captação por programas','captacao_programas.php'));
//array_push($menu,array('Agências de fomento','Demandas de editais','agencia_editais_demandas.php'));
//array_push($menu,array('Agências de fomento','Convenios de Fomento','agencia_de_fomento.php'));


array_push($menu,array('Bonificação','Resumo de bonificações/captação/isenção','captacao_bonificacao.php'));
//array_push($menu,array('Bonificação','Resumo de bonificações (validados)','captacao_bonificacao.php?dd1=10'));
//array_push($menu,array('Bonificação','Resumo de bonificações (validados pelo coordenador)','captacao_bonificacao.php?dd1=1'));

array_push($menu,array('Bonificação','Gerar Bonificação','bonificacao_fomento_gerar.php'));
//array_push($menu,array('Bonificação','Gerar Bonificação (2)','bonificacao_fomento_gerar_2.php'));


if ($perfil->valid('#CPS'))
	{ 
	array_push($menu,array('Bonificação - Processos','Validação para gerar bonificação (Administração)','bonificacao_@.php'));
	array_push($menu,array('Bonificação - Processos','__Desmembrar pagamento de bonificação','bonificacao_@A.php'));
	array_push($menu,array('Bonificação - Processos','__Cancelar pagamento de bonificação','bonificacao_@X.php'));
	array_push($menu,array('Bonificação - Processos','Comunicação ao professor','bonificacao_A.php'));
	} 
//array_push($menu,array('Bonificação - Processos','__Bonificados','bonificacao_B.php'));

array_push($menu,array('Bonificação - Relatório','Relatório de bonificação','bonificacao_rel.php')); 
array_push($menu,array('Bonificação - Relatório','Relatório de isenção','bonificacao_rel_isencao.php'));


//$sql = "delete from bonificacao where bn_codigo = '00162'";
//$rlt = db_query($sql);
 
?>
<TABLE width="710" align="center" border="0">
<TR>
<?
	$tela = menus($menu,"3");
?>
<? require("../foot.php");	?>