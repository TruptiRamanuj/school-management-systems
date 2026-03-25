<?php include 'includes/admin_header.php'; 

// Fetch quick stats
$stats = [
    'admissions' => ($conn) ? $conn->query("SELECT COUNT(*) FROM admissions")->fetch_row()[0] : 0,
    'departments' => ($conn) ? $conn->query("SELECT COUNT(*) FROM departments")->fetch_row()[0] : 0,
    'events' => ($conn) ? $conn->query("SELECT COUNT(*) FROM events")->fetch_row()[0] : 0,
    'unread_contacts' => ($conn) ? $conn->query("SELECT COUNT(*) FROM contacts WHERE status='Unread'")->fetch_row()[0] : 0
];

// Latest admissions
$latest_admissions = ($conn) ? $conn->query("SELECT * FROM admissions ORDER BY submitted_at DESC LIMIT 5") : null;
?>

<div class="stats-grid reveal">
    <div class="stat-card">
        <i class="fas fa-id-card" style="font-size: 2rem; color: var(--primary); margin-bottom: 1rem;"></i>
        <h3><?php echo $stats['admissions']; ?></h3>
        <p>Total Admissions</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-building-columns" style="font-size: 2rem; color: var(--secondary); margin-bottom: 1rem;"></i>
        <h3><?php echo $stats['departments']; ?></h3>
        <p>Active Departments</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-calendar-day" style="font-size: 2rem; color: #10b981; margin-bottom: 1rem;"></i>
        <h3><?php echo $stats['events']; ?></h3>
        <p>Total Events</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-message" style="font-size: 2rem; color: #f59e0b; margin-bottom: 1rem;"></i>
        <h3><?php echo $stats['unread_contacts']; ?></h3>
        <p>Unread Messages</p>
    </div>
</div>

<div class="reveal" style="margin-top: 3rem;">
    <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: var(--shadow-sm);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h3>Recent Admission Inquiries</h3>
            <a href="manage_admissions.php" style="color: var(--primary); font-size: 0.9rem; font-weight: 600;">View All <i class="fas fa-arrow-right"></i></a>
        </div>
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Class</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if($latest_admissions && $latest_admissions->num_rows > 0): ?>
                    <?php while($row = $latest_admissions->fetch_assoc()): ?>
                    <tr>
                        <td style="font-weight: 600;"><?php echo $row['full_name']; ?></td>
                        <td><?php echo $row['class_selected']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><span style="display: inline-block; padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.75rem; font-weight: 700; background: <?php echo $row['status'] == 'Pending' ? '#fffbeb' : ($row['status'] == 'Approved' ? '#ecfdf5' : '#fef2f2'); ?>; color: <?php echo $row['status'] == 'Pending' ? '#b45309' : ($row['status'] == 'Approved' ? '#065f46' : '#991b1b'); ?>;"><?php echo $row['status']; ?></span></td>
                        <td><?php echo date('d M, Y', strtotime($row['submitted_at'])); ?></td>
                        <td><a href="manage_admissions.php?id=<?php echo $row['id']; ?>" style="color: var(--primary);"><i class="fas fa-eye"></i> View</a></td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6" style="text-align: center; padding: 2rem; color: var(--text-muted);">No recent admissions found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="reveal" style="margin-top: 3rem; display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
    <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: var(--shadow-sm);">
        <h3>System Overview</h3>
        <p style="margin-top: 1rem; color: var(--text-muted); font-size: 0.9rem;">Current Server Time: <?php echo date('Y-m-d H:i:s'); ?></p>
        <p style="color: var(--text-muted); font-size: 0.9rem;">PHP Version: <?php echo phpversion(); ?></p>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Database: MYSQL (MariaDB Compatible)</p>
    </div>
    <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: var(--shadow-sm);">
        <h3>Quick Actions</h3>
        <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-top: 1.5rem;">
            <a href="manage_events.php" class="btn btn-primary" style="font-size: 0.85rem;"><i class="fas fa-calendar-plus"></i> Add Event</a>
            <a href="manage_gallery.php" class="btn btn-secondary" style="font-size: 0.85rem;"><i class="fas fa-image"></i> Add Gallery Image</a>
        </div>
    </div>
</div>

</div> <!-- Close admin-main div from header -->
</body>
</html>
