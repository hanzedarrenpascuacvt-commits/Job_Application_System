<?php
require_once 'dbConfig.php';

function insertApplication($pdo, $fn, $ln, $email, $phone, $position, $years, $skills, $portfolio) {
    $sql = "INSERT INTO applications (first_name, last_name, email, phone, position_applied, years_experience, skills, portfolio)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    return $pdo->prepare($sql)->execute([$fn, $ln, $email, $phone, $position, $years, $skills, $portfolio]);
}

function getAllApplications($pdo) {
    return $pdo->query("SELECT * FROM applications ORDER BY date_added DESC")->fetchAll();
}

function getApplicationByID($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM applications WHERE application_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function updateApplication($pdo, $id, $fn, $ln, $email, $phone, $position, $years, $skills, $portfolio) {
    $sql = "UPDATE applications SET first_name=?, last_name=?, email=?, phone=?,
            position_applied=?, years_experience=?, skills=?, portfolio=? WHERE application_id=?";
    return $pdo->prepare($sql)->execute([$fn, $ln, $email, $phone, $position, $years, $skills, $portfolio, $id]);
}

function deleteApplication($pdo, $id) {
    return $pdo->prepare("DELETE FROM applications WHERE application_id = ?")->execute([$id]);
}
