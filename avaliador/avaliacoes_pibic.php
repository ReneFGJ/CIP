<?
$parecer_pibic->tabela = 'pibic_parecer_'.date("Y");
echo '<HR>';
//$tela = $parecer_pibic->resumo_avaliador_pendencia($par->codigo);

//$tela = $parecer_pibic->resumo_avaliador($par->codigo,'RPAJ');

/*
 * RELATORIO PARCIAL
 */
//$sql = "update ".$parecer_pibic->tabela." set pp_data = 20140417 where pp_tipo = 'RPAR' ";
//$rlt = db_query($sql); 
if (date("m") < 4) 
	{ $tela = $parecer_pibic->resumo_avaliador($par->codigo,'RPAR'); } 
	//{ $tela = $parecer_pibic->resumo_avaliador($par->codigo,'RPAC'); } 

if ((date("m") >= 5) and (date("m") < 8))
	{ $tela = $parecer_pibic->resumo_avaliador($par->codigo,'SUBMI'); }
	 
$tot = $tot + $tela[0];
if ($tela[0] > 0) { echo $tela[1]; }
$tela[1] = '';
/*
 * CORRECAO DO RELATORIO PARCIAL
 */
//$sql = "update ".$parecer_pibic->tabela." set pp_data = 20140318 where pp_tipo = 'RPAC' ";
//$rlt = db_query($sql);
 
if (date("m") < 4)
	{ $tela = $parecer_pibic->resumo_avaliador($par->codigo,'RPAC'); }
if ((date("m") >= 4) and (date("m") <= 4))
	{ $tela = $parecer_pibic->resumo_avaliador($par->codigo,'RFIN'); }
		 
$tot = $tot + $tela[0];
if ($tela[0] > 0) { echo $tela[0]; }

/*
 * CORRECAO DO RELATORIO JUNIOR
 */
//if (date("m") < 4)
//	{ $tela = $parecer_pibic->resumo_avaliador($par->codigo,'RPAJ'); } 
//$tot = $tot + $tela[0];
//if ($tela[0] > 0) { echo '<h2>PIBIC Jr</h2>'; echo $tela[1]; }

/*
 * CORRECAO DO RELATORIO JUNIOR
 */
/* ATUALIZA DATA */
//$sql = "update ".$parecer_pibic->tabela." set pp_data = 20140520 where pp_tipo = 'SUBMI' ";
//$rlt = db_query($sql);

//if (date("m") < 6)
//	{ $tela = $parecer_pibic->resumo_avaliador($par->codigo,'SUBMI'); } 
//$tot = $tot + $tela[0];
//if ($tela[0] > 0) { echo '<h2>Submissão IC Internacional</h2>'; echo $tela[0]; }

	 
?>