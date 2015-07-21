<? ob_start(); ?>
<?
global $nocab;
$include = '../';
require('../db.php');
require($include.'sisdoc_debug.php');
?>
<head>
<link rel="STYLESHEET" type="text/css" href="letras.css">
</head>
<table width="100%" class="lt1">
<TR valign="top"><TD>	
<?
$msg = '';
$ok = 1;

/* Excluir todas as bolsas */
//$sql = "delete from pibic_bolsa ";
//$rlt = db_query($sql);

/* Recupera bolsa atual */
$sql = "select * from pibic_bolsa ";
$sql .= " where pb_aluno = '".$dd[0]."' ";
$sql .= " and pp_ano = '".date("Y")."' ";
$sql .= " and pb_protocolo = '".$dd[2]."' ";
$sql .= " and pb_ativo = 1 ";
$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
		$bolsa = trim($line['pb_tipo']);
	} else {
		$bolsa = '';
	}

/* Sem Bolsa */
if ($dd[5] == '')
	{
	$sql = "select * from pibic_bolsa_tipo where pbt_edital = '".$edital."' ";
	if (strlen($bolsa) > 0)
		{
		$sql .= " and pbt_codigo = '".$bolsa."' ";
		}
	$sql .= " and pbt_ativo = 1 ";
	$sql .= " order by pbt_descricao ";
	$rlt = db_query($sql);
	
	?>
	<form method="post" action="<?=$edital;?>_bolsa_indicar_tipo.php">
	<input type="hidden" name="dd0" value="<?=$dd[0];?>">
	<input type="hidden" name="dd1" value="<?=$dd[1];?>">
	<input type="hidden" name="dd2" value="<?=$dd[2];?>">
	<B><I>Indicar Bolsa</b></I>
	<?
	while ($line = db_read($rlt))
		{
		$chk = '';
		$cd = trim($line['pbt_codigo']);
		if ($cd == $bolsa) { $check = 'checked'; }
		echo '<BR><input type="radio" name="dd5" value="'.$line['pbt_codigo'].'" '.$chk.'>'.$line['pbt_descricao'];
		}
	if (strlen($bolsa) > 0) {
	?>
		<BR><input type="radio" name="dd5" value="-" >Remover indicação de bolsa
	<? } ?>
	<BR><input type="submit" name="acao" value="Indicar bolsa">
	</form>
	<TD><B>Bolsas distribuídas do professor</B>
	<?
		$sql = "select count(*) as total, pb_tipo, pbt_descricao, pbt_edital from pibic_bolsa 
		left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
				where pb_professor = '".$dd[1]."'
				and pp_ano = '".date("Y")."' 
				group by pbt_descricao, pbt_edital, pb_tipo 
				";
		$rlt = db_query($sql);
		
		while ($line = db_read($rlt))
		{
			echo '<BR>('.$line['total'].') '.$line['pbt_descricao'];
			echo ' <B>'.$line['pbt_edital'].'</B> - '.$line['pb_tipo'];
		}
		
	
	
	
	exit;
	}

///////////////////////////////////////////////////////////////// TIPO DE BOLSA
$bolsa_max_paga = 0;
$bolsa_max_icv  = 4;
$doutor = 0;
$ssens  = 0;


/* RN */
$chm = 1; // carga horária mínima
$sql = "select * from pibic_professor ";
$sql .= " where pp_cracha = '".trim($dd[1])."' ";

$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
		$ss = $line['pp_ss'];
		$tti = trim($line['pp_titulacao']);
		$sc = $line['pp_carga_semanal'];
		if ($tti == '002') { $bolsa_max_paga = 0; } /* Mestre */
		if ($tti == '003') { $bolsa_max_paga = 1; } /* Doutor */
		 $bolsa_max_paga++; $ssens  = 1; 
		if ($tti == '001') { $bolsa_max_paga = 2; }
		$bolsa_max_paga = 2;
	} else {
		echo 'Código do professor inválido';
		exit;
	}

