<BR>
<?php
if (isset($layout))
	{
		
	} else {
		$layout = 1;
	}
if ($layout == 1) {
?>
<div id="content">
	<?php echo $content;?>
	<?
	}

	if ($layout == 2) {
	?>
	<div id="content">
		<table width="100%">
			<tr valign="top">
				<td width="75%"><?php echo $content;?></td>
				<td width="25%"><?php echo $content_right;?></td>
			</tr>
		</table>
		<?
		}
?>
