</div>
<BR>
<BR>
<BR>
<BR>
</div>
<BR>
<div id="foot">
	<div id="foot_logo"></div>
	<table width="1024" align="center">
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr valign="top">
			<!--Div Semic -->
			<td width="25%"><b>SEMIC</b>
			<BR>
				<a HREF="<?php echo base_url('index.php/semic/whats_semic');?>" class="link_foot"><?php echo msg('about_system');?></a>
				<BR>
				<a HREF="<?php echo base_url('index.php/semic/contact');?>" class="link_foot"><?php echo msg('contact_system');?></a>
			</td>
			
			<!--Div Apoio -->
			<td width="25%" ><b><?php echo msg('apoio');?></b>
				<br>
				<br>
				&nbsp; 
					<a href="http://cienciaefe.pucpr.br/" target="_new"> 
						<img src="<?php echo base_url('img/semic2015/logo_cf.png');?>" height="40" border=0> </a>
						&nbsp;
						
					<a href="http://www.solmarista.org.br/" target="_new"> 
						<img src="<?php echo base_url('img/semic2015/marista_rede.png');?>" height="50" border=0> 
					</a>
					&nbsp;
					
					<a href="http://www.parafusoeducom.org" target="_new"> 
						<img src="<?php echo base_url('img/semic2015/logoparafuso.png');?>" height="40" border=0> 
					</a>
					
					
					<!--
					&nbsp;&nbsp; 
					<a href="http://www.centrodedefesa.org.br/" target="_new"> 
						<img src="<?php echo base_url('img/semic2015/marista_defesa.png');?>" height="55" border=0> 
					</a>
					-->
				</td>
			<!--Div Agências de fomento -->
			<td width="25%"><b><?php echo msg('colaboracao');?></b>
			<br>
			<br>
			&nbsp; <a href="http://www.cnpq.br/" target="_new"> 
				<img src="<?php echo base_url('img/semic2015/logo_cnpq.png');?>" height="25" border=0> </a> 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				<a href="http://www.fappr.pr.gov.br/" target="_new"> 
					<img src="<?php echo base_url('img/semic2015/logo_fa.png');?>" height="35" border=0> </a></td>
			<!--Div IES -->
			<td width="25%"><b><?php echo msg('ies');?></b>
			<br>
			<br>
				&nbsp; 
				<a href="http://www.pucpr.br//" target="_new"> 
					<img src="<?php echo base_url('img/semic2015/logo_pucpr_2.png');?>" height="80" border=0> </a>
					 &nbsp;&nbsp; <a href="http://www.senaipr.org.br/" target="_new"> 
					<img src="<?php echo base_url('img/semic2015/logo_senai_small.jpg');?>" height="20" border="0" style="position:absolute;"> 
				</a>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script type="text/javascript">
	$(function() {
		$(window).scroll(function() {
			if($(this).scrollTop() != 0) {
				$('#toTop').fadeIn();
			} else {
				$('#toTop').fadeOut();
			}
		});
		$('#toTop').click(function() {
			$('body,html').animate({
				scrollTop : 0
			}, 800);
		});
	});

</script>