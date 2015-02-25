<?
global $estilo;
// ************* dolar
$cp = array();

$sql = "title:journal_id:select * from journals where journal_id=".$jid;
$SN  = "1:SIM&0:NAO";
$NS  = "0:NAO&1:SIM";
$oseq = CharE("1:1º posição&2:2º posição&3:3º posição&4:4º posição&5:5º posição&6:6º posição&7:7º posição&8:8º posição&9:9º posição&10:10º posição&11:11º posição&12:12º posição&13:13º posição");
array_push($cp,array('dd0',$dd[0],'$H8','Section ID',$estilo,False,'section_id',False));
array_push($cp,array('dd1',$dd[1],'$Q '.$sql,'Journal ID',$estilo,True,'journal_id',False));
array_push($cp,array('dd2',$dd[2],'$S120','Titulo',$estilo,True,'title',False));
array_push($cp,array('dd3',$dd[3],'$S20','Abreviatura',$estilo,False,'abbrev',False));
array_push($cp,array('dd4',$dd[4],'$O '.$oseq,'Sequencia',$estilo,False,'seq',False));
array_push($cp,array('dd5',$dd[5],'$O '.$SN,'Retringir do editor',$estilo,False,'editor_restricted',False));
array_push($cp,array('dd6',$dd[6],'$O '.$SN,'Indexado Metadados',$estilo,False,'meta_indexed',False));
array_push($cp,array('dd7',$dd[7],'$O '.$SN,'Abstract Desabilitado',$estilo,False,'abstracts_disabled',False));
array_push($cp,array('dd8',$dd[8],'$S60','Identificador',$estilo,False,'identify_type',False));
array_push($cp,array('dd9',$dd[9],'$O '.$NS,'Titulo oculto',$estilo,False,'hide_title',False));
array_push($cp,array('dd10',$dd[10],'$T60:6','Data para publicar',$estilo,False,'policy',False));

if (strlen($dd[6])==0) {$dd[6]=$jid; }
$fieldini=0;

?>


