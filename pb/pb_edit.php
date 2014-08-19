<?
$include = '../';
require("../db.php");

require('../_class/_class_language.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');
require("_class/_class_publish.php");
$cap = new publish;
$cp = $cap->cp();

$chk = checkpost($dd[0]);

if (($chk == $dd[90]) or (strlen($dd[0])==0))
{
?><head>
	<title>::CIP::</title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
	<link rel="shortcut icon" type="image/x-icon" href="http://cip.pucpr.br/favicon.ico" />
	<link rel="STYLESHEET" type="text/css" href="../css/letras.css">	
</head><?

	$http_edit = page().'?dd90='.$dd[90];
	$http_redirect = '';
	
	/** Comandos de Edição */
	?><TABLE width="98%" align="center" bgcolor="<?=$tab_color;?>"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
	if ($saved > 0)
		{
			echo 'FIM';
			require('../close.php');
		} else {
			if (strlen($acao) > 0)
				{
					?>
					<script>
						alert("Os campos em vermelho são obrigatórios, no campo valores informe 0,00 se não existir recursos desta modalidade.");
					</script>
					<?
				}
		}
	}

?>