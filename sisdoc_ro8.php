<?
/////////////// versao
global $format, $encode, $limit, $offset;
$encode = "UTF-8";
$eof = chr(13);
function ro8() {
	global $eof, $vars, $format, $verbo, $encode, $limit, $offset;
	$verbo = strtolower($vars['verbo']);
	$format = trim(strtolower($vars['format']));
	$offset = trim(strtolower($vars['offset']));
	$date = trim(strtolower($vars['date']));
	$enddate = trim(strtolower($vars['enddate']));
	$encode = trim(strtolower($vars['encode']));
	$base = trim(strtolower($vars['base']));

	if (strlen($base) > 0) {
		if (file_exists($base)) {
			require ($base);
		} else { echo 'Arquivo "<B>' . $base . '</B>" não existe';
			exit ;
		}
	}

	$ro_ok = 0;
	/////////////////////////////////////////// header
	$content_type = 'text/html';
	$charset = 'ISO-8859-1';
	if (strlen($format) == 0) { $format = 'xml';
	}
	if ($format == "xml") { $content_type = 'application/xml';
	}
	if (($format == "sql") or ($format == "txt")) { $content_type = 'text/plain';
	}

	if ($encode == 'UTF-8') { $charset = 'utf-8';
	};
	header('content-type: ' . $content_type . '; charset: ' . $charset);
	////////////////////////////////////////////////////

	if ($verbo == 'tables') { $ro8 = ro8_table();
		$ro_ok = 1;
	}

	if ($verbo == 'totalrecord') { $ro8 = ro8_totalrecord();
		$ro_ok = 1;
	}

	if ($verbo == 'listrecord') { $ro8 = ro8_listrecord();
		$ro_ok = 1;
	}

	if ($verbo == 'tablestruture') { $ro8 = ro8_tablestruture();
		$ro_ok = 1;
	}

	if ($ro_ok == 0) { $ro8 = ro8_erro(array('999', 'Verbo incorreto'));
	};
	$ro8 = ro8_cab() . $eof . $ro8 . ro8_foot() . $eof;
	return ($ro8);
}

