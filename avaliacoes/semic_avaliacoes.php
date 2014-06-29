<?
require("cab.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_form2.php");
require($include."cp2_gravar.php");
$tabela = "pibic_semic_avaliador";
$cp = array();
if (strlen($dd[1]) > 0)
	{
	$nr = strzero(substr($dd[1],0,strpos($dd[1],'-')),5);
	$dv = dv(round($nr));
	while ($dv > 9) { $dv = $dv - 10; }
	$dv1 = substr($dd[1],strlen($dd[1])-1,1);

	if ($dv != $dv1) 
		{ $dd[1] = ''; 
		?>
		<script>
			alert('Erro de código de entrada da avaliação, Erro <?=$dv;?>');
		</script>
		<?
		}
	else
	{ 
		$dd[1] = $nr.'-'.$dv; 
		$sql = "select * from pibic_semic_avaliador ";
		$sql .= " left join  pareceristas  on us_codigo = psa_p01 ";
		$sql .= " where id_psa = ".$nr;
		$rlt = db_query($sql);
		$line = db_read($rlt);
		if (strlen($dd[0]) == 0)
			{
			$tp = substr($line['psa_p03'],0,1);
			$dd[0] = $line['id_psa'];
			$dd[3] = $line['us_nome'];
			$dd[4] = $line['psa_abe_1'];
			$dd[5] = $line['psa_abe_2'];
			$dd[6] = $line['psa_abe_3'];
			$dd[7] = $line['psa_abe_4'];
			$dd[8] = $line['psa_abe_5'];
			if ($tp == 'P') { $dd[5] = 'NÃO APLICÁVEL'; } else 
				{ $dd[6] = 'NÃO APLICÁVEL'; }
			$id = trim($line['psa_p04']).strzero($line['psa_p02'],2);
			$dd[9] = $id;
			$acao = '';
			} else {
			$dd[10] = '1';
			}
	}
	}

array_push($cp,array('$H8','id_psa','',False,True,''));
if (strlen($dd[1]) > 0)
	{
/////////////////////////////////////////////////////// CALCULA NOTA
		$nta = nota($dd[4]);
		$ntb = nota($dd[5]);
		$ntc = nota($dd[6]);

		////////////////////////////////// ERROS
		if ($nta == (-1)) { $dd[4] = ''; }		
		if ($ntb == (-1)) { $dd[5] = ''; }		
		if ($ntc == (-1)) { $dd[6] = ''; }		

		$nota = round($nta)+round($ntb)+round($ntc);
		$nota = $nota + round($dd[7]);
		$nota = $nota + (100*round($dd[8]));
		$dd[11] = strzero($nota,3);
////////////////////////////////////////////////////////////////////
	
		$nt = round($dd[7]);
		if (($nt > 100) or ($nt < 0)) { $dd[7] = ''; }
		array_push($cp,array('$S','','ID avaliação',True,False,''));
		array_push($cp,array('$A','','ID '.$dd[1].'-'.$dd[9],False,True,''));
		array_push($cp,array('$S200','','Avaliador',False,False,''));
		array_push($cp,array('$S20','psa_abe_1','Avaliação Resumo (A)',True,True,'')); //dd4
		array_push($cp,array('$S20','psa_abe_2','<B>Avaliação Oral (B)',True,True,''));
		array_push($cp,array('$S20','psa_abe_3','<B>Avaliação Poster (C)',True,True,''));
		array_push($cp,array('$I8','psa_abe_4','<B>Notas Geral',True,True,'')); // dd7
		array_push($cp,array('$C1','psa_abe_5','<B>Indicado como um dos dez melhores',False,True,''));
		array_push($cp,array('$S8','','Trabalho',True,False,'')); //dd9
		array_push($cp,array('$H8','','',True,False,'')); //dd10
		array_push($cp,array('$H8','psa_p06','',True,True,'')); //dd11
	} else {
		array_push($cp,array('$S8','','ID avaliação',True,True,''));
		array_push($cp,array('$B8','','Lançar Avaliação >>>',False,True,''));
	}	
?>
<table align="center" width="704">
<TR><TD colspan="2" class="lt4" align="center">
LANÇAR AVALIAÇÃO
<TR><TD>
<? editar(); ?>
</TD></TR>
</table>
<form action="semic_avaliacoes.php"><input type="submit" name="ato" value="<< voltar >>"></form>

<?
if ($saved > 0)
	{
	redirecina("semic_avaliacoes.php");
	}

function nota($aa)
	{
	$aa .= '-';
	$nts = array(0,0,0);
	$vlr = 0;
	$err = 0;
	if ($aa == 'NÃO APLICÁVEL-') { $vlr = 30; $aa = ''; }
	while (strpos($aa,'-') > 0)
		{
		$pos = strpos($aa,'-');
		$nt1 = round('0'.substr($aa,0,$pos));
		if (($nt1 <= 0) or ($nt1 > 10)) { $err = 1; } else
		{ $vlr = $vlr + $nt1; }
		$aa = substr($aa,$pos+1,strlen($aa));
		}
	if ($err == 1) { return(-1); } else { return($vlr); }
	}