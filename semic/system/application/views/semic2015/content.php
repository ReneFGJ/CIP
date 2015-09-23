<BR>
<?php
if (isset($layout)) {

} else {
	$layout = 1;
}
if ($layout == 1) {
	echo '<div id="content">';
	echo $content;
}

if ($layout == 2) {
	echo '
	<div id="content">
		<table width="100%">
			<tr valign="top">
				<td width="75%">' . $content . '</td>
				<td width="25%">' . $content_right . '</td>
			</tr>
		</table>
		';
}
?>
