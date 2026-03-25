<?php include 'includes/admin_header.php'; 

// Handle Department Add
if (isset($_POST['add_department']) && $conn) {
    $name = sanitize($_POST['name']);
    $overview = sanitize($_POST['overview']);
    $subjects = sanitize($_POST['subjects']);
    $activities = sanitize($_POST['activities']);
    $icon = sanitize($_POST['icon']);

    $stmt = $conn->prepare("INSERT INTO departments (name, overview, subjects, activities, icon) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $overview, $subjects, $activities, $icon);
    $stmt->execute();
    header("Location: manage_departments.php?msg=Department Added");
    exit();
}

// Handle Delete
if (isset($_GET['delete']) && $conn) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM departments WHERE id = $id");
    header("Location: manage_departments.php?msg=Department Deleted");
    exit();
}

$departments = get_departments();
?>

<div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: var(--shadow-sm);" class="reveal">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3>Academic Departments</h3>
        <button onclick="document.getElementById('add_modal').style.display='flex'" class="btn btn-primary" style="font-size: 0.85rem;"><i class="fas fa-plus"></i> Add New Department</button>
    </div>

    <table>
        <thead>
            <tr>
                <th>Icon</th>
                <th>Name</th>
                <th>Overview</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($departments as $dep): ?>
            <tr>
                <td><i class="fas <?php echo $dep['icon']; ?>" style="font-size: 1.5rem; color: var(--secondary);"></i></td>
                <td style="font-weight: 600;"><?php echo $dep['name']; ?></td>
                <td style="font-size: 0.9rem; color: var(--text-muted); max-width: 400px;"><?php echo substr($dep['overview'], 0, 100); ?>...</td>
                <td>
                    <div style="display: flex; gap: 0.75rem;">
                        <a href="?delete=<?php echo $dep['id']; ?>" style="color: var(--error);" onclick="return confirm('Are you sure you want to delete this department?');"><i class="fas fa-trash"></i></a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Add Modal Backdrop -->
    <div id="add_modal" style="position: fixed; inset: 0; background: rgba(0,0,0,0.5); display: none; align-items: center; justify-content: center; z-index: 2000;">
        <div style="background: white; border-radius: 16px; width: 600px; padding: 3rem; position: relative; max-height: 90vh; overflow-y: auto;">
            <a href="#" onclick="document.getElementById('add_modal').style.display='none'" style="position: absolute; top: 1.5rem; right: 1.5rem; font-size: 1.5rem; color: var(--text-muted);"><i class="fas fa-times"></i></a>
            <h2 style="margin-bottom: 2rem; color: var(--primary);">Add New Department</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Department Name</label>
                    <input type="text" name="name" class="form-control" required placeholder="Pre-Primary">
                </div>
                <div class="form-group">
                    <label>Department Overview</label>
                    <textarea name="overview" class="form-control" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label>Subjects (Comma-separated)</label>
                    <input type="text" name="subjects" class="form-control" required placeholder="Math, English, Science">
                </div>
                <div class="form-group">
                    <label>Activities (Comma-separated)</label>
                    <input type="text" name="activities" class="form-control" placeholder="Sports, Art, Dance">
                </div>
                <div class="form-group">
                    <label>Icon Class (Font Awesome)</label>
                    <input type="text" name="icon" class="form-control" value="fa-school">
                </div>
                <button type="submit" name="add_department" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Add Department</button>
            </form>
        </div>
    </div>
</div>

</div> 
</body>
</html>
