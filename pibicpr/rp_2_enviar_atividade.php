<?php
require("cab.php");
require($include.'sisdoc_email.php');

require("../_class/_class_ic.php");
$icc = new ic;

require("../_class/_class_atividades.php");
$at = new atividades;
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

$sql = "select * from atividade
		inner join pibic_professor on pp_cracha = act_docente 
			where act_codigo ='IC2' and act_status = '@' 
			order by pp_cracha
			";
$rlt = db_query($sql);

$tot = 0;
$totc = 0;

$jid==20;
$line = $icc->ic("IC_RPAC_COMUNICA");

$tit = $line['nw_titulo'];
$txt = $line['nw_descricao'];
$xcracha="x";
while ($line = db_read($rlt))
{
	$cracha = $line['pp_cracha'];
	$tot++;
	
	if ($cracha != $xcracha)
	{
		$totc++;
		$xcracha = $cracha;
		$email_1 = trim($line['pp_email']);
		$email_2 = trim($line['pp_email_1']);
	
		$titu = '[IC] '.$line['pp_protocolo'].' '.$tit;
	
		$cracha = trim($line['pp_cracha']);
		$link = http.'apb.php?dd0='.$cracha;
		$link .= '&dd90='.substr(checkpost($cracha),2,2);
	
		$texto = $txt;
		$link = '<A HREF="'.$link.'" target="new">'.$link.'</A>';
		$texto = troca($texto,'$LINK',$link);
		$texto = troca($texto,'$PROFESSOR',$nome);

		$email0 = array();
		$email1 = array();
		
		if (strlen($email_1) > 0) 
			{ array_push($email1,$email_1); }
		if (strlen($email_2) > 0) 
			{ array_push($email1,$email_2); }
					
		//array_push($email0,'alessandra.lacerda@pucpr.br');
		array_push($email0,'pibicpr@pucpr.br');
		//array_push($email0,'edena.grein@pucpr.br');
		//array_push($email0,'cleybe.vieira@pucpr.br');
		//array_push($email0,'renefgj@gmail.com');

		echo '<HR>';
		echo $line['pp_nome'];	
		echo '<BR>'.$link;
		
		for ($r=0;$r < count($email0);$r++)
			{
				//enviaremail($email1[$r],'',$titu.' - '.trim($line['pp_nome']).' (copia)',$texto); 
				echo '<BR>Enviado para = '.$email0[$r];
			}
			
		for ($r=0;$r < count($email1);$r++)
			{
				//enviaremail($email1[$r],'',$titu.' - '.trim($line['pp_nome']),$texto); 
				echo '<BR>Enviado para = '.$email1[$r];
			}		
	}
}
echo '<HR>';
echo $tot.'/'.$totc;
require("../foot.php");	
?>