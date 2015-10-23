<?php
require ("db.php");
require ("functions.php");
require($include.'sisdoc_email.php');
/* */
if (strlen(trim($dd[1])) == 0) { $dd[1] = $_SESSION['scf_nome']; }
if (strlen(trim($dd[2])) == 0) { $dd[2] = $_SESSION['scf_email']; }
if (strlen(trim($dd[3])) == 0) { $dd[3] = $_SESSION['scf_curso']; }

if (strlen(trim($dd[4])) == 0) { $dd[4] = $_SESSION['scf_pais']; }
if (strlen(trim($dd[5])) == 0) { $dd[5] = $_SESSION['scf_UES']; }

/* Validador */
if (strlen($acao) > 0)
	{
		$ok = 1;
		if (strlen($dd[1]) < 5) { $ok = -1; $erro[1] = 'Nome inválido'; } else {$erro[1] = ''; }
		if (strlen($dd[2]) < 5) { $ok = -2; $erro[2] = 'email inválido'; } else {$erro[2] = ''; }
		if (strlen($dd[3]) < 5) { $ok = -3; $erro[3] = 'Curso inválido'; } else {$erro[3] = ''; }
		if (strlen($dd[4]) < 5) { $ok = -4; $erro[5] = 'Universidade inválida'; } else {$erro[5] = ''; }
		if (strlen($dd[5]) < 3) { $ok = -5; $erro[4] = 'País inválido'; } else {$erro[4] = ''; }
		
		if (strlen($dd[20]) < 1) { $ok = -10; $erro[20] = '(Obrigatório)'; } else {$erro[20] = ''; }
		if (strlen($dd[25]) < 1) { $ok = -10; $erro[25] = '(Obrigatório)'; } else {$erro[25] = ''; }
		if (strlen($dd[27]) < 1) { $ok = -10; $erro[27] = '(Obrigatório)'; } else {$erro[27] = ''; }
		if (strlen($dd[40]) < 1) { $ok = -10; $erro[40] = '(Obrigatório)'; } else {$erro[40] = ''; }
		if (strlen($dd[45]) < 1) { $ok = -10; $erro[45] = '(Obrigatório)'; } else {$erro[45] = ''; }
		
		if ($ok==1)
			{
				$cpf = $_SESSION['scf_cpf'];
				$cracha = $_SESSION['scf_cracha'];
				$nome = $dd[1];
				$email = $dd[2];
				$curso = $dd[3];
				$pais = $dd[4];
				$univ = $dd[5];
				$r1 = $dd[20];
				$r2 = $dd[25];
				$r3 = $dd[27];
				$r4 = $dd[40];
				$r5 = $dd[45];
				
				$s1 = substr($dd[21],0,40);
				$s2 = substr($dd[21],0,40);
				$s3 = substr($dd[26],0,40);
				$s4 = substr($dd[28],0,40);
				$s5 = substr($dd[41],0,40);
				$s6 = substr($dd[42],0,40);
				$s7 = substr($dd[46],0,40);
				$s8 = substr($dd[47],0,40);
				
				$s9 = substr($dd[10].'/'.$dd[11],0,40);
				$s10 = substr($dd[12].'/'.$dd[13],0,40);
				$s11 = substr($dd[14].'/'.$dd[15],0,40);
				
				$data = date("Ymd");
				$hora = date("H:i");
				
				$sql = "select * from scf_evento where s_cracha = '".$cracha."' ";
				$rlt = db_query($sql);
				
				if (!($line = db_read($rlt)))
					{
					$sql = "INSERT INTO scf_evento(
            			s_cpf, s_nome, s_email, s_curso, s_cracha, s_universidade, 
            			s_pais, s_p01, s_p02, s_p03, s_p04, s_p05, s_p06, s_p07, s_p08, 
            			s_p09, s_p10, s_p11, s_p12, s_p13, s_p14, s_s01, s_s02, s_s03, 
            			s_s04, s_s05, s_s06, s_s07, s_s08, s_s09, s_s10, s_s11, s_data, s_hora)
    				VALUES ('$cpf','$nome','$email','$curso','$cracha','$univ', 
            			'$pais','$r1','$r2','$r3','$r4','$r5','$r6','$r7','$r8',
            			'$r9','$r10','$r11','$r12','$r13','$r14','$s1','$s2','$s3',
            			'$s4','$s5','$s6','$s7','$s8','$s9','$s10','$s11','$data','$hora'
            			);";
					$rlt = db_query($sql);
					} else {
						$sql = "
						UPDATE scf_evento
   							SET s_nome='$nome', s_email='$email', s_curso='$curso', 
       						s_universidade='$univ', s_pais='$pais', s_p01='$r1', s_p02='$r2', s_p03='$r3', s_p04='$r4', 
       						s_p05='$r5', s_s01='$s1', s_s02='$s2', s_s03='$s3', s_s04='$s4', 
       						s_s05='$s5', s_s06='$s6', s_s07='$s7', s_s08='$s8', s_s09='$s9', s_s10='$s10',
       						s_s11='$s11', 
       						s_data='$data', 
       						s_hora='$hora'
 						WHERE s_cracha = '".$cracha."' ";
						$rlt = db_query($sql);	
					}
					$file = fopen('email_confirmacao.php','r');
					$texto = fread($file,1024*10);
					fclose($file);
					require("_email.php");
					/* Dados */
					$dados = '';
					$ddt = array();
					$ddt[1] = 'Nome:';
					$ddt[2] = 'email:';
					$ddt[3] = 'Curso:';
					$ddt[4] = 'Pais:';
					$ddt[5] = 'Universidade:';
					$ddt[20] = 'Estagio:';
					$ddt[21] = 'Onde:';
					$ddt[25] = 'Pesquisa:';
					$ddt[26] = 'Onde:';
					$ddt[27] = 'Trabalho:';
					$ddt[28] = 'Onde:';
					$ddt[40] = 'Mestrado:';
					$ddt[41] = 'Onde:';
					$ddt[42] = 'Seleção Onde:';
					$ddt[45] = 'Doutorado:';
					$ddt[46] = 'Onde:';
					$ddt[47] = 'Seleção Onde:';
										
					for ($r=0;$r < 100;$r++)
						{
						if (strlen($dd[$r]) > 0)
							{
								$dados .= '<BR><TT>'.$ddt[$r].'('.$r.')='.$dd[$r].'</TT>';
							}	
						}
					enviaremail($email,'','SwBExperience - Inscrição - '.$nome,$texto);
					enviaremail('csf@pucpr.br','','SwBExperience - Inscrição - '.$nome,$texto.'<HR>'.$dados);
					enviaremail('renefgj@gmail.com','','SwBExperience - Inscrição',$texto.'<HR>'.$dados);
					redirecina('inscricao-03.php');
			}
	}

