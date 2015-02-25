<style>
#calendario {
	border : 0px none;
	color : Gray;
	padding-bottom : 12px;
	padding-left : 0px;
	padding-right : 0px;
	padding-top : 6px;
}
</style

<?
echo '<CENTER><font class="lt5"><font style="font-size: 16px;">calendário';
$nucleo = lowercase($pp);
$nucleo_cod = '00001';
if (strlen($dd[0]) == 0) { $dd[0] = date('Ym'); }
$data = $dd[0];
$dias = array();


$sql = "select * from ".$nucleo."_calendario ";
$sql .= " inner join ".$nucleo."_calendario_tipo on ct_ev = cal_ev ";
$sql .= " where cal_data >= ".$data."00 and cal_data <= ".$data.'31';
$sql .= " order by cal_data,cal_hora ";


$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
	$dd_dia = intval(substr($line['cal_data'],6,2));
	array_push($dias,array($dd_dia,trim($line['cal_descricao']),trim($line['cal_hora']),trim($line['ct_cor']),$line['cal_data'],$line['id_cal']));
	}
echo calendario($data,$dias);
echo '<BR>';
echo agenda($data,$dias);
//////////////////////////////////////////////////////////////////////////
echo '<BR><BR>';
$data = dateadd('m',1,date("Ymd"));
$data = substr($data,0,6);
$dias = array();


$sql = "select * from ".$nucleo."_calendario ";
$sql .= " inner join ".$nucleo."_calendario_tipo on ct_ev = cal_ev ";
$sql .= " where cal_data >= ".$data."00 and cal_data <= ".$data.'31';
$sql .= " order by cal_data,cal_hora ";


$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
	$dd_dia = intval(substr($line['cal_data'],6,2));
	array_push($dias,array($dd_dia,trim($line['cal_descricao']),trim($line['cal_hora']),trim($line['ct_cor']),$line['cal_data'],$line['id_cal']));
	}
echo calendario($data,$dias);
echo '<BR>';
echo agenda($data,$dias);
?>
