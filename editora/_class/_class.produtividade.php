<?
class produtividade
	{
	var $codigo;
	var $descricao;
	
	function mosta($tp)
		{
		$rs = '';
		if ($tp == '0') { $rs = ''; }
		if ($tp == '2') { $rs = 'N�vel 1A'; }
		if ($tp == '3') { $rs = 'N�vel 1B'; }
		if ($tp == '4') { $rs = 'N�vel 1C'; }
		if ($tp == '5') { $rs = 'N�vel 1D'; }
		if ($tp == '6') { $rs = 'N�vel 2'; }
		if ($tp == '9') { $rs = '??'; }
		return($rs);
		}
	}
	
/*
<UL>
<LI>0 - N�o</LI>
<LI>2 - Nivel 1A</LI>
<LI>3 - Nivel 1B</LI>
<LI>4 - N�vel 1C</LI>
<LI>5 - N�vel 1D</LI>
<LI>6 - N�vel 2</LI>
</UL> 
?*
?>