/////////////////////////////// VERBO TABLE STRUTURE
function ro8_tablestruture() {
	global $base, $eof, $vars, $limit, $offset, $encode, $format;
	// --- parametros
	$cr = chr(13) . chr(10) . '<BR>';
	$table = $vars['table'];
	$owner = $vars['owner'];
	$ro8 = ro8_checktable($table);
	if (strlen($ro8) == 0) {
		$ro_sql = "SELECT column_name,udt_name,character_maximum_length,ordinal_position,table_catalog, ";
		$ro_sql .= " table_schema,table_name,column_default,is_nullable FROM information_schema.columns ";
		$ro_sql .= " WHERE table_name = '" . $table . "' order by ordinal_position ";
		//			echo $ro_sql;

		$ro_rlt = db_query($ro_sql);
		$ro8 .= ro8_wr('tablename', $table);
		///////////////////////////////////////////

		if (($format != 'sql') and ($format != 'cp')) {
			while ($ro_line = db_read($ro_rlt)) {
				if ($format != 'doc') { $ro8 .= ro8_hd('structure');
				}

				$ro_key = array_keys($ro_line);
				for ($k = 0; $k < count($ro_line); $k++) {
					$fld = trim($ro_key[$k * 2 + 1]);
					if (strlen($fld) > 0) { $ro8 .= ro8_wr($ro_key[$k * 2 + 1], $ro_line[$k]);
					}
				}
				$ro8 .= ro8_ft('structure');
			}
		} else {
			if ($format == 'sql') {
				////////// estrutura SQL
				$ro8 .= "-- DROP TABLE " . $table . chr(13) . chr(10);
				$ro8 .= "" . chr(13) . chr(10);
				$ro8 .= "CREATE TABLE " . $table . chr(13) . chr(10);
				$ro8 .= "( " . chr(13) . chr(10);
			}
			///////// estrutura CP
			if ($format == 'cp') {
				////////// estrutura SQL
				$ro8 .= "<PRE>";
				$ro8 .= '////////////////////////////////////////////////////' . chr(13);
				$ro8 .= '////// Sistema RO8-CP [v0.11.01]                 ///' . chr(13);
				$ro8 .= "////// by Rene Faustino Gabriel Junior           ///" . chr(13);
				$ro8 .= "////// gerado em " . date("d/m/Y H:i:s") . '             ///' . chr(13);
				$ro8 .= '////////////////////////////////////////////////////' . chr(13);
				$ro8 .= "</PRE><TT>";
				$ro8 .= '$tabela = ' . chr(39) . $table . chr(39) . ';' . $cr;
			}

			$col = 0;
			while ($ro_line = db_read($ro_rlt)) {
				$field = $ro_line['column_name'];
				$tipo = $ro_line['udt_name'];
				$size = $ro_line['character_maximum_length'];
				$null = $ro_line['is_nullable'];
				$defa = $ro_line['column_default'];
				if ($null == "NO") {$null = "NOT NULL";
				} else { $null = '';
				}
				if (substr($defa, 0, 7) == 'nextval') { $pkey = $field;
					$tipo = "serial";
					$defa = '';
				}
				if (strlen($defa) > 0) { $defa = "DEFAULT " . $defa;
				}
				if ($tipo == 'bpchar') { $tipo = "char(" . $size . ")";
				}

				//////////////////////////////////////////////////////////////////////////// CP
				$tp_tipo = $tipo;
				//							if ($tipo == 'serial') { $tp_tipo = '$H8'; }
				if ($tipo == 'int8') { $tp_tipo = '$I8';
				}
				if ($tipo == 'int2') { $tp_tipo = '$SN';
				}
				if ($tipo == 'int4') { $tp_tipo = '$I8';
				}

				if (strlen($size) > 0) { $tp_tipo = '$S' . $size;
				}
				if (strpos($field, 'data') > 0) { $tp_tipo = '$D8';
				}
				if (strpos($field, 'date') > 0) { $tp_tipo = '$D8';
				}
				if (strpos($field, '_dt') > 0) { $tp_tipo = '$D8';
				}
				if (strpos($field, 'update') > 0) { $tp_tipo = '$U8';
				}

				if ($col == 0) { $tp_tipo = '$H8';
				}

				if ($format == 'cp') {
					$ro8 .= 'array_push($cp,array(' . chr(39);
					$ro8 .= $tp_tipo;
					$ro8 .= chr(39) . ',' . chr(39);
					$ro8 .= $field;
					$ro8 .= chr(39) . ',' . chr(39);
					$ro8 .= $tp_nome;
					$ro8 .= "',False,True,''));" . $cr;
				}
				//////////////////////////////////////////////////////////////////////////// HTML
				if ($format == 'sql') {
					if ($col > 0) { $ro8 = trim($ro8) . ', ' . chr(13) . chr(10);
					}
					$ro8 .= $field . ' ' . $tipo . ' ' . $null . $defa;
				}
				$col++;
			}
			if ($format == 'sql') {
				$ro8 .= chr(13) . chr(10) . "); " . chr(13) . chr(10);
				if (strlen($pkey) > 0) { $ro8 .= chr(13) . chr(10) . "ALTER TABLE " . $table . " ADD CONSTRAINT " . $pkey . " PRIMARY KEY(" . $pkey . ");" . chr(13) . chr(10);
				}
				$ro8 .= chr(13) . chr(10) . '-- CREATE INDEX ld_campo ON ' . $table . ' (ld_campo)' . chr(13) . chr(10);
			}
		}
	}
	return ($ro8);
}

