<?
global $estilo;
// ************* dolar
$cp = array();
$sql = "title:journal_id:select * from journals where journal_id=".$jid;;
$nmes = "0:Sem Indicação de mes&1:Janeiro&2:Fevereiro&3:Março&4:Abril&5:Maio&6:Junho&7:Julho&8:Agosto&9:Setembro&10:Outubro&11:Novembro&12:Dezembro";
array_push($cp,array('dd0',$dd[0],'$H8','Artigo ID',$estilo,False,'id_issue',False));
array_push($cp,array('dd1',$dd[1],'$S128','Titulo (1)',$estilo,False,'issue_title',False));
array_push($cp,array('dd2',$dd[2],'$S5','Volume',$estilo,False,'issue_volume',False));
array_push($cp,array('dd3',$dd[3],'$S5','Numero',$estilo,False,'issue_number',False));
array_push($cp,array('dd4',$dd[4],'$S5','Ano',$estilo,False,'issue_year',False));
array_push($cp,array('dd5',$dd[5],'$O A:Ativo&N:Inativo','Status',$estilo,False,'issue_status',False));
array_push($cp,array('dd6',$dd[6],'$Q '.$sql,'Journal ID',$estilo,False,'journal_id',False));
array_push($cp,array('dd7',$dd[7],'$D8','Data para publicar',$estilo,True,'issue_dt_publica',False));
array_push($cp,array('dd8',$dd[8],'$O 0:Nao&1:Sim','Publicado',$estilo,False,'issue_published',False));
array_push($cp,array('dd10',$dd[10],'$O '.$nmes,'Mes Inicial',$estilo,False,'issue_month_1',False));
array_push($cp,array('dd11',$dd[11],'$O '.$nmes,'Mes Final',$estilo,False,'issue_month_2',False));
array_push($cp,array('dd9',$dd[9],'$S20','Img de capa',$estilo,False,'issue_capa',False));
array_push($cp,array('dd12',$dd[12],'$O 0:Nao&1:Sim','Suplemento',$estilo,False,'edicao_tipo',False));
array_push($cp,array('dd13',$dd[13],'$S120','Suplemento (link)',$estilo,False,'issue_link',False));
if (strlen($dd[6])==0) {$dd[6]=$jid; }
$fieldini=0;

?>


