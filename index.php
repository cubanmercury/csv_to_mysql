<?php
    //display error message if any
    ini_set('display_startup_errors',1);
    ini_set('display_errors',1);
    error_reporting(-1);

    //openup connection to database
    include('dbconnection.php');

    //open elements.csv file
    if(($handle = fopen("elements.csv", "r")) !== FALSE){
        $flag = true;

        //fetch data from each row
        while(($data = fgetcsv($handle, ",")) !== FALSE){
            if($flag){
                $flag = false;
                continue;
            }
            //get data from each column
            $atomic_number = mysqli_real_escape_string($conn, $data[0]);
            $symbol = mysqli_real_escape_string($conn, $data[1]);
            $name = mysqli_real_escape_string($conn, $data[2]);
            $mass_number = mysqli_real_escape_string($conn, $data[3]);
            $electron_configuration = mysqli_real_escape_string($conn, $data[4]);
            $e_group = mysqli_real_escape_string($conn, $data[5]);
            $e_period = mysqli_real_escape_string($conn, $data[6]);
            $year = mysqli_real_escape_string($conn, $data[7]);
            $ionisation_energy = mysqli_real_escape_string($conn, $data[8]);
            $abundance = mysqli_real_escape_string($conn, $data[9]);
            $density = mysqli_real_escape_string($conn, $data[10]);
            $melting_point = mysqli_real_escape_string($conn, $data[11]);
            $boiling_point = mysqli_real_escape_string($conn, $data[12]);
            $electronegativity = mysqli_real_escape_string($conn, $data[13]);
            $specific_heat_capacity = mysqli_real_escape_string($conn, $data[14]);
            $radioactive = mysqli_real_escape_string($conn, $data[15]);
            $block = mysqli_real_escape_string($conn, $data[16]);

            //query to inset into db
            $sql = "INSERT IGNORE INTO elements (atomic_number, symbol, name, mass_number, electron_configuration, e_group, e_period, year, ionisation_energy, abundance, density, melting_point, boiling_point, electronegativity, specific_heat_capacity, radioactive, block) VALUES ('$atomic_number', '$symbol', '$name', '$mass_number', '$electron_configuration', '$e_group', '$e_period', '$year', '$ionisation_energy', '$abundance', '$density', '$melting_point', '$boiling_point', '$electronegativity', '$specific_heat_capacity', '$radioactive', '$block')"; 
            echo $sql;

            //execute the insertion query
            $retreval = mysqli_query($conn, $sql);

            if($retreval == false){
                die('could not enter data: ' . mysqli_error($conn));
            }
            echo "<p style='color: green;'>Entered data with name = " . $name . " successfully</p><br>";
        }
        echo "<br><p style='color: blue;'>All data inserted successfully</p>";
        fclose($handle);
    }
    mysqli_close($conn);