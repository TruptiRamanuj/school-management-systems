<?php
include_once 'auth.php';
include_once '../includes/db.php';
$admin_page = basename($_SERVER['PHP_SELF'], ".php");

// Get some stats for the sidebar
$total_admissions = ($conn) ? $conn->query("SELECT COUNT(*) FROM admissions")->fetch_row()[0] : 0;
$unread_contacts = ($conn) ? $conn->query("SELECT COUNT(*) FROM contacts WHERE status='Unread'")->fetch_row()[0] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Shwastik School</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: #f8fafc; overflow-x: hidden; min-height: 100vh; }
        .admin-sidebar {
            width: 250px; background: var(--accent); color: white; position: fixed; top: 0; left: 0; height: 100%; padding: 2rem 0; z-index: 1000;
        }
        .admin-main { margin-left: 250px; padding: 2rem 3rem; width: calc(100% - 250px); }
        .sidebar-links { list-style: none; padding: 0 1rem; margin-top: 2rem; }
        .sidebar-links li { margin: 0.5rem 0; }
        .sidebar-links li a {
            display: flex; align-items: center; gap: 1rem; padding: 0.75rem 1.25rem; color: #94a3b8; border-radius: 8px; font-weight: 500; transition: var(--transition);
        }
        .sidebar-links li a:hover, .sidebar-links li a.active { background: rgba(255,255,255,0.1); color: white; }
        .sidebar-links li a.active i { color: var(--secondary); }
        .badge { background: var(--secondary); color: var(--accent); padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.75rem; font-weight: 700; }
    </style>
</head>
<body>
    <div class="admin-sidebar shadow-lg">
        <div style="padding: 0 2rem; margin-bottom: 3rem; text-align: center;">
            <h1 style="font-size: 1.25rem;">Shwastik <span style="color: var(--secondary);">Admin</span></h1>
        </div>
        <ul class="sidebar-links">
            <li><a href="dashboard.php" class="<?php echo $admin_page == 'dashboard' ? 'active' : ''; ?>"><i class="fas fa-chart-line"></i> Dashboard</a></li>
            <li><a href="manage_admissions.php" class="<?php echo $admin_page == 'manage_admissions' ? 'active' : ''; ?>"><i class="fas fa-id-card"></i> Admissions <span class="badge"><?php echo $total_admissions; ?></span></a></li>
            <li><a href="manage_departments.php" class="<?php echo $admin_page == 'manage_departments' ? 'active' : ''; ?>"><i class="fas fa-building-user"></i> Departments</a></li>
            <li><a href="manage_gallery.php" class="<?php echo $admin_page == 'manage_gallery' ? 'active' : ''; ?>"><i class="fas fa-images"></i> Gallery</a></li>
            <li><a href="manage_events.php" class="<?php echo $admin_page == 'manage_events' ? 'active' : ''; ?>"><i class="fas fa-calendar-check"></i> Events</a></li>
            <li><a href="manage_contacts.php" class="<?php echo $admin_page == 'manage_contacts' ? 'active' : ''; ?>"><i class="fas fa-envelope"></i> Contacts <?php if($unread_contacts > 0): ?><span class="badge"><?php echo $unread_contacts; ?></span><?php endif; ?></a></li>
            <li style="margin-top: 5rem;"><a href="logout.php" style="color: #ef4444;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <div class="admin-main">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem; background: white; padding: 1.5rem 2rem; border-radius: 12px; box-shadow: var(--shadow-sm);">
            <div>
                <h2 style="font-size: 1.5rem; color: var(--primary);"><?php echo ucwords(str_replace('_', ' ', $admin_page)); ?></h2>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Welcome back, <strong><?php echo $_SESSION['admin_name']; ?></strong>!</p>
            </div>
            <div style="display: flex; gap: 1rem; align-items: center;">
                <a href="../index.php" target="_blank" class="btn" style="background: var(--bg-alt); font-size: 0.85rem;"><i class="fas fa-external-link-alt"></i> View Site</a>
                <div style="width: 45px; height: 45px; background: var(--primary); border-radius: 50%; color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.25rem;">S</div>
            </div>
        </div>
