<?
global $estilo;
// ************* dolar
$cp = array();
//  fl_type char(3) DEFAULT 'TXT'::bpchar,
//  fl_filename char(255),
//  fl_texto text
array_push($cp,array('dd0',$jid,'$H8','Artigo ID',$estilo,False,'id_fl',False));
array_push($cp,array('dd1',$dd[1],'$O TXT:Arquivo Text;PDF:Arquivo PDF;HTM:Pagina Internet','Tipo',$estilo,True,'fl_type',False));
array_push($cp,array('dd2',$dd[2],'$S255','Descrição',$estilo,False,'fl_filename',False));
array_push($cp,array('dd3',$dd[3],'$T70:7','Texto',$estilo,True,'fl_texto',False));
$fieldini=0;

?>


