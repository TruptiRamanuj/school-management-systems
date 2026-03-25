<?php 
include 'includes/header.php'; 
?>

<!-- Hero Section -->
<section class="hero reveal">
    <div class="container">
        <h1>Welcome to Shwastik School</h1>
        <p>Building the leaders of tomorrow with a perfect blend of modern education and traditional values.</p>
        <div style="display: flex; gap: 1rem; justify-content: center;">
            <a href="admission.php" class="btn btn-secondary">Admission Open 2026-27</a>
            <a href="about.php" class="btn btn-primary" style="background: white; color: var(--primary);">Explore More</a>
        </div>
    </div>
</section>

<!-- Highlights Section -->
<section>
    <div class="container">
        <div class="section-header">
            <h2>Why Choose Shwastik?</h2>
            <div class="line"></div>
        </div>
        <div class="grid-3">
            <div class="card reveal" style="animation-delay: 0.1s;">
                <div class="card-body text-center">
                    <div class="card-icon"><i class="fas fa-microscope"></i></div>
                    <h3>Modern Labs</h3>
                    <p>State-of-the-art science and computer laboratories for practical learning experiences.</p>
                </div>
            </div>
            <div class="card reveal" style="animation-delay: 0.2s;">
                <div class="card-body text-center">
                    <div class="card-icon"><i class="fas fa-medal"></i></div>
                    <h3>Top Excellence</h3>
                    <p>Consistent academic results and sports achievements at national and state levels.</p>
                </div>
            </div>
            <div class="card reveal" style="animation-delay: 0.3s;">
                <div class="card-body text-center">
                    <div class="card-icon"><i class="fas fa-bus"></i></div>
                    <h3>Safe Campus</h3>
                    <p>Comprehensive security system and safe transportation for all students across the city.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section (Optional but nice) -->
<section style="background: var(--bg-alt); padding: 4rem 0;">
    <div class="container">
        <div class="grid-3" style="text-align: center;">
            <div class="stat-item">
                <h2 style="font-size: 3rem; color: var(--primary);">1500+</h2>
                <p>Happy Students</p>
            </div>
            <div class="stat-item">
                <h2 style="font-size: 3rem; color: var(--primary);">80+</h2>
                <p>Expert Teachers</p>
            </div>
            <div class="stat-item">
                <h2 style="font-size: 3rem; color: var(--primary);">25+</h2>
                <p>Years Excellence</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section style="background: var(--primary); color: white; text-align: center; padding: 5rem 0;">
    <div class="container">
        <h2 style="font-size: 2.5rem; margin-bottom: 1.5rem;">Join Our School Today!</h2>
        <p style="margin-bottom: 2rem; opacity: 0.9;">Admissions for the upcoming session are now open. Secure your child's future with us.</p>
        <a href="admission.php" class="btn btn-secondary">Download Brochure</a>
        <a href="admission.php" class="btn btn-secondary" style="margin-left: 1rem;">Apply Online</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
