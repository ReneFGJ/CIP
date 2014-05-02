<? 
$bb1 = "Acessar >>";
$bb2 = "Ainda não sou cadastrado";
$txt_titulo = decode("Submissão de Documento Científico");
if ($idioma == "2")
	{
	$bb1 = "to access";
	$bb2 = "I am not still registered";
	$txt_titulo = "Submission of Scientific Document";	
	}
global $estilo;
$field_email_1 = "sa_email";
$field_email_2 = "sa_email_alt";



$cap = array();
for ($k=0;$k<100;$k++)
	{ array_push($cap,''); }

$cap[0] = 'Identificação do pesquisador';
$cap[1] = 'e-mail';

$cap[2] = 'Informe <B>obrigatoriamente</B> o seu e-mail';
$cap[3] = 'já sou cadastrado';
$cap[4] = 'quero me cadastrar';
$cap[5] = '   avançar >>>    ';
$cap[6] = '';
$cap[7] = 'Esqueceu sua senha? Clique aqui';
$cap[8] = "senha incorreta";
//$cap[9] = "e-mail já cadastrado no sistema";
//$cap[10]= "e-mail é necessário";
//$cap[11]= "e-mail não cadastrado";

$cap[9] = "Este e-mail já cadastrado no sistema";
$cap[10]= "O e-mail é necessário";
$cap[11]= "e-mail não cadastrado";
$cap[12]= "necessário informar a senha";
$cap[13]= "e-mail inválido";
$cap[14] = "Informe sua senha:";
/////
if ($idioma == "2")
	{
	$cap[0] = 'Researcher´s identification';
	$cap[1] = 'e-mail';
	
	$cap[2] = 'Inform your e-mail (<B>obligatorily</B>)';
	$cap[3] = 'I am already registered';
	$cap[4] = 'I want myself to register';
	$cap[5] = '   next >>>    ';
	$cap[6] = '';
	$cap[7] = 'did you forget the password click here?';
	$cap[8] = "incorrect password";
	//$cap[9] = "e-mail já cadastrado no sistema";
	//$cap[10]= "e-mail é necessário";
	//$cap[11]= "e-mail não cadastrado";
	
	$cap[9] = "This e-mail already registered in the system";
	$cap[10]= "The e-mail is requested";
	$cap[11]= "e-mail not registered";
	$cap[12]= "necessary to inform the password";
	$cap[13]= "Invalid e-mail";
	$cap[14] = "Enter your password:";
	}
	
$sql = "select * from ic_noticia where nw_ref = 'SUB_INDEX' and nw_idioma = '".$idioma_id."' and nw_journal = ".$jid;
$rrr = db_query($sql);
if ($eline = db_read($rrr))
	{
	$sC = $eline['nw_titulo'];
	$cap[6] = $eline['nw_descricao'];
	}

for ($k=0;$k < 100;$k++)
	{ $cap[$k] = decode($cap[$k]); }

				$recupera_senha = false;
				$chk1 = "checked";
				if (strlen($dd[3]) > 0)
					{
//					print_r($dd);
					//////////////////////////////////////////// CPF
//					$chkcpf = cpf($dd[1]);
					$chkcpf = checaemail($dd[1]);

					if ((strlen($acao) > 0) and ($chkcpf == false))
						{
						$msg = $cap[13]; //"CPF Incorreto"; 
						}					
					///////////////////////////////////////////////
					if ($dd[3] == '2') { $chk1 =''; $chk2 = 'checked'; }
					//////////////////////////// TIPO JA CADASTRADO
					if (($dd[3] == '1') and ($chkcpf))
						{
						if (strlen($dd[1]) > 0)
							{
								if (strlen($dd[2]) > 0)
									{
										///////////// verefica login e senha
										$sql = "select * from ".$tabela." where ".$field_email_1." = '".$dd[1]."' or ".$field_email_2." = '".$dd[1]."'";
										$rlt = db_query($sql);
										if ($line = db_read($rlt))
											{
												if (
													(md5(trim($line['sa_senha'])) == md5(trim($dd[2])))
												    or (md5(trim($line['sa_senha'])) == md5(Uppercase(trim($dd[2])))
													or (md5(trim($line['sa_senha'])) == md5(LowerCase(trim($dd[2]))))
													))
													{
															/// Identificacao ok
															setcookie("pesq",$line['sa_codigo'],time()+60*60*60);
															setcookie("pesq_email",$line['sa_email'],time()+60*60*60);
															setcookie("pesq_nome",$line['sa_nome'],time()+60*60*60);
															redirecina("resume.php");
															$ok=1;
													} else {
														$msg = $cap[8];
														$recupera_senha = true;
													}
											} else {
												$msg = $cap[11]; // "e-mail não cadastrado";
											}
									} else {
										$msg = $cap[12]; //"senha é necessária";
									}
							} else {
								$msg = $cap[10]; //"e-mail é necessário";
							}
						}
					//////////////////////////// TIPO JA CADASTRADO
					if (($dd[3] == '2')  and ($chkcpf))
						{
								///////////// verefica login e senha
								$sql = "select * from ".$tabela." where ".$field_email_1." = '".$dd[1]."' ";
								$sql .= " or ".$field_email_2." = '".$dd[1]."'";
								$rlt = db_query($sql);
								if ($line = db_read($rlt))
									{ 
									$msg = $cap[9]; 
									$recupera_senha = true;
									} else {
										setcookie("pesq_email",$dd[1],time()+60*60*60);
										redirecina('submit_cadastro.php?dd1='.$dd[1]);
									}
							
						}
					}
				if ($recupera_senha == true)
					{
					$msg_senha = '<H2><A CLASS="lt2" HREF="#" onclick="newxy('.chr(39).'submit_recupera_senha.php?dd0='.$dd[1].chr(39).',400,120);">';
					$msg_senha .= '<font color="#990000" >'.$cap[7].'</font></A></H2>';
					}
					
				//////////////////////////////////////////////////////////////////////////////////q
				?>
