<?php
$include = '../';
require("../db.php");
require("../_class/_class_message.php");
$file = '../messages/msg_pt_BR.php';
require($file);
$LANG = 'pt_BR';

/* IDIDOMAE */
if ($dd[90]=='idioma')
	{
		require('../_class/_class_pibic_bolsa_contempladas.php');
		$pb = new pibic_bolsa_contempladas;
		require('../_class/_class_ic_relatorio_final.php');
		$rp = new ic_relatorio_final;
		$pb->le('',$dd[0]);
		
		if ($dd[2]=='save')
			{
				$pb->fixa_idioma($dd[0],$dd[4]);
				echo '
				<script>
					window.location.reload( true );
				</script>
				';
			}		
		
		echo $rp->form_idioma_apresentacao_mostra();
	}
/* TITULO DO PLANO DO ALUNO */
if ($dd[90]=='titulo')
	{
		require('../_class/_class_pibic_bolsa_contempladas.php');
		$pb = new pibic_bolsa_contempladas;
		require('../_class/_class_ic_relatorio_final.php');
		$rp = new ic_relatorio_parcial;
		$pb->le('',$dd[0]);
		
		echo $rp->mostra_titulo($pb);
		
		if ($dd[2]=='save')
			{
				$pb->altera_titulo($dd[7],$dd[4],$dd[6]);
				echo '
				<script>
					window.location.reload( true );
				</script>
				';
			}		
	}
/* AREA DO CONHECIMENTO */
if ($dd[90]=='area')
	{
		require('../_class/_class_pibic_bolsa_contempladas.php');
		$pb = new pibic_bolsa_contempladas;
		require('../_class/_class_ic_relatorio_final.php');
		$rp = new ic_relatorio_final;
		$pb->le('',$dd[0]);
		
		if ($dd[2]=='save')
			{
				$pb->fixa_area($dd[0],$dd[4]);
				echo '
				<script>
					window.location.reload( true );
				</script>
				';
			}		
		
		echo $rp->form_area_conhecimento_mostra();
	}

/* ARQUIVOS */
if ($dd[90]=='ged')
	{
	require("_ged_config.php");
	
		require('../_class/_class_pibic_bolsa_contempladas.php');
		$pb = new pibic_bolsa_contempladas;
		$pb->le('',$dd[0]);
			
	if ($dd[2]=='files_del')
		{
			$ged->id_doc = round($dd[10]);
			$ged->file_delete_confirm();
			echo '
				<script>
					window.location.reload( true );
				</script>
				';			
		}
	
	$ged->protocol = $dd[0];
		
				$popup = "";
				$frame = "";
				$page = page();
				
				$divname = 'geds';
				$frame = '1';
				$sx = '<fieldset class="fieldset01">';
				$sx .= '<legend class="legend01">'.msg('ic_aquivos').'</legend>';
				$sx .= msg('ic_rpar_file');
				$sx .= '<table width="100%" class="tabela00">';
				$sx .= '<TR><TH><h2>'.msg('ic_aquivos').'</h2>';
				$sx .= $ged->file_list('',page());
				$sx .= '</table>';			
				$nota = $pb->line['pb_relatorio_final_nota'];
				if (($nota <> 2) and ($nota <> (-1)))
					{
						$sx .= $ged->upload_form('RELAF','Submeter relatório final');		
					} else {
						$sx .= $ged->upload_form('RFC','Submeter correção do relatório final ');		
					}
					
				
				
				$sx .= '</fieldset>';
	}
echo $sx;
echo date("d/m/Y H:i:s");

?>