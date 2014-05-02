<?
$form = true;
require("cab.php");
require($include."sisdoc_form2.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_data.php");
require($include."cp2_gravar.php");

$msg = '../messages/msg_'.page();
if (file_exists($msg)) { require($msg); } else { echo 'Erro: mensagens.'; }

if (strlen($dd[0])==0)
	{
	$sql = "select * from pibic_professor where pp_cracha = '".$user->cracha."' ";
	$rlt = db_query($sql);
	$line = db_read($rlt);
	$dd[0] = $line['id_pp'];
	}
	
if (strlen($dd[4]) == 12)
	{
		$dd[4] = substr($dd[4],3,8);
		require("../_class/_class_discentes.php");
		$dis = new discentes;
		$dis->consulta($dd[4]);
		$dis->le('',$dd[4]);

		if (strlen($dis->pa_nome)==0)
			{
				$dd[4] = '**INVALIDO**';
			} else {
				$dd[2] = $dis->pa_nome;
				$sql = "select * from pibic_professor where pp_cracha = '".$dd[4]."' ";
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
						$dd[0]=$line['id_pp'];
					}
			}
	}
require("cp/cp_pibic_professor2.php");
?>
<TABLE align="center" width="<?=$tab_max;?>" border="0" class="lt1" >
<TR valign="top" align="center">
<TD align="left" class="lt1">
<?
	$texto = msg('information');

	echo '<h2>Cadastro de Doutorando</h2>';
	echo '<font class="lt1">';
	echo mst($texto);
	
////////////////////////// editar
$tab_max = "100%";
echo '<TABLE width="100%" align="center" class="lt1"><TR><TD>';
editar();
echo '<TR><TD colspan="10">* campos obrigatórios</TD></TR>';
echo '</TABLE>';

if ($saved > 0)
	{
		echo '<center>';
		echo '<BR><BR><font color="green">Dados gravados com sucesso!';
		echo '<form action="submissao.php">';
		echo '<input type="submit" value="Entrar no sistema">';
		echo '<form>';
	}

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
