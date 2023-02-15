<style>
    table, tr, th, td{
        border: 1px solid black;
    }
    #erow{
        border-color: white;
    }
</style>

<?php 
    $val1=null;
    $val2=null;
    $untill=null;
    $render=null;
?>

<table>
    <?php
        if(!empty($_POST) && is_numeric($_POST['untill'])){
            $val1=$_POST['table1'];
            $val2=$_POST['table2'];
            $untill=$_POST['untill'];
        }
        else{
            $render = "Vul gegevens in";
        }
    ?>
    <form action="" method="post">
        <tr>
            <th>Tafel van <input type=Text name=table1></th>
            <th>Tafel van <input type=Text name=table2></th>
            <th>Tot en met <input type=Text name=untill value=<?php echo($untill)?>></th>
            <th><input type=Submit name=Submit value="Bereken"></form></th>
        </tr>   
    <?php
        $y=1;
        if(!empty($_POST) && is_numeric($_POST['untill'])){
            if(empty($_POST['table1']) && empty($_POST['table2'])){
                $render = "Vul een tafel in";
            }
            else{
                for($x=1;$x<=$untill;$x++){
                    $render .= '<tr>';
                    if(is_numeric($_POST['table1'])){
                        $render .= '<td>'.$val1.' x '.$x.' = '.($x*$val1). '</td>';
                    }
                    else{
                        $render .= '<td id="erow"></td>';
                    }
                    if(is_numeric($_POST['table2'])){
                    $render .= '<td>'.$val2.' x '.$y.' = '.($y*$val2). '</td>';
                    }
                    $render .= '</tr>';
                    $y=$y+1;
                }
            }   
        }
    ?>
    <?php echo($render) ?>
</table>