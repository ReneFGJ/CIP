<?php
require("cab.php");

if ((strlen($dd[1]) >0) and (strlen($dd[2]) > 0))
	{
		if ($hd->validar($dd[1],$dd[2])==1)
			{
				redirecina('bolsistas-submissao.php');
				exit;
			}
	}
?>
<div id="total" class="total">
	<?php require("header.php");?>
	<div id="corpo">
    <h1>Scholarship Holder<span class="lt6light"> Access</span></h1>
				  	<div id="acesso-bolsista">
					  	<div id="acesso-login">
					  		<p class="texto-caixa-acesso-bolsistas">Prezado estudante,<br />

During your exchange you must post within 30 days after traveling, the following documents: <strong>insure receipt and enrollment receipt</strong>, as well include the following information: <strong>address abroad, International Relations contact of your University, contact in Brasil</strong>. 

Is it your first access? Create a password:</p>
								<form method="post" action="<?=page();?>">
					  			<span class="lt4">CPF</span><br /><input type="text" name="dd1" class="input-light" id="cpf" placeholder="000.000.000-000" value="<? echo $dd[1]; ?>'"></input><br />
					  			<span class="lt4">Password</span><br /><input type="password" name="dd2" class="input-light" placeholder="" value=""></input><br />
					  			<? echo $hd->error; ?>
					  			<button class="botao-grande">Login</button>
					  			</form>
					  	</div>
				  	</div>
				 	
			</div>
			<script>
				$("#cpf").mask("999.999.999-99");				
			</script>
			<?php require("footer.php");?>
			
		</div>
		
	</body>
</html>