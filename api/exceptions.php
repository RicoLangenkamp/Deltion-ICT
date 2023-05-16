<?php
$bline = 0;
$exceptionarray = array();
if (($file = fopen("C:\Users\Rico Langenkamp\Documents\api gegevens\bijzonderheden.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
        // removes top line of file (row with column names) 
        if ($bline > 0) {
            // seperates line. fgetcsv(file, amount of characters per row, seperator)
            $fields = count($data);
            //counts amount of fields in line
            $item = array();
            for ($i = 0; $i < $fields; $i++) {
                //pushes field into array
                array_push($item, $data[$i]);
            }
            //pushes fieldarray into big array (2nd layer, so array is 1 layer)
            array_push($exceptionarray, $item);
        }
        $bline++;
    }
    fclose($file);
}

foreach ($exceptionarray as $row) {
    $temp = array();
    if ($row[0] !== "Salland ICT") {
        $temp[0] = $row[0];
        $temp[1] = $row[1];
        $temp[2] = "";
        $temp[3] = $row[3];
        $temp[4] = "";
        $temp[5] = $row[4];
        $temp[6] = $row[5];
        array_push($array, $temp);
    }
}

?>