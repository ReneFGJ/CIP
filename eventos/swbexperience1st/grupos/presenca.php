<?php
$include = '../';
require("../db.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<style>
		td	
		{
			padding: 15px 0px;
		}
		.td2
			{
				font-size: 40px;
			}
		table
			{
				padding: 5px;
			}
		.borderb 
			{
				border-bottom: 1px solid #000000;
			}
		body
			{
				font-family: "Tahoma", "Verdana", "Helvetica", "Arial", sans-serif;
				font-size: 15px;
			}
			a {
				text-decoration: none;
				color: #ba1818;
				font-size: 1em;
				font-family: "Helvetica", "Arial", sans-serif;
			}
			ul li {
				list-style: none;
				line-height: 200%;
				text-align: left;
			}
			header {
				width: 100%;
				position: absolute;
				background-color: #ba1818;
				top: 0;
				left: 0;
			}
			ul {
				margin-top: 220px;
				margin-left: 6%;
			}
			.bto {
				width: 190px;
				height: 60px;
				float: left;
				margin: 10px;
				padding: 10px;
				border: 5px solid #000000;
			}
			.myButton {
				width: 200px;
				height: 40px;
				margin-bottom: 20px;
				margin-right: 40px;
				-moz-box-shadow: 0px 1px 0px 0px #f0f7fa;
				-webkit-box-shadow: 0px 1px 0px 0px #f0f7fa;
				box-shadow: 0px 1px 0px 0px #f0f7fa;
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #E0E0E0), color-stop(1, #B0B0B0));
				background: -moz-linear-gradient(top, #E0E0E0 5%, #B0B0B0 100%);
				background: -webkit-linear-gradient(top, #E0E0E0 5%, #B0B0B0 100%);
				background: -o-linear-gradient(top, #E0E0E0 5%, #B0B0B0 100%);
				background: -ms-linear-gradient(top, #E0E0E0 5%, #B0B0B0 100%);
				background: linear-gradient(to bottom, #E0E0E0 5%, #B0B0B0 100%);
				background-color: #E0E0E0;
				-moz-border-radius: 6px;
				-webkit-border-radius: 6px;
				border-radius: 6px;
				border: 1px solid #404040;
				display: inline-block;
				cursor: pointer;
				color: #333333;
				font-family: Arial;
				font-size: 15px;
				font-weight: bold;
				padding: 29px 74px;
				text-decoration: none;
				text-shadow: 0px -1px 0px #5b6178;
			}
			.myButton:hover {
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #B0B0B0), color-stop(1, #E0E0E0));
				background: -moz-linear-gradient(top, #B0B0B0 5%, #E0E0E0 100%);
				background: -webkit-linear-gradient(top, #B0B0B0 5%, #E0E0E0 100%);
				background: -o-linear-gradient(top, #B0B0B0 5%, #E0E0E0 100%);
				background: -ms-linear-gradient(top, #B0B0B0 5%, #E0E0E0 100%);
				background: linear-gradient(to bottom, #B0B0B0 5%, #E0E0E0 100%);
				filter: progid :DXImageTransform.Microsoft.gradient(startColorstr='#B0B0B0', endColorstr='#E0E0E0',GradientType=0);
				background-color: #B0B0B0;
			}
			.myButton:active {
				position: relative;
				top: 1px;
			}
			h1 {
				font-family: Arial, Helvetica, sans-serif;
				font-size: 24px;
			}
			.lt4 { font-size: 24px; }
		</style>
	</head>
	<body>
		<header>
			<img src="banner-swb.jpg" />
		</header>
		<div style="height: 220px; width: 100%;"></div>
		<center>
			
		<h1>Lista de presença</h1>
		
	<?php

	
	$sx = '<table width="100%">';
	$id = 0;
	$pr = 0;
	
	if (strlen($dd[1]) > 0)
		{
			if ($dd[2]=='present')
				{
					$sql = "update scf_evento set s_p14 = '1' where id_s = ".$dd[0];
					$zrlt = db_query($sql);
				}
			if ($dd[2]=='undo')
				{
					$sql = "update scf_evento set s_p14 = '0' where id_s = ".$dd[0];
					$zrlt = db_query($sql);
				}
		}
		
	$sql = "select count(*) as total, s_pais from scf_evento
				where s_p14 = '1'
				group by s_pais 
				order by s_pais";
	$rlt = db_query($sql);	
	
	$sa = '<table width="200" align="left">';
	while ($line = db_read($rlt))
		{
			$sa .= '<tr>';
			$sa .= '<td>';
			$sa .= $line['s_pais'];
			$sa .= '</td>';
			
			$sa .= '<td>';
			$sa .= $line['total'];
			$sa .= '</td>';
		}
	$sa .= '</table>';
	echo $sa;
		
	$sql = "select * from scf_evento 
				order by s_nome";
	$rlt = db_query($sql);		
	while ($line = db_read($rlt))
		{
			$presente = $line['s_p14'];
			if ($presente==1)
				{
					$link = '<a href="'.page().'?dd0='.$line['id_s'].'&dd1='.checkpost($line['id_s']).'&dd2=undo">';
					$check = '<img src="img/icone_check.png" height="18" border=0>';
					$bg = ' bgcolor="#F0FFF0" ';
					$pr++;		
				} else {
					$link = '<a href="'.page().'?dd0='.$line['id_s'].'&dd1='.checkpost($line['id_s']).'&dd2=present">';
					$check = '';
					$bg = '';
				}
			$id++;
			$sx .= '<TR '.$bg.' >';
			$sx .= '<td align="right" class="borderb td2">'.$link.$id.'</A>.</td>';
			
			$sx .= '<td class="borderb" width="32">';
			$sx .= $check;
			$sx .= '</td>';
			
			$sx .= '<td class="borderb">';
			$sx .= utf8_decode($line['s_nome']);
			$sx .= '</td>';
			
			$sx .= '<td class="borderb">';
			$sx .= utf8_decode($line['s_pais']);
			$sx .= '</td>';
			
			$sx .= '<td class="borderb">';
			$sx .= utf8_decode($line['s_universidade']);
			$sx .= '</td>';
			
		}
	$sx .= '</table>';
	
	echo '<table align="right" class="bb"><TR><TD class="borderb lt4">'.$pr.' presentes</td></tr></table>';
	echo $sx;
	