/* RN25	Professor com carga horário superior a 1 hora */
if ($sc < $chm)
	{
		/* Regra cancelado em 26/06/2015 */
		// $ok = -9; $msg .= 'Carga horária inferir a carga mínima ('.$chm.' horas).'; 
	}

/* LImite de bolsas pagas */
//////////////////////////////////////////////////////////////// Máximo duas bolsas pagas
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
				$ok = -5; $msg .= 'Professor já possui ('.$bolsa_max_paga.') bolsas pagas.<BR>'; 
				}
			}	
		}
	
////////////////////////////////////////////////////////////////
	echo '>>>'.$dd[5];
	if ((($dd[5] != 'A') and ($dd[5] != 'R') and ($dd[5] != 'G') and ($dd[5] != 'D') and ($dd[5] != 'U') and ($dd[5] != 'E')) and ($dd[5] != '-'))
	{
	$sql = "select count(*) as total from pibic_bolsa ";
//	$sql .= " inner join ";
	$sql .= " where pb_professor = '".$dd[1]."'  and pb_ativo = 1 ";
	$sql .= " and pp_ano = '".date("Y")."' ";
	$rlt = db_query($sql);

	if ($line = db_read($rlt))
		{ 
		if ($line['total'] >= ($bolsa_max_paga+$bolsa_max_icv+10))
			{
			$ok = -5; $msg .= 'Professor já possui '.($bolsa_max_paga+$bolsa_max_icv).'/'.($line['total']).' bolsas distribuídas.<BR>'; 
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
			{ $ok = -2; $msg .= 'Professor já possui uma bolsa CNPq.<BR>'; }
		} else {
			{ $ok = -7; $msg .= 'Professor não tem titulação de Doutor(a)..<BR>'; }
		}
	}
		

////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// REGRA FUNDACAO
if ($dd[5] == 'F')
	{
	$sql = "select count(*) as total from pibic_bolsa ";
	$sql .= " where pb_professor = '".$dd[1]."' and pb_tipo = 'F' and pb_ativo = 1 ";
	$sql .= " and pp_ano = '".date("Y")."' ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{ 
		$total = $line['total'];
		if ($total >= 2)
			{
			$ok = -3; $msg .= 'Professor já possui uma bolsa da Fundação Araucária.<BR>'; 
			}
		}
	}
	
////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// REGRA ICV (Máximo 2 bolsas)
if ($dd[5] == 'I')
	{
	$sql = "select count(*) as total from pibic_bolsa ";
	$sql .= " where pb_professor = '".$dd[1]."' and pb_tipo = 'I' and pb_ativo = 1 ";
	$sql .= " and pp_ano = '".date("Y")."' ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{ 
		if ($line['total'] >= 8)
			{
			$ok = -4; $msg .= 'Professor já possui quatro bolsas ICV. '.($line['total']).'<BR>';	 
			}
		}
	}	
	
////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// REGRA ESTRATÈGICA PUCPR (Somente não SS)
if ($dd[5] == 'U')
	{
	if ($ss == 'S')
		{ 
			$ok = -8; $msg .= 'Não pode atribuir Bolsa PUCPR para SS.<BR>'; 
		}
	}
////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// REGRA ESTRATÈGICA PUCPR (Somente não SS)
if ($dd[5] == 'E')
	{
	if ($ss == 'N')
		{ 
			$ok = -9; $msg .= 'Não pode atribuir Bolsa CNPQ para não SS.<BR>'; 
		}
	}	
////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// REGRA ICV (Máximo 2 bolsas)
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
			$ok = -5; $msg .= 'Professor já possui duas bolsas PUCPR.<BR>'; 
			}
		}
	}		


if ($ok == 1)
	{
	$sql = "delete from pibic_bolsa where pb_protocolo = '".$dd[2]."' ";
	$rlt = db_query($sql);
	
	if ($dd[5] != '-')
	{	
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
	}
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
</table>