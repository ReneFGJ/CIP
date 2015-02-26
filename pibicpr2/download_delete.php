<?
require("db.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_cookie.php");
$user_id = read_cookie('nw_user');
$user_nome = read_cookie('nw_user_nome');
$user_nivel = read_cookie('nw_nivel');
$user_log = read_cookie('nw_log');

$nucleo = 'pibic_ged';

//			$sql = "update reol_submit_files set ";
//			$sql .= " pl_codigo = '0".substr($protocolo,1,6)."' ";
//			$sql .= " where id_pl = '0".$dd[0]."'";
//			$rlt = db_query($sql);

if (strlen($user_id) ==0)
	{
	echo '<CENTER><font color="RED" size=2 face="verdana">Erro de Login</font></CENTER>';
	exit;
	}


if ((strlen($dd[2])==0) or (strlen($dd[1])==0))
	{
	echo 'Falha na autenticação';
	exit;
	}
$sql = "select * from pibic_ged_files ";
$sql .= " inner join pibic_submit_documento on pl_codigo = doc_protocolo ";
$sql .= " where id_pl=".$dd[0];
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
		$protocolo = trim($line['doc_protocolo']);
		$file = trim($line['pl_filename']);
		$filename = trim($line['pl_texto']);
		$arq = $uploaddir;
		$arq = $file;
		?>
		<form>
			<input type="hidden" name="dd0" value="<?=$dd[0];?>">
			<input type="hidden" name="dd1" value="<?=$dd[1];?>">
			<input type="hidden" name="dd2" value="<?=$dd[2];?>">
			<input type="hidden" name="dd3" value="<?=$dd[3];?>">
			<center><input type="submit" name="dd50" value="CONFIRMAR EXCLUSÂO"></center>
		</form>
		<?

		
		if ((strlen($dd[50]) > 0) and ($dd[0] > 0))
			{
			echo 'Excluir';
			$sql = "update ".$nucleo."_files set ";
			$sql .= " pl_codigo = '*".substr($protocolo,1,6)."' ";
			$sql .= " where id_pl = '0".$dd[0]."'";
//			echo $sql;
//			exit;
// update pibic_ged_files set pl_codigo = '*002070' where id_pl = '02892'
			$rlt = db_query($sql);
			require("close.php");
			exit;
			}
	} else {
		echo 'Arquivo não localizadao';
	}
	$nucleo = 'PIBIC';
	$pj_codigp = $dd[1];
	$acao="D";

?>