<?php
class secretaria
	{
	
		function cab()
			{
				$sx .= '<header>
							<title>Enprop - PUCPR</title>
							<script type="text/javascript" src="js/jquery-calender_pt_BR.js"></script>
							<script type="text/javascript" src="js/jquery.maskedit.js"></script>
							<script type="text/javascript" src="js/jquery.maskmoney.js"></script>
							<script type="text/javascript" src="js/jquery.tagsinput.js"></script>
							<link rel="stylesheet" href="css/calender_data.css">
							<link rel="stylesheet" href="css/style_keyword_form.css" >
							<link rel="stylesheet" href="css/font.css">
							<link rel="stylesheet" href="css/form_proceeding.css" type="text/css" media="screen">
							<script rel="text/javascript" src="js/jquery-1.7.1.js"></script>	
							<head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">							
						</header>
						
						<body>
						<table width="100%" cellpadding=0 cellspacing=0 >
						<TR>
							<TD align="center"><img src="http://www2.pucpr.br/reol/eventos/enprop/img/logo_enprop.png">
						<TR>
							<TD align="center"><h2>SECRETARIA -  Staff</h2></TD>
						</table>
						';
				return($sx);
			}
			
		function foot()
			{
				$sx = '<center>';
				$sx .= '&copy 2013 - PUCPR';
				$sx = '</center>';
				return($sx);
			}
	}
?>
