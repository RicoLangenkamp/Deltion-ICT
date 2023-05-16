<?php
$array = array(); // array with data

include("destiny.php");
include("Voip.php");
include("exceptions.php");

foreach ($array as $res) {
    $sortAux[] = $res[1];
}
array_multisort($sortAux, SORT_ASC, $array);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <tr>
            <td style="border: 1px solid black">Klant/Partner</td>
            <td style="border: 1px solid black">Klantnaam</td>
            <td style="border: 1px solid black">Type</td>
            <td style="border: 1px solid black">Omschrijving</td>
            <td style="border: 1px solid black">specificatie</td>
            <td style="border: 1px solid black">aantal</td>
            <td style="border: 1px solid black">prijs</td>
        </tr>
        <?php
        foreach ($array as $a) {
            echo"<tr>";
            foreach($a as $b){
                echo"<td style='border: 1px solid black'>" . $b . "</td>";
            }
            echo"/<tr>";
        }
        ?>
    </table>
</body>

</html>