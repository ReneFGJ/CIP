<?
$nmes = "";
for ($km=1;$km <= 12;$km++)
	{
	if ($km > 1) { $nmes .= '&'; }
	$nmes .= $km.':'.nomemes($km);
	}
$tabela = "issue";
$cp = array();
$nc = $nucleo.":".$nucleo;
array_push($cp,array('$H4','id_issue','id_issue',False,False,''));
array_push($cp,array('$Q title:journal_id:select * from journals where journal_id = '.intval($journal_id).' order by upper(asc7(title))','journal_id','Layout',True,True,''));
array_push($cp,array('$A4','','Dados da ediзгo',False,True,''));
array_push($cp,array('$S200','issue_title','Tнtulo da Ediзгo (temбtica)',False,True,''));
array_push($cp,array('$S3','issue_volume','Volume',False,True,''));
array_push($cp,array('$S10','issue_number','Nъmero',False,True,''));
array_push($cp,array('$S4','issue_year','Ano',False,True,''));
array_push($cp,array('$O '.$nmes,'issue_month_1','Mes (de)',True,True,''));
array_push($cp,array('$O '.$nmes,'issue_month_2','Mes (atй)',True,True,''));
array_push($cp,array('$D80','issue_dt_publica','Dt. Publicaзгo',True,True,''));
array_push($cp,array('$O 1:Sim&0:Nгo','issue_published','Publicado (acesso ao pъblico)',True,True,''));

array_push($cp,array('$A4','','Dados adicionais',False,True,''));
array_push($cp,array('$O S:Concluido&N:Editoraзгo&X:Cancelado','issue_status','Status',True,True,''));
array_push($cp,array('$H8','issue_capa','Img. capa',False,True,''));
array_push($cp,array('$S1','edicao_tipo','Tipo',False,True,''));
array_push($cp,array('$S100','issue_link','Link (Suplemento)',False,True,''));

/// Gerado pelo sistem "base.php" versao 1.0.2
?>