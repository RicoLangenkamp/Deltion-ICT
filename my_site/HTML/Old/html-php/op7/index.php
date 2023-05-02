<?php
    $out=null;
    $x=null;
    $array= ['book1','book2','book3','book4','book5','book6','book7','book8','book9'];

    for($x=0;$x<count($array);$x++){
        $out .= $array[$x].'<br>';
    }
    echo($out);
?>