<?
require("cab_root.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_breadcrumb.php');
require("cab_institucional.php");
require('_class/_class_header.php');

require('_class/_class_message.php');


/* BreadCrumb */
$breadcrumb = array();
array_push($breadcrumb, array('inicial',http.'main.php'));
array_push($breadcrumb, array('atualizar meus dados',http.'minha_conta.php'));

$hd = new header;
echo $hd->mostra('nc');
echo $hd->breadcrumb($breadcrumb);

require("_class/_class_docentes.php");
$pr = new docentes;


$id = $_SESSION['user_cracha'];
$dd[0] = $id;

$tabela = $pr->tabela;
$cp = $pr->cp_atualizacao();

require($include.'_class_form.php');
$form = new form;

$tela = $form->editar($cp,$tabela);

if ($form->saved > 0)
	{
		echo '<h1><center>Dados atualizados com Sucesso</center></h1>';		
	} else {
		echo $tela;
	}



?>
