<?
    /**
     * Classe de Área do Conhecimento
	 * @author Rene Faustino Gabriel Junior <monitoramento@sisdoc.com.br> (Analista-Desenvolvedor)
	 * @copyright Copyright (c) 2011, PUCPR
	 * @access public
     * @version v0.11.30;
	 * @package Classe
	 * @subpackage Geral
     */
class area_do_conhecimento
	{
	var $area;
	var $tabela = "ajax_areadoconhecimento";
	function mostrar($area)
		{
		$rr = '';
		if ($area == 'H') { $rr = 'Ciências Humanas'; }
		if ($area == 'V') { $rr = 'Ciências da Vida'; }
		if ($area == 'S') { $rr = 'Ciências Sociais Aplicadas'; }
		if ($area == 'E') { $rr = 'Ciências Exatas'; }
		return($rr);
		}

function relatorio_areas($tp=0)
		{
			global $perfil,$nw;			
			if ($tp==0)
				{
					$sx = '<h1>'.msg('areas_todas').'</h1>';
					$wh = '';
				}			
			if ($tp==1)
				{
					$sx = '<h1>'.msg('areas_do_semic').'</h1>';
					$wh = ' where a_semic = 1 ';
				}
			if ($tp==3)
				{
					$sx = '<h1>Área de submissão</h1>';
					$wh = " where a_submit = '1' ";
				}
			
			$sql = "select * from ".$this->tabela."
				$wh 
				order by a_cnpq ";
			$rlt = db_query($sql);

			while ($line = db_read($rlt))
			{
				$s .= '<TR '.coluna().'>';
				$sf = '';
				$cnpq = trim($line['a_cnpq']);
				if (substr($cnpq,2,2) == '00')
					{
					$sf .= '<TD colspan="4"><B>';
					} else {
						if (substr($cnpq,5,2) == '00')
						{
						$sf .= '<TD><TD colspan="3"><I>';
						} else {
						if (substr($cnpq,8,2) == '00')
							{
							$sf .= '<TD><TD><TD colspan="2">';
							} else {
							$sf .= '<TD>&nbsp;&nbsp;<TD>&nbsp;&nbsp;<TD>&nbsp;&nbsp;<TD>';
							}
						}		
					}
				$s .= '<TD align="center"><TT>';
				$s .= $line['a_cnpq'];
				$s .= ''.$sf;
				$s .= $line['a_descricao'];
				//if (($perfil->valid('#ADM#PIB#COO')))
				//	{
				//		$s .= '<TD>a';
				//	}
			}
			$sx .= '<table width="100%" class="tabela00">'.chr(13);
			$sx .= '<TR>'.chr(13);
			$sx .= '<TH width="20%">Código CNPq'.chr(13);
			$sx .= '<TH colspan="5">Descrição'.chr(13);
			$sx .= $s;
			$sx .= '</table>';
			return($sx);
	}		
	function row()
		{
			global $cdf,$cdm,$masc;
				$cdf = array('id_aa','a_cnpq','a_descricao','a_semic','a_submit');
				$cdm = array('Código','cpnq','descricao','SEMIC','SUBMISSÃO');
				$masc = array('','','','','','S','S');
		}
	function cp()
		{
			$cp = array();
			array_push($cp,array('$H8','id_aa','id_aa',False,True,''));
			array_push($cp,array('$S100','a_descricao','Nome',False,True,''));
			array_push($cp,array('$S14','a_cnpq','Sigla',False,True,''));
			array_push($cp,array('$H7','a_codigo','Codigo',False,True,''));
			array_push($cp,array('$H7','a_geral','Use',False,True,''));
			array_push($cp,array('$O 1:Sim&0:Não','a_semic','Habilitado para o SEMIC',True,True,''));
			array_push($cp,array('$O 1:Sim&0:Não','a_submit','Habilitado para o SUBMISSAO',True,True,''));
			return($cp);
		}
	}