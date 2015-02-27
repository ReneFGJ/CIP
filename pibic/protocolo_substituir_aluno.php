<?
require("cab_pibic.php");
require($include.'sisdoc_form2.php');
require($include."sisdoc_search.php");
require($include."sisdoc_autor.php");
require($include."sisdoc_windows.php");
//require($include."sisdoc_debug.php");
require($include."sisdoc_colunas.php");
require($include."cp2_gravar.php");
?>
<TABLE align="center" width="<?=$tab_max;?>" border=0 >
<TR valign="top" width="<?=$tab_max;?>" align="center">
<TD align="left" class="lt2">
Bem vindo prof.(a) <B><?=$nome;?></B>.<BR>Cod. funcional: <B><?=$id_pesq;?></B><BR>
<BR>
<??>
<CENTER><h3>Solicitação de substituição de estudante de Inciação Científica<BR>Etapa 1/4</h3></CENTER><HR>
<?
$sql = "select * from ic_noticia where nw_ref = 'PIBIC_SUBST' and nw_idioma = '".$idioma_id."' ";
//and nw_journal = ".$jid;
$rrr = db_query($sql);
if ($eline = db_read($rrr)) { echo '<font class="lt1"><BR>'.$eline['nw_descricao']; }

/* */
$cp = array();
$pos = 0;
if (strlen($dd[1]) == 12) { $dd[1] = substr($dd[1],3,8); }
if (strlen($dd[1]) == 9 ) { $dd[1] = substr($dd[1],0,8); }
array_push($cp,array('$H8','','',False,True,''));
array_push($cp,array('$S12','','<font class=lt1><NOBR>Código do cracha do novo estudante</font>',True,True,''));
array_push($cp,array('$H8','','',False,True,''));
$dx=1;
require("pucpr_aluno.php");
if (strlen($dd[1]) > 0) { $cp[1][0] = $CP1; }
array_push($cp,array('$M8','',$msg,True,True,''));
array_push($cp,array('$H8','','',True,True,''));

//////////////// dados do novo aluno
if (strlen($msg)> 100) ///////////////// ALUNO DA PUCPR
		{ 
		redirecina("protocolo_substituir_aluno_2.php?dd1=".$dd[1].'&dd2='.md5($secu.$dd[1]));
		}
		
	?><TABLE width="500" align="center" class="lt1"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?
?>
<TD width="210">
<? require("resume_menu_left_projetos.php");?>
<BR>
<? // require("resume_menu_left.php");?>
<BR>
<? require("resume_menu_left_3.php");?>
<BR>

</table>
<?

echo '</div></div>';
echo $hd->foot();
?>