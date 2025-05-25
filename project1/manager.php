<?php

require_once('settings.php');
$conn = mysqli_connect($host, $user, $pwd, $sql_db);


$query = "SELECT * FROM `eoi`";
$jobsquery = "SELECT jobref FROM `eoi` ";

$input_jobref = mysqli_query($conn, $jobsquery);
$result = mysqli_query($conn, $query);

if ($result) {
    // Loop through the result set and print each row
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['JobReferenceNumber'] == 'G02')
        {
        // Echo each column in the row
            foreach ($row as $column => $value) 
            {
                echo $column . ': ' . $value . '<br>';
            }
            echo '<hr>';
        }
    }
} else {
    // Query failed
    echo "Error: " . mysqli_error($conn);
}

// print all:
while ($row = mysqli_fetch_assoc($result)) {
        
    foreach ($row as $column => $value) 
    {
        echo $column . ': ' . $value . '<br>';
    }
    echo '<hr>';
        
    }
?>