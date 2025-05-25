<?php
require_once('settings.php');
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

function displayjobs($conn, $refnumber) {
    // Escape the input
    $job_ref = mysqli_real_escape_string($conn, $refnumber);

    // Query with filter
    $query = "SELECT * FROM eoi WHERE JobReferenceNumber = '$job_ref'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Loop through the filtered result set and print each row
        while ($row = mysqli_fetch_assoc($result)) {
            foreach ($row as $column => $value) {
                echo htmlspecialchars($column) . ': ' . htmlspecialchars($value) . '<br>';
            }
            echo '<hr>';
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['G01'])) {displayjobs($conn, 'G01');}
    if (isset($_POST['G02'])){displayjobs($conn, 'G02');}
    if (isset($_POST['G03'])){displayjobs($conn, 'G03');}
    if (isset($_POST['G04'])){displayjobs($conn, 'G04');}
    if (isset($_POST['G05'])){displayjobs($conn, 'G05');}
    if (isset($_POST['G06'])){displayjobs($conn, 'G06');}
    if (isset($_POST['G07'])){displayjobs($conn, 'G07');}

    if (isset($_POST['listall'])) 
    {
       $query = "SELECT * FROM `eoi`";     // print all:
       $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) 
        {
            foreach ($row as $column => $value) 
            {
                echo $column . ': ' . $value . '<br>';
            }
            echo '<hr>';
        }
    }
    else{echo 'error';}
}
?>

<html>
<h1> Manager </h1>
<p> 
<form action="manager.php" method="post">

    <fieldset> 
        <label><input type="submit" name="listall" value="List all"  /> </label>
    </fieldset>

    <fieldset>
        List from: 
        <label> <input type="checkbox" name="G01"> GO1</label>
        <label> <input type="checkbox" name="G02"> GO2</label>
        <label> <input type="checkbox" name="G03"> GO3</label>
        <label> <input type="checkbox" name="G04"> GO4</label>
        <label> <input type="checkbox" name="G05"> GO5</label>
        <label> <input type="checkbox" name="G06"> GO6</label>
        <label> <input type="checkbox" name="G07"> GO7</label>
        <label> <input type="submit" name="submitt" value="Submit"  /> </label>
    </fieldset>
</form>
</p>
</html>







