<?php
require "header.php";
require "functions.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $name = formatName($_POST['name']);
        $email = $_POST['email'];
        $skillsString = $_POST['skills'];

        if (!validateEmail($email)) {
            throw new Exception("Invalid email address.");
        }

        $skillsArray = cleanSkills($skillsString);

        saveStudent($name, $email, $skillsArray);

        $message = "Student saved successfully!";
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<h3>Add Student</h3>

<form method="post">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Skills: <input type="text" name="skills" required><br><br>
    <button type="submit">Save Student</button>
</form>

<p><?php echo $message; ?></p>

<?php require "footer.php"; ?>
