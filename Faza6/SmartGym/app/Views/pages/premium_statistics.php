<?php

use App\Models\ExerciseEquipmentTypeModel;
use App\Models\TargetedMuscleGroupModel;
use App\Models\ExerciseEquipmentModel;

$eetm = new ExerciseEquipmentTypeModel();
$eem = new ExerciseEquipmentModel();
$tmgm = new TargetedMuscleGroupModel();

echo"<b>STATISTIKA</b><br><br>";
echo "Grupa mišića | Broj korišćenih sprava | Broj bodova | Procenat<br><br>";

foreach($stats as $stat) {
            echo $stat['muscle'];
            echo "|";
            echo $stat['cnt'];
            echo "|";
            echo $stat['jacina'];
            echo "|";
            echo number_format($stat['percent'], 2, '.', '');
            echo "%<br>";
        }

echo "<br><br>";
echo "===================================================================";
echo "<br><br>";

echo "Zapostavili ste sledeće grupe mišića:<br><br>";
$stats = array_reverse($stats);
foreach($stats as $stat) {
    if ($stat['jacina'] >= $limit) { break; }
    echo "<b>-";
    echo $stat['muscle'];
    echo"</b><br>";
    echo " &nbsp&nbsp Mi predlažemo da više radite:<br>";
    $groups = $tmgm->findForGroup($stat['IdMuscle']);
    foreach($groups as $group) {
        $equipment = $eetm->find($group->IdTip);
        if ($eem->cnt($equipment->IdTip) > 0) {
            echo " &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp *";
            echo anchor("$path/showEquipment/{$equipment->IdTip}","$equipment->Naziv");
            echo "<br>";
        }
    }
    echo "<br>";
}

echo "<br><br>";
echo "===================================================================";
echo "<br><br>";

$num = count($myEq);
if ($num > 0) {
    echo "Vaše omiljene sprave:<br><br>";
    if ($num > 3) { $num = 3; }
    $i = 1;
    foreach($myEq as $me) {
        echo "$i. &nbsp";
        $equipment = $me['type'];
        echo anchor("$path/showEquipment/{$equipment->IdTip}","$equipment->Naziv");
        echo "<br>";
        if (++$i > $num) { break; }
    }
    echo "<br><br>";
    echo "===================================================================";
    echo "<br><br>";
}

$num2 = count($allEq);
if ($num2 > 0) {
    echo "Najpopularnije sprave:<br><br>";
    if ($num2 > 3) { $num2 = 3; }
    $i = 1;
    foreach($allEq as $ae) {
        echo "$i. &nbsp";
        $equipment = $ae['type'];
        echo anchor("$path/showEquipment/{$equipment->IdTip}","$equipment->Naziv");
        echo "<br>";
        if (++$i > $num2) { break; }
    }
}