<table width="<?=tab_max;?>" border="0" align="center" cellpadding="0" cellspacing="0" class="lt1">
  <tr>
    <td width="<?=tab_max;?>">
	<table width="<?=tab_max;?>" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
    <td align="center" height="10" colspan="20"><TABLE width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="lt1">
</TABLE></td>
	<tr>
	  <td align="center" height="10" colspan="20"><BR><font class="lt4">&nbsp;<?=$txt_titulo;?><BR><BR><BR></td>
	  <TR valign="top"><TD>	
		<? //--- identificação do usuário ----- ?>
	    <td > 
      	<table width="400" border="0" cellpadding="0" cellspacing="0" bgcolor="#EFEFEF" >
		<TR>
			<TD width="13" height="16"><img src="<?=$http_site;?>/include/img/bg_formulario_login_top_left.png" width="13" height="16" alt="" border="0"></TD>
			<TD height="16" ><img src="<?=$http_site;?>/include/img/nada.png" width="1" height="1" alt="" border="0"></TD>
			<TD width="13" height="16" ><img src="<?=$http_site;?>/include/img/bg_formulario_login_top_right.png" width="13" height="16" alt="" border="0"></TD>
		</TR>
		<TR>
			<TD  width="1%" height="13"><img src="/include/img/nada.png" width="13" height="1" alt=""></TD>
			<TD colspan="1"><TABLE width="100%" align="center">		
	<form method="post" action="/reol/pibic/submit.php">
    <TR>
    	<TD colspan="2" align="center"><font color=Red><B><?=$msg;?>&nbsp;</B></font>        </TD>
    </TR>
    <TR>
      <TD colspan="2" align="center"><h2 align="center"><?=$cap[0];?></h2></TD>
    </TR>
    <TR>
      <TD colspan="2" align="left"><p class="lt1"><?=$cap[2];?>
      <br/>
       <input type="text" name="dd1" value="<?=$dd[1];?>" size="30" maxlength="100" class="lt1">
      </p></TD>
    </TR>
	<TR>
		<TD width="59%" height="40" align="left" valign="top"><BR>
				 <?=$msg_senha;?>
				 <p class="lt1">
				 <?=$cap[14];?> <BR><input type="password" name="dd2" value="" size="20" maxlength="30" class="lt1"></p>				         </TD>
	     <TD width="41%" align="left" valign="bottom"><p class="lt1"><input type="radio" name="dd3" value="1" <?=$chk1;?>><?=$cap[3];?><BR>
				 <input type="radio" name="dd3" value="2" <?=$chk2;?>><?=$cap[4];?></p><BR>         </TD>
	</TR>
	<TR>
    	<TD colspan="2" align="right">
				 <input type="submit" name="acao" value="<?=$cap[5];?>" class="botao">		</TD>
    </TR>
  </form>
</TABLE>
</TD>
			<TD ><img src="<?=$http_site;?>/include/img/nada.png" width="13" height="1" alt=""></TD>
        </TR>
		<TR>
			<TD width="13"><img src="<?=$http_site;?>/include/img/bg_formulario_login_botton_left.png" width="13" height="16" alt="" border="0"></TD>
			<TD  align="center"><img src="<?=$http_site;?>/include/img/nada.png" width="1" height="1" alt="" border="0" /></TD>
			<TD width="13"  ><img src="<?=$http_site;?>/include/img/bg_formulario_login_botton_right.png" width="13" height="16" alt="" border="0"></TD>
        </TR>
</table>	  </td>
	<TD width="10">&nbsp;</TD>
	<TD width=300>
	  <p class="lt1"><?
		echo mst($cap[6]);	  
	  ?></p></TD>
  	</tr>
	</table>
    <tr>
    <td align="right" height="16" colspan="20"><font class="lt0">&nbsp;<?=$cap[99];?></td>
  </tr>
</table>

<?
$acao = $vars['acao'];
if ($grava > 0)
	{
	echo '=======>'.$acao;
	}
?>
<? require ("foot.php"); ?>
<!--  Ver erro da página 
<script>
	dd1.focus();
</script> -->