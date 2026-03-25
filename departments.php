<?php 
include 'includes/header.php'; 

$dep_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$departments = get_departments();

if ($dep_id > 0 && $conn) {
    $sql = "SELECT * FROM departments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $dep_id);
    $stmt->execute();
    $current_dep = $stmt->get_result()->fetch_assoc();
} else {
    $current_dep = null;
}
?>

<section class="hero reveal" style="padding: 6rem 0; margin-bottom: 2rem;">
    <div class="container">
        <h1>Academic Departments</h1>
        <p>Providing specialized learning paths for every age and stage of development.</p>
    </div>
</section>

<div class="container">
    <div style="display: flex; gap: 3rem; margin-bottom: 6rem;">
        <!-- Sidebar Navigation -->
        <aside style="width: 300px; flex-shrink: 0;">
            <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 1.5rem; position: sticky; top: 120px; box-shadow: var(--shadow-sm);">
                <h3 style="margin-bottom: 1.5rem; color: var(--primary);">Explore Departments</h3>
                <ul style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <?php if(!empty($departments)): ?>
                    <?php foreach($departments as $dep): ?>
                        <li>
                            <a href="departments.php?id=<?php echo $dep['id']; ?>" 
                               class="btn <?php echo ($dep_id == $dep['id'] || ($dep_id == 0 && $dep == $departments[0])) ? 'btn-primary' : ''; ?>" 
                               style="width: 100%; text-align: left; background: <?php echo ($dep_id == $dep['id'] || ($dep_id == 0 && $dep == $departments[0])) ? '' : 'transparent'; ?>; color: <?php echo ($dep_id == $dep['id'] || ($dep_id == 0 && $dep == $departments[0])) ? 'white' : 'var(--text-dark)'; ?>; padding: 0.75rem 1rem;">
                               <i class="fas <?php echo $dep['icon']; ?>"></i> <?php echo $dep['name']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p>No departments available.</p>
                    <?php endif; ?>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main style="flex: 1;">
            <?php 
            $display_dep = $current_dep ?: (!empty($departments) ? $departments[0] : null);
            if ($display_dep):
            ?>
                <div class="reveal">
                    <h2 style="font-size: 2.5rem; color: var(--primary); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 1rem;">
                        <i class="fas <?php echo $display_dep['icon']; ?>" style="color: var(--secondary);"></i>
                        <?php echo $display_dep['name']; ?> Department
                    </h2>
                    
                    <div style="background: white; border-radius: 16px; border: 1px solid #e2e8f0; padding: 3rem; box-shadow: var(--shadow-sm);">
                        <div style="margin-bottom: 2.5rem;">
                            <h3 style="color: var(--primary); margin-bottom: 1rem;">Overview</h3>
                            <p style="font-size: 1.1rem; color: var(--text-muted); line-height: 1.8;"><?php echo $display_dep['overview']; ?></p>
                        </div>
                        
                        <div class="grid-3" style="grid-template-columns: 1fr 1fr; gap: 2.5rem;">
                            <div>
                                <h3 style="color: var(--primary); margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="fas fa-book" style="color: var(--secondary);"></i> Subjects
                                </h3>
                                <ul style="list-style: disc; margin-left: 1.5rem; color: var(--text-muted);">
                                    <?php 
                                    $subjects = explode(',', $display_dep['subjects']);
                                    foreach($subjects as $sub):
                                    ?>
                                        <li style="margin-bottom: 0.5rem;"><?php echo trim($sub); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div>
                                <h3 style="color: var(--primary); margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="fas fa-basketball-ball" style="color: var(--secondary);"></i> Activities
                                </h3>
                                <ul style="list-style: disc; margin-left: 1.5rem; color: var(--text-muted);">
                                    <?php 
                                    $activities = explode(',', $display_dep['activities']);
                                    foreach($activities as $act):
                                    ?>
                                        <li style="margin-bottom: 0.5rem;"><?php echo trim($act); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 3rem; text-align: center; background: var(--bg-alt); padding: 3rem; border-radius: 16px;">
                        <h3 style="margin-bottom: 1rem;">Ready to enroll in this department?</h3>
                        <p style="margin-bottom: 1.5rem;">Join our community of learners and thinkers.</p>
                        <a href="admission.php" class="btn btn-primary">Apply Now for <?php echo $display_dep['name']; ?></a>
                    </div>
                </div>
            <?php else: ?>
                <h2>Department not found.</h2>
            <?php endif; ?>
        </main>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
