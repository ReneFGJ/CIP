<?
switch ($LANG)
	{
	default:
		$bt_submit = 'Acessar >>>';
		$texto  = '';
		$lab_login = 'Submissão de trabalhos';
		break;
	}

$cp = array();
array_push($cp,array('$H8','','',False,True));
array_push($cp,array('$S15','','CPF',True,True));
array_push($cp,array('$B8','',$bt_submit,False,True));
	
$tela_login .= $form->editar($cp,'');

$cpf = round('0'.validaCPF($dd[1]));

if (($form->saved > 0) and ($cpf == 1))
	{
		echo '<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>';
		$us = new user;
		if ($us->existe_cpf($dd[1])==1)
			{
				$_SESSION['user_id'] = $us->line['id_us'];
				redirecina('page_user.php');
			} else {
				$us->cadastra_usuario($dd[1]);
				$us->existe_cpf($dd[1]);
				$_SESSION['user_id'] = $us->line['id_us'];
				redirecina('page_user.php');
				
				//redirecina('page_user.php?dd0='.$this->line['id_us']
			}
		echo 'FIM';		
		require('foot.php');
		exit;
	} else {
		$texto .= '<BR><BR><font color="red">CPF inválido</font>';
	}
	
$tela = '';
$tela .= '<h1>'.$lab_login.'</h1>';
$tela .= '<div style="colunas">';
$tela .= $texto;
$tela .= '</div>';

$tela .= $tela_login;

?>
<style>
	.colunas
	{
  		columns: 2;
  		-webkit-columns: 2;
  		-moz-columns: 2;		
	}
	.cc2 {
		font-family: Tahoma, Arial, Verdana;
		font-size: 20px;
		color: #2D332D;
		text-align: center;
	}
	.bt_submit
		{
			width: 250px;
			height: 50px;
			background-color: #8B1217;
			color: #E0EFE0;
			font-size: 20px;
		}
	.pg03 { background-color: #FFEFEF; }
</style>

<div id="page03" class="page_min pg03">
	
	<table width="98%" cellpadding=0 cellspacing=0 align="center" border=0 style="min-height:800px;">
		<TR valign="top">
			<TD><?php echo $tela; ?></TD>
			<TD align="right"><img src="img/logo.png" height="150"></TD>
		</TR>
	</table>
</div>


<script>
	jQuery(function($){
   		$("#dd1").mask("999.999.999-99");
	});
</script>
