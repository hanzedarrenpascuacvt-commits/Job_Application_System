<?php
require_once 'core/models.php';
$a = getApplicationByID($pdo, $_GET['id']);
$positions = ['Front End Developer', 'Back End Developer', 'Full Stack Developer'];
?>
<!DOCTYPE html>
<html>
<head><title>Edit Application</title></head>
<body>
<h1>Edit Application</h1>
<form action="core/handleForms.php" method="POST">
    <input type="hidden" name="application_id" value="<?= $a['application_id'] ?>">
    <input type="text" name="first_name" value="<?= htmlspecialchars($a['first_name']) ?>" required>
    <input type="text" name="last_name" value="<?= htmlspecialchars($a['last_name']) ?>" required>
    <input type="email" name="email" value="<?= htmlspecialchars($a['email']) ?>" required>
    <input type="text" name="phone" value="<?= htmlspecialchars($a['phone']) ?>">
    <select name="position_applied">
        <?php foreach ($positions as $p): ?>
            <option <?= $p == $a['position_applied'] ? 'selected' : '' ?>><?= $p ?></option>
        <?php endforeach; ?>
    </select>
    <input type="number" name="years_experience" value="<?= $a['years_experience'] ?>" min="0">
    <input type="text" name="skills" value="<?= htmlspecialchars($a['skills']) ?>">
    <button type="submit" name="updateBtn">Update</button>
    <a href="index.php">Cancel</a>
</form>
</body>
</html>
