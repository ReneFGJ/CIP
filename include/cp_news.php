<?
global $estilo;
// ************* dolar
$cp = array();
$sql = "ns_descricao:ns_id:select * from news_secoes where journal_id=".$jid.' order by ns_posicao';

// dd7, 11, 15
// Resumo dd6, dd10, dd14
$oseq = CharE("1:1� posi��o&2:2� posi��o&3:3� posi��o&4:4� posi��o&5:5� posi��o&6:6� posi��o&7:7� posi��o&8:8� posi��o&9:9� posi��o&10:10� posi��o&11:11� posi��o&12:12� posi��o&13:13� posi��o&14:14� posi��o&15:15� posi��o&16:16� posi��o&17:17� posi��o&18:18� posi��o&19:19� posi��o&20:20� posi��o&21:21� posi��o&22:22� posi��o&23:23� posi��o&24:24� posi��o&25:25� posi��o&26:26� posi��o&27:27� posi��o&28:28� posi��o&29:29� posi��o&30:30� posi��o&31:31� posi��o&32:32� posi��o&33:33� posi��o&34:34� posi��o&35:35� posi��o&36:36� posi��o&37:37� posi��o&38:38� posi��o&39:39� posi��o&40:40� posi��o&41:41� posi��o&42:42� posi��o&43:43� posi��o&44:44� posi��o&45:45� posi��o&46:46� posi��o&47:47� posi��o&48:48� posi��o&49:49� posi��o&50:50� posi��o&51:51� posi��o&52:52� posi��o&53:53� posi��o&54:54� posi��o&55:55� posi��o&56:56� posi��o&57:57� posi��o&58:58� posi��o&59:59� posi��o&60:60� posi��o&61:61� posi��o&62:62� posi��o&63:63� posi��o");
array_push($cp,array('dd0',$dd[0],'$H8','News ID',$estilo,True,'news_id',False));
array_push($cp,array('dd1',$dd[1],'$S255','Titulo (1)',$estilo,True,'news_titulo',False));
array_push($cp,array('dd2',$jid,'$H8','Journal',$estilo,True,'Journal_ID',False));
array_push($cp,array('dd3',$dd[3],'$Q '.$sql,'Sec��o',$estilo,True,'news_secao',False));
array_push($cp,array('dd4',$dd[4],'$T60:7','Texto',$estilo,False,'news_descricao',False));
array_push($cp,array('dd5',$dd[5],'$S150','Link http',$estilo,False,'news_link',False));
array_push($cp,array('dd6',$dd[6],'$S255','Imagem',$estilo,False,'news_image',False));
array_push($cp,array('dd7',$dd[7],'$D8','Mostrar a partir de',$estilo,True,'news_inserir',False));
array_push($cp,array('dd8',$dd[8],'$D8','Extinguir em',$estilo,True,'news_validade',False));
array_push($cp,array('dd9',$dd[9],'$O A:Ativo&B:Invis�vel&D:Para deletar','Status',$estilo,False,'news_status',False));
array_push($cp,array('dd10',$dd[10],'$S8','ID-Noticia',$estilo,False,'news_idf',False));
if (strlen($dd[2])==0) {$dd[2]=$jid; };
if (strlen($dd[7])==0) { $dd[7]=date('d/m/Y'); $cp[7][1]=$dd[7]; }
if (strlen($dd[8])==0) { $dd[8]='01/01/2020'; $cp[8][1]=$dd[8]; }
$fieldini=0;

?>


