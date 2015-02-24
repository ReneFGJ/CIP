<?
global $estilo;
// ************* dolar
$cp = array();
$oseq = CharE("1:1º posição&2:2º posição&3:3º posição&4:4º posição&5:5º posição&6:6º posição&7:7º posição&8:8º posição&9:9º posição&10:10º posição&11:11º posição&12:12º posição&13:13º posição&14:14º posição&15:15º posição&16:16º posição&17:17º posição&18:18º posição&19:19º posição&20:20º posição&21:21º posição&22:22º posição&23:23º posição&24:24º posição&25:25º posição&26:26º posição&27:27º posição&28:28º posição&29:29º posição&30:30º posição&31:31º posição&32:32º posição&33:33º posição&34:34º posição&35:35º posição&36:36º posição&37:37º posição&38:38º posição&39:39º posição&40:40º posição&41:41º posição&42:42º posição&43:43º posição&44:44º posição&45:45º posição&46:46º posição&47:47º posição&48:48º posição&49:49º posição&50:50º posição&51:51º posição&52:52º posição&53:53º posição&54:54º posição&55:55º posição&56:56º posição&57:57º posição&58:58º posição&59:59º posição&60:60º posição&61:61º posição&62:62º posição&63:63º posição");

array_push($cp,array('dd0',$dd[0],'$H8','Secao ID',$estilo,False,'ns_id',False));
array_push($cp,array('dd1',$dd[1],'$S80','Titulo (1)',$estilo,True,'ns_descricao',False));
array_push($cp,array('dd2',$dd[2],'$O '.$oseq,'Nº sequencia',$estilo,True,'ns_posicao',False));
array_push($cp,array('dd3',$dd[3],'$S7','Cor (opcional)',$estilo,False,'ag_cor',False));
array_push($cp,array('dd4',$jid,'$H8','Journal',$estilo,True,'Journal_ID',False));
if (strlen($dd[4])==0) {$dd[4]=$jid; };
?>


