<?php
class perfil
	{
		var $us_codigo; /* User ID  */
		
		function find_perfil()
			{
			return($rs);	
			}		
		/* Valid the perfil */
		function valid($type)
			{
				global $nw;
				$per = ' '.$nw->user_perfil;
				if (strpos($per,$type) > 0)
					{ return(True); }
				else
					{ return(False); }
			}
	}
?>
