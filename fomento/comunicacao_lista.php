<?
require("cab_fomento.php");
echo '<link rel="stylesheet" href="../css/style_form_001.css" type="text/css" />';
require($include."_class_form.php");
$form = new form;

require("_email.php");

echo '<H3>Comunica��o por e-mail</h3>';

	$tps = array();
	//array_push($tps,array('000','Informar a lista de e-mail manualmente'));
	array_push($tps,array('003','Docentes com orienta��es IC (recuperar e-mail)'));
	array_push($tps,array('004','Docentes Stricto Sensu com orienta��es IC (recuperar e-mail)'));
	array_push($tps,array('005','Docentes Stricto Sensu vinculados a programas de P�s-Gradua��o'));
	array_push($tps,array('006','Docentes com Doutorado'));
	array_push($tps,array('007','Todos os docentes'));
	
	array_push($tps,array('100','Bolsistas produtividades da Institui��o'));
	
	$op .= ' : ';
	for ($r=0;$r < count($tps);$r++)
		{
			if ($dd[1]==$tps[$r][0]) { $tipo = trim($tps[$r][1]); }
			$op .= '&'.$tps[$r][0].':'.$tps[$r][1];
		}

	$tabela = '';
	$cp = array();
	array_push($cp,array('$H8','','',False,False));
	array_push($cp,array('$O '.$op,'','',False,False));
	array_push($cp,array('$H8','','',False,False));
	array_push($cp,array('$H8','','',False,False));
	array_push($cp,array('$H8','','',False,False));
	array_push($cp,array('$B8','','Selecionar >>>',False,False));
	
	$tela = $form->editar($cp,'');
	
	if ($form->saved > 0)
	{
	if ((strlen($dd[1]) > 0) and (strlen($dd[3])==0))
		{
			$page = '../pibicpr/comunicacao.php';
			$page = troca($page,'.php','_selecao=php');
			$page = troca($page,'=','.');
			if ($dd[1] != '000') { require($page); }
		}
	
	echo $dd[3];
	} else {
		echo $tela;			
	}

require("../foot.php");

?>