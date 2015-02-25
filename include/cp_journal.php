<?
global $estilo;
// ************* dolar
$cp = array();
//  journal_id int4 NOT NULL DEFAULT nextval('journals_journal_id_seq'::text),
//  title varchar(255) NOT NULL,
//  description text,
//  path varchar(32) NOT NULL,
//  seq float8 NOT NULL DEFAULT 0,
//  enabled int2 NOT NULL DEFAULT 1,
//  layout char(4),
$sql = "layout_descricao:layout_cod:select * from layout";
$dc = 'cor_nome:cor_value:select * from cores where journal_id = '.$jid.' order by cor_nome';

array_push($cp,array('dd0',$jid,'$H8','Artigo ID',$estilo,False,'journal_id',False));
array_push($cp,array('dd1',$dd[1],'$S255','Titulo (1)',$estilo,True,'title',False));
array_push($cp,array('dd2',$dd[2],'$T60:5','Descrição',$estilo,False,'description',False));
array_push($cp,array('dd3',$dd[3],'$S32','Caminho',$estilo,True,'path',False));
array_push($cp,array('dd4',$dd[4],'$O 1:1','Seq',$estilo,False,'seq',False));
array_push($cp,array('dd5',$dd[5],'$O 1:Ativo&0:Inativo','Ativo',$estilo,False,'enabled',False));
array_push($cp,array('dd6',$dd[6],'$Q '.$sql,'Layout',$estilo,False	,'layout',False));
array_push($cp,array('dd7',$dd[7],'$S30','ISSN',$estilo,False,'journal_issn',False));
array_push($cp,array('dd8',$dd[8],'$Q '.$dc,'Cor de fundo',$estilo,False,'jn_bgcor',False));
array_push($cp,array('dd9',$dd[9],'$S60','ID repositorio *',$estilo,True,'jn_id',False));
array_push($cp,array('dd10',$dd[10],'$S60','Site http',$estilo,True,'jn_http',False));
array_push($cp,array('dd11',$dd[11],'$S100','e-mail administrador',$estilo,True,'jn_email',False));
array_push($cp,array('dd12',$dd[12],'$O N:NÂO&S:SIM','Aberto submissão de artigos',$estilo,True,'jn_send',False));
array_push($cp,array('dd13',$dd[13],'$O N:NÂO&S:SIM','Notícias no menu',$estilo,True,'jn_noticia',False));
array_push($cp,array('dd14',$dd[14],'$O N:NÂO&S:SIM','Possui suplemento',$estilo,False,'jn_suplemento',False));
$fieldini=0;

?>

