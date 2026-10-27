<?php require_once 'core/models.php'; $applications = getAllApplications($pdo); ?>
<!DOCTYPE html>
<html>
<head><title>Job Application System</title></head>
<body>
<h1>Web Developer Job Application</h1>

<form action="core/handleForms.php" method="POST">
    <input type="text" name="first_name" placeholder="First Name" required>
    <input type="text" name="last_name" placeholder="Last Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="phone" placeholder="Phone">
    <select name="position_applied" required>
        <option>Front End Developer</option>
        <option>Back End Developer</option>
        <option>Full Stack Developer</option>
    </select>
    <input type="number" name="years_experience" placeholder="Years of Experience" min="0">
    <input type="text" name="skills" placeholder="Skills (e.g. HTML, PHP, React)">
    <button type="submit" name="insertBtn">Submit Application</button>
</form>

<h2>All Applications</h2>
<table border="1" cellpadding="6">
    <tr>
        <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Position</th>
        <th>Experience</th><th>Skills</th><th>Date Added</th><th>Actions</th>
    </tr>
    <?php foreach ($applications as $a): ?>
    <tr>
        <td><?= $a['application_id'] ?></td>
        <td><?= htmlspecialchars($a['first_name'] . ' ' . $a['last_name']) ?></td>
        <td><?= htmlspecialchars($a['email']) ?></td>
        <td><?= htmlspecialchars($a['phone']) ?></td>
        <td><?= htmlspecialchars($a['position_applied']) ?></td>
        <td><?= $a['years_experience'] ?></td>
        <td><?= htmlspecialchars($a['skills']) ?></td>
        <td><?= $a['date_added'] ?></td>
        <td>
            <a href="edit.php?id=<?= $a['application_id'] ?>">Edit</a>
            <form action="core/handleForms.php" method="POST" style="display:inline"
                  onsubmit="return confirm('Delete this application?')">
                <input type="hidden" name="application_id" value="<?= $a['application_id'] ?>">
                <button type="submit" name="deleteBtn">Delete</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>