<?
require("cab.php");
require($include.'sisdoc_form2.php');
require($include."sisdoc_search.php");
require($include."sisdoc_autor.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_email.php");
require($include."cp2_gravar.php");
?>
<TABLE align="center" width="<?=$tab_max;?>" border=0 >
<TR valign="top" width="<?=$tab_max;?>" align="center">
<TD align="left" class="lt2">
Bem vindo prof.(a) <B><?=$nome;?></B>.<BR>Cod. funcional: <B><?=$id_pesq;?></B><BR>
<BR>
<??>
<CENTER><h3>Solicitação de substituição de estudante de Inciação Científica</h3><B>Etapa 3/3 - Confirmação</B></CENTER><HR>
<?
$sql = "select * from ic_noticia where nw_ref = 'PIBIC_SUBST3' and nw_idioma = '".$idioma_id."' ";
//and nw_journal = ".$jid;
$rrr = db_query($sql);
if ($eline = db_read($rrr)) { echo '<font class="lt1"><BR>'.$eline['nw_descricao']; }

////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////
$dx=1;
$pos = 0;

require("pucpr_aluno_2_mst.php"); 
?>
<table width="100%" class="lt1"><?=$sp;?></table>
<?
//$sql = "delete from pibic_protocolo ";
//$rlt = db_query($sql);

$sql = "select * from pibic_protocolo ";
$sql .= " where pr_aluno_1 = '".$dd[1]."' ";
$sql .= " and pr_aluno_2 = '".$dd[3]."' ";
$sql .= " and pr_tipo = 'SUB' ";
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
		echo '<BR><BR>';
		echo '<font color=RED>Solicitação já cadastrada</font>';
		echo '<BR><BR>';
	} else {
		$sql = "select * from ic_noticia where nw_ref = 'PIBIC_SUBSTE' and nw_idioma = '".$idioma_id."' ";
		//and nw_journal = ".$jid;
		$rrr = db_query($sql);
		if ($eline = db_read($rrr)) { $texto = $eline['nw_descricao']; }


		$qsql = "select * from pibic_bolsa_contempladas ";
		$qsql .= " inner join pibic_aluno on pa_cracha = pb_aluno ";
		$qsql .= " where pb_professor = '".$id_pesq."'";	
		$qsql .= " and pb_aluno = '".$dd[3]."' ";
		$qsql .= " and pb_status = 'A' ";
		$qsql .= " order by pa_nome ";
		if (!($line = db_read($rlt)))
			{ 
			$proto = $line['pb_protocolo'];
			$sql = "insert into pibic_protocolo ";
	
			$sql .= "( pr_codigo , pr_tipo , pr_motivo , ";
			$sql .= " pr_protocolo , pr_aluno_1 , pr_aluno_2 , ";
			$sql .= " pr_status , pr_data , pr_hora , ";
	
			$sql .= " pr_text , pr_ativo , pr_data_ef , ";
			$sql .= " pr_hora_ef , pr_log_ef ";
	
			$sql .= " ) values ( ";
	
			$sql .= " '', 'SUB', '".$dd[4]."',";
			$sql .= " '".$proto."', '".$dd[1]."','".$dd[3]."',";
			$sql .= " 'A',".date("Ymd").",'".date("H:m")."',";

			$sql .= " '', 1 , 1900001, ";
			$sql .= " '', '' ";
			$sql .= ")";
			echo $sql;
			exit;
			$rlt = db_query($sql);
		
			$sql = "update pibic_protocolo set pr_codigo=trim(to_char(id_pr,'0000000')) where (length(trim(pr_codigo)) < 7) or (pr_codigo isnull);";
			$rlt = db_query($sql);
		
			$sql = "select * from pibic_protocolo ";
			$sql .= " where pr_aluno_1 = '".$dd[1]."' ";
			$sql .= " and pr_aluno_2 = '".$dd[3]."' ";
			$sql .= " and pr_tipo = 'SUB' ";
			$rlt = db_query($sql);
			$line = db_read($rlt);
			$est1 = $dd[1];
			$est2 = $dd[3];
			$proto = $line['pr_codigo'];
			//////////////////////////////////// email
			$email = '';
			$t0 = strpos($sp,'Documentos');
			$tt = substr($sp,0,$t0).'</TD></TR>';
			$ta = '<table border=1><TR><TD colspan="2" class="lt2" align="center">Novo estudante</TD></TR><TR><TD>'.$tt.'</TD></TR></table>';
		
			$dx = 3;
			$pos = 0;
			$sp = '';
			$dd[1] = $dd[3];
			require("pucpr_aluno_2_mst.php"); 
			$t0 = strpos($sp,'Documentos');
			$tt = substr($sp,0,$t0).'</TD></TR>';
			$tb = '<table border=1><TR><TD colspan="2" class="lt2" align="center">Estudante retirado</TD></TR><TR><TD>'.$tt.'</TD></TR></table>';
		
			$tt = $ta.'<BR><BR>'.$tb;
			$tit = 'Solicitação de substituição';

			$e1 = 'renefgj@gmail.com';
			$e3 = '[PIBIC] - Solicitação de substituição de aluno - '.$proto ;
			$tt = troca($tt,'$protocolo',$proto);
			$e4 = $texto.'<BR>'.$tt.'<BR><BR><BR>'.$est1.' '.$est2;
			enviaremail($e1,$e2,$e3,$e4);
			////////////////////////////////////// fim			
			echo $tt;
			echo '<font color="green"><center>Solicitação gravada com sucesso!</center></font>';
			} else {
				echo 'Erro ao gravar a solicitação, não foi localizado este estudante no protocolo';
			}
	}
	

	
?>
<TD width="210">
<? require("resume_menu_left_projetos.php");?>
<BR>
<? // require("resume_menu_left.php");?>
<BR>
<? require("resume_menu_left_3.php");?>
<BR>
<? require("resume_menu_left_2.php");?>
<BR>
<? require("resume_menu_left_mail.php");?>

</table>
<?
require("foot_body.php");
require("foot.php");
?>