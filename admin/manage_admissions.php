<?php include 'includes/admin_header.php'; 

// Delete admission
if (isset($_GET['delete']) && $conn) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM admissions WHERE id = $id");
    header("Location: manage_admissions.php?msg=Deleted Successfully");
    exit();
}

// Update status
if (isset($_POST['update_status']) && $conn) {
    $id = intval($_POST['id']);
    $status = sanitize($_POST['status']);
    $conn->query("UPDATE admissions SET status = '$status' WHERE id = $id");
    header("Location: manage_admissions.php?msg=Status Updated");
    exit();
}

// Fetch all admissions
$admissions = ($conn) ? $conn->query("SELECT * FROM admissions ORDER BY submitted_at DESC") : null;
?>

<div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: var(--shadow-sm);" class="reveal">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3>Admissions Management</h3>
        <?php if(isset($_GET['msg'])): ?>
            <div style="padding: 0.5rem 1rem; background: #dcfce7; color: #166534; border-radius: 6px; font-weight: 600; font-size: 0.9rem;">
                <i class="fas fa-check"></i> <?php echo $_GET['msg']; ?>
            </div>
        <?php endif; ?>
    </div>

    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Parent Name</th>
                    <th>Phone</th>
                    <th>Class</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if($admissions && $admissions->num_rows > 0): ?>
                    <?php while($row = $admissions->fetch_assoc()): ?>
                    <tr>
                        <td style="font-weight: 600;"><?php echo $row['full_name']; ?></td>
                        <td><?php echo $row['parent_name']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['class_selected']; ?></td>
                        <td>
                            <form action="" method="POST" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <select name="status" onchange="this.form.submit()" style="padding: 0.3rem; border-radius: 4px; font-size: 0.8rem; background: <?php echo $row['status'] == 'Pending' ? '#fffbeb' : ($row['status'] == 'Approved' ? '#ecfdf5' : '#fef2f2'); ?>; color: <?php echo $row['status'] == 'Pending' ? '#b45309' : ($row['status'] == 'Approved' ? '#065f46' : '#991b1b'); ?>; border: 1px solid <?php echo $row['status'] == 'Pending' ? '#b45309' : ($row['status'] == 'Approved' ? '#065f46' : '#991b1b'); ?>;">
                                    <option value="Pending" <?php echo $row['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Approved" <?php echo $row['status'] == 'Approved' ? 'selected' : ''; ?>>Approved</option>
                                    <option value="Rejected" <?php echo $row['status'] == 'Rejected' ? 'selected' : ''; ?>>Rejected</option>
                                </select>
                                <input type="hidden" name="update_status" value="1">
                            </form>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.75rem;">
                                <a href="?view=<?php echo $row['id']; ?>" style="color: var(--primary);"><i class="fas fa-eye"></i></a>
                                <a href="?delete=<?php echo $row['id']; ?>" style="color: var(--error);" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6" style="text-align: center; padding: 2rem; color: var(--text-muted);">No admission applications found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- View Modal Backdrop (Simple implementation) -->
    <?php if(isset($_GET['view'])): 
        $vid = intval($_GET['view']);
        $v_sql = "SELECT * FROM admissions WHERE id = $vid";
        $v_res = $conn->query($v_sql);
        if($v_res && $v_res->num_rows > 0):
        $v = $v_res->fetch_assoc();
    ?>
    <div style="position: fixed; inset: 0; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; z-index: 2000;">
        <div style="background: white; border-radius: 16px; width: 600px; padding: 3rem; position: relative;">
            <a href="manage_admissions.php" style="position: absolute; top: 1.5rem; right: 1.5rem; font-size: 1.5rem; color: var(--text-muted);"><i class="fas fa-times"></i></a>
            <h2 style="margin-bottom: 2rem; color: var(--primary);">Application Details</h2>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div>
                    <p style="font-size: 0.85rem; color: var(--text-muted);">Student Name</p>
                    <p style="font-weight: 600; margin-bottom: 1rem;"><?php echo $v['full_name']; ?></p>
                    <p style="font-size: 0.85rem; color: var(--text-muted);">DOB</p>
                    <p style="font-weight: 600; margin-bottom: 1rem;"><?php echo $v['dob']; ?></p>
                    <p style="font-size: 0.85rem; color: var(--text-muted);">Gender</p>
                    <p style="font-weight: 600; margin-bottom: 1rem;"><?php echo $v['gender']; ?></p>
                    <p style="font-size: 0.85rem; color: var(--text-muted);">Class Selected</p>
                    <p style="font-weight: 600; margin-bottom: 1rem;"><?php echo $v['class_selected']; ?></p>
                </div>
                <div>
                    <p style="font-size: 0.85rem; color: var(--text-muted);">Parent Name</p>
                    <p style="font-weight: 600; margin-bottom: 1rem;"><?php echo $v['parent_name']; ?></p>
                    <p style="font-size: 0.85rem; color: var(--text-muted);">Phone</p>
                    <p style="font-weight: 600; margin-bottom: 1rem;"><?php echo $v['phone']; ?></p>
                    <p style="font-size: 0.85rem; color: var(--text-muted);">Email</p>
                    <p style="font-weight: 600; margin-bottom: 1rem;"><?php echo $v['email']; ?></p>
                    <p style="font-size: 0.85rem; color: var(--text-muted);">Status</p>
                    <p style="font-weight: 600; margin-bottom: 1rem; color: var(--primary);"><?php echo $v['status']; ?></p>
                </div>
            </div>
            <div style="margin-top: 1rem;">
                <p style="font-size: 0.85rem; color: var(--text-muted);">Address</p>
                <p style="font-weight: 600;"><?php echo $v['address']; ?></p>
            </div>
        </div>
    </div>
    <?php endif; endif; ?>
</div>

</div> <!-- Close admin-main div from header -->
</body>
</html>
