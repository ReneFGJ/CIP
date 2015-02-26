<?
$tabela = "ge_edicoes";
$cp = array();
$nc = $nucleo.":".$nucleo;
$nmes = '$O 0:Sem mes';
for ($r=1;$r <=12;$r++)
	{
	$nmes .= '&'.$r.':'.nomemes($r);
	}
array_push($cp,array('$H4','id_ge','id_ge',False,False,''));
array_push($cp,array('$Q title:journal_id:select * from journals where journal_id = '.$journal_id,'ge_revista','Publicaзгo',True,True,''));
array_push($cp,array('$A4','','Dados da ediзгo',False,True,''));
array_push($cp,array('$S200','ge_titulo','Tнtulo da Ediзгo (temбtica)',False,True,''));
array_push($cp,array('$S5','ge_volume','Volume',False,True,''));
array_push($cp,array('$S5','ge_numero','Nъmero',False,True,''));
array_push($cp,array('$S5','ge_ano','Ano',False,True,''));
array_push($cp,array($nmes,'ge_mes_1','Mes (1)',False,True,''));
array_push($cp,array($nmes,'ge_mes_2','Mes (2)',False,True,''));
array_push($cp,array('$D80','ge_prev','Dt. Publicaзгo (prev.)',False,True,''));
array_push($cp,array('$O 1:Sim&0:Nгo','ge_ativo','Ativo',True,True,''));

array_push($cp,array('$A4','','Dados adicionais',False,True,''));
array_push($cp,array('$S5','ge_status','Status',True,True,''));
array_push($cp,array('$S30','ge_capa','Img. capa',False,True,''));
array_push($cp,array('$O P:Periуdico&L:Livro&C:Carderno de resumo','ge_tipo','Tipo',False,True,''));
array_push($cp,array('$T60:4','ge_obs','Obs',False,True,''));
array_push($cp,array('$U5','ge_data','Data',False,True,''));
array_push($cp,array('$H8','ge_codigo','Status',False,True,''));

/// Gerado pelo sistem "base.php" versao 1.0.2
?>