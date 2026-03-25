<?php 
include 'includes/header.php'; 

$sql = "SELECT * FROM gallery ORDER BY uploaded_at DESC";
$result = $conn ? $conn->query($sql) : null;
?>

<section class="hero reveal">
    <div class="container">
        <h1>School Gallery</h1>
        <p>A glimpse into the vibrant life and activities at Shwastik School.</p>
    </div>
</section>

<div class="container" style="margin-bottom: 6rem; margin-top: -3rem;">
    <!-- Gallery Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
        <?php if($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="card reveal" style="border-radius: 12px; overflow: hidden; position: relative; border: none; box-shadow: var(--shadow-sm);">
                    <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['caption']; ?>" style="width: 100%; height: 250px; object-fit: cover;">
                    <div style="padding: 1rem; background: white;">
                        <span style="display: inline-block; padding: 0.25rem 0.75rem; background: var(--bg-alt); color: var(--primary); border-radius: 4px; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.5rem;"><?php echo $row['category']; ?></span>
                        <p style="font-weight: 500;"><?php echo $row['caption']; ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <!-- Placeholder Local Images if DB is empty -->
            <div class="card reveal" style="border-radius: 12px; overflow: hidden; position: relative; border: none; box-shadow: var(--shadow-sm);">
                <img src="assets/images/classroom.png" alt="Smart Classroom" style="width: 100%; height: 250px; object-fit: cover;">
                <div style="padding: 1rem; background: white;">
                    <span style="display: inline-block; padding: 0.25rem 0.75rem; background: var(--bg-alt); color: var(--primary); border-radius: 4px; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.5rem;">Activities</span>
                    <p style="font-weight: 500;">Learning session in the smart classroom.</p>
                </div>
            </div>
            <div class="card reveal" style="border-radius: 12px; overflow: hidden; position: relative; border: none; box-shadow: var(--shadow-sm);">
                <img src="assets/images/lab.png" alt="Science Lab" style="width: 100%; height: 250px; object-fit: cover;">
                <div style="padding: 1rem; background: white;">
                    <span style="display: inline-block; padding: 0.25rem 0.75rem; background: var(--bg-alt); color: var(--primary); border-radius: 4px; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.5rem;">Infrastructure</span>
                    <p style="font-weight: 500;">Modern science lab facilities.</p>
                </div>
            </div>
            <div class="card reveal" style="border-radius: 12px; overflow: hidden; position: relative; border: none; box-shadow: var(--shadow-sm);">
                <img src="assets/images/sports.png" alt="Sports ground" style="width: 100%; height: 250px; object-fit: cover;">
                <div style="padding: 1rem; background: white;">
                    <span style="display: inline-block; padding: 0.25rem 0.75rem; background: var(--bg-alt); color: var(--primary); border-radius: 4px; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.5rem;">Sports</span>
                    <p style="font-weight: 500;">Main football ground and track.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
