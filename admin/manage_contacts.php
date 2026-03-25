<?php include 'includes/admin_header.php'; 

// Delete Contact Inquery
if (isset($_GET['delete']) && $conn) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM contacts WHERE id = $id");
    header("Location: manage_contacts.php?msg=Deleted");exit();
}

// Mark as Read
if (isset($_GET['read']) && $conn) {
    $id = intval($_GET['read']);
    $conn->query("UPDATE contacts SET status = 'Read' WHERE id = $id");
    header("Location: manage_contacts.php?msg=Marked as Read");exit();
}

$contacts = ($conn) ? $conn->query("SELECT * FROM contacts ORDER BY submitted_at DESC") : null;
?>

<div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: var(--shadow-sm);" class="reveal">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3>Contact Inquiries</h3>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Sender</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if($contacts && $contacts->num_rows > 0): ?>
                <?php while($row = $contacts->fetch_assoc()): ?>
                <tr style="background: <?php echo $row['status'] == 'Unread' ? 'rgba(30, 58, 138, 0.03)' : ''; ?>;">
                    <td><?php echo date('d M, Y', strtotime($row['submitted_at'])); ?></td>
                    <td>
                        <div style="font-weight: 600;"><?php echo $row['name']; ?></div>
                        <div style="font-size: 0.8rem; color: var(--text-muted);"><?php echo $row['email']; ?></div>
                    </td>
                    <td><?php echo $row['subject']; ?></td>
                    <td><span class="badge" style="background: <?php echo $row['status'] == 'Read' ? '#10b981' : '#f59e0b'; ?>; color: white;"><?php echo $row['status']; ?></span></td>
                    <td>
                        <div style="display: flex; gap: 0.75rem;">
                            <a href="?view=<?php echo $row['id']; ?>" style="color: var(--primary);"><i class="fas fa-eye"></i></a>
                            <?php if($row['status'] == 'Unread'): ?>
                                <a href="?read=<?php echo $row['id']; ?>" style="color: var(--success);"><i class="fas fa-check-double"></i></a>
                            <?php if($conn) $conn->query("UPDATE contacts SET status = 'Read' WHERE id = " . $row['id']); ?>
                            <?php endif; ?>
                            <a href="?delete=<?php echo $row['id']; ?>" style="color: var(--error);" onclick="return confirm('Delete this inquiry?');"><i class="fas fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5" style="text-align: center; padding: 2rem; color: var(--text-muted);">No inquiries found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if(isset($_GET['view'])): 
        $vid = intval($_GET['view']);
        $v = $conn->query("SELECT * FROM contacts WHERE id = $vid")->fetch_assoc();
        if($v):
    ?>
    <div style="position: fixed; inset: 0; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; z-index: 2000;">
        <div style="background: white; border-radius: 16px; width: 600px; padding: 3rem; position: relative;">
            <a href="manage_contacts.php" style="position: absolute; top: 1.5rem; right: 1.5rem; font-size: 1.5rem; color: var(--text-muted);"><i class="fas fa-times"></i></a>
            <h2 style="margin-bottom: 2rem; color: var(--primary);">Contact Inquiry</h2>
            <div style="margin-bottom: 1.5rem;">
                <p style="font-size: 0.85rem; color: var(--text-muted);">From:</p>
                <p style="font-weight: 600;"><?php echo $v['name']; ?> <span style="font-weight: 400; color: var(--text-muted);">(<?php echo $v['email']; ?>)</span></p>
            </div>
            <div style="margin-bottom: 1.5rem;">
                <p style="font-size: 0.85rem; color: var(--text-muted);">Subject:</p>
                <p style="font-weight: 600;"><?php echo $v['subject']; ?></p>
            </div>
            <div style="margin-bottom: 1.5rem;">
                <p style="font-size: 0.85rem; color: var(--text-muted);">Message:</p>
                <div style="padding: 1.5rem; background: var(--bg-alt); border-radius: 8px; line-height: 1.6;"><?php echo nl2br($v['message']); ?></div>
            </div>
        </div>
    </div>
    <?php endif; endif; ?>
</div>
</div>
</body>
</html>
