<?php

include '../core/codon.config.php';
echo '<pre>';

Config::Set('PIREP_CHECK_DUPLICATE', false);

$schedules = SchedulesData::findSchedules(array('s.flighttype'=>'P'));
$idx = rand(0, count($schedules)-1);
$sched = $schedules[$idx];
unset($schedules);

echo '<strong>Filing report...</strong><br />';
$data = array(
	'pilotid'=>1,
	'code'=>$sched->code,
	'flightnum'=>$sched->flightnum,
	'route' => 'HYLND DCT PUT J42 RBV J230 BYRDD J48 MOL DCT FLCON',
	'depicao'=>$sched->depicao,
	'arricao'=>$sched->arricao,
	'aircraft'=>$sched->aircraft,
	'flighttime'=>$sched->flighttime,
	'submitdate'=>'NOW()',
	'fuelused'=>6000,
	'source'=>'unittest',
	'comment'=>'Test Flight',
);

//$data = array(
//	'pilotid'=>1,
//	'code'=>'vms',
//	'flightnum'=>1,
//	//'route' => 'HYLND DCT PUT J42 RBV J230 BYRDD J48 MOL DCT FLCON',
//	'depicao'=>'lfll',
//	'arricao'=>'egll',
//	'aircraft'=>'1',
//	'route' => 'BUSIL UT133 AMORO',
//	'flighttime'=>'3',
//	'submitdate'=>'NOW()',
//	'fuelused'=>6000,
//	'source'=>'unittest',
//	'comment'=>'Test Flight',
//	);

$pirepid = PIREPData::fileReport($data);
if($ret == false)
{
	echo PIREPData::$lasterror;
}

echo "PIREP ID is {$pirepid}";

$report_info = PIREPData::findPIREPS(array('p.pirepid'=>$pirepid));
echo '<br />';
print_r($report_info);

echo '<strong>Deleting...</strong><br />';
#PIREPData::deletePIREP($pirepid);
//$report_info = PIREPData::findPIREPS(array('p.pirepid'=>$pirepid));

if(!$report_info)
{
	echo 'PIREP deleted';
}
else
{
	echo 'Failed to delete PIREP!';
}