<?php
$temp1 = mktime(8,30,0,10,6,2015);
$temp2 = mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));

$tempo = ($temp1 - $temp2 );
//$tempo = 60;
?>
<body>
	<table width="100%" border=0 cellpadding=0 cellspacing="0">
		<tr>
			<td width="20%" bgcolor="#FBF5DB">&nbsp;</td>
			<td width="949">
			<table class="lt1" width="100%"  cellpadding=0 cellspacing="0">
				<tr>
					<td><div id="banner">

					</div></td>

					<td width="100" bgcolor="#EDF3E5">
						<font class="lt6">Faltam</font><br>
						<br>
						
						<script type="application/javascript">
							var myCountdown2 = new Countdown({
								time : <?php echo $tempo;?>,
								width : 320,
								height : 80,
								rangeHi : "days"	// <- no comma on last item!
							});						
						</script>
						<br><font class="lt6">para o XXIII SEMIC</font>						
						</td>
			</td>
		</tr>
	</table>
	<td width="20%" bgcolor="#EDF3E5">&nbsp;</td>
	</tr>
	</table>
	<div class="center">

			<script>
					$("#banner").vegas({slides : [{ src : "<?php echo base_url('img/semic2015/bk_topo_en_date.jpg'); ?>" }, {
						src : "<?php echo base_url('img/semic2015/bk_topo_en_date.jpg'); ?>"
						}, {
						src : "<?php echo base_url('img/semic2015/bk_topo_02_date.jpg'); ?>"
						}, {
						src : "<?php echo base_url('img/semic2015/bk_topo_en_date.jpg'); ?>"
						}, {
						src : "<?php echo base_url('img/semic2015/bk_topo_03_date.jpg'); ?>"
						}]
					});
			</script>