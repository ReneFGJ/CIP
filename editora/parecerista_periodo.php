<?
require("cab.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_form2.php");
require($include."sisdoc_data.php");
require($include."cp2_gravar.php");
require($include.'sisdoc_debug.php');	

$cp = array();
$tabela = "";

array_push($cp,array('$H8','','',False,True,''));
array_push($cp,array('$A','','Avaliações realizadas entre',False,True,''));
array_push($cp,array('$D8','','De',True,True,''));
array_push($cp,array('$D8','','até',True,True,''));
array_push($cp,array('$O  :Todos&@:Indicados (sem avaliação)&C:Avaliados&X:Cancelados&D:Declinados&B:Avaliados','','Tipos',False,True,''));

echo $hd->menu();
echo '<div id="conteudo">';
echo $hd->main_content('Pareceres emetidos');

echo '<BR><font class=lt3>de '.$dd[2].' até '.$dd[3].'</font></CENTER>';
?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
editar();
?></TD></TR>
</TABLE>
<?

if ($saved > 0)
	{
	$dd[4] = trim($dd[4]);
	$sql = "select * from submit_parecer_2013 ";
	$sql .= " left join submit_documento on doc_protocolo = pp_protocolo ";
	$sql .= " left join pareceristas on pp_avaliador = us_codigo ";
	//$sql .= " left join instituicao on us_instituicao = inst_codigo ";
	$sql .= " where ((doc_journal_id = '".round('0'.$jid)."') or (doc_journal_id = '".strzero(round('0'.$jid),7)."'))";
	
	$sql .= " and (pp_data >= ".brtos($dd[2])." and pp_data <= ".brtos($dd[3]).") ";
	if (strlen($dd[4]) > 0)
		{
			$sql .= " and (pp_status = '".$dd[4]."' )"; 
		}
	$sql .= " order by us_nome, pp_data ";
	$rlt = db_query($sql);
	$nome = "X";
	$id = 0;
	while ($line = db_read($rlt))
		{
			$id++;
		//print_r($line);
		//exit;
		if ($nome != $line['us_nome'])
			{
			$sr .= '<TR><TD colspan=5 class="lt3"><B>'.trim($line['us_nome']).'</B> ('.trim($line['inst_nome']).')</TD></TR>';
			$nome = $line['us_nome'];
			}
		$sr .= '<tr '.coluna().'>';
		$sr .= '<TD align="center">';
		$sr .= stodbr($line['pp_data']);
		$sr .= '<TD align="center">';
		$sr .= ($line['pp_protocolo']);
		$pa_data = $line['pp_parecer_data'];
		$sr .= '<TD align="center">';
		$sta = $line['pp_status'];
		$status = $sta;
		if ($sta == 'I') { $status = "<font color=Green >Indicado"; }
		if ($sta == '@') { $status = "<font color=Green >Indicado"; }
		if ($sta == 'D') { $status = "<font color=Grey >Declinado"; }
		if ($sta == 'A') { $status = "<font color=BLue ><B>Finalizado"; }
		if ($sta == 'B') { $status = "<font color=BLue ><B>Finalizado"; }
		if ($sta == 'C') { $status = "<font color=BLue ><B>Finalizado"; }
		if ($sta == 'X') { $status = "<font color=Red >Cancelado Indicação"; }
		$sr .= $status;
		$sr .= '<TD align="center">';
		if ($pa_data > 20000101) 
			{ $dif = '('.Round(DiffDataDias($line['pp_data'],$pa_data)).' dias)'; $pa_data = stodbr($pa_data).'-'.$dif; } else { $pa_data = '-'; }
		$sr .= $pa_data;
		$sr .= '</tr>';
		$tela = $line;
		}
	echo '<table width="100%" class="tabela00" >';
	echo $sr;
	echo '<TR><TD colspan=10>Total '.$id;
	echo '</table>';
	}
echo '</div>';
require("foot.php");	
?>