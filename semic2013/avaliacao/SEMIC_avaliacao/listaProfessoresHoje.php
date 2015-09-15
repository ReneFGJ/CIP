<?php
require("cab.php");
require("_class/_class_avaliacao.php");

$av = new avaliacao();

$dia = date('j');
$dia = 23;
$mes = date('m');
$ano = date('Y');

echo "$dia-$mes-$ano 0:00";
// $hojeInicio = strtotime("$dia-$mes-$ano 0:00");
// $hojeFim = strtotime("$dia-$mes-$ano 23:59"); 

#$hojeInicio = strtotime("today");
$hojeInicio = strtotime("$ano-$mes-$dia 0:00");
$hojeFim = $hojeInicio + 24*60*60*60;
#$hojeFim = strtotime("tomorrow");

$qry  = "select distinct av_parecerista_cod, av_local, av_tstamp_avaliacao_est, av_tipo_trabalho from pibic_semic_avaliador_notas";
$qry .= " where av_tstamp_avaliacao_est > $hojeInicio and av_tstamp_avaliacao_est < $hojeFim";
$qry .= " ORDER BY av_local";
#echo $qry;
$rlt = db_query($qry);

function cpf_($cpf)
	{
	$cpf = sonumero($cpf);
	if (strlen($cpf) <> 11) { return(false); } 

	$soma1 = ($cpf[0] * 10) + ($cpf[1] * 9) + ($cpf[2] * 8) + ($cpf[3] * 7) + 
			 ($cpf[4] * 6) + ($cpf[5] * 5) + ($cpf[6] * 4) + ($cpf[7] * 3) + 
			 ($cpf[8] * 2); 
	$resto = $soma1 % 11; 
	$digito1 = $resto < 2 ? 0 : 11 - $resto; 

	$soma2 = ($cpf[0] * 11) + ($cpf[1] * 10) + ($cpf[2] * 9) + 
			 ($cpf[3] * 8) + ($cpf[4] * 7) + ($cpf[5] * 6) + 
			 ($cpf[6] * 5) + ($cpf[7] * 4) + ($cpf[8] * 3) + 
			 ($cpf[9] * 2); 
			 
	$resto = $soma2 % 11; 
	$digito2 = $resto < 2 ? 0 : 11 - $resto; 
	#echo "$digito1, $digito2";
	if (($cpf[9] == $digito1) and ($cpf[10] == $digito2))
		{ return array($digito1, $digito2, true); } else
		{ return array($digito1, $digito2, false); }
	}

function codigoAvaliadorComDigitos($idAvaliador){
	$digito1 = 0;
	$digito2 = 0;
	$sucesso = false;
	while(!$sucesso){
		$idAvaliadorComVerificador = $idAvaliador.$digito1.$digito2;
		list($digito1, $digito2, $sucesso) = cpf_(str_pad($idAvaliadorComVerificador, 11, '0', STR_PAD_LEFT));
	}
	$idAvaliadorComVerificador = $idAvaliador.$digito1.$digito2;
	return intval($idAvaliadorComVerificador);
}

$tabAcessoRapidoHtml = '';
$tabAcessoRapidoHtml .= "<table border=1>";
while(($line = db_read($rlt))){
	$tabAcessoRapidoHtml .= "<tr>";
	list($idAvaliador, $local, $tstamp_est, $tipoTrabalho) = $line;

	$formatoData = "j/m/Y H:m";
	#$linha = array(1);
	$linha = array(codigoAvaliadorComDigitos($idAvaliador), $av->get_nome_avaliador($idAvaliador), $local, date($formatoData, $tstamp_est), $tipoTrabalho);


	if($tstamp_est > $hojeInicio && $tstamp_est < $hojeFim && date('j', $tstamp_est) == $dia){
		foreach($linha as $campo){
			$tabAcessoRapidoHtml .= "<td>$campo</td>";	
		}
	}
	#$tabAcessoRapidoHtml .= implode(",", $linha), "\n";
	$tabAcessoRapidoHtml .= "</tr>";
}
$tabAcessoRapidoHtml .= "</table>";


echo $tabAcessoRapidoHtml;
?>