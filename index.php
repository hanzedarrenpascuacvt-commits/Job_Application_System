<?php require_once 'core/models.php'; $applications = getAllApplications($pdo); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Job Application System</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>
<h1>Web Developer Job Application</h1>

<?php
$messages = [
    'deleted' => ['Deleted successfully!', 'deleted'],
    'added'   => ['Application added successfully!', 'success'],
    'updated' => ['Application updated successfully!', 'success'],
];
$m = isset($_GET['msg']) ? ($messages[$_GET['msg']] ?? null) : null;
?>
<?php if ($m): ?>
    <div class="msg <?= $m[1] ?>" id="flash"><?= $m[0] ?></div>
<?php endif; ?>

<form action="core/handleForms.php" method="POST">
    <div class="form-group">
        <label>First Name</label>
        <input type="text" name="first_name" required>
    </div>
    <div class="form-group">
        <label>Last Name</label>
        <input type="text" name="last_name" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" required>
    </div>
    <div class="form-group">
        <label>Phone</label>
        <input type="text" name="phone">
    </div>
    <div class="form-group">
        <label>Position Applied</label>
        <select name="position_applied" required>
            <option>Front End Developer</option>
            <option>Back End Developer</option>
            <option>Full Stack Developer</option>
        </select>
    </div>
    <div class="form-group">
        <label>Years of Experience</label>
        <input type="number" name="years_experience" min="0">
    </div>
    <div class="form-group">
        <label>Skills</label>
        <input type="text" name="skills" placeholder="e.g. HTML, PHP, React">
    </div>
    <div class="form-group">
        <label>Portfolio Link</label>
        <input type="url" name="portfolio" placeholder="https://github.com/username">
    </div>
    <button type="submit" name="insertBtn">Submit Application</button>
</form>

<h2>All Applications</h2>
<table>
    <tr>
        <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Position</th>
        <th>Experience</th><th>Skills</th><th>Portfolio</th><th>Date Added</th><th>Actions</th>
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
        <td>
            <?php if (!empty($a['portfolio'])): ?>
                <a href="<?= htmlspecialchars($a['portfolio']) ?>" target="_blank">View</a>
            <?php endif; ?>
        </td>
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

<script>
    var flash = document.getElementById('flash');
    if (flash) {
        // Tinatanggal agad ang ?msg=... sa URL para hindi bumalik kapag nag-refresh
        history.replaceState(null, '', window.location.pathname);

        // Nawawala ang mensahe pagkalipas ng 2 segundo
        setTimeout(function () {
            flash.style.display = 'none';
        }, 2000);
    }
</script>
</body>
</html>
