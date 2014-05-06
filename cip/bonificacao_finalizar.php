<?php
require("cab_cip.php");
require($include.'sisdoc_email.php');
require("../_class/_class_docentes.php");
$doc = new docentes;

require("../_class/_class_bonificacao.php");
$bon = new bonificacao;
$bon->le($dd[0]);

echo '<center><font class="lt3">';
if ($bon->status == 'A')
	{
		$prof = $bon->professor;
		$doc->le($prof);
		
		$proto = $bon->origem_protocolo;
		$proto_or = $bon->bn_original_protocolo;
		$tipo  = $bon->origem_tipo;
		$valor = number_format($bon->valor,2,',','.');
		$nome = trim($bon->professor_nome);
		
		require('../_class/_class_ic.php');
		$ic = new ic;
		$nw = $ic->ic('bon_comunicacao_boni');
		
		$titulo_email = $nw['nw_titulo'].' - '.$proto;
		$txt = $nw['nw_descricao'];
				
		$txt = troca($txt,'$nome',$nome);
		$txt = troca($txt,'$valor',$valor);
		$txt = troca($txt,'$proto',$proto);
	
		if ($tipo == 'PRJ')
			{
				require("../_class/_class_captacao.php");
				$cap = new captacao;
				$cap->le($proto);
				$txt2 = '<BR><BR>'.$cap->mostra();
				$cap->alterar_status(81);
				$bon->libera_pagamento(date("Ymd"));
			}
		
		require("_email.php");
		enviaremail('renefgj@gmail.com','','Bonificação',$txt.$txt2);
		
		$email = trim($doc->pp_email);
		if (strlen($email) > 0) { enviaremail($email,'',$titulo_email,$txt.$txt2); }
		
		$email = trim($doc->pp_email_1);
		if (strlen($email) > 0) { enviaremail($email,'',$titulo_email,$txt.$txt2); }
		
		enviaremail('cip@pucpr.br','',$titulo_email.'[copia]',$txt.$txt2); 
				
		$bon->historico_inserir($bon->protocolo,'BON','Bonificado por '.$user->user_login);
		$bon->troca_status('A','F');
		
		/* Altera Status */
		echo 'PROCESSO FINALIZADO COM SUCESSO!';		
	} else {
		echo 'Protocolo não habilidado para bonificação';
	}
	echo '<form action="bonificacao_A.php"><center>';
	echo '<input type="submit" value="voltar">';
	echo '</form>';	

	echo $txt2;

?>
