<?
				if (strlen($dd[22]) > 0)
				{
				$nome = '';
				$emailpara = array();
				$xsql = "select * from pareceristas where us_codigo = '".$dd[22]."' ";
				$xrlt = db_query($xsql);
				while ($xline = db_read($xrlt))
					{
					$nome = trim(trim($xline['us_titulacao']).' '.$xline['us_nome']);
					$email = trim($xline['us_email']);
					if (strlen($email) > 0) { array_push($emailpara,$email); }
					$email = trim($xline['us_email_alternativo']);
					if (strlen($email) > 0) { array_push($emailpara,$email); }
					}
				$lk = $http_site.'parecerista_parecer.php?dd0='.$dd[0].'&dd1='.p($dd[0].$dd[22]).'&dd2='.$dd[22];
				$linkp = '<A HREF="'.$lk.'" target="newz">';
				$linkp .= '<font class="lt1"><B>';
				$linkp .= $lk;
				$linkp .= '</B></A>'.$nl;
				///////////////////////// trocas
				$texto = troca($texto_original,'$parecer_link',$linkp);
				$texto = troca($texto,'$parecerista',$nome);
				
				echo mst($texto);
				echo '<HR>';
				echo 'confirmação de submissão enviado para:<BR>';
				for ($em = 0;$em < count($emailpara);$em++)
					{
//					if ($destino == true)
					enviaremail($emailpara[$em],$emailadmin,'AVALIAÇÃO - PIBIC PUCPR',($texto));
					enviaremail('pibicpr@pucpr.br',$emailadmin,'(copia) AVALIAÇÃO - PIBIC PUCPR',($texto));
					echo $emailpara[$em].'<BR>';
					}
				/////////////////////////////// Grava pré parecer
				$sql = "insert into pibic_parecer_enviado ";
				$sql .= "(pp_nrparecer,pp_tipo,pp_protocolo,";
				$sql .= "pp_protocolo_mae,pp_avaliador,pp_status,";
				$sql .= "pp_data,pp_hora,pp_parecer_data,pp_ano";
				$sql .= ") values (";
				$sql .= "'','I','".$protocolo."',";
				$sql .= "'".$protocolo."','".$dd[22]."','I',";
				$sql .= "'".date("Ymd")."','".date("H:i")."',19000101,'".date("Y")."'";
				$sql .= ")";
				$xrlt = db_query($sql);					
				}

?>