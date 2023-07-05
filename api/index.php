<?php 
include("../../api/final.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border: 1px solid black;
            border-collapse: collapse;
        }

        td {
            border-left: 1px solid black;
        }

        tr:nth-child(odd) {
            background: lightgray;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th style="background-color: gray">Klant/Partner</th>
            <th style="background-color: gray">Klantnaam</th>
            <th style="background-color: gray">Omschrijving</th>
            <th style="background-color: gray">specificatie</th>
            <th style="background-color: gray">aantal</th>
            <th style="background-color: gray">prijs</th>
            <th style="background-color: gray">korting</th>
        </tr>
        <?php
        $pids = array();
        foreach ($array as $h) {
            $pids[] = $h[3];
        }
        $uniquePids = array_unique($pids);
        foreach($uniquePids as $a){
            echo $a . "<br>";
        }
        foreach ($array as $a) {
            echo "<tr>";
            foreach ($a as $b) {
                echo "<td>" . $b . "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>