<?
global $estilo;
// ************* dolar
if (strlen(trim($dd[2])) == 0)
	{ 
	$dd[2] = $_COOKIE[$secu."_j22".$jid]; 
	}

$cp = array();
$sql = "vol:id_issue:select ('vol.'||issue_volume||' num.'||issue_number||' '||issue_title||' '||issue_year) as vol,* from issue where journal_id=".$jid.' order by issue_dt_publica';;
$sql2 = "title:section_id:select * from sections where journal_id=".$jid.' order by seq';
$sql3 = "title:journal_id:select * from journals where journal_id=".$jid;

// dd7, 11, 15
// Resumo dd6, dd10, dd14
if (strlen(trim("".$dd[6] )) > 0) {$dd[6]  = troca($dd[6] ,chr(13),' ');}
if (strlen(trim("".$dd[10])) > 0) {$dd[10] = troca($dd[10],chr(13),' ');}
if (strlen(trim("".$dd[14])) > 0) {$dd[14] = troca($dd[14],chr(13),' ');}

if (strlen(trim("".$dd[6] )) > 0) {$dd[6]  = troca($dd[6] ,chr(10),' ');}
if (strlen(trim("".$dd[10])) > 0) {$dd[10] = troca($dd[10],chr(10),' ');}
if (strlen(trim("".$dd[14])) > 0) {$dd[14] = troca($dd[14],chr(10),' ');}

$oseq = "1:1º posição";
for ($kky=2;$kky < 150;$kky++) { $oseq = $oseq . '&'.$kky.':'.$kky.'º posição'; }
$oseq = CharE($oseq);

array_push($cp,array('dd0',$dd[0],'$H8','Artigo ID',$estilo,False,'id_article',False));
array_push($cp,array('dd1',$dd[1],'$S255','Titulo (1)',$estilo,True,'article_title',False));
array_push($cp,array('dd2',$dd[2],'$Q '.$sql,'Edição',$estilo,True,'article_issue',False));

array_push($cp,array('dd3',$dd[3],'$O '.$oseq,'Nº sequencia',$estilo,True,'article_seq',False));
array_push($cp,array('dd4',$dd[4],'$Q '.$sql2,'Secção',$estilo,True,'article_section',False));

array_push($cp,array('dd5',$dd[5],'$T60:7','Autor(es)',$estilo,False,'article_author',False));
array_push($cp,array('dd6',$dd[6],'$T80:15','Resumo/Abstract',$estilo,False,'article_abstract',False));
array_push($cp,array('dd7',$dd[7],'$S255','Palavra-chave',$estilo,False,'article_keywords',False));
array_push($cp,array('dd8',$dd[8],'$O pt_BR:Portugues Brasil&en:Ingles&es:Espanhol&it:Italiano&pt:Portugues (Portugal)&fr:Frances&na:não aplicado','Idioma',$estilo,False,'article_idioma',False));
array_push($cp,array('dd9',$dd[9],'$S255','Titulo (2)',$estilo,False,'article_2_title',False));
array_push($cp,array('dd10',$dd[10],'$T80:15','Resumo/Abstract',$estilo,False,'article_2_abstract',False));
array_push($cp,array('dd11',$dd[11],'$S255','Palavra-chave',$estilo,False,'article_2_keywords',False));
array_push($cp,array('dd12',$dd[12],'$O pt_BR:Portugues Brasil&en:Ingles&es:Espanhol&it:Italiano&pt:Portugues (Portugal)&fr:Frances&na:não aplicado','Idioma',$estilo,False,'article_2_idioma',False));

array_push($cp,array('dd13',$dd[13],'$S255','Titulo (3)',$estilo,False,'article_3_title',False));
array_push($cp,array('dd14',$dd[14],'$T80:15','Resumo/Abstract',$estilo,False,'article_3_abstract',False));
array_push($cp,array('dd15',$dd[15],'$S255','Palavra-chave',$estilo,False,'article_3_keywords',False));
array_push($cp,array('dd16',$dd[16],'$O pt_BR:Portugues Brasil&en:Ingles&es:Espanhol&it:Italiano&pt:Portugues (Portugal)&fr:Frances&na:não aplicado','Idioma',$estilo,False,'article_3_idioma',False));

array_push($cp,array('dd17',$dd[17],'$D8','Enviado em',$estilo,True,'article_dt_envio',False));
array_push($cp,array('dd18',$dd[18],'$D8','Aceito em',$estilo,True,'article_dt_aceite',False));
array_push($cp,array('dd19',$dd[19],'$S15','Pagina',$estilo,False,'article_pages',False));
array_push($cp,array('dd20',$dd[20],'$O A:Para publicar&1:Publicado&2:Cancelado&D:Para deletar','Status',$estilo,False,'article_publicado',False));
array_push($cp,array('dd21',$dd[21],'$Q '.$sql3,'Jornal',$estilo,True,'journal_id',False));
$fieldini=0;

if (strlen($dd[17])==0) { $dd[17]='01/01/1900'; $cp[17][1]=$dd[17]; }
if (strlen($dd[18])==0) { $dd[18]='01/01/1900'; $cp[18][1]=$dd[18]; }

?>


