<?php 
include 'includes/header.php'; 
?>

<section class="hero reveal" style="padding: 6rem 0;">
    <div class="container">
        <h1>About Our School</h1>
        <p>A journey through our vision, values, and the legacy of excellence that defines Shwastik School.</p>
    </div>
</section>

<section>
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;">
            <div class="reveal">
                <h2 style="font-size: 2.5rem; color: var(--primary); margin-bottom: 2rem;">Our History & Legacy</h2>
                <p style="font-size: 1.15rem; color: var(--text-muted); line-height: 1.8; margin-bottom: 1.5rem;">Founded in 1998, Shwastik School has been at the forefront of providing quality education for over two decades. What started as a small community initiative has grown into a premier institution known for academic rigor and overall development of students.</p>
                <p style="font-size: 1.15rem; color: var(--text-muted); line-height: 1.8;">We believe that education is not just about textbooks, but about nurturing character, curiosity, and compassion. Our alumni are now serving in diverse fields globally, carrying the values they learned here.</p>
            </div>
            <div class="reveal" style="animation-delay: 0.2s;">
                <img src="assets/images/about-students.png" alt="Students Learning" style="width: 100%; border-radius: 20px; box-shadow: var(--shadow-lg);">
            </div>
        </div>
    </div>
</section>

<section style="background: var(--bg-alt);">
    <div class="container">
        <div class="grid-3" style="grid-template-columns: repeat(3, 1fr);">
            <div class="card reveal" style="padding: 3rem; text-align: center; border: none; box-shadow: var(--shadow-sm);">
                <div style="font-size: 3rem; color: var(--secondary); margin-bottom: 1.5rem;"><i class="fas fa-eye"></i></div>
                <h3 style="margin-bottom: 1rem; color: var(--primary);">Our Vision</h3>
                <p style="color: var(--text-muted);">To be a global leader in education, fostering students who can contribute positively to a dynamic world.</p>
            </div>
            <div class="card reveal" style="padding: 3rem; text-align: center; border: none; box-shadow: var(--shadow-sm); animation-delay: 0.1s;">
                <div style="font-size: 3rem; color: var(--secondary); margin-bottom: 1.5rem;"><i class="fas fa-bullseye"></i></div>
                <h3 style="margin-bottom: 1rem; color: var(--primary);">Our Mission</h3>
                <p style="color: var(--text-muted);">To provide a safe, inclusive, and challenging environment that encourages lifelong learning and personal growth.</p>
            </div>
            <div class="card reveal" style="padding: 3rem; text-align: center; border: none; box-shadow: var(--shadow-sm); animation-delay: 0.2s;">
                <div style="font-size: 3rem; color: var(--secondary); margin-bottom: 1.5rem;"><i class="fas fa-heart"></i></div>
                <h3 style="margin-bottom: 1rem; color: var(--primary);">Our Values</h3>
                <p style="color: var(--text-muted);">Integrity, Excellence, Respect, and Community are the pillars that support everything we do.</p>
            </div>
        </div>
    </div>
</section>

<!-- Principal Message -->
<section>
    <div class="container">
        <div style="background: white; border-radius: 24px; border: 1px solid #e2e8f0; padding: 4rem; display: flex; gap: 4rem; align-items: start; box-shadow: var(--shadow-md);">
            <div style="width: 300px; flex-shrink: 0;" class="reveal">
                <img src="assets/images/principal.png" alt="Principal" style="width: 100%; border-radius: 12px; filter: grayscale(10%);">
                <div style="margin-top: 1rem; text-align: center;">
                    <h3 style="color: var(--primary);">Dr. Aruna Sharma</h3>
                    <p style="color: var(--secondary); font-weight: 600;">Principal</p>
                </div>
            </div>
            <div class="reveal" style="animation-delay: 0.2s; position: relative;">
                <i class="fas fa-quote-left" style="font-size: 4rem; color: var(--bg-alt); position: absolute; top: -2rem; left: -2rem; z-index: -1;"></i>
                <h2 style="font-size: 2rem; color: var(--primary); margin-bottom: 1.5rem;">Message from the Principal</h2>
                <p style="font-size: 1.15rem; color: var(--text-muted); line-height: 1.8; font-style: italic; margin-bottom: 1.5rem;">"Dear Parents and Students, I am honored to lead Shwastik School in its mission to shape the next generation. Our commitment is to provide an environment where every child feels seen, heard, and challenged. We don't just teach subjects; we nurture thinkers and doers."</p>
                <p style="font-size: 1.15rem; color: var(--text-muted); line-height: 1.8;">"Together, let's create a future where excellence is the standard and kindness is the norm. I look forward to working with all of you to make Shwastik School the best it can be."</p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
