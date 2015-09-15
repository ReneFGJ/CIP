<?php
require("cab.php");
/* libs */
require($include.'_class_form.php');
/* classes */
require("_class/_class_avaliacao.php");

$nomePagina = page();
$av = new avaliacao($nomePagina);

#### Início da renderização da página ####

$tituloCab = NULL; //$tituloCab = NULL -> gerado de $tipoTrabalhoStr, $idTrabalhoStr em $hd->cab_logado()
//$botaoEsquerda = array($av->build_url_pagina("logout",array()), 'icon-circle-arrow-left');
$botaoDireita  = NULL;
$botaoEsquerda = NULL;

if ($dd[1]==1)
	{
		$hd->logout();
		redirecina('index.php');
	}

echo $hd->cab_logado($tipoTrabalhoStr, $idTrabalhoStr, $nomeAvaliador, "Sair do login", $botaoEsquerda, $botaoDireita);
////////////////////////////////////////////////////
echo '<center>';
echo '<ul class="botao_avaliacao"> 
		<a href="logout.php?dd1=1"> 
		Confirmar saída <i class="icon-edit" style="margin-left:5px; font-size:25px; vertical-align:-2px;"></i> </a> 
		</ul>
		';
echo '<BR><BR>';
echo '<ul class="botao_avaliacao"> 
		<a href="semic_trabalhos.php"> 
		Voltar a avaliação <i class="icon-edit" style="margin-left:5px; font-size:25px; vertical-align:-2px;"></i> </a> 
		</ul>
		';
echo '</center>';	

echo '</div>';

////////////////////////////////////////////////////
?>
