<?php include 'includes/admin_header.php'; 

// Add Event
if (isset($_POST['add_event']) && $conn) {
    $title = sanitize($_POST['title']);
    $description = sanitize($_POST['description']);
    $event_date = sanitize($_POST['event_date']);
    $location = sanitize($_POST['location']);

    $stmt = $conn->prepare("INSERT INTO events (title, description, event_date, location) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $event_date, $location);
    $stmt->execute();
    header("Location: manage_events.php?msg=Event Added");
    exit();
}

// Delete Event
if (isset($_GET['delete']) && $conn) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM events WHERE id = $id");
    header("Location: manage_events.php?msg=Event Deleted");
    exit();
}

$events = ($conn) ? $conn->query("SELECT * FROM events ORDER BY event_date ASC") : null;
?>

<div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: var(--shadow-sm);" class="reveal">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3>Event Calendar</h3>
        <button onclick="document.getElementById('add_modal').style.display='flex'" class="btn btn-primary" style="font-size: 0.85rem;"><i class="fas fa-plus"></i> Add New Event</button>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Title</th>
                <th>Location</th>
                <th width="150">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if($events && $events->num_rows > 0): ?>
                <?php while($row = $events->fetch_assoc()): ?>
                <tr>
                    <td style="font-weight: 600; color: var(--primary);"><?php echo date('d M, Y', strtotime($row['event_date'])); ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td>
                        <div style="display: flex; gap: 0.75rem;">
                            <a href="?delete=<?php echo $row['id']; ?>" style="color: var(--error);" onclick="return confirm('Are you sure you want to delete this event?');"><i class="fas fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4" style="text-align: center; padding: 2rem; color: var(--text-muted);">No events found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div id="add_modal" style="position: fixed; inset: 0; background: rgba(0,0,0,0.5); display: none; align-items: center; justify-content: center; z-index: 2000;">
        <div style="background: white; border-radius: 16px; width: 600px; padding: 3rem; position: relative;">
            <a href="#" onclick="document.getElementById('add_modal').style.display='none'" style="position: absolute; top: 1.5rem; right: 1.5rem; font-size: 1.5rem; color: var(--text-muted);"><i class="fas fa-times"></i></a>
            <h2 style="margin-bottom: 2rem; color: var(--primary);">Add New Event</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Event Title</label>
                    <input type="text" name="title" class="form-control" required placeholder="Annual Sports Day">
                </div>
                <div class="form-group">
                    <label>Event Description</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Event Date</label>
                        <input type="date" name="event_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" name="location" class="form-control" value="School Campus">
                    </div>
                </div>
                <button type="submit" name="add_event" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Add Event</button>
            </form>
        </div>
    </div>
</div>
</div>
</body>
</html>
