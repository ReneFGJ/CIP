<?php
require ("db.php");
require ("functions.php");

/* Validação */
if (strlen($dd[1]) > 0) {
	$cpf = sonumero($dd[1]);

	if (cpf($cpf)) {
		$_SESSION['scf_cpf'] = $cpf;

		$sql = "select * from pibic_aluno where pa_cpf = '" . $cpf . "'";
		$rlt = db_query($sql);
		if ($line = db_read($rlt)) {
			$cracha = $line['pa_cracha'];
			$_SESSION['scf_cpf'] = $cpf;
			$_SESSION['scf_nome'] = trim($line['pa_nome']);
			$_SESSION['scf_email'] = trim($line['pa_email']);
			$_SESSION['scf_cracha'] = trim($line['pa_cracha']);
			$_SESSION['scf_curso'] = trim($line['pa_curso']);

			/* */
			$sql = "select * from pibic_bolsa_contempladas where pb_aluno = '" . $cracha . "' and pb_tipo = 'S' and pb_status <> 'C' ";
			$rlt = db_query($sql);
			if ($line = db_read($rlt)) {
				$_SESSION['scf_pais'] = trim($line['pb_colegio_orientador']);
				$_SESSION['scf_UES'] = trim($line['pb_colegio']);
				redirecina('inscricao-02.php');
			} else {
				$erro = 'Não foi localizado sua saída para o Ciência sem Fronteiras, entre em contado com scf@pucpr.br';	
			}
			
		} else {
			$erro = 'CPF não localizado no sistema, consulte scf@pucpr.br';
		}
	} else {
		$erro = 'CPF Inválido';
	}
}

if (strlen($acao) == 0) {
	$dd[1] = $_SESSION['scf_cpf'];
}

/* Formulario */
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