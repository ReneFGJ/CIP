<?php
if (strlen($acao) > 0)
	{
		echo '<HR>ACAO<HR>';
		$ok = 1;
		if (strlen($dd[1]) < 5) { $err1 = 'Nome inválido'; $ok = 0; }
		if (strlen($dd[2]) < 5) { $err2 = 'e-mail inválido'; $ok = 0; }
		if (strlen($dd[3]) < 8) { $err3 = 'CPF inválido'; $ok = 0; }
	}
?>
<p>
	<span class="passos-inscricao">1</span> Fill the form below:
</p>
<form action="<?php echo page();?>#formulario" name="form" method="post">
<br />
Name
<br />
<input class="input-inscricao" name="dd1" value="<?php echo $dd[1]; ?>">
</input>
<br />
<font color="red"><?php echo $err1;?></font>
<br />

Email
<br />
<input class="input-inscricao" name="dd2">
</input>
<br />
<font color="red"><?php echo $err2;?></font>
<br />
<br />
CPF* (we need this document because...)
<br />
<input class="input-inscricao" name="dd3">
</input>
<br />
<font color="red"><?php echo $err3;?></font>
<br />
<br />
Exchange Programm Country
<br />
<input class="input-inscricao" name="dd4">
</input>
<br />
<font color="red"><?php echo $err4;?></font>
<br />
<button class="botao-enviar" name="acao" id="aval" value="I confirm my presence in this event">
	I confirm my presence in this event
</button>
<br />
<br />
</form>