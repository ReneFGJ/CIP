<?
require("../_class/_class_submit.php");

//require_once($include.'sisdoc_data.php');
//require_once($include.'sisdoc_windows.php');
require_once($include.'_class_form.php');
$form = new form;
//$form->class = 'class="form_submit" ';
$clx = new submit;

/* Verifica se já existe o e-mail */
if ((strlen($dd[4]) > 0) and ($dd[2]=='01'))
	{
		$dd[1] = $clx->email_exists($dd[4]);
	}
$cp = $clx->cp_user_new();

$link = http.'pb/index.php/'.$path;
$sxe = $form->editar($cp,$tabela,$link);

if ($form->saved > 0)
	{
			$sql = "update submit_autor set sa_codigo = trim(to_char(id_sa,'0000000'))";
			$rlt = db_query($sql);
					
		echo '<center>';
		echo '<h1>'.msg('registration_completed').'</h1>';
		echo '<BR><BR>';
		echo '<form method="post" action="'.$link.'?dd99=submit">';
		echo '<input type="submit" value="'.msg('return_login').'">';
		echo '</form>';
	} else {
		echo $sxe;
	}
?>