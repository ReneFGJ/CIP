<?php
require("cab_cip.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_email.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$menu = array();
/////////////////////////////////////////////////// MANAGERS
//array_push($menu,array('Isenção','Gerar Bonificações','artigos_gerar.php'));

echo '<H3>Artigos cadastrados para Bonificação</h3>';

/* IC */
require("../_class/_class_ic.php");

/* Resumo */
require("../_class/_class_artigo.php");
$art = new artigo;
	
require("../_class/_class_docentes.php");
$doc = new docentes;

$art->le(round($dd[0]));

$doc->le($art->autor);
echo $doc->mostra();

require_once("_ged_artigo_ged_documento.php");
$ged->protocol = $art->protocolo;
$ged->file_delete();

echo $art->mostra();

if ($art->line['ar_professor']==$ss->user_cracha)
	{
		if (($art->line['ar_status']==0) or ($art->line['ar_status']==8))
		{
		echo '<form action="artigo_novo.php" method="get">
				<input type="hidden" name="dd0" value="'.$dd[0].'">
				<input type="hidden" name="pag" value="1">
				<input type="submit" value="editar" class="botao-geral">
			</form>
		';
		}
	}

if ($perfil->valid('#CPS#ADM#COO'))
	{
		require("../_class/_class_pucpr_formulario.php");
		$form_pucpr = new formulario;
		$form_pucpr->beneficiario = $art->autor;
		$form_pucpr->beneficiario_nome = $art->autor_nome;
		$form_pucpr->artigo_id = $art->id;
		
		echo $form_pucpr->show_botton_create();

		echo $ged->upload_botton_with_type($art->protocolo,'','');
		echo '<h2>Ações</h2>';
		
		echo '<table width="100%">';
		echo '<TR valign="top">';
		echo '<TD width="50%">';
		echo $art->acoes();
		
		echo '<TD>';
		echo $art->pagamentos();
		
		echo '</table>';
		
	}
	//$tela = menus($menu,"3");
	
$protocolo = $art->protocolo;
echo $art->historico_mostrar($protocolo, $protocolo_origem);	
require("../foot.php");
?>

