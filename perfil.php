<?php
/* $breadcrumbs */
$breadcrumbs = array();
array_push($breadcrumbs,array('main.php','principal'));
array_push($breadcrumbs,array($site.'main.php','menu'));
require("cab_perfil.php");

require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_colunas.php');
/* Grafico */
require("_class/_class_graficos.php");
$gr = new graphics;

/* Produção */
require("_class/_class_lattes.php");
$lattes = new lattes;

/* Captacao */
require("_class/_class_captacao.php");
$cap = new captacao;

/* Artigos */
require("_class/_class_artigo.php");
$art = new artigo;

/* Docentes */
require("_class/_class_docentes.php");
$act = new docentes;
/****/
if (strlen($dd[0])> 0)
	{
		$chk = checkpost($dd[0]);
		$act->le($dd[0]);
		$codigo = $act->pp_cracha;
	} else {
		$codigo = $nw->user_cracha;
	}

require("_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

require("_class/_class_programa_pos.php");
$pos = new programa_pos;

$act->le($codigo);
echo $act->mostra_dados();

/* Abas */
$ops = array(
		'Informações gerais',
		'Orientações de <NOBR>Pós-Graduação</nobr>',
		'Orientações de <nobr>Iniciação Científica</nobr> (IC)',
		'Produção Científica',
		'Captação de recursos',		
		'Banco de Projetos'
		);
		
/* Monta JavaScript */		
echo '<script type="text/javascript"> function mudaAba (numero_aba) {	';
for ($r=0;$r < count($ops);$r++)
		{
		echo chr(13).'if (numero_aba == '.($r+1).') { '.chr(13);
		
		for ($y=0;$y < count($ops);$y++)
			{
				$tps = '.hide();';
				if ($y==$r) { $tps = '.fadeIn("slow");'; }
				echo '$("#aba'.($y+1).'")'.$tps;
			}
		echo ' } '.chr(13);
		}
echo '} </script> '.chr(13);

echo '
			<table class="tabela00" width="100%" border=0>
			<TR valign="top"><TD width="140">
				<div id="menu-info-gerais" class="menu-info-gerais">
					<a name="grafico"></a>
					<ul class="lt0">
			';
			for ($r=0;$r < count($ops);$r++)
			{
				echo '<a href="#grafico" OnClick="mudaAba('.($r+1).')">';
				echo '<li>'.$ops[$r].'</li></a>'.chr(13);
			}
			echo '</ul>'.chr(13);
echo '</div> '.chr(13);
echo '</TD>';

echo '<TD>';

/* Monta telas */
$orientacao_ic = $pb->orientacoes_ic($codigo);
$orientacao_pos = $pos->orientacoes_pos($codigo);

$tela03j .= $lattes->jcr($codigo);

/* Tela 00 */
$tela00t = '<IMG SRC="'.http.'img/imagem-teste-infografico.jpg">';
$tela00i = $pb->grafico_orientacoes($orientacao_ic);
$tela00p = $pos->grafico_orientacoes($orientacao_pos);
$captacao = $cap->captacao_total_professor($codigo,1);
$tela00x = $gr->grafico_folha($captacao[0],$captacao[1],'Total de captação acadêmica');
$tela00x .= '<font class="lt0">Desde '.substr($captacao[3],0,4);

$tela00f = $lattes->resumo_qualis($codigo);
$producao = $lattes->recupera_producao($codigo);
$tela03a .= '<center>'.$gr->grafico_barras($producao,'','gr_red.png');

$captacao = $cap->captacao_total_professor($codigo,2);

$artigos = $art->resumo($codigo);
if (strlen($artigos) > 0) { $artigos .= '<BR><BR><BR>'; }

if ($captacao[0] > 0)
	{
	$tela00y = $gr->grafico_folha($captacao[0],$captacao[1],'Total de captação institucional');
	$tela00y .= '<font class="lt0">Desde '.substr($captacao[3],0,4);
	}
	
	
/* Tela 05 */
//$tela05 = $lattes->resumo_qualis($codigo);
$tela00h = $lattes->indice_h($codigo);

$tela00 = '<table width="100%" style="background-color: white;" border=0>';
$tela00 .= '<TR valign="top"><TD>';
$tela00 .= $tela00x . '<td>'.$tela00y;
$tela00 .= '<TR><TD colspan=2><BR><BR><H3>Produção Científica</h3>';
$tela00 .= '<TR><TD colspan=2>';
	$tela00q = '<table width="100%" class="tabela00">';
	$tela00q .= '<TR valign="top">';
	$tela00q .= '<TD class="tabela01"  bgcolor="#F7F7F7">';
	$tela00q .= $tela03j;
	$tela00q .= '<TD class="tabela01" bgcolor="#F7F7F7">';
	$tela00q .= $tela00h;
	$tela00q .= '<TD class="tabela01" bgcolor="#F7F7F7">';
	$tela00q .= $tela00f;
	$tela00q .= '</table>';
$tela00 .= $tela00q;
$tela00 .= '<TR><TD colspan=2>'.$tela03a;
$tela00 .= '<TR valign="top"><TD>&nbsp;';
$tela00 .= '<TR valign="top"><TD>';
$tela00 .= $tela00i.'<BR>';
$tela00 .= '<TD>';
$tela00 .= $tela00p.'<BR>';

//$tela00 .= '<TR valign="top"><TD colspan=2>';
//$tela00 .= $tela00t;
$tela00 .= '</table>';

/* Tela 01 */
$tela01  = $pos->mostra_docentes_orientacoes($codigo);
$tela01 .= $pos->mostra_docente_programa($codigo);
$tela01a = $pos->mostra_docentes_orientacoes_detalhe($codigo,'');
$tela01 .= $tela01a[1];

//$tela02 = '<IMG SRC="'.http.'jpg.php?tp=1">';

$tela02 = '<h3>Orientações de Iniciação Científica</h3>';
$tela02 .= $pb->mostra_orientacoes_ic($orientacao_ic);



$tela03 = '<h2>Produção Científica</h2>';
//$tela05 .= $lattes->mostra_lattes_producao($codigo);
$tela03 .= $artigos;
$tela03 .= $tela00q;
//$tela03 .= $tela03j;
$tela03 .= $tela03a;

$tela03 .= $lattes->mostra_lattes_producao($codigo);

/* Tela 04 */
$cap->docente = $codigo;
$tela04 = '<h2>Captação de Recursos</h2>';
$tela04 .= '<Table class="tabela00" border=0 width="100%"><TR align="center">';
$tela04 .= '<TD width="50%">'. $tela00x . '<td>'.$tela00y;
$tela04 .= '</table>';
$tela04 .= $cap->mostra_captacao();	



/*
 * esumo_qualis_discente_ss($programa,$areas,$anoi=1990,$anof=2999)
 */





for ($r=0;$r< count($ops);$r++)
	{
	$style = "display:none; background-color: white;";
	echo '<div id="aba'.($r+1).'" style="'.$style.'" >'.chr(13);
	//echo '==>'.$r;
	if ($r==0) { echo $tela00; }
	if ($r==1) { echo $tela01; }
	if ($r==2) { echo $tela02; }
	if ($r==3) { echo $tela03; }
	if ($r==4) { echo $tela04; }
	if ($r==5) { echo $tela05; }
		
	echo '</div>'.chr(13);
	}
echo '</table>';
echo '<script> $("#aba1").fadeIn("slow"); </script>';

echo $hd->foot();

?>