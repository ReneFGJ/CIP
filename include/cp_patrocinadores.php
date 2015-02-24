<?
global $estilo;
// ************* dolar
$cp = array();
array_push($cp,array('dd0',$dd[0],'$H8','ID',$estilo,False,'id_patro',False));
array_push($cp,array('dd1',$dd[1],'$S100','Nome da entidade',$estilo,True,'patro_descricao',False));
array_push($cp,array('dd2',$dd[2],'$S100','Imagens da entidade',$estilo,False,'patro_imagem',False));
array_push($cp,array('dd3',$dd[3],'$S100','Link URL',$estilo,False,'patro_link',False));
array_push($cp,array('dd4',$dd[4],'$T60:10','Informações sobre',$estilo,False,'patro_texto',False));
array_push($cp,array('dd5',$dd[5],'$O P:Patrocionador&C:Créditos','Tipo',$estilo,True,'patro_tipo',False));
array_push($cp,array('dd6',$dd[6],'$O S:SIM&N:NAO','Tipo',$estilo,True,'patro_ativo',False));
array_push($cp,array('dd7',$dd[7],'$H8','Tipo',$estilo,True,'patro_dt_criacao',False));

if (strlen($dd[7])==0) {$dd[7]=date("Ymd"); $cp[7][1] = $dd[7]; }
$fieldini=0;

?>


