<?
require("cab.php");
require('../_class/_class_grupo_de_pesquisa.php');

	/* Mensagens */
	$link_msg = '../messages/msg_'.page();
	if (file_exists($link_msg)) { require($link_msg); }

global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');

	$clx = new grupo_de_pesquisa;
	
	$sql = "select * from ".$clx->tabela."
		 order by gp_cnpq_certificado, gp_nome
	";
	$rlt = db_query($sql);
	echo '<table width="'.$tab_max.'" class="lt1">';
	echo '<TR>';
	echo '<TH>'.msg('gr_nome');
	echo '<TH>'.msg('gr_status');
	echo '<TH>'.msg('gr_atualizado');
	$cabx = 'X';
	
	$sta = $clx->grupo_lattes_status();
	$rel = $clx->grupo_status_array();
	$tot = 0;
	$tot1 = 0;
	while ($line = db_read($rlt))
		{
			$dt_cnpq = $line['gp_data_autorizacao'];
			$st_cnpq = trim($line['gp_cnpq_certificado']);
			$status = $line['gp_status'];
			
			$link = '<A HREF="grupo_de_pesquisa_detalhe.php?dd0='.$line['id_gp'].'&dd90='.checkpost($line['id_gp']).'">';
			if ($st_cnpq != $cabx)
				{
					if ($tot1 > 0)
						{ echo '<TR><TD colspan=3 align="right"><I>sub-total '.$tot1; $tot1 = 0; }
					$cabx = $st_cnpq;
					echo '<TR><TD colspan=3 class="lt2"><B><I>';
					echo $sta[$st_cnpq];
				}
			if ($dt_cnpq < 20000101) { $update = msg('not_update'); }
			else {
				$update  = stodbr($dt_cnpq);
			}	
			echo '<TR '.coluna().'>';
			echo '<TD>'.$link.$line['gp_nome'].'</A>';
			echo '<TD>'.$rel[$status];
			echo '<TD>'.$update;
			$tot = $tot + 1;
			$tot1 = $tot1 + 1;
		}
	if ($tot1 > 0)
		{ echo '<TR><TD colspan=3 align="right"><I>sub-total '.$tot1; }
	if ($tot > 0)
		{ echo '<TR><TD colspan=3 align="right"><I><B>total geral '.$tot; }
	echo '</table>';
?>