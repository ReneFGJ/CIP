<?
global $estilo;
// ************* dolar
if (strlen($dd[7])==0) {$dd[7] = date("d/m/Y"); }
$cp = array();
$sql = "vol:id_issue:select ('vol.'||issue_volume||' num.'||issue_number||' '||issue_title||' '||issue_year) as vol,* from issue where journal_id=".$jid.' order by issue_dt_publica';;
$sql2 = "title:section_id:select * from sections where journal_id=".$jid.' and editor_restricted=0 order by seq';
$sql3 = "title:journal_id:select * from journals where journal_id=".$jid;

$oseq = CharE("1:1� posi��o&2:2� posi��o&3:3� posi��o&4:4� posi��o&5:5� posi��o&6:6� posi��o&7:7� posi��o&8:8� posi��o&9:9� posi��o&10:10� posi��o&11:11� posi��o&12:12� posi��o&13:13� posi��o");
array_push($cp,array('dd0',$dd[0],'$H8','Artigo ID',$estilo,False,'id_peer',False));
array_push($cp,array('dd1',$dd[1],'$S255','Titulo (1)',$estilo,True,'peer_title',False));
array_push($cp,array('dd2',1,'$H','1',$estilo,False,'peer_issue',False));
array_push($cp,array('dd3',$dd[3],'$Q'.$sql2,'Sec��o',$estilo,True,'peer_section',False));
array_push($cp,array('dd4',$dd[4],'$T70:18','Resumo/Abstract',$estilo,True,'peer_abstract',False));
array_push($cp,array('dd5',$dd[5],'$S255','Palavra-chave',$estilo,False,'peer_keywords',False));
array_push($cp,array('dd6',$dd[6],'$O pt_BR:Portugues Brasil&en:Ingles&es:Espanhol&it:Italiano&pt:Portugues (Portugal)','Idioma',$estilo,False,'peer_idioma',False));
array_push($cp,array('dd7',$dd[7],'$D8','Enviado em',$estilo,True,'peer_dt_envio',True));
array_push($cp,array('dd8',$dd[8],'$O A:Para enviar','Processo',$estilo,False,'peer_publicado',False));
array_push($cp,array('dd9',$dd[9],'$O A:digitando','Status',$estilo,False,'peer_status',False));
array_push($cp,array('dd10',$dd[10],'$Q '.$sql3,'Jornal',$estilo,True,'journal_id',False));
array_push($cp,array('dd11',$userid,'$H8','Usuario',$estilo,True,'peer_autor',False));

$fieldini=0;
?>


