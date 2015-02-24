<?
$tabela = "peer_autores";
$cp = array();
$opt = " : &Dr(a):Dr(a)&Msc:Msc&PhD:PhD&Esp:Esp&Graduado:Graduado&Graduando:Graduando&Profissional:Profissional&Outros:Outros&Prof.:Prof.";
$opp = '';
for ($ko=1;$ko < 10;$ko++)
	{
	if (strlen($opp) >0) { $opp = $opp . '&'; }
	$opp = $opp . $ko.":".$ko.'К autor';
	}
array_push($cp,array('$H8','id_peer','id_peer',False,True,''));
array_push($cp,array('$H8','id_pa','id_pa',False,True,''));
array_push($cp,array('$S80','pa_author','Nome completo do Autor',True,True,''));
array_push($cp,array('$S20','pa_titulacao','Titulacao',False,True,''));
array_push($cp,array('$S40','pa_instituicao','Nome da instituiчуo (tabalho/pesquisa)',True,True,''));
array_push($cp,array('$S100','pa_email','e-mail',False,True,''));
array_push($cp,array('$O '.$opp,'pa_ordem','Ordem de autoria',True,True,''));
array_push($cp,array('$T70:7','pa_content','breve resumo sobre autor,',False,True,''));
array_push($cp,array('$S200','pa_lates','Link do Lattes (opcional)',False,True,''));
$key = 1;

/// Gerado pelo sistem "base.php" versao 1.0.2
?>