<?php
require ("cab.php");
?>
<div class="main">
	<header>
		<img src="img/bk_topo_pt1.png" />
	</header>

	<div class="content-4">
		<div class="text-3">
			<h1>Sum�rio</h1>

			<ul class="lista-sumario">
				<li>
					<a href="#pibic"><i class="fa fa-circle-o"></i> Inicia��o Cient�fica (PIBIC)</a>
				</li>
				<li>
					<a href="#pibiti"><i class="fa fa-circle-o"></i> Inicia��o Tecnol�gica (PIBITI)</a>
				</li>
				<li>
					<a href="#pibicem"><i class="fa fa-circle-o"></i> Inicia��o Cient�fica J�nior (PIBIC_EM)</a>
				</li>
				<li>
					<a href="#mostra"><i class="fa fa-circle-o"></i> Mostra de Pesquisa da P�s-Gradua��o</a>
				</li>
				<li>
					<a href="#csf"><i class="fa fa-circle-o"></i> Ci�ncia sem Fronteiras</a>
				</li>
				<br />
				<li>
					<a href="#ipibic"><i class="fa fa-circle-o"></i> Inicia��o Cient�fica Internacional (iPIBIC)</a>
				</li>
				<li>
					<a href="#ipibiti"><i class="fa fa-circle-o"></i> Inicia��o Tecnol�gica Internacional (iPIBITI)</a>
				</li>
				<li>
					<a href="#ipibicem"><i class="fa fa-circle-o"></i> Inicia��o Cient�fica J�nior Internacional (iPIBIC_EM)</a>
				</li>
			</ul>

			<?php

			$tp = '';
			if ($LANG == 'en') { $tp = '_en';
			}

			echo '<A NAME="PIBIC"><A>';
			require ("sumario_01" . $tp . ".php");
			echo '<A NAME="PIBITI"><A>';
			require ("sumario_02" . $tp . ".php");
			echo '<A NAME="PIBIC_EM"><A>';
			require ("sumario_03" . $tp . ".php");
			echo '<A NAME="POS-G"><A>';
			require ("sumario_04" . $tp . ".php");
			echo '<A NAME="CSF"><A>';
			require ("sumario_05" . $tp . ".php");

			echo '<A NAME="iPIBIC"><A>';
			require ("sumario_11" . $tp . ".php");
			echo '<A NAME="iPIBITI"><A>';
			require ("sumario_12" . $tp . ".php");
			echo '<A NAME="iPIBIC_EM"><A>';
			require ("sumario_13" . $tp . ".php");

			require ("foot.php");
			?>
</div>