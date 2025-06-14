<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="jobs.html"  rel="webpage">
    <link href="apply.html" rel="webpage">
    <link href="about.html" rel="webpage">
    <link href="https://fonts.googleapis.com/css2?family=Special+Gothic&family=Special+Gothic+Expanded+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Special+Gothic&display=swap" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet">
</head>

<body>
    <!-- navigation menu -->
  <?php include 'nav.inc'; ?>
  <header class="header_jobs_page">
    <h1>Job Application | SharkSec</h1>
  </header>

  <main>
    <h2 id="apply-heading">Job Application Form</h2>

    <!-- sends data to test server -->
    <form action="process_eoi.php" method="post" novalidate= "novalidate" >
      
      <!-- job reference  -->
      <label for="jobref">Job Reference Number:</label>
      <select id="jobref" name="jobref" required>
        <option value="">Select a job</option>
        <!--selecting job options-->
        <option value="G01">G01 - Software Developer</option>
        <option value="G02">G02 - Network Administrator</option>
        <option value="G03">G03 - Data Analyst</option>
        <option value="G04">G04 - Cybersecurity Specialist</option>
        <option value="G05">G05 - IT Support Technician</option>
        <option value="G06">G06 - Cloud Engineer</option>
        <option value="G07">G07 - AI/ML Engineer</option>
      </select>

      <!-- input for first Name  -->
      <label for="fname">First Name:</label>
      <input type="text" id="fname" name="fname" maxlength="20" pattern="[A-Za-z\s\-]+" required />

      <!-- input for last Name -->
      <label for="lname">Last Name:</label>
      <input type="text" id="lname" name="lname" maxlength="20" pattern="[A-Za-z\s\-]+" required />

      <!-- input for date of Birth -->
      <label for="dob">Date of Birth:</label>
      <input type="date" id="dob" name="dob" required />

      <!-- Gender selection  -->
      <fieldset>
        <legend>Gender</legend>
        <label><input type="radio" name="gender" value="Male" required /> Male</label>
        <label><input type="radio" name="gender" value="Female" /> Female</label>
        <label><input type="radio" name="gender" value="Other" /> Other</label>
      </fieldset>

      <!-- Address fields -->
      <label for="address">Street Address:</label>
      <input type="text" id="address" name="address" maxlength="40" required />

      <label for="suburb">Suburb/Town:</label>
      <input type="text" id="suburb" name="suburb" maxlength="40" required />

      <!-- State dropdown with state codes -->
      <label for="state">State:</label>
      <select id="state" name="state" required>
        <option value="" disabled selected>Select a state</option>
        <option value="VIC">VIC</option>
        <option value="NSW">NSW</option>
        <option value="QLD">QLD</option>
        <option value="NT">NT</option>
        <option value="WA">WA</option>
        <option value="SA">SA</option>
        <option value="TAS">TAS</option>
        <option value="ACT">ACT</option>
      </select>

      <!-- input for postcode (for 4 digits) -->
      <label for="postcode">Postcode:</label>
      <input type="text" id="postcode" name="postcode" pattern="\d{4}" maxlength="4" required />

      <!-- input for email -->
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required />

      <!-- input for phone number (8-12 digits) -->
      <label for="phone">Phone:</label>
      <input type="tel" id="phone" name="phone" pattern="[0-9 ]{8,12}" required />

      <!-- checkboxes technical skill -->
      <fieldset>
        <legend>Technical Skills (Select all that apply):</legend>
        <label><input type="checkbox" name="skills[]" value="HTML" /> HTML</label>
        <label><input type="checkbox" name="skills[]" value="CSS" /> CSS</label>
        <label><input type="checkbox" name="skills[]" value="JavaScript" /> JavaScript</label>
        <label><input type="checkbox" name="skills[]" value="Python" /> Python</label>
        <label><input type="checkbox" name="skills[]" value="Java" /> Java</label>
        <label><input type="checkbox" name="skills[]" value="SQL" /> SQL</label>
      </fieldset>

      <!-- textarea for additional skills part-->
      <label for="otherskills">Other Skills:</label>
      <textarea id="otherskills" name="otherskills" rows="4" cols="40" placeholder="Tell us more about your other skills..."></textarea>

      <!-- apply button -->
      <button type="submit">Apply</button>
    </form>
  </main>

  <!-- the footer-->
  <?php include 'footer.inc'; ?>

</body>
</html>
