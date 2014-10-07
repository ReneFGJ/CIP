<?php
require ("cab.php");
?>
<div class="main">
	<header>
		<img src="img/bk_topo_pt1.png" />
	</header>

	<div class="content-4">
		<div class="text-3">
			<h1>Sumário</h1>

			<ul class="lista-sumario">
				<li>
					<a href="#pibic"><i class="fa fa-circle-o"></i> Iniciação Científica (PIBIC)</a>
				</li>
				<li>
					<a href="#pibiti"><i class="fa fa-circle-o"></i> Iniciação Tecnológica (PIBITI)</a>
				</li>
				<li>
					<a href="#pibicem"><i class="fa fa-circle-o"></i> Iniciação Científica Júnior (PIBIC_EM)</a>
				</li>
				<li>
					<a href="#mostra"><i class="fa fa-circle-o"></i> Mostra de Pesquisa da Pós-Graduação</a>
				</li>
				<li>
					<a href="#csf"><i class="fa fa-circle-o"></i> Ciência sem Fronteiras</a>
				</li>
				<br />
				<li>
					<a href="#ipibic"><i class="fa fa-circle-o"></i> Iniciação Científica Internacional (iPIBIC)</a>
				</li>
				<li>
					<a href="#ipibiti"><i class="fa fa-circle-o"></i> Iniciação Tecnológica Internacional (iPIBITI)</a>
				</li>
				<li>
					<a href="#ipibicem"><i class="fa fa-circle-o"></i> Iniciação Científica Júnior Internacional (iPIBIC_EM)</a>
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