<?php
require("cab.php");
require("../_class/_class_pibic_projetos_v2.php");
$ano = date("Y");
$meta = 1500;

$pj = new projetos;
if (strlen($dd[0])==0)
	{
		$pj->ano = date("Y");
	} else {
		$pj->ano = $dd[0];
	}
$ano = $pj->ano;

$sql = "select count(*) as total, pj_ano, doc_edital  
	from pibic_projetos 
	inner join pibic_submit_documento on doc_protocolo_mae = pj_codigo 
	
	where pj_ano = '".$pj->ano."'
					and (doc_status = 'B' or doc_status = 'C' or doc_status = 'D' or doc_status = 'F') 
					and (pj_status = 'B' or pj_status = 'C' or pj_status = 'D' or pj_status = 'F')
	group by pj_ano, doc_edital 
";
$rlt = db_query($sql);

$mt = array('PIBIC' => 800, 'PIBITI' => 300, 'PIBICE' => 60);
$tot = 0;
while ($line = db_read($rlt))
	{
		$page = troca(page(),'.php','');
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
echo $pj->resumo_planos_centro(); 

echo $pj->resumo_planos_campi();

echo $pj->resumo_projetos_area();

echo $pj->resumo_planos_area_conhecimento();
echo $pj->resumo_planos_area();

echo $pj->resumo_planos_area_estrategica();

?>

    <title>
      Google Visualization API Sample
    </title>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        var data = google.visualization.arrayToDataTable([
 <? 
 $rst = $pj->rst;
 for ($r=0;$r < count($rst);$r++)
 	{
 		$bolsa = ($rst[$r][1]+$rst[$r][2]+$rst[$r][3]);
		$meta = ($rst[$r][4]+$rst[$r][5]+$rst[$r][6]);
 		if ($r > 0) echo ','.chr(13).chr(10);
 		echo "['".$rst[$r][0]."', 0, 0,".$bolsa.", ".$meta."]";
 	}
 ?>
        ], true);

        var options = {
          legend:'none'
        };

        var chart = new google.visualization.CandlestickChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }

      google.setOnLoadCallback(drawVisualization);
    </script>
  </head>
  <body>
    <div id="chart_div2" style="width: 900px; height: 500px;"></div>
  </body>

