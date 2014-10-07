<?php
	$ext = '';
	if (strlen($dd[1]) > 0)
		{
			$ext = '?dd1='.$dd[1].'&dd99=view&dd98=pb';
		}
		
if (substr($layout,0,1) == '5')
{
	redirecina(http.'pb/index.php/'.lowercase($path).$ext);
	exit;
}
if (substr($layout,0,1) == '2')
{
	if (strlen($dd[99])==0) { $dd[99] = 'capa'; }

	redirecina(http.'pb/index.php/'.lowercase($path).$ext);
	exit;
}
?>