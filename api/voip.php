<?php
$vline = 0;
$voiparray = array();
if (($file = fopen("C:\Users\Rico Langenkamp\Documents\api gegevens\abonnement.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
        // removes top line of file (row with column names) 
        if ($vline > 0) {
            // seperates line. fgetcsv(file, amount of characters per row, seperator)
            $fields = count($data);
            //counts amount of fields in line
            $item = array();
            for ($i = 0; $i < $fields; $i++) {
                //pushes field into array
                array_push($item, $data[$i]);
            }
            //pushes fieldarray into big array (2nd layer, so array is 1 layer)
            array_push($voiparray, $item);
        }
        $vline++;
    }
    fclose($file);
}
$eline = 0;
if (($file = fopen('C:\Users\Rico Langenkamp\Documents\api gegevens\eenmalig.csv', "r")) !== FALSE) {
    while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
        // removes top line of file (row with column names) 
        if ($eline > 0) {
            // seperates line. fgetcsv(file, amount of characters per row, seperator)
            $fields = count($data);
            //counts amount of fields in line
            $item = array();
            for ($i = 0; $i < $fields; $i++) {
                //pushes field into array
                array_push($item, $data[$i]);
            }
            //pushes fieldarray into big array (2nd layer, so array is 1 layer)
            array_push($voiparray, $item);
        }
        $eline++;
    }
    fclose($file);
}
$temp = array();
foreach ($voiparray as $row) {
    if ($row[0] !== "Salland ICT") {
        if ($row[1] == "Salland ICT") {
            $temp[0] = $row[2];
        } else {
            $temp[0] = $row[1];
        }
        $temp[1] = $row[2];
        $temp[2] = "";
        $temp[3] = $row[6];
        if ($row[6] == "Eenmalig") {
            $temp[3] = $row[7];
        }
        $temp[4] = "";
        $row[5] = Round(str_replace(",", ".", $row[5]));
        $temp[5] = $row[5];
        $row[9] = Round(str_replace(",", ".", $row[9]), 2);
        $temp[6] = $row[9];
        array_push($array, $temp);
    }
}
$callarray = array();
$gline = 0;
if (($file = fopen('C:\Users\Rico Langenkamp\Documents\api gegevens\gesprekskosten.csv', "r")) !== FALSE) {
    while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
        // removes top line of file (row with column names) 
        if ($gline > 0) {
            // seperates line. fgetcsv(file, amount of characters per row, seperator)
            $fields = count($data);
            //counts amount of fields in line
            $item = array();
            for ($i = 0; $i < $fields; $i++) {
                //pushes field into array
                array_push($item, $data[$i]);
            }
            //pushes fieldarray into big array (2nd layer, so array is 1 layer)
            array_push($callarray, $item);
        }
        $gline++;
    }
    fclose($file);
}

foreach ($callarray as $row) {
    if ($row[0] !== "Salland ICT") {
        if ($row[1] == "Salland ICT") {
            $customer = $row[2];
            $name = $row[2];
        } else {
            $customer = $row[1];
            $name = $row[2];
        }

        $gduration = round($row[9]/60);
        $gcalls = $row[8];
        $gamount = round(str_replace(",", ".", $row[10]),2);

        // create 3 new rows for calls, duration and price. 
        $temp = array("");
        $call = array($temp, $temp, $temp);


        // modify array to:
        // call price
        $call[0][0] = $customer;
        $call[0][1] = $name;
        $call[0][2] = "calls";
        $call[0][3] = "gesprekskosten";
        $call[0][4] = "";
        $call[0][5] = 1;
        $call[0][6] = $gamount;

        // amount of calls
        $call[1][0] = $customer;
        $call[1][1] = $name;
        $call[1][2] = "calls";
        $call[1][3] = "aantal";
        $call[1][4] = "";
        $call[1][5] = $gcalls;
        $call[1][6] = 0;

        // call time
        $call[2][0] = $customer;
        $call[2][1] = $name;
        $call[2][2] = "calls";
        $call[2][3] = "tijd";
        $call[2][4] = "";
        $call[2][5] = $gduration;
        $call[2][6] = 0;

        foreach ($call as $c) {
            array_push($array, $c);
        }
    }
}
?>