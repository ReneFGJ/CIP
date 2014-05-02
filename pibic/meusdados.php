<?
$form = true;
require("cab.php");
require($include."sisdoc_form2.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_data.php");
require($include."cp2_gravar.php");

if (strlen($dd[0])==0)
	{
	$sql = "select * from pibic_professor where pp_cracha = '".$user->cracha."' ";
	$rlt = db_query($sql);
	$line = db_read($rlt);
	$dd[0] = $line['id_pp'];
	}
require("cp/cp_pibic_professor.php");
?>
<TABLE align="center" width="<?=$tab_max;?>" border="0" class="lt1" >
<TR valign="top" align="center">
<TD align="left" class="lt1">
<?
	$texto = 'SUB_DADOS';
	$sql = "select * from ic_noticia where nw_ref = 'SUB_DADOS' and nw_idioma = '".$idioma_id."' and nw_journal = ".$jid;	
	$rrr = db_query($sql);
	if ($eline = db_read($rrr))
		{
		$sC = $eline['nw_titulo'];
		$texto = $eline['nw_descricao'];
		} else {
		echo 'SUB_DADOS';
		}
	echo '<h1>'.$sC.'</h1><font class="lt1">';
	echo mst($texto);
	
////////////////////////// editar
$tab_max = "100%";
echo '<TABLE width="100%" align="center"><TR><TD>';
editar();
echo '<TR><TD colspan="10">* campos obrigatórios</TD></TR>';
echo '</TABLE>';

if ($saved > 0)
	{
	$sql = "";
	$sql = "update submit_autor set sa_codigo = ";
	$sql .= "trim(to_char(id_sa,'".strzero(0,7)."')) where (length(trim(sa_codigo)) < 7) or (sa_codigo isnull);";
	$rlt = db_query($sql);
	
	redirect("main.php");
	}	
	

//<TD width="210">
//require("resume_menu_left.php");
//<BR>
//require("resume_menu_left_mail.php");
//<BR>
//require("resume_menu_left_2.php");
?>
</table>
<? require("foot.php"); ?>

<script>
function invi(obj)
{
<? for ($k=0;$k < count($sc1);$k++) { ?>
	if (obj==<?=$k;?>) { dsp<?=$k;?>.style.display = ''; }
<? } ?>
}
</script>
