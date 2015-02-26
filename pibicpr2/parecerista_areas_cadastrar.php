<?
require("db.php");
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');


if ((strlen($dd[0]) > 0) and (strlen($dd[10]) > 0))
{
	if ($dd[11]=='del')
		{
		$sql = "update pareceristas_area set ";
		$sql .= "pa_parecerista = 'X' || substr(pa_parecerista,2,6) ";
		$sql .= ",pa_area = 'X' || substr(pa_area,2,6) ";
		$sql .= ",pa_update = ".date("Ymd");
		$sql .= " where id_pa = ".$dd[10];
		$rlt = db_query($sql);
		}
}
if ((strlen($dd[1]) > 0) and (strlen($dd[2]) > 0))
	{
	$sql = "select * from ajax_areadoconhecimento where a_codigo='".$dd[2]."' ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$cod_area = $line['id_aa'];
		$sql = "select * from pareceristas_area ";
		$sql .= "where pa_parecerista = '".strzero($dd[0],7)."' ";
		$sql .= " and pa_area = '".$dd[2]."' ";
		$rlt = db_query($sql);
		if (!$line = db_read($rlt))
			{
			$sql = "insert into pareceristas_area ";
			$sql .= "(pa_parecerista,pa_area,pa_update) ";
			$sql .= " values ";
			$sql .= "('".strzero($dd[0],7)."','".$dd[2]."',".date("Ymd").")";
			$rlt = db_query($sql);
//			$dd[1] = '';
			$dd[2] = '';
			require("close.php");
			} else {
			echo '<font color="red">Já cadastrado</font>';
			}
		}
	}
	
////////////////////////////////////////////////////////////////

		$cp = array();
		array_push($cp,array('$H8','','',False,True,''));
		array_push($cp,array('$S15','','Código CNPQ',True,True,''));
		if (strlen($dd[1]) == 0)
			{
			array_push($cp,array('$H1','','Codigo',True,True,''));
			} else {
			array_push($cp,array('$Q a_descricao:a_codigo:select * from ajax_areadoconhecimento where a_cnpq like \''.$dd[1].'%\'','','Descricao',True,False,''));
			array_push($cp,array('$H1','','Codigo',True,True,''));
			}
		?>
		<table width="<?=$tab_max;?>" align="center" border=1 >
		<TR><TD>
		<?
		editar();
		?>
		</table>	
?>