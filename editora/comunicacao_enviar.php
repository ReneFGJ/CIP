<?
require("cab.php");
require($include.'sisdoc_email.php');
require("_email.php");

echo $hd->menu();
echo '<div id="conteudo">';
echo $hd->main_content('Enviar e-mail');

		require("_class/_class_users.php");
		$user = new users;
		
		echo 'Saldo para enviar -->'.$user->email_resumo_enviar();
		$total = $user->enviar_email(100);
		echo '<BR>Falta '.$total;
		
		if ($total > 0)
			{
				echo '<meta http-equiv="refresh" content="10">';
			}
		
?>