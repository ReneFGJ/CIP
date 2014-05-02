<?php
$include = '../';
require("../db.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_breadcrumb.php');

$tdoc = "pibic_submit_documento";
$tdov = "pibic_submit_documento_valor";
$tdoco = "submit_documentos_obrigatorio";
$cdoc = "pibic_submit_sub_orcamento";
$ged_files ="pibic_ged_files";
$faq = "faq";
$submit_autores = "submit_autores";
$ic_noticia = "ic_noticia";
$submit_manuscrito_field = "submit_manuscrito_field";
$submit_manuscrito_tipo = "submit_manuscrito_tipo";
$table_pesquisador = 'reol_pesquisador';
$submit_crono_orca = "submit_crono_orca";

require("../_class/_class_ajax.php");
$email_adm = 'pibicpr@pucpr.br';
$admin_nome = 'Iniciação Científica PUCPR';

/* Segurança do Login */
require($include.'sisdoc_security_pucpr.php');
$nw = new usuario;
$sec = $nw->Security();

require("../_class/_class_message.php");
$file = '../messages/msg_pt_BR.php';
require($file);

require("../_class/_class_user_perfil.php");
$perfil = new user_perfil; 

require("../cab_institucional.php");

/* Messages */
$file = '../messages/msg_pt_BR.php';
require($file);

$menu = array();
array_push($menu,array('Início','index.php'));
$data = round(date("m"));

if (($data >= 1) and ($data < 3))
	{
		array_push($menu,array('Submissão de projetos','submit_project.php'));
		array_push($menu,array('Relatório Parcial','atividade_IC1.php'));				
	}
if (($data >= 6) and ($data < 8))
	{	
		array_push($menu,array('Relatório Final','atividade_IC3.php'));
		array_push($menu,array('Resumos','atividade_IC4.php'));
	}
//array_push($menu,array('Indicadores','indicadores.php'));
//array_push($menu,array('pareceristas','parecerista.php'));
//array_push($menu,array('discentes','discentes.php'));
//array_push($menu,array('pagamentos','pagamentos.php'));

$id_pesq = $nw->user_cracha;
$nome = $nw->user_nome;

require('../_class/_class_header.php');
$hd = new header;
echo $hd->mostra('ic');
?>
