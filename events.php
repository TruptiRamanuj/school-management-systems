<?php 
include 'includes/header.php'; 

$sql = "SELECT * FROM events ORDER BY event_date ASC";
$result = $conn ? $conn->query($sql) : null;
?>

<section class="hero reveal" style="padding: 6rem 0;">
    <div class="container">
        <h1>Upcoming Events</h1>
        <p>Stay updated with our latest workshops, ceremonies, and school activities.</p>
    </div>
</section>

<div class="container" style="margin-bottom: 6rem; margin-top: -3rem;">
    <div style="display: flex; flex-direction: column; gap: 2rem;">
        <?php if($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="card reveal" style="display: flex; flex-direction: row; border: none; box-shadow: var(--shadow-md); border-radius: 16px; overflow: hidden;">
                    <div style="width: 200px; background: var(--primary); color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem; text-align: center;">
                        <h2 style="font-size: 3rem;"><?php echo date('d', strtotime($row['event_date'])); ?></h2>
                        <span style="text-transform: uppercase; font-weight: 600; font-size: 1.25rem;"><?php echo date('M', strtotime($row['event_date'])); ?></span>
                        <span style="opacity: 0.8; font-size: 0.9rem;"><?php echo date('Y', strtotime($row['event_date'])); ?></span>
                    </div>
                    <div style="padding: 2rem; flex: 1; display: flex; flex-direction: column; justify-content: center;">
                        <span style="font-size: 0.85rem; color: var(--secondary); font-weight: 700; text-transform: uppercase;"><i class="fas fa-map-marker-alt"></i> <?php echo $row['location']; ?></span>
                        <h3 style="font-size: 1.5rem; margin: 0.5rem 0;"><?php echo $row['title']; ?></h3>
                        <p style="color: var(--text-muted);"><?php echo $row['description']; ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <!-- Dummy Events if DB is empty -->
            <div class="card reveal" style="display: flex; flex-direction: row; border: none; box-shadow: var(--shadow-md); border-radius: 16px; overflow: hidden;">
                <div style="width: 200px; background: var(--primary); color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem; text-align: center;">
                    <h2 style="font-size: 3rem;">15</h2>
                    <span style="text-transform: uppercase; font-weight: 600; font-size: 1.25rem;">May</span>
                </div>
                <div style="padding: 2rem; flex: 1;">
                    <span style="font-size: 0.85rem; color: var(--secondary); font-weight: 700;"><i class="fas fa-map-marker-alt"></i> School Auditorium</span>
                    <h3 style="font-size: 1.5rem; margin: 0.5rem 0;">Annual Science Exhibition</h3>
                    <p style="color: var(--text-muted);">Showcasing the creative and innovative science projects developed by our students across all grades.</p>
                </div>
            </div>
            <div class="card reveal" style="display: flex; flex-direction: row; border: none; box-shadow: var(--shadow-md); border-radius: 16px; overflow: hidden;">
                <div style="width: 200px; background: var(--secondary); color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem; text-align: center;">
                    <h2 style="font-size: 3rem;">20</h2>
                    <span style="text-transform: uppercase; font-weight: 600; font-size: 1.25rem;">Jun</span>
                </div>
                <div style="padding: 2rem; flex: 1;">
                    <span style="font-size: 0.85rem; color: var(--primary); font-weight: 700;"><i class="fas fa-map-marker-alt"></i> Parents Lounge</span>
                    <h3 style="font-size: 1.5rem; margin: 0.5rem 0;">Parent-Teacher Meeting</h3>
                    <p style="color: var(--text-muted);">Interactive session between parents and faculty members to discuss student progress and curriculum for the next term.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
