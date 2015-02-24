<?
require("cab_fomento.php");
echo '<link rel="stylesheet" href="../css/style_form_001.css" type="text/css" />';
require($include."sisdoc_windows.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_form2.php");
require($include."sisdoc_email.php");
require($include."cp2_gravar.php");
require("_email.php");

echo '<H3>Comunicação por e-mail</h3>';

	$tps = array();
	array_push($tps,array('000','Informar a lista de e-mail manualmente'));
	array_push($tps,array('003','Docentes com orientações IC (recuperar e-mail)'));
	array_push($tps,array('004','Docentes Stricto Sensu com orientações IC (recuperar e-mail)'));
	array_push($tps,array('005','Docentes Stricto Sensu vinculados a programas de Pós-Graduação'));
	array_push($tps,array('006','Docentes com Doutorado'));
	array_push($tps,array('007','Todos os docentes'));
	
	array_push($tps,array('100','Bolsistas produtividades da Instituição'));
	
	$op .= ' : ';
	for ($r=0;$r < count($tps);$r++)
		{
			if ($dd[1]==$tps[$r][0]) { $tipo = trim($tps[$r][1]); }
			$op .= '&'.$tps[$r][0].':'.$tps[$r][1];
		}

	$tabela = '';
	
	if ((strlen($dd[1]) > 0) and (strlen($dd[3])==0))
		{
			$page = '../pibicpr/'.page();
			$page = troca($page,'.php','_selecao=php');
			$page = troca($page,'=','.');
			if ($dd[1] != '000') { require($page); }
		}
	
	$cp = array();
	array_push($cp,array('$H8','','',False,True,''));
	array_push($cp,array('$O'.$op,'','Informe os destinatários',True,True,''));
	array_push($cp,array('$H8','','',True,True,''));
	array_push($cp,array('$B8','','Avançar >>>',false,True,'botao-geral'));		

	echo '<TABLE width="940" align="center">';
	echo '<TR><TD colspan=2>';
	echo '<H10>'.msg('comunication').'</h10>';
	echo '<TR><TD>';
		editar();
	echo '<TR><TD colspan="2">';
	echo '</TD></TR>';
	echo '</TABLE>';	
		
$id = 'pdi';
		
if ($saved > 0)
	{
		echo $dd[3];
	}

require($include."sisdoc_menus.php");
if (($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
	array_push($menu,array('Iniciação Científica','Modelo de Mensagens','comunicacao_modelos.php?dd1=bon'));
	} 
$tela = menus($menu,"3");

require("../foot.php");

?>