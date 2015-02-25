<?
global $estilo;
// ************* dolar
$cp = array();
$sql = "vol:id_issue:select ('vol.'||issue_volume||' num.'||issue_number||' '||issue_title||' '||issue_year) as vol,* from issue where journal_id=".$jid.' order by issue_dt_publica';;
$sql2 = "title:section_id:select * from sections where journal_id=".$jid.' order by seq';
$sql3 = "title:journal_id:select * from journals where journal_id=".$jid;

$oseq = CharE("1:1º posição&2:2º posição&3:3º posição&4:4º posição&5:5º posição&6:6º posição&7:7º posição&8:8º posição&9:9º posição&10:10º posição&11:11º posição&12:12º posição&13:13º posição");
array_push($cp,array('dd0',$dd[0],'$H8','Artigo ID',$estilo,False,'id_peer',False));
array_push($cp,array('dd1',$dd[1],'$T60:15','Autor(es)',$estilo,False,'peer_author',False));

$fieldini=0;

?>


