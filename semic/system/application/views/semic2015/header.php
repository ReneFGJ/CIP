<?php
header('Content-type: text/html; charset=ISO-8859-1');
?>
<head>
	<title>SEMIC 2015 - PUCPR</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="shortcut icon" type="image/x-icon" href="https://cip.pucpr.br/favicon.ico" />
	<link rel="stylesheet" href="<?php echo base_url('css/jquery-ui.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('css/fonts_cicpg.css');?>">
	<?php
	/* ESTILOS CSS
	 */
	if (isset($css) > 0) {
		for ($r = 0; $r < count($css); $r++) {
			echo '<link rel="stylesheet" href="' . base_url('css/' . $css[$r]) . '">' . chr(13) . chr(10);
		}
	}
	?>
	<script language="JavaScript" type="text/javascript" src="<?php echo base_url('js/jquery.js');?>"></script>
	<script language="JavaScript" type="text/javascript" src="<?php echo base_url('js/jquery-ui.min.js');?>"></script>
	<?php
	/* BIBLIOTECAS JAVA SCRIPT
	 */
	if (isset($js) > 0) {
		for ($r = 0; $r < count($js); $r++) {
			echo '<script language="JavaScript" type="text/javascript" src="' . base_url('js/' . $js[$r]) . '"></script>' . chr(13) . chr(10);
		}
	}
	?>
</head>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
</head>
<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-12712904-7']);
	_gaq.push(['_trackPageview']); (function() {
		var ga = document.createElement('script');
		ga.type = 'text/javascript';
		ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(ga, s);
	})();

</script>
<body>