/////////////////////////////// VERBO LIST RECORD
function ro8_listrecord() {
	global $base, $eof, $vars, $limit, $offset, $encode, $format;
	// --- parametros
	$table = $vars['table'];
	$limit = $vars['limit'];
	$owner = $vars['owner'];
	if (strlen($limit) == 0) { $limit = 100;
	}
	if (strlen($offset) == 0) { $offset = 0;
	}
	$ro8 = ro8_checktable($table);
	if (strlen($ro8) == 0) {
		$ro_sql = "select * ";
		$ro_sql .= " from " . $table;	
		$ro_rlt = db_query($ro_sql);
		$ro_line = db_read($ro_rlt);
		$ro_key = array_keys($ro_line);
		$fld = trim($ro_key[1]);
		
		$ro_sql = "select * ";
		$ro_sql .= " from " . $table;
		$ro_sql .= " order by ".$fld; 
		if ($limit > 0) { $ro_sql .= ' limit ' . $limit;
		}
		if (strlen($offset) == 0) { $offset = 0;
		}
		if ($offset > 0) { $ro_sql .= ' offset ' . $offset;
		}
		if ($format == "sql") { $ro8 .= '--- table ' . $table . ', offset ' . $offset . ', limit ' . $limit . chr(13) . chr(10);
		}
		$ro_rlt = db_query($ro_sql);
		$totr = 0;
		while ($ro_line = db_read($ro_rlt)) {
			$ro_key = array_keys($ro_line);
			if ($totr == 0) {
				
				for ($k = 0; $k < count($ro_line); $k++) {
					$fld = trim($ro_key[$k * 2 + 1]);
					if ($format == "html")
						{
							$ro8 .= '<TR>';
							$ro8 .= '<TH>' . $fld;
						}
				}
			}
			$totr++;
			if ($format == "sql") {
				$ro8v = '';
				$ro8 .= "insert into " . $table . '(';
				for ($k = 1; $k < count($ro_line); $k++) {
					$fld = trim($ro_key[$k * 2 + 1]);
					if (strlen($fld) > 0) {
						if (strlen($ro8v) > 0) { $ro8 .= ',';
							$ro8v .= ',';
						}
						$ro8 .= $ro_key[$k * 2 + 1];
						$ro8v .= chr(39) . CharE(trim($ro_line[$k])) . chr(39);
					}
				}
				$ro8 .= ') values (' . $ro8v . '); ' . chr(13) . chr(10);
			} else {
				$ro8 .= ro8_hd('record');
				//				print_r($ro_key);
				for ($k = 0; $k < count($ro_line); $k++) {
					$fld = trim($ro_key[$k * 2 + 1]);
					if (strlen($fld) > 0) { $ro8 .= ro8_wr($ro_key[$k * 2 + 1], $ro_line[$k]);
					}
				}
				$ro8 .= ro8_ft('record');
				//				print_r($ro_line);
			}
		}
		if (($totr > 0) and ($format == "sql")) { $ro8 = '-- total de ' . $totr . ' registros' . chr(13) . chr(10) . $ro8;
		}
	}
	return ($ro8);
}

////////////////////////////////////// checa tabela
function ro8_checktable($ro_table) {
	global $base;
	if (strlen($ro_table) == 0) {
		return (ro8_erro(array("010", 'tabela não informada')));
		exit ;
	}

	if ($base == "pgsql") { $ro_sql = "select * from pg_tables where (tablename='" . $ro_table . "') and (schemaname='public')";
	}

	if (strlen($ro_sql) > 0) {
		$ro_rlt = db_query($ro_sql);
		if (!($line = db_read($ro_rlt))) {
			return (ro8_erro(array("011", 'tabela não existe')));
			exit ;
		} else {
			return ("");
		}
	}
	return (ro8_erro(array('000', 'Tipo da base de dados não foi informado')));
	exit ;
}

/////////////////////////////// VERBO TOTAL RECORD
function ro8_totalrecord() {
	global $base, $eof, $vars, $offset, $date, $enddate;
	// --- parametros
	$table = $vars['table'];
	$offset = $vars['offset'];
	$limit = $vars['limit'];
	$owner = $vars['owner'];
	// ---
	$ro8 = ro8_checktable($table);
	if (strlen($ro8) == 0) {
		$ro_sql = "select count(*) as total ";
		$ro_sql .= " from " . $table;
		$ro_rlt = db_query($ro_sql);
		$ro_line = db_read($ro_rlt);
		$ro8 .= ro8_hd('table');
		$ro8 .= ro8_wr('name', $table);
		$ro8 .= ro8_wr('totalrecord', $ro_line['total']);
		$ro8 .= ro8_wr('lastupdate', $ro_line['update']);
		$ro8 .= ro8_ft('table');
	}
	return ($ro8);
}

