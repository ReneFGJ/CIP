<?
require("cab_fomento.php");
//require($include.'sisdoc_debug.php');
require("_email.php");

if (!(function_exists('msg')))
{ function msg($x) { return($x); } }

require("_class_comunicacao.php");
$cm = new comunicacao;

require($include.'_class_form.php');
$form = new form;
echo utf8_decode('<h1>Comunicação por e-mail</h1>');
$cp = $cm->cp();
$tela = $form->editar($cp,'comunicacao');

if ($form->saved > 0)
	{
		$id = $cm->last_id();
		if ($id > 0)
			{
				redirecina("comunicacao_preview.php?dd0=".$id."&dd90=".checkpost($id));
			} else {
				echo $tela;
			}
				
	} else {
		echo $tela;		
	}


		
if ($saved > 0)
	{
		$email_producao = $dd[3];
		$total = 0;
		$usnome = 'X';
		if ($dd[9] != 'HTML')
			{
				$e4 = mst($dd[8]);
			} else {
				$e4 = $dd[8];
			}
		$e3 = $dd[7];	
		$style = '<font style=font-family: Tahoma, Arial; font-size: 12px; line-height: 150%; >';
		$e4 = '<TABLE width=600 ><TR><TD><img src='.http.'img/email_'.$id.'_header.png >
				<TR><TD>
				<BR>'.$style.$e4.'</font><BR>
				<TR valign="top"><TD align="right"><BR><BR>
				55 (41) 3271.2128 - e-mail: <A href="mailto:pdi@pucpr.br">pdi@pucpr.br</A>
				<img src='.http.'img/email_'.$id.'_foot.png ></TABLE>';
		$dx = ' '.$dd[3].';';
		echo $e4;
		while (strpos($dx,';') > 0)
			{
			$tot++;
			$e1 = trim(substr($dx,0,strpos($dx,';')));
			$dx = ' '.substr($dx,strpos($dx,';')+1,strlen($dx));
			$email_2 = $e1;
			
			echo '<BR>enviado ';
			if (strlen($email_2) > 0) { enviaremail($email_2,$e2,$e3,$e4); echo $email_2.'<BR>'; }
			}
	echo "<center>Total de ".$tot." comunicados enviados</center>";
	}

require($include."sisdoc_menus.php");
if (($perfil->valid('#PIB')) or ($perfil->valid('#ADM')))
	{
	array_push($menu,array('Inicia��o Cient�fica','Modelo de Mensagens','comunicacao_modelos.php?dd1=bon'));
	} 
$tela = menus($menu,"3");

require("../foot.php");

?>