?>
<div class="colunas">
	<div class="coluna-1">
		<label for="cpf" class="label-esp"><b>Nome</b> <font color="red"><?php echo $erro[1];?></font></label>
		<br />
		<input class="input-inscricao preencher" id="dd1" name="dd1" value="<?php echo $dd[1];?>">
		</input>
		<br />
		<br />
		<label for="cpf" class="label-esp" ><b>Email</b> <font color="red"><?php echo $erro[2];?></font></label>
		<br />
		<input class="input-inscricao preencher" id="dd2" name="dd2" value="<?php echo $dd[2];?>">
		</input>
		<br />
		<br />
		<label for="cpf"><b>Curso da PUCPR</b> <font color="red"><?php echo $erro[3];?></font></label>
		<br />
		<input class="input-inscricao preencher" id="dd3" name="dd3" value="<?php echo $dd[3];?>">
		</input>
		<br />
		<br />
		<label for="cpf"><b>Universidade de destino</b> <font color="red"><?php echo $erro[5];?></font></label>
		<br />
		<input class="input-inscricao preencher" id="dd5" name="dd5" value="<?php echo $dd[5];?>">
		</input>
		<br />
		<br />
		<label for="cpf"><b>País de Destino</b> <font color="red"><?php echo $erro[4];?></font></label>
		<br />
		<input class="input-inscricao preencher" id="dd4" name="dd4"  value="<?php echo $dd[4];?>">
		</input>
		<br />
		<br />
		<label for="cpf"><b>Início e Término da vigência da bolsa</b></label>
		<br />
		Início
		<select class="selecionar" name="dd10" id="dd10">
			<?php
			$mes = array('Janiero','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
			for ($r=0;$r < count($mes);$r++)
				{
					$check = '';
					if ($dd[10]==$mes[$r])
						{
							$check = ' selected ';
						}
					echo '<option value="'.$mes[$r].'" '.$check.'>'.$mes[$r].'</option>';
				}
			?>
		</select>
		<select name="dd11" id="dd11">
			<?php
			for ($r=2009;$r <= date("Y");$r++)
				{
					$check = '';
					if ($dd[11]==$r)
						{
							$check = ' selected ';
						}
					echo '<option value="'.$r.'" '.$check.'>'.$r.'</option>';
				}
			?>
		</select>
		<br />
		Término
		<select name="dd12" id="dd12">
			<?php
			$mes = array('Janiero','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
			for ($r=0;$r < count($mes);$r++)
				{
					$check = '';
					if ($dd[12]==$mes[$r])
						{
							$check = ' selected ';
						}
					echo '<option value="'.$mes[$r].'" '.$check.'>'.$mes[$r].'</option>';
				}
			?>
		</select>
		<select name="dd13" id="dd13">
			<?php
			for ($r=2009;$r <= date("Y");$r++)
				{
					$check = '';
					if ($dd[13]==$r)
						{
							$check = ' selected ';
						}
					echo '<option value="'.$r.'" '.$check.'>'.$r.'</option>';
				}
			?>
		</select>
		<br />
		<br />
		<label for="cpf"><b>Mês e ano de retorno à PUCPR</b></label>
		<br />
		<select name="dd14" id="dd14">
			<?php
			$mes = array('Janiero','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
			for ($r=0;$r < count($mes);$r++)
				{
					$check = '';
					if ($dd[14]==$mes[$r])
						{
							$check = ' selected ';
						}
					echo '<option value="'.$mes[$r].'" '.$check.'>'.$mes[$r].'</option>';
				}
			?>			
		</select>
		<select name="dd15" id="dd15">
			<?php
			for ($r=2009;$r <= date("Y");$r++)
				{
					$check = '';
					if ($dd[15]==$r)
						{
							$check = ' selected ';
						}
					echo '<option value="'.$r.'" '.$check.'>'.$r.'</option>';
				}
			?>
		</select>
		<br />
	</div>
	<!--- Estágio -->
	<div class="coluna-2">
		<?php
		$check = array('','','');
		$idx=20; if (isset($dd[$idx])) { $check[$dd[$idx]] = ' checked '; }
		?>
		<label for="cpf"><b>Você fez estágio durante o intercâmbio?</b> <font color="red"><?php echo $erro[20];?></font></label>
		<br />
		<input type="radio"  value="1"  name="dd20" id="dd20" <?php echo $check[1];?> >
		Sim. Onde?
		<input class="input-inscricao" name="dd21" id="dd21" value="<?php echo $dd[21];?>">
		</input>
		<br />
		<input type="radio"  value="0"  name="dd20" id="dd20" <?php echo $check[0];?> >
		Não
		<br />
		<br />
		
		<!--- Pesquisa -->
		<?php
		$check = array('','','');
		$idx=25; if (isset($dd[$idx])) { $check[$dd[$idx]] = ' checked '; }
		?>		
		<label for="cpf"><b>Você fez pesquisa durante o intercâmbio?</b> <font color="red"><?php echo $erro[25];?></font></label>
		<br />
		<input type="radio"  value="1"  name="dd25" id="dd25" <?php echo $check[1];?>>
		Sim. Onde?
		<input class="input-inscricao"  name="dd26" id="dd26" value="<?php echo $dd[26];?>">
		</input>
		<br />
		<input type="radio"  value="0"  name="dd25" id="dd25" <?php echo $check[0];?>>
		Não
		<br />
		<br />
		<!----- Trabalho ----->
		<?php
		$check = array('','','');
		$idx=27; if (isset($dd[$idx])) { $check[$dd[$idx]] = ' checked '; }
		?>		
		<label for="cpf"><b>Você está trabalhando?</b> <font color="red"><?php echo $erro[27];?></font></label>
		<br />
		<input type="radio"  value="1"  name="dd27" id="dd27" <?php echo $check[1];?>>
		Sim. Onde?
		<input class="input-inscricao" name="dd28" id="dd28" value="<?php echo $dd[28];?>">
		</input>
		<br />
		<input type="radio"  value="0"  name="dd27" id="dd27" <?php echo $check[0];?>>
		Não
		<br />
		<br />
		
		<!--- Mestrado -->
		<?php
		$check = array('','','');
		$idx=40; if (isset($dd[$idx])) { $check[$dd[$idx]] = ' checked '; }
		?>		
		<label for="cpf"><b>Vocês está em algum programa de mestrado?</b> <font color="red"><?php echo $erro[40];?></font></label>
		<br />
		<input type="radio"  value="1" name="dd40" id="dd40" <?php echo $check[1];?>>
		Sim. Onde?
		<input class="input-inscricao"  name="dd41" id="dd41" value="<?php echo $dd[41];?>">
		</input>
		<br />
		<input type="radio"  value="2"  name="dd40" id="dd40" <?php echo $check[2];?>>
		Em processo de seleção. Onde?
		<input class="input-inscricao"  name="dd42" id="dd42" value="<?php echo $dd[42];?>">
		</input>
		<br />
		<input type="radio"  value="0"  name="dd40" id="dd40" <?php echo $check[0];?>>
		Não
		<br />
		<br />
		
		<!--- Doutorado -->
		<?php
		$check = array('','','');
		$idx=45; if (isset($dd[$idx])) { $check[$dd[$idx]] = ' checked '; }
		?>		
		<label for="cpf"><b>Vocês está em algum programa de doutorado?</b> <font color="red"><?php echo $erro[45];?></font></label>
		<br />
		<input type="radio"  value="1"  name="dd45" id="dd45" <?php echo $check[1];?>>
		Sim. Onde?
		<input class="input-inscricao" name="dd46" id="dd46" value="<?php echo $dd[46];?>">
		</input>
		<br />
		<input type="radio"  value="2"  name="dd45" id="dd45" <?php echo $check[2];?>>
		Em processo de seleção. Onde?
		<input class="input-inscricao"  name="dd47" id="dd47" value="<?php echo $dd[47];?>">
		</input>
		<br />
		<input type="radio"  value="0"  name="dd45" id="dd45" <?php echo $check[0];?>>
		Não
		<br />
		<br />
		<button class="botao-enviar" id="submit02">
			Finalizar minha inscrição
		</button>
	</div>
</div>

<script>
	$("#submit02").click(function() {
		$("#id_inscricao").fadeIn();
		var $nome = $("#dd1").val();
		var $email = $("#dd2").val();
		var $curso = $("#dd3").val();
		
		var $univ = $("#dd4").val();
		var $pais = $("#dd5").val();
		
		var $di1 = $("#dd10").val();
		var $di2 = $("#dd11").val();
		var $df1 = $("#dd12").val();
		var $df2 = $("#dd13").val();
		var $dr1 = $("#dd14").val();
		var $dr2 = $("#dd15").val();
		
		var $esta = $("#dd20:checked").val();
		var $esta_onde = $("#dd21").val();
		
		var $inte = $("#dd25:checked").val();
		var $inte_onde = $("#dd26").val();

		var $work = $("#dd27:checked").val();
		var $work_onde = $("#dd28").val();

		var $mest = $("#dd40:checked").val();
		var $mest_onde = $("#dd41").val();
		var $mest_proc = $("#dd42").val();
		
		var $dout = $("#dd45:checked").val();
		var $dout_onde = $("#dd46").val();
		var $dout_proc = $("#dd47").val();

		$.ajax({
			url : "inscricao-02.php",
			data : {
				dd1 : $nome,
				dd2 : $email,
				dd3 : $curso,
				dd4 : $univ,
				dd5 : $pais,
				
				dd10 : $di1,
				dd11 : $di2,
				dd12 : $df1,
				dd13 : $df2,
				dd14 : $dr1,
				dd15 : $dr2,
				
				dd20 : $esta,
				dd21 : $esta_onde,				
				
				dd25 : $inte,
				dd26 : $inte_onde,
				
				dd27 : $work,
				dd28 : $work_onde,
				
				dd40 : $mest,
				dd41 : $mest_onde,
				dd42 : $mest_proc,
				
				dd45 : $dout,
				dd46 : $dout_onde,
				dd47 : $dout_proc,				
				acao : "enviar"
			},
			cache : false
		}).done(function(data) {
			$("#id_inscricao").html(data);
		});
	});

</script>
