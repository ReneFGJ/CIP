<?php
require("cab_root.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_breadcrumb.php');
require("cab_institucional.php");

require('_class/_class_header.php');
$hd = new header;
echo $hd->mostra('nc');

$user_id = trim($ss->user_cracha);

if (strlen($user_id)==0) 
	{
		$user_id = $ss->user_id;
		$cra = 1;
		if (strlen($user_id) > 0)
			{
				if ($ss->le($user_id)==1)
					{
						$ss->LiberarUsuario();
						//$cra = 0;		
					}
			}
		if (($cra == 1) and (strlen($user_id) > 0))
			{
			echo $nw->solicita_cracha();
		 	$user_cracha = '00000000';
		 	exit;
			} 
	}
?>