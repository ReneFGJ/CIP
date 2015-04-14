<?
	require('../_class/_class_csf.php');
	$csf = new csf;
	
	//Chama metodo que gera os quadro estatisticos
	$total = $csf->total_bolsistas();
	$totali = $csf->total_inscricoes();

?>
<body style="font-family: Arial;border: 0 none;">
	<div style="text-align: justify">
<?php 
	$txt = msg("csf_mapa");
	$txt = troca($txt,' 50 ',' '.$total.' '); 
	$txt = troca($txt,' 60 ',' '.$totali.' ');
	
	echo $txt;
	
	$txt = msg("csf_mapa_res");
	$txt = troca($txt,'$est',' '.$total.' '); 
	$txt = troca($txt,'$insc',' '.$totali.' ');
	echo '<center>'.$txt.'</center>';
	echo '<BR><BR>';
?></div>

<!--Chama metodo que gera os mapas e tabela dinamicos -->
<?php echo $csf->world_mapa_estudantes(); ?>
	
	<div style="text-align: justify">
		<BR><BR><center><h2><?=msg('est_no_ext');?></h2></center>
	   	<div style="text-align: justify"><?php echo msg("csf_mapa_foot"); ?></div>
		<!--Chama metodo que gera a relacao dos alunos por curso e pais -->		
		<?php echo $csf->lista_bolsistas();?>
	</div>
	
