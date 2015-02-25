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
			$page = '../pibicpr/comunicacao.php';
			$page = troca($page,'.php','_selecao=php');
			$page = troca($page,'=','.');
			if ($dd[1] != '000') { require($page); }
		}
	
	echo $dd[3];

require("../foot.php");

?>