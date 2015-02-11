<?php
class docentesRH
	{
	function inport_file($txt)
		{
			$txt = troca($txt,chr(13),'¢');
			$txt = troca($txt,chr(10),'');
			$ln = splitx('¢',$txt);
			$xnome = '';
			for ($r=1;$r < 50;$r++)
				{
					$ln[$r] = troca($ln[$r],';;',';0;');
					$nn = splitx(';',$ln[$r].';');
					
					$nome = trim($nn[0]);
					$cracha = $this->trata_cracha(trim($nn[1]));
					$titulacao = $this->trata_titulacao(trim($nn[2]));
					$campus = $this->trata_campus(trim($nn[6]));
					$escola = UpperCase(trim($nn[7]));
					$curso = UpperCase(trim($nn[8]));

					if ($cracha != $xnome)
						{
							$xnome = $cracha;					
							echo '<HR>';
							echo 'Nome: '.$nome;
							echo '<BR>Cracha: '.$cracha;
							echo '<BR>Titulacao: '.$titulacao .' '.$nn[2];
							echo '<BR>Campus: '.$campus;
							echo '<BR>Escola: '.$escola;
							echo '<BR>Curso: '.$curso;
						}
					$h1 = round($nn[18]);
					$h2 = round($nn[19]);
					$h3 = round($nn[10]);
					$h4 = round($nn[21]);
					$h5 = round($nn[22]);
					$h6 = round($nn[23]);
					$h7 = round($nn[24]);
					$h8 = round($nn[25]);						
					
				}
		}
	function trata_campus($cap)
		{
			switch($cap)
				{
				case 'Curitiba': 				$cap = 'PUC CURITIBA'; break;
				case 'Londrina': 				$cap = 'PUC LONDRINA'; break;
				case 'São José dos Pinhais': 	$cap = 'PUC SAO JOSE'; break;
				case 'Toledo': 					$cap = 'PUC TOLEDO'; break;
				case 'Maringá': 				$cap = 'PUC MARINGA	'; break;
				default:
					$cap = '???'; break;
				
				}
			return($cap);
		}		
	function trata_titulacao($tit)
		{
			switch($tit)
				{
				case 'Mestre': $tit = '001'; break;
				case 'Doutor': $tit = '002'; break;
				case 'Especialista': $tit = '005'; break;
				case 'Graduado': $tit = '009'; break;
				case 'Residência Médica': $tit = '010'; break;
				default:
					$tit = '???'; break;
				
				}
			return($tit);
		}		
	function trata_cracha($cracha)
		{
			if (strlen($cracha) > 8)
				{
					$cracha = substr($cracha,3,8);
				}
			return($cracha);
		}
		
	function atualiza_cadastro_professor($cracha,$nome,$titulacao)
		{
			
		}
		
	function structure()
		{
		$sql = "CREATE TABLE pibic_professor
					( 
					id_pp serial NOT NULL, 
					pp_nome char(100), 
					pp_nome_asc char(100), 
					pp_nasc char(10), 
					pp_codigo char(7), 
					pp_cracha char(15), 
					pp_login char(30), 
					pp_escolaridade char(20), 
					pp_titulacao char(5), 
					pp_carga_semanal int4 DEFAULT 0, 
					pp_ss char(1), 
					pp_cpf char(20), 
					pp_negocio char(30), 
					pp_centro char(50), 
					pp_curso char(50), 
					pp_telefone char(20), 
					pp_celular char(20), 
					pp_lattes char(100), 
					pp_email char(100), 
					pp_email_1 char(100), 
					pp_senha char(20), 
					pp_endereco text, 
					pp_afiliacao char(7), 
					pp_ativo int4 DEFAULT 1, 
					pp_grestudo text, 
					pp_prod int8 DEFAULT 0, 
					pp_ass char(100), 
					pp_escola char(5), 
					pp_update char(4), 
					pp_avaliador int4, 
					pp_comite int4, 
					pp_curso_cod char(5), 
					pp_nome_lattes char(100), 
					pp_livredocencia char(1), 
					pp_posdoc char(1), 
					pp_bl char(1), 
					pp_bl_motivo text, 
					pp_cited char(100), 
					pp_funcao char(100), 
					pp_fc float8 
					); 
		";
		$rlt = db_query($sql);
		}
		
	}
?>

