<?
global $estilo;
// ************* dolar
$cp = array();
array_push($cp,array('dd0',$dd[0],'$H8','ID',$estilo,False,'id_layout',False));
array_push($cp,array('dd1',$dd[1],'$S100','Nome da cor',$estilo,True,'layout_descricao',False));
array_push($cp,array('dd2',$dd[2],'$S7','Codigo HTML da cor',$estilo,True,'layout_cod',False));
array_push($cp,array('dd3',$dd[3],'$O S:Sim&N:Não','Ativo',$estilo,True,'layout_ativo',False));
if (strlen($dd[3])==0) {$dd[3]=$jid; }
$fieldini=0;

?>


