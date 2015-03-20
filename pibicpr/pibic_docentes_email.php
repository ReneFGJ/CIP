<?php
	require("cab.php");
	
	require("../_class/_class_docentes.php");
			
		$pb = new docentes;
	
		echo $pb->docentes_sem_email();
				
	require("../foot.php");	
?>