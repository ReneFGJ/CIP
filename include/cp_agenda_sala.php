<?
//  ag_id serial NOT NULL,
//  ag_descricao char(40),
//  ag_cor char(8),
//  ag_endereco text,
//  journal_id int8
global $estilo;
// ************* dolar
$cp = array();
array_push($cp,array('dd0',$dd[0],'$H8','ID',$estilo,False,'ag_id',False));
array_push($cp,array('dd1',$dd[1],'$S40','Nome da sala',$estilo,True,'ag_descricao',False));
array_push($cp,array('dd2',$dd[2],'$S10','Abreviatura',$estilo,False,'ag_nick',False));
array_push($cp,array('dd3',$dd[3],'$S7','Cor',$estilo,Flase,'ag_cor',False));
array_push($cp,array('dd4',$dd[4],'$T60:6','Localização',$estilo,False,'ag_endereco',False));
array_push($cp,array('dd5',$jid,'$H8','Journal',$estilo,True,'Journal_ID',False));
if (strlen($dd[5])==0) {$dd[5]=$jid; }
$fieldini=0;

?>


