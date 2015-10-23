<?php
if (!(function_exists("cpf")))
	{
	function cpf($cpf)
	{
		$cpf = sonumero($cpf);
		if (strlen($cpf) <> 11) { return(false); } 
		
		$soma1 = ($cpf[0] * 10) + ($cpf[1] * 9) + ($cpf[2] * 8) + ($cpf[3] * 7) + 
			 	($cpf[4] * 6) + ($cpf[5] * 5) + ($cpf[6] * 4) + ($cpf[7] * 3) + 
			 	($cpf[8] * 2); 
		$resto = $soma1 % 11; 
		$digito1 = $resto < 2 ? 0 : 11 - $resto; 
		
		$soma2 = ($cpf[0] * 11) + ($cpf[1] * 10) + ($cpf[2] * 9) + 
			 	($cpf[3] * 8) + ($cpf[4] * 7) + ($cpf[5] * 6) + 
			 	($cpf[6] * 5) + ($cpf[7] * 4) + ($cpf[8] * 3) + 
			 	($cpf[9] * 2); 
			 	
		$resto = $soma2 % 11; 
		$digito2 = $resto < 2 ? 0 : 11 - $resto; 
		if (($cpf[9] == $digito1) and ($cpf[10] == $digito2))
			{ return(true); } else
			{ return(false); }
		}
	}
?>