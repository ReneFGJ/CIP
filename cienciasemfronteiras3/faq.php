<?
/**
* Submiss�o de projeto parametrizado
* @author Rene F. Gabriel Junior <rene@sisdoc.com.br>
* @version 1.0m
* @copyright Copyright � 2012, Rene F. Gabriel Junior.
* @access public
* @package CEP
* @subpackage submit
*/
$login = 1;
require("cab.php");

require('../_class/_class_faq.php');
$faq = new faq;
$faq->faq_seccao = 'CSF';

/* Sess�o e p�gina da Submissao */
echo '<div id="content">';
echo '<H1>'.msg('faq_title').'</h1>';
echo '<Table width="'.$tab_max.'" class="lt1" align="center" >';
echo '<TR><TD>';
echo $faq->faq();
echo '</table>';
echo '</div>';

require("foot.php");
?>
<script>
	$("#content").corner();
</script>


