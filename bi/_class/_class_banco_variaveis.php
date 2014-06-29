<?php
class banco_variavel
	{
	var $tabela = 'variaveis';
	var $tabela_dados = 'dados';
	
	function lista_variaveis()
		{
			$sql = "select * from ".$this->tabela."
					where v_ativo = 1 
					order by v_variavel ";
			$rlt = db_query($sql);
			$sx = '<Table width="100%">';
			$sx .= '<TR><TH width="15%">Variável
						<TH width="40%">Nome
						<TH width="40%">Descrição
						<TH width="5%">Atualizado
						<TH>Fonte';
			while ($line = db_read($rlt))
				{
					$page = page();
					$page = troca($page,'.php','_detalhe_php');
					$page = troca($page,'_detalhe_php','_detalhe.php');
					$link = '<A HREF="'.$page.'?varid='.trim($line['v_variavel']).'&dd1='.$line['v_codigo'].'">';
					$linke = '<A HREF="var_ed.php?dd0='.$line['id_v'].'&dd90='.checkpost($line['id_v']).'">editar</A>';
					$sx .= '<TR>';
					$sx .= '<TD class="tabela01"><NOBR>'.$link.$line['v_variavel'].'</A></nobr>';
					$sx .= '<TD class="tabela01"><B>'.$line['v_nome'].'</B>';
					$sx .= '<TD class="tabela01">'.$line['v_descricao'].'&nbsp;';
					$sx .= '<TD class="tabela01">'.$line['v_lastupdate'].'&nbsp;';
					$sx .= '<TD class="tabela01">'.$line['v_fonte'].'&nbsp;';
					$sx .= '<TD class="tabela01">'.$linke;
				}
			$sx .= '</table>';
			return($sx);
		}
	
	function exportar_lista($var,$fmt='HTML')
		{
			$codigo = $this->recupera_codigo($var);
			$sql = "select * from ".$this->tabela_dados." 
						inner join ".$this->tabela." on d_variavel = v_codigo
						
					where v_codigo = '$codigo' 
					order by d_fld1, d_fld2
					";
			$rlt = db_query($sql);
			$sh = '';
			$ok = array(0,0,0,0,0,0,0,0,0,0);
			$editar = 1;
			switch ($fmt)
				{
				case 'CVS':
						$as = '"';
						$suf = '';
						$pre = '';
						$sep = ',';
						$editar = 0;
					break;
				case 'XML':
						$suf = '<TR>';
						$pre = '<TD>';
						$sep = '</TD>';	
						$fim = '</tr>';
						$editar = 0;				
					break;
				case 'XLS':
						$as = '';
						$sta = '<table>';
						$suf = '<TR>';
						$pre = '<TD>';
						$sep = '</TD>';	
						$fim = '</tr>';	
						$sto = '</table>';
						$editar = 0;					
					break;	
				case 'HTML':
						$sta = '<table width="100%">';
						$suf = '<TR>';
						$pre = '<TD>';
						$sep = '</TD>';	
						$fim = '</tr>';	
						$sto = '</table>';					
						$editar = 1;
					break;					
				}

			while ($line = db_read($rlt))
				{
					$linke = '<A HREF="var_dados_ed.php?dd0='.$line['id_d'].'&dd90='.checkpost($line['id_d']).'">editar</A>';
					if (strlen($sh) == 0)
						{
							$sh .= $suf;
							$sh .= $pre.trim($line['v_col_01']).'/'.trim($line['v_col_02']).$sep;
							$sh .= $pre.'varid'.$sep;
							$sh .= $pre.trim($line['v_col_03']).$sep;
							$sh .= $pre.trim($line['v_col_04']).$sep;
							$sh .= $pre.trim($line['v_col_05']).$sep;
							$sh .= $pre.trim($line['v_col_06']);
							$sh .= chr(10).chr(13);
						}
					$sx .= $suf;
					$sx .= $pre.$as.trim($line['d_fld1']);
							if (strlen($line['d_fld2']) > 0) { $sx .='/'.trim($line['d_fld2']).$as; }
					$sx .= $sep;
					$sx .= $pre.$as.trim($line['v_variavel']).$as.$sep;
					$sx .= $pre.$as.trim($line['d_fld3']).$as.$sep;
					$sx .= $pre.trim($line['d_fld4']).$sep;
					$sx .= $pre.trim($line['d_fld5']).$sep;
					$sx .= $pre.trim($line['d_fld6']).$sep;				
					if (($editar==1) and ($line['d_lock'] != 'X')) {
						$sx .= $pre.$linke.$sep;
					}
					$sx .= $fim;
					$sx .= chr(13).chr(10);
				}
			$sx = $sta.$sh.$sx.$sto;
			return($sx);
		}
	
	function alimenta_lista($var,$vals=array())
		{
			$cod = $this->recupera_codigo($var);
			if (strlen($cod) > 0)
				{
					for($r=0;$r < count($vals);$r++)
						{
							$vars = $vals[$r];
							$this->grava_registro($cod,$vars);
						}
					return(1);
				} else {
					return(0);
				}
			
		}
		
	function grava_registro($codigo,$vars)
		{
			$fld1 = $vars[0];
			$fld2 = $vars[1];
			$fld3 = $vars[2];
			$fld4 = abs($vars[3]);
			$fld5 = abs($vars[4]);
			$fld6 = abs($vars[5]);
			
			$sql = "select * from ".$this->tabela_dados." 
					where d_variavel = '$codigo' 
							and d_fld1 = '$fld1'
							and d_fld2 = '$fld2' ";
			$rlt = db_query($sql);
			
			if ($line = db_read($rlt))							
				{
					if ($line['d_lock'] != '1')
						{
						$sql = "update ".$this->tabela_dados." set 
								d_fld3 = '$fld3',
								d_fld4 = '$fld4',
								d_fld5 = '$fld5',
								d_fld6 = '$fld6'
							where id_d = ".$line['id_d'];
						}
				} else {
					$sql = "insert into ".$this->tabela_dados."
							(
								d_variavel, 
								d_fld1, d_fld2, d_fld3,
								d_fld4, d_fld5, d_fld6,
								d_lock
							) values (
								'$codigo',
								'$fld1','$fld2','$fld3',
								'$fld4','$fld5','$fld6',
								0
							)
							";
				}
				$xrlt = db_query($sql);

		}
	function structure()
		{
			$sql = "alter table ".$this->tabela." add column v_descricao text";
			//$rlt = db_query($sql);
			
			$sql = "create table ".$this->tabela."
			(
				id_v serial not null,
				v_nome char(80),
				v_codigo char(7),
				v_update integer,
				v_variavel char(30),
				v_metodologia text,
				v_col_01 char(30),
				v_col_02 char(30),
				v_col_03 char(30),
				v_col_04 char(30),
				v_col_05 char(30),
				v_col_06 char(30).
				v_ativo integer
				)
			";
			
			$sql = "create table ".$this->tabela_dados."
				(
				id_d serial not null,
				d_variavel char(7),
				d_fld1 char(20),
				d_fld2 char(20),
				d_fld3 char(20),
				d_fld4 char(20),
				d_fld5 char(20),
				d_fld6 char(20),
				d_lock char(1)
				)
			";
			//$rlt = db_query($sql);
		}
	function cp_dados()
		{
			$cp = array();
			$c1 = 'v1 (texto)';
			$c2 = 'v2 (texto)';
			$c3 = 'v3 (texto)';
			$c4 = 'v4 (dados)';
			$c5 = 'v5 (dados)';
			$c6 = 'v6 (dados)';
			
			array_push($cp,array('$H8','id_d','',False, True));
			array_push($cp,array('$Q v_nome:v_codigo:select * from '.$this->tabela.' where v_ativo = 1 order by v_variavel','d_variavel','',True, True));
			array_push($cp,array('$S15','d_fld1',$c1,False, True));
			array_push($cp,array('$S15','d_fld2',$c2,False, True));
			array_push($cp,array('$S15','d_fld3',$c3,False, True));
			array_push($cp,array('$S15','d_fld4',$c4,False, True));
			array_push($cp,array('$S15','d_fld5',$c5,False, True));
			array_push($cp,array('$S15','d_fld6',$c6,False, True));
			array_push($cp,array('$C1','d_lock','Travado',False, True));
			return($cp);
		}
	function updatex()
		{
			global $base;
			$c = 'v';
			$c1 = 'id_'.$c;
			$c2 = $c.'_codigo';
			$c3 = 7;
			$sql = "update ".$this->tabela." set $c2 = lpad($c1,$c3,0) where $c2='' ";
			if ($base=='pgsql') { $sql = "update ".$this->tabela." set $c2 = trim(to_char(id_".$c.",'".strzero(0,$c3)."')) where $c2='' "; }
			$rlt = db_query($sql);
		}
					
	function cp()
		{
			//$sql = "alter table ".$this->tabela." add column v_fonte char(30);";
			//$rlt = db_query($sql);
			$cp = array();
			array_push($cp,array('$H8','id_v','',False,True));
			array_push($cp,array('$H8','v_codigo','',False,True));
			array_push($cp,array('$S30','v_variavel','Variável',False,True));
			array_push($cp,array('$S80','v_nome','Nome',False,True));
			array_push($cp,array('$U8','v_update','',False,True));
			array_push($cp,array('$T60:4','v_descricao','Descrição',False,True));
			array_push($cp,array('$T60:4','v_metodologia','Metodologia',False,True));
			
			array_push($cp,array('$O : &PUCPR:PUCPR&Externo:Externo','v_fonte','Fonte',True,True));
			
			array_push($cp,array('$S30','v_col_01','Name 1',False,True));
			array_push($cp,array('$S30','v_col_02','Name 2',False,True));
			array_push($cp,array('$S30','v_col_03','Name 3',False,True));
			array_push($cp,array('$S30','v_col_04','Name 4',False,True));
			array_push($cp,array('$S30','v_col_05','Name 5',False,True));
			array_push($cp,array('$S30','v_col_06','Name 6',False,True));
			array_push($cp,array('$O 1:Ativo&0:Inativo','v_ativo','Ativo',False,True));
			return($cp);
		}
	function recupera_codigo($var)
		{
			$sql = "select * from ".$this->tabela." where v_variavel = '".$var."'";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					return($line['v_codigo']);
				} else {
					return('');
				}
		}
	
	function mostra_variavel($line)
		{
			$sx = '<TR>';
			$sx .= '<TD>';
			$sx .= trim($line['v_nome']);
			$sx .= '<TD>';
			$sx .= trim($line['v_codigo']);
			$sx .= '<TD>';
			$sx .= trim($line['v_update']);
			return($sx);			
		}
	}
?>
