<?php
require_once('settings.php');
$conn = mysqli_connect($host, $user, $pwd, $sql_db);
include 'nav.inc'; 
function displaydata($conn, $filter_value, $column, $delete) {
    // Escape the input
    $escaped_filter_value = mysqli_real_escape_string($conn, $filter_value);

    if ($delete) {
        $query = "DELETE FROM `eoi` WHERE `$column` = '$escaped_filter_value'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_affected_rows($conn) > 0) {
                echo "Deleted entries where $column = $escaped_filter_value.<hr>";
            } else {
                echo "No entries found to delete where $column = $escaped_filter_value.<hr>";
            }
        } else {
            echo "Error executing delete query: " . mysqli_error($conn);
        }
    } 
    else 
    {
        $query = "SELECT * FROM `eoi` WHERE `$column` = '$escaped_filter_value'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // Loop through and display each row
                while ($row = mysqli_fetch_assoc($result)) {
                    foreach ($row as $column_name => $value) {
                        echo htmlspecialchars($column_name) . ': ' . htmlspecialchars($value) . '<br>';
                    }
                    echo '<hr>';
                }
            }
            
        } else
        {
            echo "error";
        }
    }
    
}


function change_eoi_status($conn, $eoi){}

?>

<html>
<head>
    <link rel="stylesheet" href="styles/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Special+Gothic&family=Special+Gothic+Expanded+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Special+Gothic&display=swap" rel="stylesheet"> 
