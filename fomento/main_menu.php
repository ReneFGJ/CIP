<?php
/* $breadcrumbs */
$breadcrumbs = array();
array_push($breadcrumbs,array('main.php','principal'));
array_push($breadcrumbs,array($site.'main.php','menu'));

require('main_cab.php');
require($include.'sisdoc_colunas.php');

require("_class/_class_captacao.php");
$cap = new captacao;

/* Resumos para corrigir */
require("_class/_class_semic.php");
$semic = new semic;
$tot_semic = $semic->resumo_corrigir($ss->user_cracha);

require("_class/_class_atividades.php");
$ati = new atividades;

/* Submiss�es IC */
require("pibic/__submit_SUBM.php");
$ic_on = $open;

/* Body */
$mn = array();

if ((date("Ymd") <= 20140424) or ($ic_on == 1))
	{
		array_push($mn,array('botao_pibic','b1',http.'pibic/submit_project.php','botao_pibic_02.jpg','imgs',''));
	}	


/* Total de Atividades */
$ati->total_isencoes($user_id);
$total = $ati->total_atividades($user_id);

$total3 = $ati->total_captacoes_validar($ss->user_cracha);

if ($total > 0)
{
	$ativ = '
		<div id="nova-atividade" class="nova-atividade">
			<p id="numero-atividade" class="numero-atividade">'.$total.'</p>
		</div>';
				
		
	/* Lista de atividades autorizadas */
	
	if ($perfil->valid('#RES'))
		{ array_push($mn,array('Lista de atividades indicadas ao seu login','b1','atividades.php','Atividades','icone-atividades',$ativ)); }
}

/* SEMIC */
if (($tot_semic > 0) or (!($perfil->valid('#CNQ'))))
	{
		//array_push($mn,array('botao_mostra','b1',http.'semic_submit/','submissao-mostra.jpg','imgs',''));
		//array_push($mn,array('SEMIC & MOSTRA DE PESQUISA, submiss�es e corre��es de trabalhos','b1','semic_submit','SEMIC & MOSTRA DE PESQUISA','icone-meu-perfil','')); 	
	}

/* Valida��es de captacao */
if ($total3 > 0)
{
	$ativ3 = '
		<div id="nova-atividade" class="nova-atividade">
			<p id="numero-atividade" class="numero-atividade">'.$total3.'</p>
		</div>';
}

/* CIP */
//if (($perfil->valid('#ADM#SCR#COO#SPG')))
	{ array_push($mn,array('Centro Integrado de Pesquisa, Grupos e Linhas de Pesquisa','b2','cip/','CIP',"icone-pesquisa",'')); }

//if (($nw->user_ss=='S') and (date("Ymd") <= 20130728))
if (!($perfil->valid('#CNQ')))
	{
		array_push($mn,array('Perfil do pesquisador, orienta��es e produ��es','b1','perfil.php','Meu Perfil','icone-meu-perfil','')); 
	}
	

	
if ($perfil->valid('#CNQ#ADM#PIB'))
	{
		array_push($mn,array('Observat�rio CNPq','b1','cnpq/','CNPq','icone-iniciacao-cientifica',''));
	}
if ($perfil->valid('#PIB'))
	{
		array_push($mn,array('Fomento (Editais)','b1','fomento_old/','Editais','icone-iniciacao-cientifica',''));
	}	

if ($perfil->valid('#SEP#SPG'))
	{
		array_push($mn,array('Secretaria dos programas de P�s-Gradua��o','b1','pos/','Secretaria PPG','icone-iniciacao-cientifica',''));
	}
if (!($perfil->valid('#CNQ')))
	{
	array_push($mn,array('Programa de Inicia��o Cient�fica, PIBIC, PIBITI, PIBIC Jr, CsF, Inclus�o Social','b1','pibic/','Inicia��o Cient�fica','icone-iniciacao-cientifica',''));
	$cap = "Capta��o de recursos, isen��o de estudantes e bonifica��es";
//if (($perfil->valid('#RES#ADM#SCR#COO')))
		array_push($mn,array($cap,'b2','cip/captacoes.php','Capta��o de recursos',"icone-pesquisa",$ativ3));
	}
	
/* Bonifica��o de artigos */
	$cap = "Bonifica��o de artigos A1, A2, Q1 e Excelence Rate";
	array_push($mn,array($cap,'b2','cip/artigos_resumo.php','Bonifica��o de artigos',"icone-pesquisa",$ativ3));

 
