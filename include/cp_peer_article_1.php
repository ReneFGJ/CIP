<?
global $estilo;
// ************* dolar
$cp = array();
$sql = "vol:id_issue:select ('vol.'||issue_volume||' num.'||issue_number||' '||issue_title||' '||issue_year) as vol,* from issue where journal_id=".$jid.' order by issue_dt_publica';;
$sql2 = "title:section_id:select * from sections where journal_id=".$jid.' order by seq';
$sql3 = "title:journal_id:select * from journals where journal_id=".$jid;

$oseq = CharE("1:1� posi��o&2:2� posi��o&3:3� posi��o&4:4� posi��o&5:5� posi��o&6:6� posi��o&7:7� posi��o&8:8� posi��o&9:9� posi��o&10:10� posi��o&11:11� posi��o&12:12� posi��o&13:13� posi��o");
array_push($cp,array('dd0',$dd[0],'$H8','Artigo ID',$estilo,False,'id_peer',False));
array_push($cp,array('dd1',$dd[1],'$T60:15','Autor(es)',$estilo,False,'peer_author',False));

$fieldini=0;

?>


