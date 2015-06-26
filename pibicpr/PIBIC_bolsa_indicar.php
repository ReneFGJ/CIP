<? ob_start(); ?>
<?
global $nocab;
require('db.php');
require($include.'sisdoc_security.php');
require($include.'sisdoc_debug.php');
security();
$msg = '';
$ok = 1;

///////////////////////////////////////////////////////////////// TIPO DE BOLSA
$bolsa_max_paga = 0;
$bolsa_max_icv  = 2;
$doutor = 0;
$ssens  = 0;
$chm = 15; // carga hor�ria m�nima
$sql = "select * from pibic_professor ";
$sql .= " where pp_cracha = '".trim($dd[1])."' ";

$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
		$ss = $line['pp_ss'];
		$tti = trim($line['pp_titulacao']);
		$sc = $line['pp_carga_semanal'];
		if ($tti == '002') { $bolsa_max_paga = 1; }
		if ($tti == '003') { $bolsa_max_paga = 1; }
		 //$bolsa_max_paga++; 
		 $ssens  = 1; 
//		if ($ss == 'S')   { $bolsa_max_paga++; $ssens  = 1; }
		//if ($tti == '001') { $bolsa_max_paga = 1; }
		
		 $bolsa_max_paga = 2;
	} else {
		echo 'C�digo do professor inv�lido';
		exit;
	}

///////////////////////////////////////
if ($sc < $chm)
	{
	/* Regra cancelado em 26/06/2015 */
	//$ok = -9; $msg .= 'Carga hor�ria inferir a carga m�nima ('.$chm.' horas).';
	}


$sql = "select * from pibic_bolsa ";
$sql .= " where pb_aluno = '".$dd[0]."' ";
$sql .= " and pp_ano = '".date("Y")."' ";
$sql .= " and pb_ativo = 1 ";

$rlt = db_query($sql);
if ($line = db_read($rlt))
	{ 
	$ok = -1; $msg .= 'Aluno j� possui uma bolsa em ['.$line['pb_tipo'].'.<BR>[C] CNPq, [F] Funda��o Arauc�ria, [P] PUCPR, [I] ICV'; 
	}
	
	
//////////////////////////////////////////////////////////////// M�ximo duas bolsas pagas
	if (($dd[5] == 'P') or ($dd[5] == 'F') or ($dd[5] == 'C') or ($dd[5] == 'E') or ($dd[5] == 'U'))
		{
		$sql = "select count(*) as total from pibic_bolsa ";
		$sql .= " where pb_professor = '".$dd[1]."' and (pb_tipo = 'P' or pb_tipo = 'F' or pb_tipo = 'C' or pb_tipo = 'E' or pb_tipo = 'U') and pb_ativo = 1 ";
		$sql .= " and pp_ano = '".date("Y")."' ";
		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{ 
			if ($line['total'] >= $bolsa_max_paga)
				{
				$ok = -5; $msg .= 'Professor j� possui ('.$bolsa_max_paga.'/'.$line['total'].') bolsas pagas.<BR>'; 
				}
			}	
		}
	
////////////////////////////////////////////////////////////////
	if (($dd[5] != 'A') and ($dd[5] != 'R') and ($dd[5] != 'G') and ($dd[5] != 'D') and ($dd[5] != 'U') and ($dd[5] != 'E'))
	{
	$sql = "select count(*) as total from pibic_bolsa ";
	$sql .= " where pb_professor = '".$dd[1]."'  and pb_ativo = 1 ";
	$sql .= " and pp_ano = '".date("Y")."' ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{ 
		if ($line['total'] >= ($bolsa_max_paga+$bolsa_max_icv))
			{
			$ok = -5; $msg .= 'Professor j� possui '.($bolsa_max_paga+$bolsa_max_icv).' bolsas distribu�das.<BR>'; 
			}
		}
	}

