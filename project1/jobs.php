<!--Used AI to generate the following code, input code from jobs.html (original) and gave this prompt: "Consider this file and the task instructions. 
Im currently doing the jobs.php page (I have created the jobs table in php my admin in a database) "and have the HTML dynamically created by PHP."
This is what I need help with. Here are the two jobs:
it_support_technician and senior_full_stack_web_developer"
Following this I gave this prompt: "How would I include your code in the existing jobs page:
(Also sidenote comment each non repeated line of php code and each repeated line of code once and what it does)"
Then I used the prompt: "Could you add the php code that I need to the jobs.php file
(comment the php code well and add a comment showing what you changed)"

Following this prompt, I prompted ChatGPT to "Do this: Insert proper job records as rows (not columns) now as you said. 
Here is the info for both jobs (Extract it from the original html file (before it became .php) 
all info you need is there) from this make the insert into statement." This was to fix an issue.
Following this ChatGPT offererd to do as follows:
"Ready for me to give you the updated jobs.php code that displays all the fields (including lists)?" which I accepted.
This code was later manually modified in parts where needed to fix other errors or bugs as I went along

Any smaller more specific AI written code will be directly annoatated.-->

<!--Add more comments to PHP (to help my own understanding of what everything does) -->

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8">                 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>

    <!-- Link to external CSS stylesheet for custom styles -->
    <link rel="stylesheet" href="styles/styles.css"> 

    <!-- Google Fonts import -->
    <link href="https://fonts.googleapis.com/css2?family=Special+Gothic&family=Special+Gothic+Expanded+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Special+Gothic&display=swap" rel="stylesheet">
</head>
<body> 

    <!-- Include the navigation bar from a reusable file -->
    <?php include 'nav.inc'; ?>

    <header class="header_jobs_page"> 
        <h1>Job Listings</h1>
    </header>

    <div class="jobs_sections_grouped"> 

        <!-- START: PHP Dynamic Job Listings -->
        <?php
        // Load database credentials from settings.php (host, user, pwd, db name)
        require_once "settings.php";

        // Connect to the MySQL database
        // @ symbol suppresses errors from being displayed directly
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db); 

        // Check if the connection failed
        if (!$conn) {
            // Display a simple user-friendly error if DB connection fails
            echo "<p>Database connection failed.</p>";
        } else {

            // SQL query to retrieve all rows (job postings) from the `jobs` table
            $query = "SELECT * FROM jobs";

            // Send the query to the database and store the result
            $result = mysqli_query($conn, $query); 

            // Check if query returned rows and executed without error
            if ($result && mysqli_num_rows($result) > 0) {

                // Loop through each job in the result set
                // ChatGPT prompt responsible for the two line below ("$index = 1;"):"I will give you your code: (input jobs.php 
                // Can you cross check and see why the jobs.php page is not formatting/styling correctly (IE no borders, aside colour is same everywhere.  )"
                $index = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    // Each $row is an associative array representing one job (e.g., $row['job_title'])

                   // ChatGPT prompt responsible for the two lines below:"I will give you your code: (input jobs.php 
                   // Can you cross check and see why the jobs.php page is not formatting/styling correctly (IE no borders, aside colour is same everywhere.  )"
                   echo "<section class='jobs_page_section_$index'>";
                   $index++;


                    // Output job title (escaped for safety using htmlspecialchars)
                    echo "<h2>" . htmlspecialchars($row['job_title']) . "</h2>";

                    // Display reference number
                    echo "<p><strong>Reference Number:</strong> " . htmlspecialchars($row['job_ref']) . "</p>";

                    // Display salary range
                    echo "<p><strong>Salary Range:</strong> " . htmlspecialchars($row['salary_range']) . "</p>";

                    // Display who the job reports to
                    echo "<p><strong>Reports to:</strong> " . htmlspecialchars($row['reports_to']) . "</p>";

                    // Display location of the job
                    echo "<p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>";

                    // Display application closing date
                    echo "<p><strong>Closing Date:</strong> " . htmlspecialchars($row['closing_date']) . "</p>";

                    echo "<hr>"; // Horizontal line for visual separation

                    // Job duties section
                    echo "<h3>What you will do</h3>";

                    // nl2br() converts newlines in text into <br> tags
                    // htmlspecialchars() prevents HTML/script injection
                    echo "<p>" . nl2br(htmlspecialchars($row['what_you_do'])) . "</p>";

                    echo "<hr>";

                    // Key responsibilities section
                    echo "<h3>Key responsibilities</h3>";

                    // Check that the field is not empty
                    if (!empty($row['key_responsibilities'])) {

                        // Convert pipe-separated string into an array
                        // e.g., "Do this|Do that" → ["Do this", "Do that"]
                        $responsibilities = explode('|', $row['key_responsibilities']);

                        echo "<ul class='jobs_page_list'>";

                        // Loop through the array and print each item as a bullet point
                        foreach ($responsibilities as $item) {
                            echo "<li>" . htmlspecialchars(trim($item)) . "</li>"; // trim() removes extra spaces
                        }

                        echo "</ul>";
                    }

                    echo "<hr>";

                    // Job requirements: Essential skills
                    echo "<h3>Job requirements</h3>";
                    echo "<p>Essential to have:</p>";

                    if (!empty($row['essential_skills'])) {
                        $essential = explode('|', $row['essential_skills']);
                        echo "<ul class='jobs_page_list'>";
                        foreach ($essential as $item) {
                            echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                        }
                        echo "</ul>";
                    }

                    // Job requirements: Preferred skills
                    echo "<p>Preferable to have:</p>";

                    if (!empty($row['preferred_skills'])) {
                        $preferred = explode('|', $row['preferred_skills']);
                        echo "<ul class='jobs_page_list'>";
                        foreach ($preferred as $item) {
                            echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                        }
                        echo "</ul>";
                    }

                    echo "</section>"; // End job section
                }
            } else {
                // If no jobs found or query failed
                echo "<p>No jobs available.</p>";
            }

            // Close the database connection to free up resources
            mysqli_close($conn); 
        }
        ?>
        <!-- END: PHP Dynamic Job Listings -->
    </div>

    <!-- Static section with extra company info -->
    <div class="jobs_container"> 
        <div class="jobs_image-box"> 
            <!-- Image related to company perks/benefits -->
            <img src="images/ChatGPT_img_jobs.png" alt="Company Benefits infographic">
        </div>

        <aside class="jobs_page_aside">
            <h2>Why else should you join our company?</h2>
            <ol id="jobs_page_list_ol">
                <li>98% of our employees are satisfied with their positions</li>
                <li>We provide 4 weeks of paid annual leave</li>
                <li>We provide 3 additional weeks of unpaid annual leave</li>
                <li>We plant 5000 trees annually as part of a carbon offset scheme</li>
                <li>Two psychology appointments offered annually</li>
            </ol>
        </aside>
    </div>

    <!-- Include the footer using reusable code -->
    <?php include 'footer.inc'; ?>    
</body>
</html>
