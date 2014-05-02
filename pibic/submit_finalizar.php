<?
if (($prj_pg==7) and (!($erro)))
	{
	$fim = true;
	$sql = "select * from ".$ic_noticia." where nw_ref = '".$id_ic."_DECLA'";
	$rrr = db_query($sql);
	echo '</form>';
	echo '<TABLE width="'.$tab_max.'" align="center" class="lt1">';
	echo '<TR><TD>';
	if ($eline = db_read($rrr))
		{
		$sC = $eline['nw_titulo'];
		echo $sC;
		$texto = $eline['nw_descricao'];
		echo mst($texto);
		}	
	echo '<TR><TD><form action="submit_finalizar_2.php">';
	echo '<select name="dd0" size="1">';
	echo '<option value="SIM">SIM</option>';
	echo '<option value="">--</option>';
	echo '</select>';
	echo '<input type="submit" name="acao" value="enviar projeto">';
	echo '</TABLE>';
	}
?>