////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// REGRA CNPQ
if ($dd[5] == 'C') 
	{
	if (($tti == '002') or ($tti == '003'))
		{
		$sql = "select * from pibic_bolsa ";
		$sql .= " where pb_professor = '".$dd[1]."' and (pb_tipo = 'C' or pb_tipo = 'E')  and pb_ativo = 1 ";
		$sql .= " and pp_ano = '".date("Y")."' ";
		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{ $ok = -2; $msg .= 'Professor j� possui uma bolsa CNPq.<BR>'; }
		} else {
			{ $ok = -7; $msg .= 'Professor n�o tem titula��o de Doutor(a)..<BR>'; }
		}
	}
		

////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// REGRA FUNDACAO
if ($dd[5] == 'F')
	{
	$sql = "select * from pibic_bolsa ";
	$sql .= " where pb_professor = '".$dd[1]."' and pb_tipo = 'F' and pb_ativo = 1 ";
	$sql .= " and pp_ano = '".date("Y")."' ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{ $ok = -3; $msg .= 'Professor j� possui uma bolsa da Funda��o Arauc�ria.<BR>'; }
	}
	
////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// REGRA ICV (M�ximo 2 bolsas)
if ($dd[5] == 'I')
	{
	$sql = "select count(*) as total from pibic_bolsa ";
	$sql .= " where pb_professor = '".$dd[1]."' and pb_tipo = 'I' and pb_ativo = 1 ";
	$sql .= " and pp_ano = '".date("Y")."' ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{ 
		if ($line['total'] >= 2)
			{
			$ok = -4; $msg .= 'Professor j� possui duas bolsas ICV.<BR>'; 
			}
		}
	}	
	
////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// REGRA ESTRAT�GICA PUCPR (Somente n�o SS)
if ($dd[5] == 'U')
	{
	if ($ss == 'S')
		{ 
			$ok = -8; $msg .= 'N�o pode atribuir Bolsa PUCPR para SS.<BR>'; 
		}
	}
////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// REGRA ESTRAT�GICA PUCPR (Somente n�o SS)
if ($dd[5] == 'E')
	{
	if ($ss == 'N')
		{ 
			$ok = -9; $msg .= 'N�o pode atribuir Bolsa CNPQ para n�o SS.<BR>'; 
		}
	}	
////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// REGRA ICV (M�ximo 2 bolsas)
if ($dd[5] == 'P')
	{
	$sql = "select count(*) as total from pibic_bolsa ";
	$sql .= " where pb_professor = '".$dd[1]."' and pb_tipo = 'P' and pb_ativo = 1 ";
	$sql .= " and pp_ano = '".date("Y")."' ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{ 
		if ($line['total'] >= 2)
			{
			$ok = -5; $msg .= 'Professor j� possui duas bolsas PUCPR.<BR>'; 
			}
		}
	}		


if ($ok == 1)
	{
	$sql = "update pibic_bolsa set pb_ativo = 0 where pb_protocolo = '".$dd[2]."' ";
	$rlt = db_query($sql);
	
	$sql = "insert into pibic_bolsa (";
	$sql .= "pb_aluno,pb_professor,pb_protocolo,";
	$sql .= "pb_tipo,pb_data,pb_hora,";
	$sql .= "pb_ativo,pb_ativacao,pb_desativacao,";
	$sql .= "pp_ano";
	$sql .= ") values (";
	$sql .= "'".$dd[0]."','".$dd[1]."','".$dd[2]."',";
	$sql .= "'".$dd[5]."',".date("Ymd").",'".date("H:i")."',";
	$sql .= "1,19000101,19000101,";
	$sql .= "'".date("Y")."'";
	$sql .= ")";
	$rlt = db_query($sql);
	?>
	<script>
		close();
	</script>
	<?
		//require("close.php");
	} else {
		?>
		<center>Erro de Indica��o</center>
		<div align="justify"><?=$msg;?></div>
		<BR><BR><BR><BR>	
		<font size="-3">
		<center>C�digo do erro <?=($ok*(-1));?></center>
		</font>
		<?
	}
?>