</head>
<body>
<div class="manager-container">
    <section class="form-section">
        <h1> Manager </h1>
        <form action="manage.php" method="post" novalidate= "novalidate" >

            <fieldset> 
                <label><input type="submit" name="listall" value="List all"  /> </label>
            </fieldset>

            <fieldset>
                <legend>List from:</legend> 
                <label> <input type="checkbox" name="G01"> GO1</label>
                <label> <input type="checkbox" name="G02"> GO2</label>
                <label> <input type="checkbox" name="G03"> GO3</label>
                <label> <input type="checkbox" name="G04"> GO4</label>
                <label> <input type="checkbox" name="G05"> GO5</label>
                <label> <input type="checkbox" name="G06"> GO6</label>
                <label> <input type="checkbox" name="G07"> GO7</label>
                <label> <input type="submit" name="submitt" value="Submit"  /> </label>
            </fieldset>
            <fieldset>
                <legend>List from: </legend>
                <label> First name: <input type="textbox" name="firstname"> </label>
                <label> Last name: <input type="textbox" name="lastname"> </label> 
                <label> <input type="submit" name="submitt" value="Submit"  /> </label>
            </fieldset>

            <fieldset>
                <legend>Delete from: </legend> 
                <label> <input type="checkbox" name="G01d"> GO1</label>
                <label> <input type="checkbox" name="G02d"> GO2</label>
                <label> <input type="checkbox" name="G03d"> GO3</label>
                <label> <input type="checkbox" name="G04d"> GO4</label>
                <label> <input type="checkbox" name="G05d"> GO5</label>
                <label> <input type="checkbox" name="G06d"> GO6</label>
                <label> <input type="checkbox" name="G07d"> GO7</label>
                <label> <input type="submit" name="Delete" value="Delete"  /> </label>
            </fieldset>
            <fieldset>
                <legend>Change EOI Status</legend>
                <label>EOI ID: <input type="text" name="eoi_id"></label><br>
                <label>New Status: 
                <select name="new_status">
                    <option value="New">New</option>
                    <option value="Current">Current</option>
                    <option value="Final">Final</option>
                </select>
                </label><br>
                <input type="submit" name="change_status" value="Update Status">
            </fieldset>

            <fieldset>
            <legend>Sort EOIs</legend>
            <label for="sortby">Sort by:</label>
            <select name="sortby" id="sortby">
                <option value="EOInumber">EOI Number</option>
                <option value="JobReferenceNumber">Job Reference</option>
                <option value="FirstName">First Name</option>
                <option value="LastName">Last Name</option>
                <option value="DateOfApplication">Application Date</option>
                <option value="Status">Status</option>
            </select>
            <select name="order">
                <option value="ASC">Ascending</option>
                <option value="DESC">Descending</option>
            </select>
            <input type="submit" name="sort_submit" value="Sort">
        </fieldset>

        </form>
    </section>

    <section class="output">
        <?php 
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                // list by job
                if (isset($_POST['G01'])) {displaydata($conn, 'G01', 'JobReferenceNumber', FALSE);}
                if (isset($_POST['G02'])){displaydata($conn, 'G02', 'JobReferenceNumber', FALSE);}
                if (isset($_POST['G03'])){displaydata($conn, 'G03', 'JobReferenceNumber', FALSE);}
                if (isset($_POST['G04'])){displaydata($conn, 'G04', 'JobReferenceNumber', FALSE);}
                if (isset($_POST['G05'])){displaydata($conn, 'G05', 'JobReferenceNumber', FALSE);}
                if (isset($_POST['G06'])){displaydata($conn, 'G06', 'JobReferenceNumber', FALSE);}
                if (isset($_POST['G07'])){displaydata($conn, 'G07', 'JobReferenceNumber', FALSE);}

                if (isset($_POST['G01d'])) {displaydata($conn, 'G01', 'JobReferenceNumber', TRUE);}
                if (isset($_POST['G02d'])){displaydata($conn, 'G02', 'JobReferenceNumber', TRUE);}
                if (isset($_POST['G03d'])){displaydata($conn, 'G03', 'JobReferenceNumber', TRUE);}
                if (isset($_POST['G04d'])){displaydata($conn, 'G04', 'JobReferenceNumber', TRUE);}
                if (isset($_POST['G05d'])){displaydata($conn, 'G05', 'JobReferenceNumber', TRUE);}
                if (isset($_POST['G06d'])){displaydata($conn, 'G06', 'JobReferenceNumber', TRUE);}
                if (isset($_POST['G07d'])){displaydata($conn, 'G07', 'JobReferenceNumber', TRUE);}

                // list all
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
                if (!empty($_POST['firstname'])) {
                    displaydata($conn, $_POST['firstname'], 'FirstName', FALSE);
                }
                if (!empty($_POST['lastname'])) {
                    displaydata($conn, $_POST['lastname'], 'LastName', FALSE);
                }

                

                if (isset($_POST['change_status'])) 
                {
                    $eoi_id = mysqli_real_escape_string($conn, $_POST['eoi_id']);
                    $new_status = mysqli_real_escape_string($conn, $_POST['new_status']);

                   
                    $query = "UPDATE `eoi` SET `Status` = '$new_status' WHERE `EOInumber` = '$eoi_id'";

                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        if (mysqli_affected_rows($conn) > 0) {
                            echo "EOI status updated for EOI $eoi_id <hr>";
                        } else {
                            echo "No EOI found";
                        }
                    } else {
                        echo "Error";
                    }
                }

                // Sort EOIs
                if (isset($_POST['sort_submit'])) {
                    $allowed_fields = ['EOInumber', 'JobReferenceNumber', 'FirstName', 'LastName', 'DateOfApplication', 'Status'];
                    $allowed_order = ['ASC', 'DESC'];

                    $sortby = in_array($_POST['sortby'], $allowed_fields) ? $_POST['sortby'] : 'EOInumber';
                    $order = in_array($_POST['order'], $allowed_order) ? $_POST['order'] : 'ASC';

                    $query = "SELECT * FROM eoi ORDER BY $sortby $order";
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            foreach ($row as $column => $value) {
                                echo htmlspecialchars($column) . ': ' . htmlspecialchars($value) . '<br>';
                            }
                            echo '<hr>';
                        }
                    } else {
                        echo "Error";
                    }
                }

                
            }
        ?>
    </section>
<div>
</body>

</html>








