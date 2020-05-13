<?php

    use App\Models\MuscleGroupModel;

    if(!empty($errors)) echo "<span style='color:red'>$errors</span>";

    //echo form_open("Moderator/addType",["method=post", "enctype=multipart/form-data"]);  
    echo '<form action="addType" method="POST" enctype="multipart/form-data"';
    echo "<br/>Naziv sprave:<br/>";
    echo form_input("naziv",set_value("naziv")); 
    
    $mgm = new MuscleGroupModel();
    $muscles = $mgm->findAll();
    echo "<br/><br/><br/>Grupe misica:<br/>";
    
    for ($i = 1; $i <= 6; $i++) {
        echo '<select name="muscle_type'.$i.'">';
        echo '<option value="0">Izaberite grupu mišića</option>';
        foreach($muscles as $muscle) {
            echo "<option value=$muscle->IdGru>$muscle->Naziv</option>";
        }  
        echo '</select>';
        echo " &nbsp;&nbsp;&nbsp;Jačina: &nbsp;";
        echo '<select name="power'.$i.'">';
        for ($num = 1; $num <= 10; $num++) {
            echo "<option value=$num>$num";
        }           
        echo '</select><br><br>';
    }
    
    echo "<br>Opis:<br/>";
    echo form_textarea("opis",set_value("opis")); 
    echo "<br/><br/>";
    
    echo '<input type="file" name="img">';
    echo "<br/><br/>";
    
    echo form_submit("dodaj", "Dodaj");
    echo " &nbsp;&nbsp; ";
    echo form_submit("nazad", "Nazad");
    //echo form_close();
    echo '</form>';
?>


