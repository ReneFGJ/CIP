<?
global $estilo;
// ************* dolar
$cp = array();
array_push($cp,array('dd0',$dd[0],'$H8','ID',$estilo,False,'id_cor',False));
array_push($cp,array('dd1',$dd[1],'$S18','Nome da cor',$estilo,True,'cor_nome',False));
array_push($cp,array('dd2',$dd[2],'$S7','Codigo HTML da cor',$estilo,True,'cor_value',False));
array_push($cp,array('dd3',$jid,'$H8','Journal',$estilo,True,'Journal_ID',False));
if (strlen($dd[3])==0) {$dd[3]=$jid; }
$fieldini=0;

?>


