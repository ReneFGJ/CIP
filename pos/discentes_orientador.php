<?
$breadcrumbs = array();
require ("cab_pos.php");

require ("../include/sisdoc_debug.php");

require ("../_class/_class_docentes.php");
$doc = new docentes;


$sql = "SELECT * 
        FROM programa_pos 
        WHERE pos_corrente = '1' 
        ORDER BY pos_nome";

$rlt = db_query($sql);


/* Montar o Select de consulta */

if ($perfil->valid('#ADM')){
    $op = ' :Selecione uma opção';
} else {
    $op = '';        
}

$prg = array();

while ($line = db_read($rlt)) {
    $per = trim($line['pos_secretaria_peril']);
    if ($perfil->valid($per)){
        //mostrar apenas o curso vinculado a secretaria
        array_push($prg,trim($line['pos_codigo']));
        if (strlen($op) > 0) {
             $op .= '&'; 
        }
        $op .= trim($line['pos_codigo']).':'.trim($line['pos_nome']);
        $dd[1] = $line['pos_codigo'];
        $secretaria = 1;
        //echo "secretaria<br>";
    }
    if($perfil->valid('#ADM')){
        //mostrar todos os cursos para escolha, perfil administrativo
        array_push($prg,trim($line['pos_codigo']));
        if (strlen($op) > 0) {
            $op .= '&'; 
        }
        $op .= trim($line['pos_codigo']).':'.trim($line['pos_nome']); 
        $secretaria = 0;
        //echo "administrador<br>"; 
        //break;      
    }
}



if ($dd[1]!="") {
    $sql2 = "SELECT DISTINCT(pf.pp_nome), pf.id_pp 
         FROM pibic_professor AS pf, programa_pos_docentes as ppd  
         WHERE ppd.pdce_programa = '$dd[1]'
         AND pf.pp_ativo = '1'
         AND pf.pp_cracha = ppd.pdce_docente
         ORDER BY pf.pp_nome";
    $rlt2 = db_query($sql2);

    $arrDoc = array();
    $op2 = " :-- Todos os professores do programa"; // coloca um dado branco no inicio do select dos professores
    while ($line2 = db_read($rlt2)){
        array_push($arrDoc,trim($line2['id_pp']));
        if (strlen($op2) > 0) { $op2 .= '&'; }
        $op2 .= trim($line2['id_pp']).':'.trim($line2['pp_nome']);
    }
}



//print_r($op2);

require ($include . "_class_form.php");
$form = new form;

$cp = array();
/*
if (count($prg) == 1){
    $mostraDoc = true;   
}else{
    $mostraDoc = false;
}
*/



array_push($cp, array('$H8', '', '', False, False));
array_push($cp, array('$O '.$op, '', 'Selecione o PPG', True, True));
if($dd[1]!=""){
    array_push($cp, array('$O '.$op2, '', 'Selecione o Docente', False, False));
}else{
    array_push($cp, array('$H8 ','', '', False, False)); // necesario para não dar erro de injection
}
//array_push($cp,array('$O C:Cursando&T:Titulodo&A:Aguardando Entrega da Dissertação&X:Cancelado&R:Trancado','','',False,False));
echo $form -> editar($cp, '');

/* se tiver somente um programa passa direto */
if (count($prg) == 1){
    $form -> saved = 1;
    $dd[1] = $prg[0];
}


if ($form -> saved > 0) {    
    require ("../_class/_class_discentes.php");
    $dis = new discentes;

    /* Recupera nome dos alunos não inseridos */
    $crachas = $doc -> docente_orientacao_sem_nome_aluno();

    if (count($crachas) > 0) {
        for ($r = 0; $r < count($crachas); $r++) {
            $crac = $crachas[$r];
            echo '<BR>Consultando ' . $crac;
            $cracha = $crachas[$r];
            $debug = 0;
            //echo '<div style="diplay: none;">';
            //require ('../pibicpr/pucpr_soap_pesquisaAluno.php');
            //echo '</div>';
        }
    }
    if (count($crachas) > 0) {
        echo '<BR>Buscando nome de ' . count($crachas) . ' alunos<BR>';
    }

    $doc -> docente_orientacao_excluir_cancelados();

    echo '<h3>Fluxo Discente</h3>';
    //echo "dd1: ".$dd[1];

    echo $doc -> docentes_orientacoes($dd[1], '', $dd[2]);
}
require ("../foot.php");
?>