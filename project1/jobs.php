<!--Used AI to generate the following code, input code from jobs.html (original) and gave this prompt: "Consider this file and the task instructions. 
Im currently doing the jobs.php page (I have created the jobs table in php my admin in a database) "and have the HTML dynamically created by PHP."
This is what I need help with. Here are the two jobs:
it_support_technician and senior_full_stack_web_developer"
Following this I gave this prompt: "How would I include your code in the existing jobs page:
(Also sidenote comment each non repeated line of php code and each repeated line of code once and what it does)"
Then I used the prompt: "Could you add the php code that I need to the jobs.php file
 (comment the php code well and add a comment showing what you changed)"
 This was the final prompt used and that code was copied and pasted here.-->

<!DOCTYPE html> <!--Tells the browser that this is HTML5, important for interpretation--> 
<html lang="en"> 
<head> <!--Contains meta tags, links to external content and to other files-->
    <meta charset="UTF-8">                 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <link rel="stylesheet" href="styles/styles.css"> <!--Links HTML to CSS file-->
    <link href="https://fonts.googleapis.com/css2?family=Special+Gothic&family=Special+Gothic+Expanded+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Special+Gothic&display=swap" rel="stylesheet">
</head>
<body> 
  <?php include 'nav.inc'; ?>

    <header class="header_jobs_page"> 
        <h1>Job Listings</h1> <!--Style h1, give it its own font using shorthand font property--> 
    </header>

    <div class="jobs_sections_grouped"> <!--Replaced hardcoded job sections with dynamic PHP output below-->

        <!-- START: PHP Dynamic Job Listings -->
        <?php
        require_once "settings.php"; // Loads database connection credentials

        $conn = @mysqli_connect($host, $user, $pwd, $sql_db); // Connect to the MySQL database

        if (!$conn) {
            // Show error if connection fails
            echo "<p>Database connection failed. Please try again later.</p>";
        } else {
            $query = "SELECT * FROM jobs"; // SQL query to fetch all jobs
            $result = mysqli_query($conn, $query); // Execute the SQL query

            if ($result && mysqli_num_rows($result) > 0) {
                // Loop through each job row in the result
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<section class="jobs_page_section">'; // Begin a section for each job

                    // Job Title and Reference Number
                    echo "<h2>" . htmlspecialchars($row['job_title']) . "</h2>";
                    echo "<p>Reference Number: " . htmlspecialchars($row['job_ref']) . "</p>";

                    // Optional: Closing Date
                    echo "<p>Closing Date: " . htmlspecialchars($row['closing_date']) . "</p>";

                    // Job Description
                    echo "<p>" . nl2br(htmlspecialchars($row['job_description'])) . "</p>";

                    // Apply Button with job_ref as URL parameter
                    echo '<a href="apply.php?job_ref=' . urlencode($row['job_ref']) . '">Apply Now</a>';

                    echo "</section>";
                }
            } else {
                // If no jobs found
                echo "<p>No job listings available at the moment.</p>";
            }

            mysqli_close($conn); // Close the database connection
        }
        ?>
        <!-- END: PHP Dynamic Job Listings -->

    </div>

    <div class="jobs_container"> <!--Used Gen AI to help better structure this code. PROMPT: Can I create a box and put the image in the box to position it? -->
        <div class="jobs_image-box"> 
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
      
  <?php include 'footer.inc'; ?>    
</body>
</html>
