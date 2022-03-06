<?php

require 'database.php';

function get_incremented_id($con, $table_name) {
    
    $query = "SELECT MAX(id) FROM $table_name WHERE 1";
    $run = mysqli_query($con, $query);
    $result = $run->fetch_assoc();
    $final_result = $result["MAX(id)"];
    if ($final_result == NULL) {
        return 1;
    }
    else {
        return $final_result + 1;
    }
};

?>