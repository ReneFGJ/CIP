<?php
if (strlen($acao) == 0) {
	$dd[1] = $_SESSION['scf_cpf'];
}
?>
<p>
	Preencha seu CPF para iniciar seu cadastro:
</p>
<br />
<label for="cpf">CPF</label>
<br />
<input name="dd1" id="dd1" class="input-inscricao" value="<?php echo $dd[1];?>">
</input>
<button class="botao-enviar" id="submit01">
	Cadastrar
</button>
<br />
<font color="red"><?php echo $erro;?></font>
<br />
<br />
<script>
	$("#submit01").click(function() {
		$("#id_inscricao").fadeIn();
		var $cpf = $("#dd1").val();
		$.ajax({
			url : "inscricao-01.php",
			data : {
				dd1 : $cpf,
				acao : "enviar"
			},
			cache : false
		}).done(function(data) {
			$("#id_inscricao").html(data);
		});
	});

</script>
<script>
	window.sr = new scrollReveal();
	jQuery("#dd1").mask("999.999.999-99");
</script>