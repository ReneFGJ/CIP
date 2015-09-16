<?php
require("cab.php");
$pass = UpperCase($_POST['pass']);
if ($pass=="SEMICXXI")
	{
		$_SESSION['staff'] = 1;
		redirecina('index.php');
	} else {
		$_SESSION['staff'] = '';
	}
?>
<table border=0 width="100%">
	<TR valign="top">	
		<TD align="left">	
			<div class="botao-0"><A HREF="index.php">Voltar</A></div>
		<TD align="center">
			<form action="staff.php" method="post">
				<table>
					<TR>
						<H1>Staff - login</H1>
						<TD><input type="password" name="pass" size="10" maxlength="8" class="form_staff"></TD>
					</TR>
					<TR>
						<TD><input type="submit" value="login" class="botao-0"></TD>
					</TR>
				</table>
			</form>
				
	</TR>
</table>