<?php

echo form_open("Admin/mark","method=post");
echo "Odaberite datum: ";
echo '<input type="date" name="datum" value="'."$date".'">';
echo " &nbsp&nbsp ";
echo '<input type="submit" name="potvrdi" value="Potvrdi"/>';
echo " &nbsp&nbsp ";
echo form_submit("nazad", "Nazad");
echo form_close();

