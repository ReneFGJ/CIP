<?php
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_menus.php");
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
	
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('iniciação científica')));
array_push($breadcrumbs,array(http.'//main.php',msg('menu CIP')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
echo '<h1>Submissões</h1>';
echo '<div style="width:80%; height:1px; border-bottom:3px solid #757575;"></div>';


	//pode requerir qualquer classe que precise do edital e data
	require("../_class/_class_pibic_projetos_v2.php");
	$pb = new projetos;
	
	//ano atual
	$ano = date("Y");
	
	//Array
	$cp = array();
	array_push($cp,array('$H4','','',False,True,''));
	array_push($cp,array('$A8','','Seleciona dado',False,True,''));
	array_push($cp,array('$[2010-'.date("Y").']','','Ano edital ',False,True,''));
	array_push($cp,array('$HV','',$ano,True,True,''));

	if ($dd[2] != null) {
		echo '<h1>Editais do ano base de '.$dd[2].'</h1>';
	} else {
		echo '<h1>Seleciona Ano do edital </h1>';
	}
	
	
	//monta tabela de seleciona dados
	?><TABLE width="<?=$tab_max?>"align="center"><TR><TD><?
		editar();
	?></TD></TR></TABLE><?	
	
	if ($saved == 0)
		{ exit; }
	
			
	$ano = $dd[2];
	$meta = 1500;

	$sql = "select count(*) as total, pj_ano, doc_edital
			from pibic_projetos
			left join pibic_submit_documento on doc_protocolo_mae = pj_codigo
			where pj_ano = '$ano'
			and (pj_status <> '!' and pj_status <> '@' and pj_status <> 'X' and pj_status <> 'E')
			and (doc_status <> '!' and doc_status <> '@' and doc_status <> 'X' and doc_status <> 'E')
			and (doc_edital = 'PIBIC' or  doc_edital = 'PIBITI' or  doc_edital = 'IS' or  doc_edital = 'ICI' or  doc_edital = 'PIBICE')
			group by doc_edital, pj_ano		
	";
	
	$rlt = db_query($sql);
	
	$mt = array('PIBIC' => 800, 'PIBITI' => 300, 'PIBICE' => 60);
	$tot = 0;
	while ($line = db_read($rlt))
		 {	$page = 'submissao_cockpit';
			$link = '<a href="'.$page.'_1.php?dd0='.$line['doc_edital'].'">';
			$linka = '<a href="submissao_cockpit_excel.php?dd0='.trim($line['doc_edital']).'&ano='.$ano.'">';
			$sx .= '<TR>';
	
			$sx .= '<TD align="center">';
			$sx .= $link;
			$sx .= $line['total'];
			$sx .= '</A>';
			$sx .= '<TD>';
			$sx .= trim($line['pj_ano']);
			$sx .= '<TD>';
			$sx .= $line['doc_edital'];
			
			$sx .= '<TD>';
			$sx .= $linka;
			$sx .= 'excel';
			$sx .= '</A>';
					
			$tot = $tot + $line['total'];
		} 
	
	echo '<h3>Cockpit da submissão de planos de aluno</h3>';	
	echo '<table class="lt1" width=500 cellpadding=4 cellspacing=0 border=1 >';
	echo $sx;
	echo '<TR><TD align="center">'.$tot."</TD><TD>Total";
	echo '</table>';
	
	$part = $meta - $tot;
	$rest = $tot;
	$cap = 'Planos submetidos';
	if ($part < 0)
		{
			$part = $meta;
			$rest = $tot - $meta;
			$cap = 'Planos acima da meta';
		}
?>		 
	 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
	    <script type="text/javascript">
	      google.load("visualization", "1", {packages:["corechart"]});
	      google.setOnLoadCallback(drawChart);
	      function drawChart() {
	        var data = new google.visualization.DataTable();
	        data.addColumn('string', 'Task');
	        data.addColumn('number', 'Hours per Day');
	        data.addRows([
	          ['<?=$cap;?>',    <?php echo $rest;?>],
	          ['Meta (<?php echo $meta;?> planos)',      <?php echo $part;?>]
	        ]);
	
	        var options = {
	          title: 'Metas da Iniciação Científica'
	        };
	
	        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
	        chart.draw(data, options);
	      }
	    </script>
	  </head>
	  <div id="chart_div" style="width: 900px; height: 500px;"></div>
	  
<?	


$ano = $dd[2];
$modalidade = $dd[0];
echo '</BR>'; 
	
	//aqui pode chamar qualquer método dentro da classe e passa como parametro o ano
	echo $pb->resumo_planos_escola($dd[2]);
	echo $pb->resumo_planos_campus($dd[2]);
	echo $pb->resumo_projeto_professor_area_conhecimento($dd[2]);
	echo $pb->resumo_planos_area_estrategica_principais($dd[2]);

	//titulo da tabela
	$sx .= '<h2><i>Gráfico das áreas de Conhecimento:';
	echo '</BR>'; 
?>
	
	<title>Google Visualization API Sample</title>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">google.load('visualization', '1', {packages: ['corechart']});</script>
    <script type="text/javascript">
      function drawVisualization() {
	        var data = google.visualization.arrayToDataTable([
			 <? 
				 $rst = $pb->rst;
				 for ($r=0;$r < count($rst);$r++)
				 	{
				 		$bolsa = ($rst[$r][1]+$rst[$r][2]+$rst[$r][3]);
						$meta = ($rst[$r][4]+$rst[$r][5]+$rst[$r][6]);
				 		if ($r > 0) echo ','.chr(13).chr(10);
						echo "['".$rst[$r][0]."', 0, 0,".$bolsa.", ".$meta."]";
				 	}
			 ?>
			], true);
			
			var options = {legend:'none'};
			var chart = new google.visualization.CandlestickChart(document.getElementById('chart_div2'));
			chart.draw(data, options);
  		}
  		google.setOnLoadCallback(drawVisualization);
    </script>
  </head>
  <body>
    <div id="chart_div2" style="width: 900px; height: 500px;"></div>
  </body>
<?	
	require("../foot.php");	
?>	
	
	
	
	

	
