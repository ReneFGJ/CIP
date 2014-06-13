<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captação'));

require("cab_cip.php");
require("_email.php");

require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_email.php');

require($include.'sisdoc_windows.php');

require("../_class/_class_ic.php");

require("../_class/_class_bonificacao.php");
$bon = new bonificacao;

require("../_class/_class_captacao.php");
$cap = new captacao;

require("../_class/_class_docentes.php");
$doc = new docentes;


$bon->le($dd[0]);
$doc->le($bon->professor);

echo '<TABLE width="100%" class="lt2"><TR><TD><B>Bonificação de pesquisador';
echo '<TD align="right">Protocolo: '.$bon->protocolo;
echo '</table>';

echo $doc->mostra();
$tipo = $bon->origem_tipo;
/* Fluxo de bonificaçao por projeto */
if ($tipo == 'PRJ')
{
		/* Ação de validar a bonificacao */
		if ($bon->status == '@')
		{
			echo '<TABLE>';
			echo '<TR><TD><form method="post" action="bonificacao_validar.php">';
			echo '<input type="hidden" name="dd0" value="'.$dd[0].'">';
			echo '<input type="hidden" name="dd90" value="'.$dd[90].'">';
			echo '<TD><INPUT TYPE="submit" value="Validar Bonificação" style="width: 500px; height: 50px;">';
			echo '</TABLE>';
		}
		/* Ação de comunicar o pesquisador */
		if ($bon->status == 'A')
		{
			echo '<TABLE>';
			echo '<TR><TD><form method="post" action="bonificacao_finalizar.php">';
			echo '<input type="hidden" name="dd0" value="'.$dd[0].'">';
			echo '<input type="hidden" name="dd90" value="'.$dd[90].'">';
			echo '<TD><INPUT TYPE="submit" value="Comunicar Pesquisador da Bonificação" style="width: 500px; height: 50px;">';
			echo '</TABLE>';
		}
}

if (($tipo == 'IPR') and (strlen($dd[10]) ==0)) 
{
		/* Ação de validar a bonificacao */
		if (($bon->status == '#')) 
		{
			echo '<TABLE>';
			echo '<TR><TD><form method="post" action="bonificacao_detalhe.php">';
			echo '<input type="hidden" name="dd0" value="'.$dd[0].'">';
			echo '<input type="hidden" name="dd10" value="IPR">';
			echo '<input type="hidden" name="dd11" value="COM">';
			echo '<input type="hidden" name="dd90" value="'.$dd[90].'">';
			echo '<TD><INPUT TYPE="submit" value="Comunicar Pesquisador da Isenção" style="width: 500px; height: 50px;">';
			echo '</TABLE>';
		}
		
		/* Ação de validar a bonificacao */
		if (($bon->status == '*')  or (strlen($bon->beneficiario)==8) and ($bon->status != 'F'))
		{
			echo '<fieldset>';
			echo '<TABLE class="lt1" width="100%" align="center">';
			echo '<TR><TH bgcolor="#C0C0C0" clss="lt2" colspan=2><center>Dados da Isenção';
			echo '<TR><TD><form method="post" action="bonificacao_detalhe.php">';
			echo '<input type="hidden" name="dd0" value="'.$dd[0].'">';
			echo '<input type="hidden" name="dd10" value="IPR">';
			echo '<input type="hidden" name="dd11" value="ATI">';
			echo '<input type="hidden" name="dd90" value="'.$dd[90].'">';
			echo '<TR><TD align="right">Número de parcelas isentas:'.sget('dd15','$[1-60]','a',1,1);
			echo '<TR><TD align="right">Valor atual das mensalidades:'.sget('dd16','$N8','',1,1);
			echo '<TR><TD align="right">Modalidade:'.sget('dd17','$O : &D:Doutorado&M:Mestrado','',1,1);
			echo '<TR><TD colspan=2 align="center"><INPUT TYPE="submit" value="Ativar Isenção do Estudante" class="botao-geral">';
			echo '</TABLE>';
			echo '</fieldset>';
		}		
}

if ($bon->origem_tipo=='PRJ')
	{
		$id = $bon->origem_protocolo;
		$cap->le($id);
		echo $cap->mostra();
		//echo $bon->mostrar_bonificacao(); 
		if ($perfil->valid('#COO#SCR#ADM') == 1) 
			{
				 $link = '<A HREF="captacao_ed.php?dd0='.$id.'" target="newx">';
				 echo $link.'editar</A>'; 
			}		
	}

if ($tipo=='IPR')
	{
		echo $bon->mostar_isencao(); 
	}	
if (($bon->origem_tipo=='IPR') and (strlen($dd[10]) > 0))
	{
		$id = $bon->origem_protocolo;
		if ($dd[11]=='COM') { $bon->isencao_produtividade_comunicar_pesquisador($bon); }
		if ($dd[11]=='ATI') { $bon->isencao_produtividade_ativar_estudante($bon); }
		echo $bon->erro;
	}

				require("_ged_bonificacao_ged_documento.php");
				$ged->protocol = $bon->protocolo;
				$ged->file_type = 'TIS';
				echo '<fieldset><legend>Arquivos</legend>';
				echo '<table width="100%"><TR><TD>';
				echo $ged->filelist();

				if ($perfil->valid('#SCR#ADM#COO'))
					{
					echo $ged->upload_botton_with_type($bon->protocolo,'','');
					}
				echo '</table></fieldset>';

echo '<input type="button" value="imprimir formulário" id="bt5">';


//$cap = new captacao;
//$cap->le($dd[0]);

//echo $cap->mostra();

//echo $bon->acao($cap->status);

//echo $bon->bonificar_formento_gerar($dd[1]);
$link = 'bonificacao_detalhe_pr.php?dd0='.$dd[0].'&dd90='.$dd[90];
$link = 'formulario_pagamento.php?dd0='.$dd[0].'&dd90='.$dd[90];

$bon = new bonificacao;
echo $bon->mostra_bonificacoes_por_projeto($cap->protocolo);
require("_ged_bonificacao_ged_documento.php");
echo $cap->historico_mostrar($cap->protocolo,$cap->protocolo);

require("../foot.php");	?>

<script>
    $("#bt5").click(function () {
      newwin2('<?php echo $link;?>',700,600);
    });
</script>

</script>