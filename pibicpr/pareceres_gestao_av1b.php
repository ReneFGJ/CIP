<?
require("cab.php");
echo '<link rel="stylesheet" href="../css/style_form_001.css" type="text/css" />';
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_email.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require("_email.php");

$cp = array();
if (strlen($dd[1])==0) { $dd[1] = '$nome $instituicao $link'; }
array_push($cp,array('$M8','','Avalições não completadas',False,False));
array_push($cp,array('$T80:7','','Texto do e-mail',True,True));
array_push($cp,array('$O : &T:Na tela&S:Confirmar envio','','tipo',True,True));

editar();

if ($saved > 0)
	{
	$text = $dd[1];
	require("../_class/_class_parecer_pibic.php");
	$pa = new parecer_pibic;
	$pa->tabela = "pibic_parecer_".date("Y");

	$sql = "select * from (
				select pp_avaliador from ".$pa->tabela."  
				where pp_status ='@' and pp_tipo = 'SUBMI' 
				group by pp_avaliador
			) as tabela 
			inner join pareceristas on us_codigo = pp_avaliador and us_journal_id = $jid
			left join instituicao on us_instituicao = inst_codigo
			order by us_nome, us_aceito desc
			";
	$rlt = db_query($sql);	
	$xnome = 'x';	
	while ($line = db_read($rlt))
		{
			$nome = UpperCaseSql(trim($line['us_nome']));
			if ($nome == $xnome) { $cor = '<font color="red">'; } else { $cor = '<font color="black">'; }
			$xnome = $nome;

			if ($line['us_aceito'] != 10) { $cor = '<font color="green">';}			
			echo '<BR>'.$cor.$line['us_codigo'].' '.$line['us_ativo'].' ';
			echo uppercasesql($line['us_nome']);
			echo ' '.$line['id_us'].' ('.$line['us_aceito'].')';
			echo "</font><BR>";
			
			$http = 'http://'.$_SERVER['HTTP_HOST'];
			$chk = substr(md5('pibic'.date("Y").$line['us_codigo']),0,10);
			$link = $http.'/reol/avaliador/acesso.php?dd0='.$line['us_codigo'].'&dd90='.$chk;
			$link = '<A HREF="'.$link.'" target="new">'.$link."</A>";	
			
			$email_1 = trim($line['us_email']);
			$email_2 = trim($line['us_email_alternativo']);
			$inst = trim($line['inst_abreviatura']);
			
			$txt = troca($text,'$nome',$nome);
			$txt = troca($txt,'$link',$link);
			$txt = troca($txt,'$instituicao',$inst);
			
			echo '<BR>'.$email_1.' '.$email_2.'<BR>';
			echo mst($txt);
			echo '<HR>';
			
			if ($dd[2]=='S')
			{
				if (strlen($email_1) > 0)
					{ enviaremail($email_1,'','[PUCPR-IC] Avaliação de projetos de Iniciação Científica',mst($txt)); } 
				if (strlen($email_2) > 0)
					{ enviaremail($email_2,'','[PUCPR-IC] Avaliação de projetos de Iniciação Científica',mst($txt)); } 
				enviaremail('monitoramento@sisdoc.com.br','','[PUCPR-IC] Avaliação de projetos de Iniciação Científica',mst($txt));
				enviaremail('pibicpr@pucpr.br','','[PUCPR-IC] Avaliação de projetos de Iniciação Científica',mst($txt));
			}
		}
	}

?>
