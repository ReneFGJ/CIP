<?
//  ae_id serial NOT NULL,
//  journal_id int8,
//  ae_horario char(5),
//  ae_data char(8),
//  ae_historico char(50),
//  ae_link char(100),
//  ae_view int8,
//  ae_sala int8
global $estilo;
// ************* dolar
$cp = array();
$sala = ' :Seleciona e sala';
$sql = "select * from agenda_sala where journal_id = '".$jid."'";
$rrr = db_query($sql);
while ($linx = db_read($rrr))
	{
	$sala = $sala . "&".trim($linx['ag_id']).':'.'('.trim($linx['ag_nick']).') '.trim($linx['ag_descricao']);
	}
array_push($cp,array('dd0',$dd[0],'$H8','ID',$estilo,False,'ae_id',False));
array_push($cp,array('dd1',$dd[1],'$S50','Nome palestra',$estilo,True,'ae_historico',False));
array_push($cp,array('dd2',$dd[2],'$S100','Link http',$estilo,false,'ae_link',False));
array_push($cp,array('dd3',$dd[3],'$I8','View ID',$estilo,false,'ae_view',False));
array_push($cp,array('dd4',$dd[4],'$O '.$sala,'Sala',$estilo,True,'ae_sala',False));
array_push($cp,array('dd5',$dd[5],'$D8','Data',$estilo,True,'ae_data',False));
array_push($cp,array('dd6',$dd[6],'$S5','Hora (HH:MM)',$estilo,True,'ae_horario',False));
array_push($cp,array('dd7',$jid,'$H8','Journal',$estilo,True,'Journal_ID',False));
array_push($cp,array('dd8',$dd[8],'$O 1:SIM&0:NAO','Mostra horario',$estilo,True,'ae_horario_visivel',False));
if (strlen($dd[7])==0) {$dd[7]=$jid; }
$fieldini=0;

?>


