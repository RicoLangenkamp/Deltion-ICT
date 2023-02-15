<?php
    if(!empty($_POST['cijfer'])){
        $cijfer=$_POST['cijfer'];
    }
    else{
        $cijfer=null;   
    }
    str_replace(',','.',$cijfer);
    if(!empty($cijfer)) {
        if(0<=$cijfer||$cijfer<=4){
            $output = 'Zeer Matig';
        }
        if(4<$cijfer||$cijfer>5.5){
            $output = 'Onoldoende';
        }
        if(5.5<=$cijfer||$cijfer>7){
            $output = 'Voldoende';
        }
        if(7<=$cijfer||$cijfer>=10){
            $output='Goed';
        }
    }
    else{
        $output=null;
    }
?>
<form action="" method="post">
    <input type="text" name="cijfer"> <br>
    <input type="submit" name="submit" value="Bekijk"><br>
</form>
<?php 
    if(!empty($output)){
        echo($cijfer . " = " . $output); 
    }
?>  
