<?php

$dline = 0; // row counter
if (($file = fopen("C:\Users\Rico Langenkamp\Documents\api gegevens\destiny.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
        // removes top line of file (row with column names) 
        if ($dline > 0) {
            // seperates line. fgetcsv(file, amount of characters per row, seperator)
            $fields = count($data);
            //counts amount of fields in line
            $item = array();
            for ($i = 0; $i < $fields; $i++) {
                //pushes field into array
                array_push($item, $data[$i]);
            }
            //pushes fieldarray into big array (2nd layer, so array is 1 layer)
            array_push($array, $item);
        }
        $dline++;
    }
    fclose($file);
}


$client = $array[0][1];
$duration = 0; // total duration of calls
$calls = 0; // total amount of calls
$amount = 0; // total price of calls
$dline2 = 0; // row counter
$skip = False;
$veneta = 0;
$sdsabo = 0;
foreach ($array as $row) {
    $row[3] = (string) $row[3];
    if ($row[2] == "calls") {
        $row[4] = minutes($row[4]);
    }
    // change to american numeric system to be able to create a double from price.
    $row[6] = str_replace(",", ".", $row[6]);
    // string to double
    $row[6] = doubleval($row[6]);
    $array[$dline2][6] = $row[6];

    if ($row[0] == "Veneta BV") {

        $client = $row[0];
        // wait till second row to skip else, so last customer still adds calls.
        if ($veneta >= 1) {
            $skip = true;
        } else {
            $veneta++;
        }

        if ($row[2] == "calls") {
            $descr = $row[3];
            $vduration = $row[4];
            $vcalls = $row[5];
            $vamount = $row[6];

            // create 3 new rows for calls, duration and price. 
            $temp = $array[($dline2)];
            $call = array($temp, $temp, $temp);


            // modify array to:
            // call price
            $call[0][2] = "calls";
            $call[0][3] = "gesprekskosten";
            $call[0][4] = $descr;
            $call[0][5] = 1;
            $call[0][6] = $vamount;

            // amount of calls
            $call[1][2] = "calls";
            $call[1][3] = "aantal";
            $call[1][4] = $descr;
            $call[1][5] = $vcalls;
            $call[1][6] = 0;

            // call time
            $call[2][2] = "calls";
            $call[2][3] = "tijd";
            $call[2][4] = $descr;
            $call[2][5] = Round($vduration);
            $call[2][6] = 0;

            // push call array into data array
            foreach ($call as $c) {
                array_push($array, $c);
            }
            unset($array[$dline2]);
        }
    }
    // last customer wont go into else statement, so this one is seperate
    if ($dline - 2 == $dline2) {
        if ($row[2] == "calls") {
            $duration += $row[4];
            $calls += $row[5];
            $amount += $row[6];
            unset($array[$dline2]);
        }

        // every client with ## in front of name is test, this can be removed. And our own can be removed as well
        if (str_contains($row[0], '##') || $row[0] == "Salland ICT" || $row[0] == "Gemeente Zwolle" || str_contains($row[3], 'Ftt' || 'BVV' || 'NLS') || str_contains($row[4],'KB')) {
            unset($array[$dline2]);
        }

        // check if last line of previous client is empty (## is deleted so no counting needed)
        if (isset($array[$dline2 - 1])) {
            // create 3 new rows for calls, duration and price. 
            $temp = $array[($dline2 - 1)];
            $call = array($temp, $temp, $temp);


            // call price
            $call[0][0] = $row[0];
            $call[0][1] = $row[1];
            $call[0][2] = "calls";
            $call[0][3] = "gesprekskosten";
            $call[0][4] = "";
            $call[0][5] = 1;
            $call[0][6] = $amount;

            // amount of calls
            $call[1][2] = "calls";
            $call[1][3] = "aantal";
            $call[1][4] = "";
            $call[1][5] = $calls;
            $call[1][6] = 0;

            // call time
            $call[2][2] = "calls";
            $call[2][3] = "tijd";
            $call[2][4] = "";
            $call[2][5] = Round($duration);
            $call[2][6] = 0;

            // push call array into data array
            foreach ($call as $c) {
                array_push($array, $c);
            }
        }
    } else {
        // add to call data of client and remove row when it is added to total
        
        // every client with ## in front of name is test, this can be removed. And our own can be removed as well
        if (str_contains($row[0], '##') || $row[0] == "Salland ICT" || $row[0] == "Gemeente Zwolle" || str_contains($row[3], 'Ftt' || 'BVV' || 'NLS') || str_contains($row[4],'KB')) {
            unset($array[$dline2]); 
        }

        if ($row[1] == $client) {
            if ($row[2] == "calls") {
                $duration += $row[4];
                $calls += $row[5];
                $amount += $row[6];
                unset($array[$dline2]);
            } elseif ($row[0] == "SDS Ommen") {
                $sdsabo += $row[6];
                unset($array[$dline2]);
            }
        } else {
            // first row of next client
            

            if ($skip == true) {
                $skip = false;
            } else {
                // SDS ommen needs to be seperated into 3 customers. i delete all lines from sds, so i check if sds was last customer using sdsabo

                if ($sdsabo != 0) {


                    $temp = array("");
                    $call = array($temp, $temp, $temp, $temp);

                    for ($i = 0; $i < 3;) {
                        if ($i == 0) {
                            $customer = "SDS Ommen Systemen & Projecten BV";
                            $perc = 0.6;
                        } elseif ($i == 1) {
                            $customer = "Schutte Dakbedekking en Renovatiebedrijf BV";
                            $perc = 0.1;
                        } else {
                            $customer = "Polyline Ommen BV";
                            $perc = 0.3;
                        }
                        $i++;


                        $call[0][0] = $customer;
                        $call[0][1] = $customer;
                        $call[0][2] = "calls";
                        $call[0][3] = "gesprekskosten";
                        $call[0][4] = "";
                        $call[0][5] = 1;
                        $call[0][6] = round($amount * $perc);

                        // amount of calls
                        $call[1][0] = $customer;
                        $call[1][1] = $customer;
                        $call[1][2] = "calls";
                        $call[1][3] = "aantal";
                        $call[1][4] = "";
                        $call[1][5] = round($calls * $perc);
                        $call[1][6] = 0;

                        // call time
                        $call[2][0] = $customer;
                        $call[2][1] = $customer;
                        $call[2][2] = "calls";
                        $call[2][3] = "tijd";
                        $call[2][4] = "";
                        $call[2][5] = Round($duration * $perc);
                        $call[2][6] = 0;


                        // subsctiption price
                        $call[3][0] = $customer;
                        $call[3][1] = $customer;
                        $call[3][2] = "Abonnement";
                        $call[3][3] = "Abonnement";
                        $call[3][4] = "";
                        $call[3][5] = 1;
                        $call[3][6] = $sdsabo * $perc;

                        foreach ($call as $c) {
                            array_push($array, $c);
                        }
                    }
                    $sdsabo = 0;
                }
                // check if last line of previous client is empty (## is deleted so no counting needed)
                if (isset($array[$dline2 - 1])) {


                    // create 3 new rows for calls, duration and price. 
                    $temp = $array[($dline2 - 1)];
                    $call = array($temp, $temp, $temp);


                    // modify array to:
                    // call price
                    $call[0][3] = "gesprekskosten";
                    $call[0][4] = "";
                    $call[0][5] = 1;
                    $call[0][6] = $amount;

                    // amount of calls
                    $call[1][2] = "calls";
                    $call[1][3] = "aantal";
                    $call[1][4] = "";
                    $call[1][5] = $calls;
                    $call[1][6] = 0;

                    // call time
                    $call[2][2] = "calls";
                    $call[2][3] = "tijd";
                    $call[2][4] = "";
                    $call[2][5] = Round($duration);
                    $call[2][6] = 0;

                    // push call array into data array
                    foreach ($call as $c) {
                        array_push($array, $c);
                    }
                }
            }
            // reset call data of previous client
            $duration = 0;
            $calls = 0;
            $amount = 0;

            // set client to new client
            if (isset($array[$dline2])) {
                $client = $array[$dline2][1];
            }

            // first line of new client added to call data
            if ($row[2] == "calls") {
                $duration += $row[4];
                $calls += $row[5];
                $amount += $row[6];
                unset($array[$dline2]);
            }
        }
    }
    $dline2++;
}





// set HH:MM:SS to amount of minutes as rounded number
function minutes($time)
{

    if (str_contains($time, ":")) {
        $time = explode(':', $time);
        $time1 = intval($time[0]);
        $time2 = intval($time[1]);
        $time3 = intval($time[2]);
        return (($time1 * 60) + $time2 + round($time3 / 60));
    } else {
        return 0;
    }
}

?>