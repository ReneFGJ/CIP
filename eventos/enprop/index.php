<?php
require("cab.php");

echo '<div class="content"><center>';
//echo '<input type="submit" onclick="goto(\'registration.php\');" value="Inscrever-se" class="bottom_submit">';
echo '<div class="clear"></div>';
echo '<input type="submit" onclick="goto(\'certificado.php\');" value="Emissão do Certificado" class="bottom_submit">';
echo '</center></div></div>';

?>

<script>
	function goto(site)
		{
			location.href=site;
		}
</script>
