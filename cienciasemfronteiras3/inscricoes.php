<?
/**
* Submissï¿½o de projeto parametrizado
* @author Rene F. Gabriel Junior <rene@sisdoc.com.br>
* @version 1.0m
* @copyright Copyright ï¿½ 2012, Rene F. Gabriel Junior.
* @access public
* @package CEP
* @subpackage submit
*/
$login = 1;
require("cab.php");

require('../_class/_class_discentes.php');
$dis = new discentes;

/* Sessï¿½o e pï¿½gina da Submissao */
echo '<div id="content">';
echo '<H1>'.msg('inscricoes_title').'</h1>';
echo '<Table width="'.$tab_max.'" class="lt1" align="center" >';
echo '<TR><TD>';
echo msg("inscricoes_instrucoes");
/*
 * Inscrições
 */
 
if (strlen($dd[1]) > 1)
	{
		$cod = trim(sonumero($dd[1]));
		if (strlen($cod) > 8)
			{
				$cod = substr($cod,3,8);
			}
		if (strlen($cod) != 8)
			{
				$erro = 'Código do discente inválido '.$cod;
			} else {
				if ($dis->consulta($cod))
					{
						$dis->le('',$cod);
						$dis->valida_set();
						redirecina('inscricoes_2.php');						
					} else {
						$erro = 'Código não localizado';
					}
			}
	}

echo '<TR><TD>';
echo '<div id="discente" style="width: 400px; background-color: #67ACCD; ">';
echo '<center><h3>'.msg('login_info').'</h3>';
echo '<table width="90%" class="lt1" align="center">';
echo '<TR><TD>'.msg("login_instru");
echo '<TR><TD>';
echo '<form method="post">';
echo '<input type="text" name="dd1" value="'.$dd[1].'" size="13" maxlength="12">';
echo '&nbsp;&nbsp;';
echo '<input type="submit" name="acao" value="'.msg("submit_dis").'" >';
echo '<BR><Font class="lt0">EX: 1018895080223 ou 88958022';
echo '</form>';

echo '<TR><TD><font color="red">'.$erro;
echo '<TR><TD><BR>&nbsp;';
echo '</table>';
echo '</div>';

echo '</table>';
echo '</div>';

require("foot.php");
?>
<script>
	$("#content").corner();
	$("#discente").corner();
</script>


