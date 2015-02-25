<? ob_start(); ?>
<?
global $nocab;
require('db.php');
require($include.'sisdoc_security.php');
require($include.'sisdoc_debug.php');
security();

$ok = 1;
$sql = "select * from pibic_bolsa ";
$sql .= " where pb_aluno = '".$dd[0]."' ";
$sql .= " and pb_ativo = 1 ";
$sql .= " and pb_tipo = '".$dd[5]."' ";
$sql .= " and pb_professor = '".$dd[1]."' ";
$sql .= " and pp_ano ='".date("Y")."' ";
//echo $sql;
$msg = '';
$rlt = db_query($sql);
if ($line = db_read($rlt))
	{ 
		$id = $line['id_pb'];
	} else {
		echo $sql;
		$ok = -1; $msg .= 'Aluno já possui uma bolsa em ['.$line['pb_tipo'].'.<BR>[C] CNPq, [F] Fundação Araucária, [P] PUCPR, [I] ICV'; 
	}

if ($ok == 1)
	{
		$sql = "update pibic_bolsa set pb_ativo = 0 ";
		$sql .= " where id_pb = ".$id;
		$rlt = db_query($sql);
		?>
		<script>
			close();
		</script>		
		<?
		//require("close.php");
	} else {
		?>
		<center>Erro de Indicação</center>
		<div align="justify"><?=$msg;?></div>
		<BR><BR><BR><BR>	
		<font size="-3">
		<center>Código do erro <?=($ok*(-1));?></center>
		</font>
		<?
	}
?>