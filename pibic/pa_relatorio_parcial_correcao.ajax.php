<?
$include = '../';
require("../db.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_data.php");
require($include."sisdoc_debug.php");
require("../_class/_class_pibic_bolsa_contempladas.php");
require("../_class/_class_language.php");
echo '<HR>RELATORIO PARCIAL<HR>';
?>
<style>
	.it0 { padding-left: 0px; color: #000000; font-weight: bold; }
	.it1 { padding-left: 10px; color: #404040;   }
	.it2 { padding-left: 20px; color: #808080;  }
</style>
<?

/** Start */
	$pb = new pibic_bolsa_contempladas;
	if (!((($dd[1]) > 0) and (checkpost($dd[1]) == $dd[90])))
		{ echo 'verbo n�o definido ou checkpost incorreto"'.$dd[2].'"'; print_r($dd); exit; }
	
	/* Le dados */		
	$pb->le('',$dd[1]);
	$cr = chr(13).chr(10);

	/* Mensagens */
	$tabela = 'pa_relatorio_parcial_ajax';
	$link_msg = '../messages/msg_'.$tabela.'.php';
	if (file_exists($link_msg)) { require($link_msg); }


/**
 * III DDD   III  OOO  M   M  AAA
 *  I  D  D   I  O   O MM MM A   A
 *  I  D   D  I  O   O M M M AAAAA
 *  I  D  D   I  O   O M   M A   A
 * III DDD   III  OOO  M   M A   A
 * 
 */


/*
 * Mostra informa��es sobre o idioma
 * Chama metodo de idioma configurado
 */
if (($dd[2]) == 'idioma')
	{
		 $ok = $pb->valida_idioma(); if ($ok==1) { $cor = '#FFFFFF'; } else { $cor = '#FFECEF';}
		 echo '<script>'.chr(13);
		 echo '$("#semic_idioma").css("background-color","'.$cor.'");'.chr(13);
		 echo '</script>'.chr(13);

		 echo '<B>'.$pb->mostra_idioma().'</B>';
	}
	
/*
 * Chama m�todo de trocar o idioma
 */
if (($dd[2]) == 'idioma_alterar')
	{
	$idi = $pb->idioma();
	$sx = '<select name="idi" id="idi">'.$cr;
	$sx .= '<option value="">::selecione::</option>'.$cr;;
	
	/* Mostra os idiomas dispon�veis */
	$keys = array_keys($idi);	
	for ($r=0;$r < count($keys);$r++)
		{
			$sel = '';
			$key = $keys[$r];
			$vlr = $idi[$key];		
			if (trim($pb->pb_semic_idioma) == $key) { $sel = 'selected '; }	
			$sx .= '<option value="'.$key.'" '.$sel.'>'.$vlr.'</option>'.$cr;
		}
	$sx .= '</select>'.$cr;
	echo $sx;
	echo '<input type="button" id="idb" value="grava">';
	echo '<script>'.$cr;
	echo '$("#idb").click (function(){ ';
	echo 'var tela01 = $.ajax( "pa_relatorio_parcial_correcao.ajax.php?dd1='.$dd[1];
	echo '&dd2=idioma_grava&dd3="+$("#idi").val()+"';
	echo '&dd90='.$dd[90].'" ) .done(function(data) ';
	echo '{ $("#sm_idioma").html(data); }) ';
	echo ' .fail(function() { alert("error"); }) ';
	echo '.always(function(data) { $("#sm_idioma").html(data); }); '.chr(13);
	echo '})';
	echo '</script>'.$cr;
	}

	/* Salva Idioma */
	if (($dd[2]) == 'idioma_grava')
		{
			$pb->pb_semic_idioma = $dd[3];
			$pb->grava_idioma();
			$pb->le('',$dd[1]);
			$ok = $pb->valida_idioma(); if ($ok==1) { $cor = '#FFFFFF'; } else { $cor = '#FFECEF';}
		 	echo '<B>'.$pb->mostra_idioma().'</B>';
			echo '<script>'.chr(13);
		 	echo '$("#semic_idioma").css("background-color","'.$cor.'");'.chr(13);
		 	echo '</script>'.chr(13);
		}
		
/**
 *  AAA  RRRR  EEEEE  AAA
 * A   A R   R E     A   A
 * AAAAA RRRR  EEE   AAAAA
 * A   A R  R  E     A   A
 * A   A R   R EEEEE A   A
 * 
 */
		
/**
 * �rea do conhecimento e curso de vinculo
 */
if (($dd[2]) == 'area')
	{
		$ok = $pb->valida_area(); if ($ok==1) { $cor = '#FFFFFF'; } else { $cor = '#FFECEF';}
		echo $pb->mostra_area_do_conhecimento();
		echo '<script>'.chr(13);
	 	echo '$("#semic_area").css("background-color","'.$cor.'");'.chr(13);
	 	echo '</script>'.chr(13);
	}	
		
/*
 * Chama m�todo de trocar o idioma
 */
if (($dd[2]) == 'area_alterar')
	{
	$idi = $pb->idioma();
	$sx = '<select name="idal" id="idal">'.$cr;
	
	$sql = "select * from ajax_areadoconhecimento ";
	$sql .= " where not ((a_cnpq like '%X%') or (a_cnpq like '%X%'))";
	$sql .= " and (a_semic = 1) ";
	$sql .= " order by a_cnpq";
	$rlt = db_query($sql);
	/* Mostra os idiomas dispon�veis */
	$xarea = '';
	while ($line = db_read($rlt))
		{
			$sel = '';
			$area = substr(trim($line['a_cnpq']),0,4);
			if (substr($area,1,1)=='.')
			{
				if ($pb->pb_semic_area == trim($line['a_cnpq'])) { $sel = 'selected'; }				
				if ($xarea != $area)
					{
						$style = "it0";
						$dsb = 'disabled';
						if (substr($area,2,2) != '00') { $style = 'it1'; $dsb = ''; }
						$sx .= '<option value="'.trim($line['a_cnpq']).'" class="'.$style.'" '.$dsb.' '.$sel.' >';
						$sx .= trim($line['a_cnpq']).' '.substr(trim($line['a_descricao']),0,40);
						$sx .= '</option>';
						$xarea = $area;			
					}  else {
						$sx .= '<option class="it2" value="'.$line['a_cnpq'].'" '.$sel.'>';
						$sx .= substr(trim($line['a_cnpq']),0,10).' '.(substr(trim($line['a_descricao']),0,40));
						$sx .= '</option>';
					}
			}			
		}
	$sx .= '</select>'.$cr;
	echo $sx;
	echo '<input type="button" id="idc" value="grava"><BR>';
	echo '<script>'.$cr;
	echo '$("#idc").click (function(){ ';
	echo 'var tela01 = $.ajax( "pa_relatorio_parcial_correcao.ajax.php?dd1='.$dd[1];
	echo '&dd2=area_grava&dd3="+$("#idal").val()+"';
	echo '&dd90='.$dd[90].'" ) .done(function(data) ';
	echo '{ $("#sm_area").html(data); }) ';
	echo ' .fail(function() { alert("error"); }) ';
	echo '.always(function(data) { $("#sm_area").html(data); }); '.chr(13);
	echo '})';
	echo '</script>'.$cr;
	}

/***
 * Grava area
 */	
if (($dd[2]) == 'area_grava')
	{
			$pb->pb_semic_area = $dd[3];
			$pb->grava_area();
			$pb->le('',$dd[1]);
			echo $pb->mostra_area_do_conhecimento();
			$ok = $pb->valida_area(); if ($ok==1) { $cor = '#FFFFFF'; } else { $cor = '#FFECEF';}
			echo '<script>'.chr(13);
		 	echo '$("#semic_area").css("background-color","'.$cor.'");'.chr(13);
		 	echo '</script>'.chr(13);			
	}

/**
 * RELATORIO
 * =========
 * PPPP   AAA  RRRR   CCC III  AAA  L
 * P   P A   A R   R C     I  A   A L
 * PPPP  AAAAA RRRR  C     I  AAAAA L
 * P     A   A R  R  C     I  A   A L
 * P     A   A R   R  CCC III A   A LLLL
 * 
 */
 
/**
 * �rea do conhecimento e curso de vinculo
 */
if ((substr($dd[2],0,5) == 'files'))
	{ require("_ged_config.php"); }


if ($dd[2]=='validar')
	{ $tipo = 'RELPC'; require("_ged_config.php"); }
	
if ($dd[2]=='2validar')
	{ $tipo = 'RELPC'; require("_ged_config.php"); }
	
echo '==>'.$dd[2].'=='.$tipo;
/***** Upload **/
if (($dd[2]) == 'files')
	{
		echo $ged->file_list();
		
			$ok = $pb->valida_relatorio_parcial(); if ($ok==1) { $cor = '#FFFFFF'; } else { $cor = '#FFECEF';}
			echo '<script>'.chr(13);
		 	echo '$("#semic_files").css("background-color","'.$cor.'");'.chr(13);
		 	echo '</script>'.chr(13);
			echo $sx;	
			
		}
/***** Upload **/
if (($dd[2]) == 'files_del')
	{
		$ged->id_doc = round($dd[0]);
		$ged->file_delete();
		echo $ged->file_list();

			// Busca arquivos
			$frame = "sm_file_row";
			$sx .= '<script type="text/javascript">'.chr(13);
			$sx .= '    var tela01 = $.ajax( "pa_relatorio_parcial_correcao.ajax.php?dd1='.$dd[1].'&dd2=files&dd3='.$frame.'&dd90='.$dd[90].'" ) .done(function(data) { $("#'.$frame.'").html(data); }) .fail(function() { alert("error"); }) .always(function(data) { $("#'.$frame.'").html(data); }); '.chr(13);
			$sx .= '</script>'.chr(13);				
			echo $sx;	

	}
	
/**
 * RELATORIO
 * =========
 * V    V  AAA  L   III DDD    AAA  
 * V    V A   A L    I  D  D  A   A 
 * V    V AAAAA L    I  D   D AAAAA 
 *  V  V  A   A L    I  D   D A   A 
 *   V    A   A LLL III DDDD  A   A 
 * 
 */

if (($dd[2]) == 'validar')
	{
			$flt = $ged->file_list();
			$files = $pb->valida_relatorio_parcial(); 
	
			$ok = $files;
			if (strlen(trim($pb->pb_semic_idioma))==0) { $ok = 0; }
			if (strlen(trim($pb->pb_semic_area))==0) { $ok = 0; }
			
			if ($ok == 1)
				{
				$sx .= '<div style="text-align: justify">';
				$sx .= msg('envia_info');
				$sx .= '</div>';
				$sx .= '<center>';
				$sx .= '<input type="button" name="final" id="final" value="'.msg('envia_definitivo').'">';
				$sx .= '</center>';
				}
			
			
			/* Regras de validacao */
			$sx .= '<table width="100%">';
			/**
			 * Valida Arquivos
			 */
			if ($files == 0)
				 { $sx .= '<TR valign="center"><TD width="20"><img src="../img/icone_alert.png" height="20"><TD><font color="red">'.msg('erro_file'); }
			if ($files==1) { $cor = '#FFFFFF'; } else { $cor = '#FFECEF';}
			echo '<script>'.chr(13);
	 		echo '$("#semic_files").css("background-color","'.$cor.'");'.chr(13);
	 		echo '</script>'.chr(13);				 
	
			 /* Idioma */
			if ($pb->pb_semic_idioma == '')
			 { $sx .= '<TR valign="center"><TD width="20"><img src="../img/icone_alert.png" height="20"><TD><font color="red">'.msg('erro_idioma'); }
			 
			 /**
			  * Área do conhecimento
			  */
			if (round($pb->pb_semic_area) == 0)
			 { $sx .= '<TR valign="center"><TD width="20"><img src="../img/icone_alert.png" height="20"><TD><font color="red">'.msg('erro_area'); }
			 
			$sx .= '</table>';
			echo $sx;
	} else {
			echo '<script>'.$cr;
			echo 'var tela01 = $.ajax( "pa_relatorio_parcial_correcao.ajax.php?dd1='.$dd[1];
			echo '&dd2=validar&dd3=';
			echo '&dd90='.$dd[90].'" ) .done(function(data) ';
			echo '{ $("#sm_valida").html(data); }) ';
			echo ' .fail(function() { alert("error"); }) ';
			echo '.always(function(data) { $("#sm_valida").html(data); }); '.chr(13);	
			echo '</script>'.$cr;
		
	}


?>
