<?
if (($perfil->valid('#ADM#SCR#COO')))
{
?>
<style>
		#menu_top a { text-decoration : none; color : #000000; }
		#menu_top a:hover { text-decoration : underline; }
		#menu_top {
			font-family : Arial, Helvetica, sans-serif;
			font-size : 12px;
			text-decoration : none;
			background-color : <?=$cab_menu_bg;?>;
			border : 1px solid Black;
		}
</style>
<table width="100%" align="center" id="menu_top" cellpadding="0" cellspacing="3">
<?
$menu = array();
array_push($menu,array(':: In�cio ::','main.php'));
array_push($menu,array('P�s-Gradua��o','pos_graduacao.php'));
array_push($menu,array('Grupos & Linhas','grupo_pesquisa.php'));
array_push($menu,array('Capta��o de recursos','captacao.php'));
array_push($menu,array('Isen��o de Bolsas (SS)','bolsas.php'));
array_push($menu,array('Artigos','artigos.php'));
array_push($menu,array('Discente','discente.php'));
array_push($menu,array('Relat�rio','relatorio.php'));


if ($user_nivel >= 9)
	{ 
	array_push($menu,array('Declara��es','main.php')); 
	}
	
if ($user_nivel >= 9)
	{ 
	array_push($menu,array('Mensagens','main.php')); 
	array_push($menu,array('Manuten��o','main.php'));
	}

array_push($menu,array('Contato','contato.php'));
?>
<TR>
<? for ($r=0;$r < count($menu);$r++) { ?>
<? if ($r > 0) { echo '<TD width="1%">|</TD>'; } ?>
<TD align="center" width="2%"><NOBR>&nbsp;<A href="<?=$menu[$r][1];?>"><font color="<?=$cab_menu_font;?>"><?=$menu[$r][0];?></font></A>&nbsp;</TD>
<? } ?>
<TD align="right">&nbsp;<A href="logout.php">Sair</A>&nbsp;</TD>
</TR>
</table>
<table width="100%" class="lt0"><TD colspan="15"><?=date("d/m/Y H:i");?></TD></TR>
</table>
<?
}
?>

