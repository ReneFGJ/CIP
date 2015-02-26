<?php
require("cab.php");
$qsql = '';
echo '<BR>PHASE 0 - UpperCase Pareceristas';
	$sql = "select * from pareceristas ";
	$rlt = db_query($sql);
	while ($line = db_read($rlt))
	{
		$xnome = trim(UpperCaseSql($line['us_nome']));
		if ($xnome != trim($line['us_nome_asc']))
			{
			$qsql .= "update pareceristas set us_nome_asc = '".$xnome."' ";
			$qsql .= " where id_us = ".$line['id_us'];
			$qsql .= ';'.chr(13);
			}
	}
if (strlen($qsql) > 0)
	{
		$rlt = db_query($qsql);
		echo '<PRE>'.$qsql.'</PRE>';
	}


echo '<BR>PHASE I - Banco de Professores / avaliadores';

$sql = "select * from docentes 
		where pp_avaliador = 1 order by pp_nome ";
		
$rlt = db_query($sql);
echo '<HR>';
while ($line = db_read($rlt))
{
	$nome = trim($line['pp_nome']);
	$cracha = trim($line['pp_cracha']);
	
	$sql = "select * from pareceristas where us_nome_asc = '".UpperCaseSql($nome)."' ";
	$rlr = db_query($sql);
	if ($xline = db_read($rlr))
		{
			$cod = trim($xline['us_codigo']);
			
			if (strlen($cod)==7)
			{
					$sql = "update pareceristas_area set pa_parecerista = '".$cracha."' where pa_parecerista = '".$cod."' ; ";
					$sql .= "update pareceristas set us_codigo = '".$cracha."' where us_codigo = '".$cod."' ";
					echo $sql;
					echo '<HR>';
					$rtt = db_query($sql);
			}
		} else {
			echo '<BR>Buscando...:'.$nome;
			echo ' - Não localizado -- Parecerista<HR>';
		}
}
exit;
echo '<BR>PHASE II - Banco de Pareceristas -> PROFESSORES';

$sql = "select * from pareceristas where us_ativo = 1";
$rlt = db_query($sql);
while ($line = db_read($rlt))
{
	$cod = trim($line['us_codigo']);
	$nome = trim(UpperCaseSql(trim($line['us_nome'])));
	$sql = "select * from docentes where pp_nome_asc = '".$nome."' ";
	$rrr = db_query($sql);
	if ($xline = db_read($rrr))
		{
			if ((round($xline['pp_avaliador'])) == 0)
				{
					$sql = "update pibic_professor set pp_avaliador = 1 where id_pp = ".$xline['id_pp'];
					echo '<BR>'.$sql;
					$yyy = db_query($sql);					
				}
		}
	
}

?>