/////////////////////////////// VERBO TABLE
function ro8_table() {
	global $base, $eof;
	if ($base == "pgsql") { $ro_sql = "select * from pg_tables where schemaname='public' order by tablename";
	}

	////////// ERRO 000
	$ro8 = '';
	if (strlen($ro_sql) > 0) {
		$ro_rlt = db_query($ro_sql);
		while ($ro_line = db_read($ro_rlt)) {
			$dono = $ro_line['tablename'];
			if ($dono = 'postgres') { $dono = 'public';
			}

			$ro8 .= ro8_hd('table');
			$ro8 .= ro8_wr('name', $ro_line['tablename']);
			$ro8 .= ro8_wr('description', $ro_line['table_description']);
			$ro8 .= ro8_wr('owner', $dono);
			$ro8 .= ro8_ft('table');
		}
	} else { $ro8 = ro8_erro(array('000', 'Tipo da base de dados não foi informado'));
	}
	return ($ro8);
}

////////////////////////////////////////////////////////////////////////////////////
function ro8_erro($ro) {
	global $eof, $format, $vars;
	if ($format == 'xml') {
		$ero8 = "<error>" . $eof;
		$ero8 .= "<coderro>" . ro8_codec($ro[0]) . "</coderro>" . $eof;
		$ero8 .= "<descerro>" . ro8_codec($ro[1]) . "</descerro>" . $eof;
		$ero8 .= '</error>' . $eof;
	} else {
		$ero8 = 'ERRO:' . $ro[0] . ' - ' . $ro[1];
	}
	return ($ero8);
}

///////////////////////////////////////////// HEADER LINE
function ro8_hd($hd) {
	global $format, $eof;
	if ($format == 'xml') { $re = '<' . $hd . '>' . $eof;
	}
	if (($format == 'xls') or ($format == 'html') or ($format == 'doc')) { $re = '<TR>';
	}
	if ($format == 'txt') { $re = '';
	}
	if ($format == 'cvs') { $re = '';
	}
	return ($re);
}

///////////////////////////////////////////// FOOT LINE
function ro8_ft($hd) {
	global $format, $eof;

	if ($format == 'xml') { $re = '</' . $hd . '>' . $eof;
	}
	if (($format == 'xls') or ($format == 'html')) { $re = '</TR>' . chr(13) . chr(10);
	}
	if (($format == 'doc') or ($format == 'html')) { $re = '</TR>' . chr(13) . chr(10);
	}
	if ($format == 'txt') { $re = '""' . chr(13) . chr(10);
	}
	if ($format == 'cvs') { $re = '' . chr(13) . chr(10);
	}
	return ($re);
}

///////////////////////////////////////////// WRITE
function ro8_wr($hd, $vl) {
	global $format;
	if ($format == 'xml') {
		$re = '<' . $hd . '>';
		$re .= ro8_codec(trim($vl));
		$re .= '</' . $hd . '>' . chr(13) . chr(10);
	}

	if (($format == 'xls') or ($format == 'html') or ($format == 'doc')) {
		if (substr($vl, 0, 7) == 'nextval') { $vl = 'serial';
		}
		$re .= '<TD>' . trim($vl) . '</TD>';
	}

	if ($format == 'txt') { $re .= '"' . $vl . '",';
	}
	if ($format == 'cvs') { $re .= $vl . ';';
	}

	return ($re);
}

