<?php

// phpinfo();

function connStrToArray($conn_str){
 
    // Initialize array.
    $conn_array = array();
 
    // Split conn string on semicolons. Results in array of "parts".
    $parts = explode(";", $conn_str);
 
 
    // Loop through array of parts. (Each part is a string.)
    foreach($parts as $part){
 
        // Separate each string on equals sign. Results in array of 2 items.
        $temp = explode("=", $part);
 
        // Make items key=>value pairs in returned array.
        $conn_array[$temp[0]] = $temp[1];
    }
 
    return $conn_array;
}

$connstring = getenv("DefaultConnection");
$connarray = connStrToArray($connstring);

print_r($connarray);
