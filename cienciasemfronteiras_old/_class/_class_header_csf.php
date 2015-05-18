<?php
class header
	{
		var $http;
		var $user;
		var $user_name;
		var $erro;
		
		function security()
			{
				$user = $_SESSION['user_cracha'];
				$user_name = $_SESSION['user_nome'];
			}
		
		function validar($cpf,$pass)
			{
				$cpf = sonumero($cpf);
				$sql = "select * from pibic_aluno where pa_cpf = '".$cpf."' ";
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
						$_SESSION['user_cracha'] = $line['pa_cracha'];
						$_SESSION['user_nome'] = $line['pa_nome'];
						return(1);
					}
				$this->erro = 'CPF Incorreto';
				return(0);
			}
		
		function cab()
			{
				header('Content-Type: text/html; charset=utf-8');
				$name="Ciência sem Fronteiras PUCPR";
				$content = "ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr";
				$sx = '
				<!DOCTYPE html>
					<html>
    				<head>
    					<title>Scholarship Holder Access - Acsess toScience Without Borders | PUCPR</title>
        				<meta charset="utf-8">
        				<meta name="<?php echo $name;?>" content="<?php echo $content;?>">
						<link rel="stylesheet" href="css/estilo.css">
						<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
						<script language="JavaScript" type="text/javascript" src="http://www2.pucpr.br/reol/js/jquery-1.7.1.js"></script>
						<script language="JavaScript" type="text/javascript" src="http://www2.pucpr.br/reol/js/jquery.corner.js"></script>
					</head>
					<body>
				';
				return($sx);
			}
	}
?>