//////////////////////////////////////////////////////// HEAD REQUEST
function ro8_cab() {
	global $verbo, $format, $encode, $limit, $offset;
	global $base_host, $base_name, $base, $vars;
	$eof = chr(13) . chr(10);
	if (($format == 'doc')) {
		header("Content-type: application/msword");
		header("Content-Disposition: attachment; filename=users.doc");
		$ro8c = '<style>' . chr(13);
		$ro8c .= 'body	{' . chr(13);
		$ro8c .= '	text-align: left;' . chr(13);
		$ro8c .= '	font-family: verdana, helvetica, sans-serif;' . chr(13);
		$ro8c .= '	font-size: 20px;' . chr(13);
		$ro8c .= '	}' . chr(13);
		$ro8c .= '</style>' . chr(13);
		$ro8c .= '<center><font style="font-size:44px;"><TT>' . $vars['table'] . '</TT></font></center><BR>';
		$ro8c .= '<TABLE width="550" border=1 cellpadding="4" cellspacing="0">';
		$ro8c .= '<TR><TD align="right">Servidor</TD><TD><B><font style="font-size:16px;">' . $base_host . '</B></TD>';
		$ro8c .= '<TD align="right">Base</TD><TD><B>' . $base_name . '</B></TD></TR>';
		$ro8c .= '<TR><TD align="right">Tabela</TD><TD><B><font style="font-size:16px;">' . $vars['table'] . '</B></TD>';
		$ro8c .= '<TD align="right">SGBD</TD><TD><B>' . $base . '</B></TD></TR>';
		$ro8c .= '<TR><TD align="right">Data</TD><TD><B>' . date("d/m/Y H:i") . '</B></TD></TR>';
		$ro8c .= '</TABLE><CENTER>';
		$ro8c .= '<BR><BR><font style="font-size:26px;">Modelo de dados</font><BR><BR></CENTER>';
		$ro8c .= '<TABLE width="100%" border=1 cellpadding="4" cellspacing="0">';
		$ro8c .= '<TR bgcolor="#c0c0c0"><TH>field</TH>';
		$ro8c .= '<TH>type</TH>';
		$ro8c .= '<TH>size</TH>';
		$ro8c .= '<TH>order</TH>';
		$ro8c .= '<TH>own</TH>';
		$ro8c .= '<TH>server</TH>';
		$ro8c .= '<TH>tabela</TH>';
		$ro8c .= '<TH>default</TH>';
		$ro8c .= '<TH>content</TH>';
		$ro8c .= '<TH>-</TH>';
		$ro8c .= '</TR>';
	}

	if (($format == 'xls') or ($format == 'html')) { $ro8c = '<TABLE width="100%" border=1>';
	}

	if ($format == 'xml') {
		$ro8c = '<?xml version="1.0" encoding="ISO-8859-1"?>' . $eof;
		$ro8c .= '<ro8 xmlns="http://www.openarchives.org/OAI/2.0/" ' . $eof;
		$ro8c .= ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">' . $eof;
		$ro8c .= '<responseDate>' . date("Y-m-d") . 'T' . date("H:i:s") . '</responseDate>' . $eof;
		$ro8c .= '<format>' . $format . '</format>' . $eof;
		$ro8c .= '<verbo>' . $verbo . '</verbo>' . $eof;
		if (strlen($limit) > 0) { $ro8c .= '<limit>' . $limit . '</limit>' . $eof;
		}
		if (strlen($offset) > 0) { $ro8c .= '<offset>' . $offset . '</offset>' . $eof;
		}
	}

	return ($ro8c);
}

//////////////////////////////////////////////////////// HEAD FOOT
function ro8_foot() {
	global $format;
	if ($format == 'xml') { $ro8c = "</ro8>";
	}
	if (($format == 'xls') or ($format == 'html') or ($format == 'doc')) { $ro8c = "</table>";
	}
	return ($ro8c);
}

//////////////////////////////////////////////////////// HEAD ENCODE
function ro8_codec($ro_str) {
	global $encode;
	$ro_str = trim($ro_str);
	if ($encode == 'UTF-8') { $ro_str = utf8_encode($ro_str);
	}
	$ro_str = troca($ro_str,'<','&lt;');
	$ro_str = troca($ro_str,'>','&rt;');
	$ro_str = troca($ro_str,'&','[e]');
	return ($ro_str);
}
?>