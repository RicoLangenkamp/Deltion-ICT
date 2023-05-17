<?php
$array = array(); // array with data

include("destiny.php");
include("Voip.php");
include("exceptions.php");


// remove empty lines from array

$array = array_values(array_filter($array));

// sort multidimentional array
foreach ($array as $res) {
    $sortAux[] = $res[1];
}
array_multisort($sortAux, SORT_ASC, $array);

$temparray = array();
$client;
$sline = 0;
foreach ($array as $line) {
    if ($line[1] == $client) {
        $temparray[$sline] = $line;
        unset($array[$sline]);
    } else {

        // print_r($temparray);
        $sortorder = array(
            "Abonnement",
            "gesprekskosten",
            "aantal",
            "tijd"
        );

        usort($temparray, function ($a, $b) use ($sortorder) {
            $a = array_search($a[3], $sortorder);
            $b = array_search($b[3], $sortorder);
            if ($a === false && $b === false) {
                return 0;
            } elseif ($a === false) {
                return 1;
            } elseif ($b === false) {
                return -1;
            } else {
                return $a - $b;
            }
        });
        foreach ($temparray as $a) {

            array_push($array, $a);
        }
        $client = $line[1];
        $temparray = array();
        $temparray[$sline] = $line;
        unset($array[$sline]);
    }
    $sline++;
}

$array = array_values(array_filter($array));
$rline = 0;
foreach ($array as $a) {
    unset($array[$rline][2]);
    $rline++;
}

$array = array_values(array_filter($array));

$order = array(
    "Kaspers ICT",
    "Jera ICT B.V.",
    "HBCS",
    "Vangnet IT"
);

usort($array, function ($a, $b) use ($order) {
    $a = array_search($a[0], $order);
    $b = array_search($b[0], $order);
    if ($a === false && $b === false) { // both items are dont cares
        return 0;                       // a == b (or add tie-breaker condition)
    } elseif ($a === false) {           // $a is a dont care
        return 1;                       // $a > $b
    } elseif ($b === false) {           // $b is a dont care
        return -1;                      // $a < $b
    } else {
        return $a - $b;                 // sort $a and $b ascending
    }
});

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
        td{
            border-bottom: 1px solid black;
        }
        tr:nth-child(odd) {
            background: lightgray;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td style="background-color: gray">Klant/Partner</td>
            <td style="background-color: gray">Klantnaam</td>
            <td style="background-color: gray">Omschrijving</td>
            <td style="background-color: gray">specificatie</td>
            <td style="background-color: gray">aantal</td>
            <td style="background-color: gray">prijs</td>
        </tr>
        <?php
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