<?php
require "header.php";

if (file_exists("students.txt")) {
    $students = file("students.txt");
    echo "<h3>Student List</h3>";

    foreach ($students as $student) {
        list($name, $email, $skills) = explode(",", trim($student));
        $skillsArray = explode(" | ", $skills);

        echo "<p>";
        echo "<strong>Name:</strong> $name<br>";
        echo "<strong>Email:</strong> $email<br>";
        echo "<strong>Skills:</strong> ";
        echo implode(", ", $skillsArray);
        echo "</p><hr>";
    }
} else {
    echo "<p>No students found.</p>";
}

require "footer.php";
?>
