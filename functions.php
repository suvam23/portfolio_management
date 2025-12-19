<?php

function formatName($name) {
    return ucwords(trim($name));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string) {
    $skills = explode(",", $string);
    return array_map('trim', $skills);
}

function saveStudent($name, $email, $skillsArray) {
    $skills = implode(" | ", $skillsArray);
    $data = "$name,$email,$skills" . PHP_EOL;

    if (!file_put_contents("students.txt", $data, FILE_APPEND)) {
        throw new Exception("Failed to save student data.");
    }
}

function uploadPortfolioFile($file) {
    $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
    $maxSize = 2 * 1024 * 1024;

    if ($file['error'] !== 0) {
        throw new Exception("File upload error.");
    }

    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception("Invalid file type.");
    }

    if ($file['size'] > $maxSize) {
        throw new Exception("File size exceeds 2MB.");
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = "portfolio_" . time() . "." . $extension;

    $uploadDir = "uploads/";

    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            throw new Exception("Upload directory does not exist and could not be created.");
        }
    }

    if (!move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
        throw new Exception("Failed to upload file.");
    }

    return $newName;
}
