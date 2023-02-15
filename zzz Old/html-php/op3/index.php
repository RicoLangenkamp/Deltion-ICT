<?php
    $val1=null;
    $val2=null;
    if(!empty($_POST['1']) && !empty($_POST['2'])){
        $val1=$_POST['1'];
        $val2=$_POST['2'];
        if(is_numeric($val1) && is_numeric($val2)){
            if(!empty($_POST['+'])){
                $output=$val1+$val2;
            }
            if(!empty($_POST['-'])){
                $output=$val1-$val2;
            }
            if(!empty($_POST['*'])){
                $output=$val1*$val2;
            }
            if(!empty($_POST['/'])){
                $output=$val1/$val2;
            }
        }
        else{
            $output="Vul alleen getallen in.";
        }
    }
    else{
        $output="Vul een getal in.";
    }
?>
<form action="" method="post">
    <input type="text" name="1" value=<?php echo($val1)?>>
    <input type="text" name="2" value=<?php echo($val2)?>><br>
    <input type="submit" name="+" value="Plus">
    <input type="submit" name="-" value="Minus">
    <input type="submit" name="*" value="Miltiply">
    <input type="submit" name="/" value="Devide">
</form>
<?php echo($output)?>