if (($perfil->valid('#ADM#PIB#PIT#SPI')))
	{ array_push($mn,array('Administra��o Inicia��o Cient�fica, PIBIC, PIBITI, PIBIC Jr, CsF, Inclus�o Social','b1','pibicpr/','Inicia��o Cient�fica','icone-iniciacao-cientifica','')); }	
if (($perfil->valid('#ADM#PIB#PIT#SPI')))
	{ array_push($mn,array('Administra��o SEMIC e Mostra de Pesquisa','b1','semic_adm/','SEMIC & MOSTRA','icone-iniciacao-cientifica','')); }	
	
if ($perfil->valid('#ADM#SPI#CPI#SCR'))
	{
	array_push($mn,array('Editais e chamadas de ag�ncia de fomento para pesquisa, estudo ou eventos','b3','fomento/','Fomento','icone-fomento',''));
	}

if ($perfil->valid('#CEU#CES'))
	{
	array_push($mn,array('Comit� de �tica no Uso de Animais','ceua','ceua/','CEUA','icone-iniciacao-cientifica',''));	
	}

if ($perfil->valid('#ADM'))
	{ array_push($mn,array('Administra��o do sistema','b1','admin/','Administra��o','')); }
if ($perfil->valid('#CSF'))
	{ array_push($mn,array('Ci�ncia Sem fronteiras','b1','csf/','CSF','')); }
	
if ($perfil->valid('#ADM#SPI#CPI'))
	{
	//array_push($mn,array('�rea do professor <I>stricto sensu</I>','ba','ss/','P�s-Gradua��o','icone-pos-graduacao',''));
	array_push($mn,array('Banco de projetos','b1','banco_projetos/','Projetos','icone-iniciacao-cientifica',''));
	}
	
if ($perfil->valid('#ADM#SPI#CPI'))
	{
	//array_push($mn,array('�rea do professor <I>stricto sensu</I>','ba','ss/','P�s-Gradua��o','icone-pos-graduacao',''));
	array_push($mn,array('Editais / Atos normativos / Resolu��es','b1','ged/','Documentos','icone-documentos',''));
	}
if ($perfil->valid('#ADM#SPI#CPI'))
	{
	array_push($mn,array('Indicadores da Pesquisa na PUCPR','b1','bi/','Indicadores','icone-indicadores',''));	
	}


	if ($perfil->valid('#ADM'))
	{
		array_push($mn,array('Produ��o cient�fica institucional','b1','lattes/','Indicadores de Produ��o','',''));	
	}	

/* Montagem da tela */
echo '<h1>Menu principal</h1>';
echo '<table border=0 cellpadding=10 align="center" class="tabela00" align="center">'.chr(13);;
$col = 6;
for ($r=0;$r < count($mn);$r++)
	{
		$sx = '';
		
		if ($col >= 4) { $col = 0; $sx .= '<TR>'.chr(13);; }
		
		$tips = $mn[$r][4];
		if ($tips == 'imgs')
			{
				$img1 = '<img src="img/'.$mn[$r][0].'_01.jpg" id="img" border=0 >';
				$sx .= '<td width="33%">';
				$sx .= '<A HREF="'.$mn[$r][2].'">';
				$sx .= $img1;
				$sx .= $img2;
				$sx .= '</A>';
				$sx .= '<script>
							var tela=1;
							setInterval("troca();", 2000);
							function troca()
								{
									if (tela == 1)
										{
											$("#img").attr("src", "img/'.$mn[$r][0].'_01.jpg");
											tela = tela + 1;
										} else {
											if (tela == 2)
												{
													tela = 3;
													$("#img").attr("src", "img/'.$mn[$r][0].'_02.jpg");													
												} else {
													tela = 1;
													$("#img").attr("src", "img/'.$mn[$r][0].'_03.jpg");																										
												}
										}				
																		
								}
							
						</script>
						
						';
				
			} else {
				$class = "icone-pesquisa";
				$link = $mn[$r][2];
				if (strlen($mn[$r][4]) > 0)
					{ $class = $mn[$r][4]; }
				$sx .= '<td width="33%">';
				$sx .= '<a href="'.$link.'" onclick="parent.location=\''.$mn[$r][2].'\'" class="no-undeline">';
				$sx .= '     <div id="icone-cip-'.$r.'" class="'.$class.' icone-cip">';
				$sx .= $mn[$r][5];
				$sx .= '
						<h2 class="'.$class.'-cor">'.$mn[$r][3].'</h2>
						<p>
							'.$mn[$r][0].'
						</p>						
					</div>
					</a>
					</td>
					'.chr(13);
			}
		echo $sx;	
		$col++;
	}
echo '</table>';
echo '<BR><BR><BR><BR><BR><BR>';

echo $hd->foot();
?>
