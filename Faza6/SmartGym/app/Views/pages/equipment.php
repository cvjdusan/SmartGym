<div class="container-fluid fill">
    <div class="row" id="content">
        <div class="offset-1 col-sm-12 col-md-10">

<?php

use App\Models\TargetedMuscleGroupModel;
use App\Models\MuscleGroupModel;

echo "<h2>{$eq->Naziv}</h2>";
echo "Grupe mišića / Jačina:<br>";

$tmgm = new TargetedMuscleGroupModel();
$mgm = new MuscleGroupModel();
$muscleGroups = $tmgm->findForType($eq->IdTip);
foreach($muscleGroups as $group) {
    $muscle = $mgm->find($group->IdGru);
    echo "<br/>$muscle->Naziv / $group->Jacina";
}

echo "<br><br>";
echo $eq->Opis;
echo "<br><br>";

echo '<img width="200px;" height="200px;" src="data:image/png;base64,'.base64_encode($eq->Slika).'"/>';

?>

            
                    </div>
    </div>
</div>
