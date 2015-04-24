<?php
class csf
	{
		var $protocolo;
		var $line;
		var $tabela = 'csf_inscricoes';
		
		function  lista_inscritos($todos=0,$d1=0,$d2=20509999,$local='')
			{
				$sql = "select * from ".$this->tabela." 
					where icsf_data > 20130901
				";
				
				$rlt = db_query($sql);
				
				$sx .= '<TR>
							<TH width="5%"	>Aluno
							<TH width="30%"	>Edital
							'; 	
				
				$tot = '';
				
				while ($line = db_read($rlt))
					{
						$aluno = $line['icsf_estudante'];
						$edital= $line['icsf_edital'];
						
						$tot++;	
						
						$cracha = '<A HREF="discente.php.php?dd0='.$line['icsf_estudante'].'" class="link">';
						$sx .= 		'<TR>';
						$sx .= 		'<TD class="tabela01" align="left">';
						$sx .= 		$cracha;
						$sx .= 		$line['icsf_estudante'];
						$sx .= 	  '</A>';
						
						$sx.= '<TD class="tabela01" align="left">'.$edital;
									
						$sx .=  '<TR>
						 	<TD colspan=6 align=right BGCOLOR="#C0C0C0" valign="bottom"><font color="white">Total de '.$tot.' docentes nas pendencias.</font>';
						$sx  .= '</table>';
			
					return($sx);	
					}
			}
		
		function csf_pais()
			{
				$sql = "select count(*) as total, pa_curso from pibic_bolsa_contempladas 
						inner join pibic_bolsa_tipo on pb_tipo = pbt_codigo
						inner join pibic_aluno on pb_aluno = pa_cracha
						where pbt_edital = 'CSF' and pb_status <> 'C'
						group by pa_curso			
				";
				$rlt = db_query($sql);
				while ($line = db_read($rlt))
					{
						print_r($line);
						echo '<HR>';
					}
				$sql = "select count(*) as total, pb_colegio_orientador from pibic_bolsa_contempladas 
						inner join pibic_bolsa_tipo on pb_tipo = pbt_codigo
						inner join pibic_aluno on pb_aluno = pa_cracha
						where pbt_edital = 'CSF' and pb_status <> 'C'
						group by pb_colegio_orientador				
				";
				$rlt = db_query($sql);
				$pp = array();
				$tt = 0;
				$tot = 0;
				while($line = db_read($rlt))
					{
						$total = $line['total'];
						$tt++;
						$tot = $tot + $total;
						
						$pais = UpperCase(trim($line['pb_colegio_orientador']));
						if ($pais == 'COREIA DO SUL') { $pais = 'COR�IA DO SUL'; }
						switch ($pais)
							{
							case 'B�LGICA': 		$continente = 2; break;
							case 'PORTUGAL': 		$continente = 2; break;
							case 'ESPANHA': 		$continente = 2; break;
							case 'ALEMANHA': 		$continente = 2; break;
							case 'IRLANDA': 		$continente = 2; break;
							case 'FRAN�A': 			$continente = 2; break;
							case 'IT�LIA': 			$continente = 2; break;
							case 'REINO UNIDO': 	$continente = 2; break;
							case 'HUNGRIA': 		$continente = 3; break;
							case 'ESC�CIA': 		$continente = 2; break;
							case 'HUNGRIA': 		$continente = 2; break;
							case 'HOLANDA': 		$continente = 2; break;
							case 'COR�IA DO SUL': 	$continente = 3; break;
							case 'AUSTR�LIA': 		$continente = 4; break;
							case 'CHINA': 			$continente = 3; break;
							case 'HONG KONG': 		$continente = 3; break;
							case 'ESTADOS UNIDOS':	$continente = 5; break;
							default: $continente = 1; break;
							}
						array_push($pp,array($pais,$total,$continente));
					}
				$sx = '<?php
				$paises_total = '.round($tt).';
				$processo_total = '.(round($tot*1.8)).';
				$estudantes_total = '.(round($tot)).';
				?>
				';
				$rlt = fopen("../semic/dados_paises.php",'w');
				fwrite($rlt,$sx);
				fclose($rlt);
			}
		
		function estudantes_csf()
			{
				$sql = "select * from pibic_bolsa_contempladas 
						inner join pibic_bolsa_tipo on pb_tipo = pbt_codigo
						inner join pibic_aluno on pb_aluno = pa_cracha
						where pbt_edital = 'CSF' and pb_status <> 'C'					
				";
				$rlt = db_query($sql);
				$sx .= '<h3>Discentes Ci�ncia sem Fronteiras</h3>';
				$sx .= '<table width="100%" class="tabela00">';
				$sx .= '<TR>';
				$sx .= '<TH>Escola';
				$sx .= '<TH>Total';

				
				$id = 0;
				
				while ($line = db_read($rlt))
					{
						$id++;
						$nome = trim($line['pa_nome']);
						$curso = $line['pb_colegio'];
						$pais = $line['pb_colegio_orientador'];
						$estra = $line['pb_area_estrategica'];
						$codigo = $line['pa_cracha'];
						$curso2 = $line['pa_curso'];
						
						//print_r($line);
						//echo '<HR>';
						$sx .= '<TR>';
						$sx .= '<TD class="tabela01">'.$codigo;
						$sx .= '<TD class="tabela01">'.$nome;
						$sx .= '<TD class="tabela01">'.$pais;
						$sx .= '<TD class="tabela01">'.$estra;
						$sx .= '<TD class="tabela01">'.$curso;
						$sx .= '<TD class="tabela01">'.$curso2;
						
						$sql .= "insert into csf_alunos 
								(scf_codigo, scf_nome, scf_pais, scf_estrategica, scf_curso, scf_universidade)
								values
								('$codigo','$nome','$pais','$estregica','$curso','$universidade');
						<BR>";
					}
				$sx .= '<TR><TD colspan=6>Total '.$id;
				$sx .= '</table>';
				echo $sql;
				$this->csf_pais();
				return($sx);
			}		
		
		function estudantes_em_viagem_centro()
			{
				$sql = "select count(*) as total, pa_centro, pb_ano from pibic_bolsa_contempladas 
						inner join pibic_bolsa_tipo on pb_tipo = pbt_codigo
						inner join pibic_aluno on pb_aluno = pa_cracha
						where pbt_edital = 'CSF' and pb_status <> 'C'
						and pb_ano = '2013'
						group by pa_centro, pb_ano
						order by pa_centro, pb_ano
						
				";
				$rlt = db_query($sql);
				$sx .= '<h3>Discentes Ci�ncia sem Fronteiras</h3>';
				$sx .= '<table width="100%" class="tabela00">';
				$sx .= '<TR>';
				$sx .= '<TH>Escola';
				$sx .= '<TH>Total';

				
				$id = 0;
				$xnome = "X";
				while ($line = db_read($rlt))
					{
						$id++;
						$nome = trim($line['pa_centro']);
						$sx .= '<TR>';
						$sx .= '<TD class="tabela01">'.$nome;
						$sx .= '<TD class="tabela01" align="center">';
						$sx .= $line['total'];
					}
				$sx .= '<TR><TD colspan=6>Total '.$id;
				$sx .= '</table>';
				
				return($sx);
			}
			
		
		function estudantes_em_viagem_campus()
			{
				$sql = "select count(*) as total, pa_centro, pb_ano from pibic_bolsa_contempladas 
						inner join pibic_bolsa_tipo on pb_tipo = pbt_codigo
						inner join pibic_aluno on pb_aluno = pa_cracha
						where pbt_edital = 'CSF' and pb_status <> 'C'
						and pb_ano between '2012' and '2015'
						group by pa_centro, pb_ano
						order by pa_centro, pb_ano
				";
				
				$rlt = db_query($sql);
				
				$sx .= '<h3>Discentes Ci�ncia sem Fronteiras</h3>';
				$sx .= '<table width="100%" class="tabela00">';
				$sx .= '<TR>';
				$sx .= '<TH>Ano';
				$sx .= '<TH>Escola';
				$sx .= '<TH>Total';
				
				$id = 0;
				$xnome = "X";
				
				
				while ($line = db_read($rlt))
					{
						$nome = trim($line['pa_centro']);
						$ano  = trim($line['pb_ano']);
						
						$id++;
						
						$sx .= '<TR>';
						$sx .= '<TD class="tabela01">'.$ano;
						$sx .= '<TD class="tabela01">'.$nome;
						$sx .= '<TD class="tabela01" align="center">';
						$sx .= $line['total'];
					}
				$sx .= '<TR><TD colspan=6>Total '.$id;
				$sx .= '</table>';
				return($sx);
			}
		
		
		function cp_dados()
			{
				$cp = array();
				array_push($cp,array('$H8','id_pb','',False,True));
				array_push($cp,array('$S1','pb_status','Status',False,True));
				return($cp);
			}
		
		function le($id)
			{
				$sql = "select * from pibic_bolsa_contempladas 
						inner join pibic_bolsa_tipo on pb_tipo = pbt_codigo
						inner join pibic_aluno on pb_aluno = pa_cracha
						where pb_protocolo = '".$id."' or id_pb = ".round($id);
				$rlt = db_query($sql);
				
				if ($line = db_read($rlt))
					{
						$this->protocolo = $line['pb_protocolo'];
						$this->line = $line;
						return(1);
					}
				return(0);				
			}
		function mostra_status($sta)
			{
				switch ($sta)
					{
					case 'A': $sx .= 'em viagem'; break;
					case 'B': $sx .= 'retornou'; break;
					case 'C': $sx .= 'cancelado'; break;
					case 'D': $sx .= 'desistiu'; break;
					}
				return($sx);
			}
		function mostra_dados()
			{
				global $perfil;
				$line = $this->line;
				
				$sx .= '<fieldset><legend>Dados da viagem</legend>';
				$sx .= '<table width="100%">';
				$sx .= '<TR valign="top">
						<TD width="60%"><font class="lt0">t�tulo do plano</font><BR>';
				$sx .= '<font class="lt3">'.$line['pb_titulo_projeto'].'</font>';
				
				$sx .= '<BR><BR>Situa��o: <B><font class="lt4">';
				$sx .= $this->mostra_status($line['pb_status']);
				$sx .= '</font></B>';
				$sx .= '<TD width="40%" bgcolor="#E0E0E0">';
				$sx .= 'Protocolo: <B>'.$line['pb_protocolo'].'</B>';
				$sx .= '<BR>Edital: <B>'.$line['pbt_descricao'].'/'.$line['pb_ano'].'</B>';
				$sx .= '<BR>Sa�da: <B>'.stodbr($line['pb_ativacao']).'</B>';
				$sx .= '<BR>Retorno / Previs�o: <B>'.stodbr($line['pb_desativacao']).'</B>';
				$sx .= '<BR>Pais: <B>'.$line['pb_colegio_orientador'].'</B>';
				$sx .= '<BR>Universidade: <B>'.$line['pb_colegio'].'</B>';
				$sx .= '<TD width="60%">';
				$sx .= '</table>';
				if ($perfil->valid('#SPI#CPI'))
					{
						$link = '<A HREF="csf_ed.php?dd0='.$line['id_pb'].'&dd90='.checkpost($line['id_pb']).'" class="link">';
						$sx .= $link.'editar'.'</A>';
					}
				$sx .= '</fieldset>';
				return($sx);
			}
		
		function estudantes_em_viagem()
			{
				$sql = "select * from pibic_bolsa_contempladas 
						inner join pibic_bolsa_tipo on pb_tipo = pbt_codigo
						inner join pibic_aluno on pb_aluno = pa_cracha
						left join curso on pa_curso_cod = curso_codigo
						left join centro on curso_centro = centro_codigo
						where pbt_edital = 'CSF' and pb_status <> 'C'
						and pb_ano between '2012' and '2015'
						order by pa_nome 
						
				";
				$rlt = db_query($sql);
				$sx .= '<h3>Discentes Ci�ncia sem Fronteiras</h3>';
				$sx .= '<table width="100%" class="tabela00">';
				$sx .= '<TR>';
				$sx .= '<TH>Protocolo';
				$sx .= '<TH>Status';
				$sx .= '<TH>Discente';
				$sx .= '<TH>Ano';
				$sx .= '<TH>Curso';
				$sx .= '<TH>Escola';
				$sx .= '<TH>Universidade';
				$sx .= '<TH>Pa�s';
				$sx .= '<TH>�rea estrat�gica';
								
				$id = 0;
				$xnome = "X";
				while ($line = db_read($rlt))
					{
						$nome = trim($line['pa_nome']);
						$font = '<font>';
						if ($nome == $xnome) { $font = '<font color="red">'; }
						$link = $line['pb_protocolo'];
						$link = '<A HREF="csf_detalhe.php?dd0='.$link.'&dd90='.checkpost($link).'" class="link">';
						$id++;
						$sx .= '<TR>';
						$sx .= '<TD class="tabela01">'.$link.$line['pb_protocolo'].'</A>';
						
						$sta = $line['pb_status'];
						$sx .= '<TD class="tabela01">';
						$sx .= $this->mostra_status($sta);
												
						$sx .= '<TD class="tabela01">'.$font.$line['pa_nome'].'</font>';
						$sx .= '<TD class="tabela01">'.$line['pb_ano'];
						$sx .= '<TD class="tabela01">'.($line['curso_nome']);
						$sx .= '<TD class="tabela01">'.($line['centro_nome']);
						$sx .= '<TD class="tabela01">'.$line['pb_colegio'];	
						$sx .= '<TD class="tabela01">'.$line['pb_colegio_orientador'];
						$sx .= '<TD class="tabela01">'.$line['pb_area_estrategica'];
						
						//print_r($line);
						//exit;
						

						
						$ln = $line;
					}
				$sx .= '<TR><TD colspan=6>Total '.$id;
				$sx .= '</table>';
				return($sx);
			}
		
		
		function depoimento_mostra($nome,$data=19000101,$texto='',$foto='',$pais='')
			{
				$sx = '<table width="100%" class="lt1">';
				
				$sx .= '<TR valign="top">';
				
				$sx .= '<TD rowspan=3 >';
				
				$sx .= '<A HREF="img_post/'.$foto.'" targer="new'.$data.'" >'; 
				$sx .= '<img src="img_post/'.$foto.'" width="100" border=0>';
				$sx .= '</A>';
				
				$sx .= '<TD>';
				
				$sx .= '<B>'.$nome;
				$sx .= ' - '.$pais;
				$sx .= '<TR><TD>'.$texto;
				$sx .= '<TR><TD>'.stodbr($data);
				$sx .= '</table>';
				return($sx);
			}
		
		function total_inscricoes()
			{
				$sql= "select count(*) as total from ".$this->tabela."  ";
				$rlt = db_query($sql);
				$line = db_read($rlt);
				return($line['total']);				
			}


//####################################################################################                      
//**************************** Inicio do metodo **************************************
/* @method: estudante_perfil()
 *          Monta o dados para grafico de perfil dos alunos
 * @author Rene Gabriel[Desenvolvedor] Apoio: Elizandro Santos de Lima[Analista de Projetos]
 * @date: 22/04/2015
 */						
		function estudante_perfil()
			{
				$sql = "select * from (
							select count(*) as total, pb_colegio, pb_tipo 
							from pibic_bolsa_contempladas 
							where pb_tipo = 'S' 
							and (pb_status <> 'C' and pb_status <> '@')
							group by pb_tipo, pb_colegio
							) as alunos
							left join 
									(select distinct inst_nome
									 from instituicao) as instituicao on pb_colegio = inst_nome
						 ";	
						 
						 
				$rlt = db_query($sql);
				
				$st = '';
				$sv = '';
				$col = 99;
				$paisn = 0;
				$tot_cursos = 0;
				$tot_alunos = 0;
				
				while ($line = db_read($rlt))
					{
						
					$paisn = trim($line['pa_curso']);
					
					if (strlen($paisn) > 0)
						{
							$tot_cursos ++;
							$tot_alunos = $tot_alunos + $line['total'];
							
						if (strlen($st) > 0) { $st .= ', '.chr(13).chr(10); $sv .= ', '; }
						
						$st .= '['.$paisn.', '.$line['total'].']';
						$sv .= "$total";

						if ($col > 1) { $col = 0; $sq .= '<TR>'; }
						$sq .= '<TD align="left">'.msg($paisn).'<TD align="center">'.$line['total'];
						$col++;						
						
						if (strlen($st) > 0) 
						{
							 $st .= ', '.chr(13).chr(10); 
						}
							
						   $st .= '['.$paisn.', '.$line['total'].']';
						
						}
					} 
					
					
					
					$sx .= '
					    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
					    <script type="text/javascript">
					      google.load(\'visualization\', \'1\', {packages:[\'corechart\']});
					      google.setOnLoadCallback(drawChart);
					      function drawChart() {
					        var data = google.visualization.arrayToDataTable([
							  [\'Curso\', \'Qtd.\'],'.$st.']);
													
						        var options = {
									          	title: \'Titulo\',
									          	is3D: \'true\',
									          };
					
					        var chart = new google.visualization.PieChart(document.getElementById(\'piechart_3d\'));
					        chart.draw(data, options);
					      }
					  		</script>
								<div id="piechart_3d" style="width: 900px; height: 500px;"></div>
								<div style="text-align: justify">Mapa</div>
								<style>
									#piechart_3d
												{
												border: 2px solid #C0C0C0;
												}
							</style>
  				';
			
				
				
				$sx .= '<BR><BR><H2>'.msg('Alunos por cursos').'</H2>';
				$sx .= '<table width=750 align=center class="lt0" cellpadding=3 cellspacing=0 border=1>';
				$sx .= '<TR>';
				$sx .= '<TH width=50% align="left">'.msg('curso').'<TH width=13%>'.msg('estudantes');
				$sx .= '<TH width=50% align="left">'.msg('curso').'<TH width=13%>'.msg('estudantes');
				$sx .= $sq.'</table>';
				
				$sx .= '<TR colspan=2>
							<align=left BGCOLOR="#99FF99 " valign="bottom">
							Total de <strong>'.$tot_alunos.'</strong> alunos,';
				$sx .= 	    " em <strong>".$tot_cursos."</strong> cursos da PUCPR.";
				$sx  .= '</table>';
								
    			return($sx);
				
			}
	
		
		function estudante_area()
			{
				$sql = "select count(*) as total, pa_curso from pibic_bolsa_contempladas 
						inner join pibic_aluno on pb_aluno = pa_cracha
						where (or pb_tipo = 'S')
						and pb_ativo = 1 and (pb_status <> 'C' and pb_status <> '@')
						group by pa_curso
						order by pa_curso 
						 ";
				$rlt = db_query($sql);
				$st = '';
				$sv = '';
				$col = 99;
				
				$curso=array();
				$curson=array();
				while ($line = db_read($rlt))
					{
					$total = $line['total'];
					$paisn = trim($line['pa_curso']);
					if (strlen($paisn) > 0)
						{
						if (strlen($st) > 0) { $st .= ', '.chr(13).chr(10); $sv .= ', '; }
						$st .= "['$paisn', $total]";
						$sv .= "$total";

						if ($col > 1) { $col = 0; $sq .= '<TR>'; }
						$sq .= '<TD align="left">'.$paisn.'<TD align="center">'.$line['total'];
						$col++;						
						}
					}
				$st = "['Ci�ncia da Computa��o e tecnologia da informa��o',1],".chr(13).chr(10);
				$st .= "['Engenharias e demais �reas tecnol�gicas',20],".chr(13).chr(10);
				$st .= "['Biologia, ci�ncias biom�dicas e sa�de',14],".chr(13).chr(10);
				$st .= "['Industria criativa',4],".chr(13).chr(10);
				$st .= "['Biotecnologia',4],".chr(13).chr(10);
				$st .= "['Energias renov�veis',3],".chr(13).chr(10);
				$st .= "['Ci�ncias extas e da terra',2],".chr(13).chr(10);
				$st .= "['Novas Tec. E engenharia construtiva',1]".chr(13).chr(10);
				$sx .= '
				     <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    				<script type="text/javascript">
      					google.load(\'visualization\', \'1\', {packages: [\'corechart\']});
    				</script>
    				<script type="text/javascript">
      					function drawVisualization() {
        				// Create and populate the data table.
        				var data = google.visualization.arrayToDataTable([
          				[\'Cruso\', \'Estudantes\'],
          				';
				$sx .= $st;
         		$sx .= ']);
       					 new google.visualization.PieChart(document.getElementById(\'visualization\')).
            				draw(data, {title:"Estudantes por Cursos"});
      					}
      				google.setOnLoadCallback(drawVisualization);
    			</script>
  				<div id="visualization" style="width: 750px; height: 400px;"></div>';
				
				$sx .= '<BR><BR><H2>�reas estrat�gicas dos Estudantes da PUCPR</H2>';
				$sx .= '<table width=750 align=center class="lt0" cellpadding=3 cellspacing=0 border=1>';
				$sx .= '<TR>';
				$sx .= '<TH width=35% align="left">Pais<TH width=13%>Estudantes';
				$sx .= '<TH width=35% align="left">Pais<TH width=13%>Estudantes';
				$sx .= $sq.'</table>';
								
    			return($sx);
				
			}
		
		function estudante_curso_pie()
			{
				$sql = "select count(*) as total, pa_curso from pibic_bolsa_contempladas 
						inner join pibic_aluno on pb_aluno = pa_cracha
						where (pb_tipo = 'K' or pb_tipo = 'S' or pb_tipo = 'T' or pb_tipo = 'W')
						and pb_ativo = 1 and (pb_status <> 'C' and pb_status <> '@')
						group by pa_curso
						order by pa_curso 
						 ";
				$rlt = db_query($sql);
				$st = '';
				$sv = '';
				$col = 99;
				
				$curso=array();
				$curson=array();
				while ($line = db_read($rlt))
					{
					$total = $line['total'];
					$paisn = msg(trim($line['pa_curso']));
					if (strlen($paisn) > 0)
						{
						if (strlen($st) > 0) { $st .= ', '.chr(13).chr(10); $sv .= ', '; }
						$st .= "['$paisn', $total]";
						$sv .= "$total";

						if ($col > 0) { $col = 0; $sq .= '<TR>'; }
						$sq .= '<TD align="left">'.$paisn.'<TD align="center">'.$line['total'];
						$col++;						
						}
					}
				$sx .= '
				     <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    				<script type="text/javascript">
      					google.load(\'visualization\', \'1\', {packages: [\'corechart\']});
    				</script>
    				<script type="text/javascript">
      					function drawVisualization() {
        				// Create and populate the data table.
        				var data = google.visualization.arrayToDataTable([
          				[\'Cruso\', \'Estudantes\'],
          				';
				$sx .= $st;
         		$sx .= ']);
       					 new google.visualization.PieChart(document.getElementById(\'visualization\')).
            				draw(data, {title:"Estudantes por Cursos"});
      					}
      				google.setOnLoadCallback(drawVisualization);
    			</script>
  				<div id="visualization" style="width: 750px; height: 400px;"></div>';
				
				$sx .= '<BR><BR><H2>Cursos dos Estudantes da PUCPR que est�o estudando em outros pa�ses</H2>';
				$sx .= '<table width=750 align=center class="lt0" cellpadding=3 cellspacing=0 border=1>';
				$sx .= '<TR>';
				$sx .= '<TH width=35% align="left">Pais<TH width=13%>Estudantes';
				$sx .= '<TH width=35% align="left">Pais<TH width=13%>Estudantes';
				$sx .= $sq.'</table>';
								
    			return($sx);
		}
								
		function estudante_curso()
			{
				$sql = "select count(*) as total, pa_curso from pibic_bolsa_contempladas 
						inner join pibic_aluno on pb_aluno = pa_cracha
						where (pb_tipo = 'K' or pb_tipo = 'S' or pb_tipo = 'T' or pb_tipo = 'W')
						and pb_ativo = 1 and (pb_status <> 'C' and pb_status <> '@')
						group by pa_curso
						order by pa_curso 
						 ";
				$rlt = db_query($sql);
				$st = '';
				$sv = '';
				$col = 99;
				while ($line = db_read($rlt))
					{
					$total = $line['total'];
					$paisn = msg(trim($line['pa_curso']));
					if (strlen($paisn) > 0)
						{
						if (strlen($st) > 0) { $st .= ', '; $sv .= ', '; }
						$st .= "'$paisn'";
						$sv .= "$total";

						if ($col > 0) { $col = 0; $sq .= '<TR>'; }
						$sq .= '<TD>'.$paisn.'<TD align="center">'.$line['total'];
						$col++;						
						}
					}
				$sx .= '				 
					<script type="text/javascript" src="http://www.google.com/jsapi"></script>
    				<script type="text/javascript">
      					google.load(\'visualization\', \'1\');
    				</script>
    				<script type="text/javascript">
      					function drawVisualization() {
        				var wrapper = new google.visualization.ChartWrapper({
          				chartType: \'ColumnChart\',
          				dataTable: [['.$st.'],
                      		['.$sv.']],
          					options: {\'title\': \'Estudantes por pa�ses\'},
          					containerId: \'visualization\'
        					});
        					wrapper.draw();
      					}
      				google.setOnLoadCallback(drawVisualization);
    			</script>
  				<div id="visualization" style="width: 750px; height: 400px;"></div>';
				
				$sx .= '<BR><BR><H2>'.msg('cursos_dos_estudantes').'</H2>';
				//Cursos dos Estudantes da PUCPR que est�o estudando em outros pa�ses
				$sx .= '<table width=750 align=center class="lt0" cellpadding=3 cellspacing=0 border=1>';
				$sx .= '<TR>';
				$sx .= '<TH width=35% align="left">'.msg('curso').'<TH width=13%>'.msg('estudantes');
				$sx .= $sq.'</table>';
								
    			return($sx);
		}
		function estudante_escola()
			{
				$sql = "select count(*) as total, pa_curso, pa_escola 
						from pibic_bolsa_contempladas 
							inner join pibic_aluno on pb_aluno = pa_cracha
							left join centro on centro_codigo = pa_escola
							where (pb_tipo = 'K' or pb_tipo = 'S' or pb_tipo = 'T' or pb_tipo = 'W')
							and pb_ativo = 1 and (pb_status <> 'C' and pb_status <> '@')
							group by pa_curso, pa_escola
						order by pa_curso 
						 ";
						 echo $sql;
				$rlt = db_query($sql);
				echo 'ok';
				$st = '';
				$sv = '';
				$col = 99;
				while ($line = db_read($rlt))
					{
						print_r($line).'<HR>';
					$total = $line['total'];
					$paisn = msg(trim($line['curso_centro']));
					if (strlen($paisn) > 0)
						{
						if (strlen($st) > 0) { $st .= ', '; $sv .= ', '; }
						$st .= "'$paisn'";
						$sv .= "$total";

						if ($col > 0) { $col = 0; $sq .= '<TR>'; }
						$sq .= '<TD>'.$paisn.'<TD align="center">'.$line['total'];
						$col++;						
						}
					}
				$sx .= '				 
					<script type="text/javascript" src="http://www.google.com/jsapi"></script>
    				<script type="text/javascript">
      					google.load(\'visualization\', \'1\');
    				</script>
    				<script type="text/javascript">
      					function drawVisualization() {
        				var wrapper = new google.visualization.ChartWrapper({
          				chartType: \'ColumnChart\',
          				dataTable: [['.$st.'],
                      		['.$sv.']],
          					options: {\'title\': \'Estudantes por pa�ses\'},
          					containerId: \'visualization\'
        					});
        					wrapper.draw();
      					}
      				google.setOnLoadCallback(drawVisualization);
    			</script>
  				<div id="visualization" style="width: 750px; height: 400px;"></div>';
				
				$sx .= '<BR><BR><H2>'.msg('cursos_dos_estudantes').'</H2>';
				//Cursos dos Estudantes da PUCPR que est�o estudando em outros pa�ses
				$sx .= '<table width=750 align=center class="lt0" cellpadding=3 cellspacing=0 border=1>';
				$sx .= '<TR>';
				$sx .= '<TH width=35% align="left">'.msg('curso').'<TH width=13%>'.msg('estudantes');
				$sx .= $sq.'</table>';
								
    			return($sx);
		}						
		function world_onde_curso_universidade()
			{
				$sql = "select * from pibic_bolsa_contempladas 
						inner join pibic_aluno on pb_aluno = pa_cracha
						where (pb_tipo = 'K' or pb_tipo = 'S' or pb_tipo = 'T' or pb_tipo = 'W')
						and pb_ativo = 1 and (pb_status <> 'C' and pb_status <> '@')
						order by pa_curso, pb_colegio_orientador, pb_colegio
						 ";
				$rlt = db_query($sql);
				$sx .= '<center><h2>'.msg('undergraduate course').'</h2>';
				$sx .= '<table class="lt1" width="100%">';
				$xpais = 'X';
				while ($line = db_read($rlt))
					{
						$pais = msg(trim($line['pa_curso']));
						if ($pais != $xpais)
							{ $sx .= '<TR bgcolor="#C0C0C0"><TD colspan=5 class="lt3">'.$pais; $xpais = $pais; }
						$sx .= '<TR '.coluna().'>';
						$sx .= '<TD>'.$line['pb_colegio'];
						
						//$sx .= '<TD>'.$line['pa_nome'];
						$sx .= '<TD>'.$line['pb_colegio_orientador'];
						$sx .= '<TD>'.substr($line['pa_nome'],0,strpos($line['pa_nome'],' '));
					}
				$sx .= '</table>';
				return($sx);			
			}							
		
		function world_onde_pais_universidade()
			{
				$sql = "select * from pibic_bolsa_contempladas 
						inner join pibic_aluno on pb_aluno = pa_cracha
						where (pb_tipo = 'K' or pb_tipo = 'S' or pb_tipo = 'T' or pb_tipo = 'W')
						and pb_ativo = 1 and (pb_status <> 'C' and pb_status <> '@')
						order by pb_colegio_orientador, pb_colegio
						 ";
				$rlt = db_query($sql);
				$sx .= '<center><h2>'.msg('country').'</h2>';
				$sx .= '<table class="lt1">';
				$xpais = 'X';
				while ($line = db_read($rlt))
					{
						$pais = trim($line['pb_colegio_orientador']);
						if ($pais != $xpais)
							{ $sx .= '<TR bgcolor="#C0C0C0"><TD colspan=5 class="lt3">'.$pais; $xpais = $pais; }
						$sx .= '<TR '.coluna().'>';
						$sx .= '<TD>'.$line['pb_colegio'];
						$sx .= '-'.$line['id_pb'];
						
						//$sx .= '<TD>'.$line['pa_nome'];
						$sx .= '<TD>'.$line['pa_curso'];
						$sx .= '<TD>'.substr($line['pa_nome'],0,strpos($line['pa_nome'],' '));
						//$sx .= '<TD>'.$line['pa_nome'];
					}
				$sx .= '</table>';
				return($sx);			
			}			

		
		function total_bolsistas()
			{
				$sql = "select count(*) as total from pibic_bolsa_contempladas 
						where (pb_tipo = 'S')
						and (pb_status <> 'C' and pb_status <> '@')
						 ";
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
						$total = $line['total'];
					}
				return($total);				
			}
		
		
		function lista_bolsistas()
			{
				$sql = "select * from pibic_bolsa_contempladas 
						inner join pibic_aluno on pb_aluno = pa_cracha
						where (pb_tipo = 'S')
		                and (pb_status <> 'C' and pb_status <> '@')
						order by pa_nome
						 ";
				$rlt = db_query($sql);
				$sx  = '<table width="100%" class="lt0" cellpadding=0 cellspacing=4 border=0 >' ;
				$sx .= '<TR><TH>Nome do estudante<TH>Curso<TH>Estudando';
				$tot = 0;
				while ($line = db_read($rlt))
					{
						$tot++;
						$curso = trim($line['pa_curso']);
						if (strpos($curso,'(') > 0)
							{ $curso = substr($curso,0,strpos($curso,'(')); }
						$sx .= '<TR '.coluna().'>';
						$sx .= '<TD>';
						$sx .= trim($line['pa_nome']);
						$sx .= '<TD>';
						$sx .= $curso;
						$sx .= '<TD>';
						$sx .= trim($line['pb_colegio_orientador']);
					}
				$sx .= '<TR><TD colspan=3 align=right BGCOLOR="#FFFF00" valign="bottom" >Total de '.$tot.' estudantes do Interc�mbio.';
				$sx  .= '</table>';
				return($sx);
			}
		
		function inscricao_csf($estudante,$edital,$passaport,$periodo,$idioma,$bolsa,$permanecia=12,$nota=0)
			{
				$sql = "ALTER TABLE ".$this->tabela." ADD column icsf_nota char(5)";
				//$rlt = db_query($sql);
				$idioma = substr($idioma,0,100);
				$data = date("Ymd");
				$hora = date("H:i");
				$sql= "select * from ".$this->tabela." where icsf_estudante = '$estudante' ";
				$rlt = db_query($sql);
				if (!($line = db_read($rlt)))
				{				
				$sql = "insert into ".$this->tabela." (
						icsf_estudante, icsf_edital, icsf_data ,
						icsf_hora, icsf_periodo, icsf_idioma_test, 
						icsf_passaport, icsf_bolsa ,
						icsf_ativo , icsf_status ,icsf_permanecia,
						icsf_nota
						
						) values (
						'$estudante','$edital',$data,
						'$hora','$periodo','$idioma',
						'$passaport','$bolsa',
						1,'A',$permanecia,
						$nota
						)";
				$rlt = db_query($sql);
				return(1);						
				} else {
					$id = round($line['id_icsf']);
					$sql = "update ".$this->tabela." 
						set icsf_edital = '$edital',
						icsf_data = $data,
						icsf_hora = '$hora',
						icsf_periodo = '$periodo',
						icsf_idioma_test = '$idioma',
						icsf_passaport = '$passaport',
						icsf_bolsa = '$bolsa',
						icsf_ativo = '1',
						icsf_status = 'A',
						icsf_nota = $nota,
						icsf_permanecia = '$permanecia'
						where id_icsf = $id
					";
					$rlt = db_query($sql);
					return(2);
				}	
			}
		function strucuture()
			{
				$sql = "CREATE TABLE ".$this->tabela."
					(
						id_icsf serial not null,
						icsf_estudante char(8),
						icsf_edital char(7),
						icsf_data integer,
						icsf_hora char(5),
						icsf_periodo char(2),
						icsf_idioma_test char(100),
						icsf_passaport char(1),
						icsf_bolsa char(6),
						icsf_ativo integer,
						icsf_status char(1),
						icsf_permanecia integer
					)
				";
				$rlt = db_query($sql);		
			}
//**************************** Fim do metodo *****************************************
	

//####################################################################################                      
//**************************** Inicio do metodo **************************************
/* @method: world_mapa_onde()
 *          Monta o grafico de barras dos alunos em cada pais
 * @author Rene Gabriel[Desenvolvedor] Apoio: Elizandro Santos de Lima[Analista de Projetos]
 * @date: 22/04/2015
 */			
		function world_mapa_onde()
			{
				$sql = "select count(*) as total, pb_colegio_orientador 
						from pibic_bolsa_contempladas 
						inner join pibic_aluno on pb_aluno = pa_cracha
						where (pb_tipo = 'S')
						and pb_ativo = 1  and (pb_status <> 'C' and pb_status <> '@')
						group by pb_colegio_orientador
						order by total desc
						 ";
				$rlt = db_query($sql);
				
				$st = "'Pa�s'";
				$sv = "0";
				$col = 99;
				
				while ($line = db_read($rlt)){
						
					$total = $line['total'];
					$paisn = trim($line['pb_colegio_orientador']);
					
					if (strlen($paisn) > 0)
						{
						if (strlen($st) > 0) { $st .= ', '; $sv .= ', '; }
						$st .= "'$paisn'";
						$sv .= "$total";

						if ($col > 2) { $col = 0; $sq .= '<TR>'; }
						$sq .= '<TD>'.$paisn.'<TD align="center">'.$line['total'];
						$col++;						
						}
					}
				
				$sx .= '				 
						<script type="text/javascript" src="https://www.google.com/jsapi"></script>
						<script type="text/javascript">
							google.load(\'visualization\', \'1\');
							google.setOnLoadCallback(drawVisualization);
							
							function drawVisualization() {
							var wrapper = new google.visualization.ChartWrapper({	
							chartType: \'ColumnChart\',
							dataTable: [['.$st.'],['.$sv.']],
								options: {\'title\': \'Estudantes por pa�ses\'},
								containerId: \'visualization\'
								});
								wrapper.draw();
							}
						
					</script>
  				
  				<div id="visualization" style="width: 750px; height: 400px;"></div>';
				
				$sx .= '<BR><BR><H2>Estudantes da PUCPR por pa�ses</H2>';
				$sx .= '<table width=600 align=center class="lt0" cellpadding=3 cellspacing=0 border=1>';
				$sx .= '<TR>';
				$sx .= '<TH width=20%>Pais<TH width=13%>Estudantes';
				$sx .= '<TH width=20%>Pais<TH width=13%>Estudantes';
				$sx .= '<TH width=20%>Pais<TH width=13%>Estudantes';
				$sx .= $sq.'</table>';
								
    			return($sx);
		}
//**************************** Fim do metodo *****************************************	

//####################################################################################                      
//**************************** Inicio do metodo **************************************
/* @method: world_mapa_estudantes()
 *          Monta o mapa por continente ou regiao da pagina do CsF
 * @author Elizandro Santos de Lima[Analista de Projetos]
 * @date: 05/04/2015
 */	
	function world_mapa_estudantes()
			{
				global $dd;
				/* Anterior */
				$sql1 = "
						select distinct inst_lat, inst_log, inst_nome, count(*) as total
						from pibic_bolsa_contempladas
						left join 
							(select distinct inst_nome, inst_log, inst_lat from instituicao) as instituicao on pb_colegio = inst_nome
						left join pibic_aluno on pb_aluno = pa_cracha
						where (pb_tipo = 'S')
						and (pb_status <> 'C' and pb_status <> '@')
						group by inst_lat, inst_log, inst_nome
						order by inst_nome
						";
				
				/* Novo */
				$sql = "select * from (
							select count(*) as total, pb_colegio, pb_tipo from pibic_bolsa_contempladas 
							where pb_tipo = 'S' 
							and (pb_status <> 'C' and pb_status <> '@')
							group by pb_tipo, pb_colegio
							) as alunos
							left join 
							(select distinct inst_nome, inst_log, inst_lat 
							 from instituicao) as instituicao on pb_colegio = inst_nome
							";
				$rlt = db_query($sql);				
				
				$st = '';
				$col = 99;
				$tot_instit = 0;
				$tot_alunos = 0;
				
				while ($line = db_read($rlt))
						{
							$paisn     = trim($line['inst_nome']);
							$pais      = trim($line['inst_nome']);
							$latitude  = $line['inst_lat'];							
							$longitude = $line['inst_log'];

						if (strlen($pais) > 0)
							{
								$tot_instit ++;
								$tot_alunos = $tot_alunos + $line['total'];
								
								if ($col >= 2) 
									{
					           		  	$col = 0; 
					           		    $sq .= '<TR>'; 
				              		}
				              	$sty = ' style="border: 1px solid #303030; padding: 2px; margin: 2px;" ';
				              	$sq .= '<TD align="center" '.$sty.'>'.$line['total'].'</td>';
				              	$sq .= '<TD '.$sty.'>'.$paisn.'</td>';
								
								$col++;
								
								if (strlen($st) > 0) 
									{
									  $st .= ', '.chr(13).chr(10); 	
									}
									$st .= '[ '.$latitude.', '.$longitude.', \''.$pais.'\', '.$line['total'].']';
							}
						
						}
			
			$selectRegion = 'world';
				
			$sx .= '
				<form method=POST name="mapas" id="mapas">	
			        <section>
			          <div class="tabs tabs-style-iconbox">
	                    <nav>
	                      <ul>
	                       <li><button id="botao1"> <a href="'.page().'?dd1=world#section-iconbox-1">Todos</a></button></li>
							<li><button id="botao1"><a href="'.page().'?dd1=021#section-iconbox-1">America do Norte</a></button></li>
							<li><button id="botao1"><a href="'.page().'?dd1=142#section-iconbox-1">�sia</a></button></li>
							<li><button id="botao1"><a href="'.page().'?dd1=150#section-iconbox-1">Europa</a></button></li>
							<li><button id="botao1"><a href="'.page().'?dd1=009#section-iconbox-1">Oceania</a></button></li>
	                        </li>                     
	                      </ul>
	                    </nav>
													
			            <div class="content-wrap">
			              <section id="section-iconbox-1"></section>
			              <section id="section-iconbox-2"></section>
			              <section id="section-iconbox-3"></section>
			              <section id="section-iconbox-4"></section>
			              <section id="section-iconbox-5"></section>
			            </div>
			          </div><!-- /tabs -->
			      </section>

					</form>	
				<script>
					$("#botao1").click(function() { $( "#mapas" ).submit(); });
					$("#botao2").click(function() { $( "#mapas" ).submit(); });
					$("#botao3").click(function() { $( "#mapas" ).submit(); });
					$("#botao4").click(function() { $( "#mapas" ).submit(); });
					$("#botao5").click(function() { $( "#mapas" ).submit(); });
				</script>
				';
				
				if (strlen($dd[1]) > 0)
					{
						$selectRegion = $dd[1];
					}
				
				$sx .= '
			        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
					<script type="text/javascript">
					  google.load(\'visualization\', \'1\', {packages:[\'geochart\']});      
					  google.setOnLoadCallback(drawChart);
					  
					  function drawChart() {
					    var data = google.visualization.arrayToDataTable([ 
					      [\'Lat\', \'Long\', \'Name\', \'Students\'], '.$st.']);
						
					var map   = new google.visualization.GeoChart(document.getElementById(\'map_div\'));
					var options = {
					//displayMode: \'markers\',
					//displayMode:\'text\',
					displayMode:\'auto\',
					colorAxis: {colors: [\'#FFFF00\', \'#CC0000\']},
					datalessRegionColor: \'#99CCFF\',
					region: \''.$selectRegion.'\',
					enableRegionInteractivity: \'automatic\'
				  };
					map.draw(data, options, {showTip: true});
			  }
    			</script>
				<div id="map_div" style="z-index:0;"></div>
				<div style="text-align: justify">Mapa</div>
				<style>
					#map_div
					{
					width: 740px;
					border: 2px solid #C0C0C0;
					}
				</style>
				';

                $sx .= '<BR><BR><H2>Estudantes da PUCPR por pa�ses</H2>';
				$sx .= '<table width=100% align=center class="tabela01">';
				$sx .= '<TR>';
				$sx .= '<TH width=10%  align="center">Estudantes<TH width=40%>Institui��o';
				$sx .= '<TH width=10%  align="center">Estudantes<TH width=40%>Institui��o';
				$sx .= $sq.'</table>';
			
				$sx .= '<TR>
							<colspan=4 align=left BGCOLOR="#99FF99 " valign="bottom">
							Total de <strong>'.$tot_instit.'</strong> institui��es destino do Interc�mbio,';
				$sx .= 	    " com <strong>".$tot_alunos."</strong> alunos enviados pela PUCPR.";
				$sx  .= '</table>';	

				return($sx);				
			}

//**************************** Fim do metodo *****************************************	
	
		
//####################################################################################                      
//**************************** Inicio do metodo b�sico**************************************
/* @method: paises_parceiros()
 *          conta estudantes por genero
 * @author Elizandro Santos de Lima[Analista de Projetos]
 * @date: 24/04/2015
 */			
	function query_todos()
	{
		
		$sql = "
				select * from (
							select count(*) as total, pb_colegio, pb_colegio_orientador 
							from pibic_bolsa_contempladas 
							where pb_tipo = 'S' 
							and (pb_status <> 'C' and pb_status <> '@')
							group by pb_tipo, pb_colegio, pb_colegio_orientador
							) as alunos
							left join 
									(select distinct inst_nome
									 from instituicao) as instituicao on pb_colegio = inst_nome
				";		 
					
				$rlt = db_query($sql);		 
					
			    $sx  = '<table>';
				$sx .= '<TR><TH colspan=2 align="left"><H2>query_todos()</h2>';
				$sx .= '<TR><TH width="5%"	>Institui��o
					    <TH width="5%"		>Local
							';
			
			$tot = 0;
			
			while ($line = db_read($rlt)){
				
				$tot++;					
	
				$sx .=  '<TR>';
				$nome 	= $line['pb_colegio'];
				$pais   = $line['pb_colegio_orientador'];					
				
				$sx .=  '<TD class="tabela01" align="left">'.$nome;
				$sx .=  '<TD class="tabela01" align="left">'.$pais;
				 
			
		}			
			$sx .=  '<TR>
						 	<TD colspan=6 align=right BGCOLOR="#C0C0C0" valign="bottom"><font color="white">Total de '.$tot.'</font>';
				$sx  .= '</table>';
			
			return($sx);			
					
					
	}			
//**************************** Fim do metodo *****************************************

			
//####################################################################################                      
//**************************** Inicio do metodo b�sico**************************************
/* @method: estudantes_genero()
 *          conta estudantes por genero
 * @author Elizandro Santos de Lima[Analista de Projetos]
 * @date: 24/04/2015
 */			
	function aluno_por_universidade()
	{
		
		$sql = "
				select * from (
							select count(*) as total, pb_colegio, pb_colegio_orientador, pa_nome 
							from pibic_bolsa_contempladas
							inner join pibic_aluno on pb_aluno = pa_cracha	 
							where pb_tipo = 'S' 
							and (pb_status <> 'C' and pb_status <> '@')
							group by pb_tipo, pb_colegio, pb_colegio_orientador, pa_nome
							) as alunos
							left join 
									(select distinct inst_nome
									 from instituicao) as instituicao on pb_colegio = inst_nome
								 
				";		 
					
				$rlt = db_query($sql);		 
					
			    $sx  = '<table>';
				$sx .= '<TR><TH colspan=2 align="left"><H2>aluno_por_universidade()</h2>';
				$sx .= '<TR>
						<TH width="50%"	>Aluno
						<TH width="35%"	>Institui��o
					    <TH width="15%"	>Local
						';
			
			$tot = 0;
			
			while ($line = db_read($rlt)){
				
				$tot++;					
	
				$sx .=  '<TR>';
				$nome_aluno   = $line['pa_nome'];
				$nome_inst 	= $line['pb_colegio'];
				$pais   = $line['pb_colegio_orientador'];
						
				$sx .=  '<TD class="tabela01" align="left">'.$nome_aluno;				
				$sx .=  '<TD class="tabela01" align="left">'.$nome_inst;
				$sx .=  '<TD class="tabela01" align="left">'.$pais;
			
		}			
			$sx .=  '<TR>
						 	<TD colspan=6 align=right BGCOLOR="#C0C0C0" valign="bottom"><font color="white">Total de '.$tot.'</font>';
				$sx  .= '</table>';
			
			return($sx);			
					
	}
//**************************** Fim do metodo *****************************************


//####################################################################################                      
//**************************** Inicio do metodo b�sico**************************************
/* @method: estudantes_genero()
 *          conta estudantes por genero
 * @author Elizandro Santos de Lima[Analista de Projetos]
 * @date: 24/04/2015
 */	
	function estudantes_genero()
	{	
		$sql = "
				select 
					CASE pa_genero 
						  WHEN 'M' THEN 'Masculino' 
						  WHEN 'F' THEN 'Feminino'   
						  ELSE 'atualizar' 
						END as genero,
					   count(*) as total
				from      pibic_bolsa_contempladas
				left join pibic_aluno on pb_aluno = pa_cracha
				where (pb_tipo = 'S')
				and (pb_status <> 'C' and pb_status <> '@')
				group by pa_genero
				order by genero desc
				";
				
		$rlt = db_query($sql);		 
					
			    $sx  = '<table>';
				$sx .= '<TR><TH colspan=2 align="left"><H2>Estudantes por genero</h2>';
				$sx .= '<TR><TH width="50%"	>Genero
							<TH width="50%"	>Total	
							';
			
			$tot = 0;
			
			while ($line = db_read($rlt)){
								
				$tot++;
				
				$genero_aluno 	= $line['genero'];
				$total_estudante   = $line['total'];						
				
				$sx .=  '<TR>';
				$sx.=   '<TD class="tabela01" align="left">'.$genero_aluno;
				$sx .=  '<TD class="tabela01" align="left">'.$total_estudante;
					
				}
		
		         $sx .=  '<TR>
						 	<TD colspan=6 align=right BGCOLOR="#C0C0C0" valign="bottom"><font color="white">Total de '.$tot.'</font>';
				 $sx  .= '</table>';
			
			return($sx);
		
	}
//**************************** Fim do metodo *****************************************


//####################################################################################                      
//**************************** Inicio do metodo b�sico**************************************
/* @method: estudantes_genero()
 *          Gera grafico por genero dos estudantes
 * @author Elizandro Santos de Lima[Analista de Projetos]
 * @date: 24/04/2015
 */	
	function grafico_estudantes_genero()
	{	
		$sql = "
				select 
					CASE pa_genero 
						  WHEN 'M' THEN 'Masculino' 
						  WHEN 'F' THEN 'Feminino'   
						  ELSE 'atualizar' 
						END as genero,
					   count(*) as total
				from      pibic_bolsa_contempladas
				left join pibic_aluno on pb_aluno = pa_cracha
				where (pb_tipo = 'S')
				and (pb_status <> 'C' and pb_status <> '@')
				group by pa_genero
				order by genero desc
				";
				
		$rlt = db_query($sql);		 
					
			$col = 99;   
			$st = '';
			$tot_alunos = 0;
			
			while ($line = db_read($rlt))
					 {
							$genero     = trim($line['genero']);
							$tota_gen   = $line['total'];

							if (strlen($tota_gen) > 0)
							{
								$tot_instit ++;
								$tot_alunos = $tot_alunos + $line['total'];
								
								$col++;
								
								if (strlen($st) > 0) 
									{
									  $st .= ', '.chr(13).chr(10); 	
									}
									$st .= '[\''.$genero.'\', '.$line['total'].']';
							}
						
					 }
					 
			$sx .= '
					<script type="text/javascript" src="https://www.google.com/jsapi"></script>
					<script type="text/javascript">
					  google.load(\'visualization\', \'1\', {packages:[\'corechart\']});
					  google.setOnLoadCallback(drawChart);
					  function drawChart() {
					
					    var data = google.visualization.arrayToDataTable([
					      	[\'Genero\', \'Total \'], '.$st.'],
							]);
					
					var options = {
					  title: \'Titulo Grafico\'
					};
					
					var chart = new google.visualization.PieChart(document.getElementById(\'piechart\'));
					
					    chart.draw(data, options);
					  }
					</script>
					 
   						<div id="piechart" style="width: 900px; height: 500px;"></div>
	  					<div style="text-align: center">Mapa</div>
						<style>
							#map_div
							{
							width: 740px;
							border: 2px solid #C0C0C0;
							}
						</style>
				';
				
			return($sx);
		
	}
//**************************** Fim do metodo *****************************************
			
}
?>
