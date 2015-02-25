<?
global $estilo;
// ************* dolar
$cp = array();
$sql = "ns_descricao:ns_id:select * from news_secoes where journal_id=".$jid.' order by ns_posicao';

// dd7, 11, 15
// Resumo dd6, dd10, dd14
$oseq = CharE("1:1º posição&2:2º posição&3:3º posição&4:4º posição&5:5º posição&6:6º posição&7:7º posição&8:8º posição&9:9º posição&10:10º posição&11:11º posição&12:12º posição&13:13º posição&14:14º posição&15:15º posição&16:16º posição&17:17º posição&18:18º posição&19:19º posição&20:20º posição&21:21º posição&22:22º posição&23:23º posição&24:24º posição&25:25º posição&26:26º posição&27:27º posição&28:28º posição&29:29º posição&30:30º posição&31:31º posição&32:32º posição&33:33º posição&34:34º posição&35:35º posição&36:36º posição&37:37º posição&38:38º posição&39:39º posição&40:40º posição&41:41º posição&42:42º posição&43:43º posição&44:44º posição&45:45º posição&46:46º posição&47:47º posição&48:48º posição&49:49º posição&50:50º posição&51:51º posição&52:52º posição&53:53º posição&54:54º posição&55:55º posição&56:56º posição&57:57º posição&58:58º posição&59:59º posição&60:60º posição&61:61º posição&62:62º posição&63:63º posição");
array_push($cp,array('dd0',$dd[0],'$H8','News ID',$estilo,True,'news_id',False));
array_push($cp,array('dd1',$dd[1],'$S255','Titulo (1)',$estilo,True,'news_titulo',False));
array_push($cp,array('dd2',$jid,'$H8','Journal',$estilo,True,'Journal_ID',False));
array_push($cp,array('dd3',$dd[3],'$Q '.$sql,'Secção',$estilo,True,'news_secao',False));
array_push($cp,array('dd4',$dd[4],'$T60:7','Texto',$estilo,False,'news_descricao',False));
array_push($cp,array('dd5',$dd[5],'$S150','Link http',$estilo,False,'news_link',False));
array_push($cp,array('dd6',$dd[6],'$S255','Imagem',$estilo,False,'news_image',False));
array_push($cp,array('dd7',$dd[7],'$D8','Mostrar a partir de',$estilo,True,'news_inserir',False));
array_push($cp,array('dd8',$dd[8],'$D8','Extinguir em',$estilo,True,'news_validade',False));
array_push($cp,array('dd9',$dd[9],'$O A:Ativo&B:Invisível&D:Para deletar','Status',$estilo,False,'news_status',False));
array_push($cp,array('dd10',$dd[10],'$S8','ID-Noticia',$estilo,False,'news_idf',False));
if (strlen($dd[2])==0) {$dd[2]=$jid; };
if (strlen($dd[7])==0) { $dd[7]=date('d/m/Y'); $cp[7][1]=$dd[7]; }
if (strlen($dd[8])==0) { $dd[8]='01/01/2020'; $cp[8][1]=$dd[8]; }
$fieldini=0;

?>


