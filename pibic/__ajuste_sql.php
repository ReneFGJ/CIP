<?php
require('cab.php');

require($include.'../_include/_class_form.php');
$cp = array();
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$T80:6','','',TRUE,True));

$form = new form;
$tela = $form->editar($cp,'');
echo $tela;

$sql = "
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89259458';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88923405';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88891545';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89262342';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88991092';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89168004';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '70004228';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88896373';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '70003041';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '70004956';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '70004989';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89055185';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88894745';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89118635';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89280404';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88891633';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89072791';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88907348';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '70001021';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '70005839';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '19203422';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '70004693';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89249955';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89053849';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '20007285';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '70006670';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88894012';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88906793';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89094924';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '19405427';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88919582';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '10040799';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89244339';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89246273';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '70005187';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89080168';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88888986';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88891668';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '70000903';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89118628';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89135401';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88925519';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '70006489';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89247786';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89118948';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88891836';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88888959';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89188073';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88967427';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88953520';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88891318';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88888988';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89117330';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '10075593';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '70006986';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88934636';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89245024';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89193729';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88890414';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '19502549';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89060138';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88890768';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89018127';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89155113';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89167931';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '70004245';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89084129';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '70000847';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88906468';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '70006885';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '70003301';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88890012';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88969978';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88928632';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88948591';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88910689';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88920130';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88986405';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89190495';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88945125';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '10025245';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89167841';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88888900';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89291168';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88916146';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89018252';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89259736';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '10016192';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '70001556';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88894719';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89086689';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '20007279';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89049814';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89154743';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89094354';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88891752';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88964048';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '70000896';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89168299';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '70001302';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88888973';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '89244780';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '70006534';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '70005262';
update pibic_professor set pp_ch = 'HR' where pp_cracha = '88891956';
";
$rlt = db_query($sql);
while ($line = db_read($rlt))
{
	print_r($line);
	echo '<HR>';
}

if ($form->saved > 0)
	{
		$sql = $dd[1];
		$rlt = db_query($sql);
	}
?>