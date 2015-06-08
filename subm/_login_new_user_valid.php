<?php
require("db.php");
require($include.'sisdoc_email.php');
require("../_class/_class_message.php");
require("_class/_class_submit.php");
require("../_class/_class_instituicao.php");
$clx = new submit;
$inst = new instituicao;

/* 
 * Validador 
 */
$okr = 1;
/* Validar o e-mail */
if (strlen($dd[3]) > 0)
	{
		$ok = checaemail($dd[3]);
		if ($ok == 1)
		{
			$ok = round($clx->exist_email($dd[3]));
			$link = '';
			if ($ok == 1)
				{
						$link = "javascript:newxy('_login_forgot_password.php',600,300);";
					$link = '<A HREF='.$link.' >';
	
					//$dd3t = '<font color=red >'.msg('email_already_exist').
					//', '.$link.'</font>'.chr(13);
					$dd3t = '<font color=red>';
					$dd3t .= msg('email_already_exist');
					$dd3t .= ', '.$link.msg('forgot_password').'</A>';
					$dd3t .= '</font>';
					$okr = 0;
				} else {
					$dd3t = '<font color=green>'.msg('valid').'</font>';
					
				}
		} else {
			$dd3t = '<font color=red>'.msg('email_invalid').'</font>';
			$okr = 0;
		}	
	} else {
		$dd3t = '<font color=red>'.msg('email_required').'</font>';
		$okr = 0;	
	}

/* Validar o e-mail */
if (strlen($dd[4]) > 0)
	{
		$ok = checaemail($dd[4]);
		if ($ok == 1)
		{
			$ok = round($clx->exist_email($dd[4]));
			$link = '';
			if ($ok == 1)
				{
						$link = "javascript:newxy('_login_forgot_password.php',600,300);";
					$link = '<A HREF='.$link.' >';
	
					//$dd3t = '<font color=red >'.msg('email_already_exist').
					//', '.$link.'</font>'.chr(13);
					$dd4t = '<font color=red>';
					$dd4t .= msg('email_already_exist');
					$dd4t .= ', '.$link.msg('forgot_password').'</A>';
					$dd4t .= '</font>';
					$okr = 0;
				} else {
					$dd4t = '<font color=green>'.msg('valid').'</font>';					
				}
		} else {
			$dd4t = '<font color=red>'.msg('email_invalid').'</font>';
			$okr = 0;
		}	
	}	
if (strlen($dd[4]) > 0)
	{
		if ($dd[3]==$dd[4])
			{
				$dd4t = '<font color=red>'.msg('email_equal').'</font>';
				$okr = 0;
			}
	}
/* Validador do nome */
$err = '<font color=red>'.msg('name_invalid').'</font>';
$dd2t = '';
if (strlen($dd[2]) > 8)
	{
		if (strpos($dd[2],'.')) { $dd2t = $err; $okr = 0; }
	} else {
		$dd2t = $err;
		$okr = 0; 
	}
	
/* Validador da senha */
if (strlen($dd[8]) > 0)
	{
		if (strlen($dd[8]) < 4)
			{
				$dd8t = '<font color=red>'.msg('password_very_short').'</font>';
				$okr = 0;
			} else {
				$dd8t = '<font color=green>'.msg('valid').'</font>';
			}
	} else {
		$dd8t = '<font color=red>'.msg('password_required').'</font>';
		$okr = 0;
	}

/* Titulação */
$dd10t = '';
if (strlen($dd[10])==0)
	{
		$dd10t = '<font color=red>'.msg('formation_required').'</font>';
		$okr = 0;
	}

/* Country */
$dd10t = '';
if (strlen($dd[11])==0)
	{
		$dd11t = '<font color=red>'.msg('country_required').'</font>';
		$okr = 0;
	}	
	
/* Lattes */
$dd5t = '';
if (strlen($dd[5]) > 0)
	{
		$lattes = $dd[5];
		$mod = 'http://buscatextual.cnpq.br/buscatextual/visualizacv';
		if ($mod == substr($lattes,0,strlen($mod)))
			{
				$dd5t = '<font color=green>'.msg('valid').'</font>';
			} else {
				$dd5t = '<font color=red>'.msg('country_required').'</font><BR>';
				$dd5t .= msg('ex').' '.msg('ex_lattes');
				$okr = 0;
			}
	}
	
/* Instituição */
$dd5t = '';
if (strlen($dd[7]) > 0)
	{
		$instituicao = $dd[7];
		if (strlen($dd[7]) > 0)
			{
				$dd7t = '<font color=green>'.msg('valid').'</font>';
			} else {
				$dd7t = '<font color=red>'.msg('country_institution').'</font><BR>';
				$okr = 0;
			}
	}
	
/*
 * MOstrar os resultados
 */

echo '<script>'.chr(13);
/* Validar nome do autor */

echo '$("#dd2d").html("'.$dd2t.'");'.chr(13);
echo '$("#dd3d").html("'.$dd3t.'");'.chr(13);
echo '$("#dd4d").html("'.$dd4t.'");'.chr(13);
echo '$("#dd5d").html("'.$dd5t.'");'.chr(13);
echo '$("#dd7d").html("'.$dd7t.'");'.chr(13);
echo '$("#dd8d").html("'.$dd8t.'");'.chr(13);
echo '$("#dd10d").html("'.$dd10t.'");'.chr(13);
echo '$("#dd11d").html("'.$dd11t.'");'.chr(13);


echo '</script>'.chr(13);
echo date("d/m/Y H:i:s");
echo $sa.chr(13);

if ($okr == 1)
	{
		
		$institution = $inst->instituicao($instituicao);
		$nome = $dd[2];		
		$email = $dd[3];
		$email2 = $dd[4];
		$pass = $dd[8];
		$country = $dd[11];
		$titu = $dd[10];
		$clx->new_user($nome,$institution,$email,$email2,$pass,$titu,$country,$bio);
		print_r($dd);
		exit;
	}

?>

