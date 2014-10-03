<?php>
require("db.php");
require($include.'sisdoc_email.php');

require("_class/_class_docentes.php");
$doc = new docentes;

require("_class/_class_ic.php");
$ic = new ic;

$doc->le($dd[0]);

echo $doc->mostra();

$ic = $ic->ic("docente_email");

$titulo = $ic['nw_titulo'] . ' - '.$this->pp_nome;
$texto = mst($ic['nw_descricao']);

require("cip/_email.php");

$texto = '<img src="'.$http.'img/email_cip_header.png"><BR>'.$texto
		.'<BR><img src="'.$http.'img/email_cip_foot.png">'
;
$email1 = $doc->pp_email;
$email2 = $doc->pp_email_1;

$texto = troca($texto,'$LINK',$doc->post_link);

if (strlen($email1) > 0)
	{
		enviaremail($email1, '', $titulo, $texto);		
	}
if (strlen($email2) > 0)
	{
		enviaremail($email2, '', $titulo, $texto);
	}
	
if (strlen($email2.$email1) == 0)
	{
		echo '<HR><font color="red"><CENTER>PROFESSOR SEM E-MAIL</font></HR>';
	} else {
		echo '<font color="green">Senha enviada com sucesso para o e-mail '.$email1.'</font>';
	}

function msg($x) { return($x); }

?>
