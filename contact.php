<?php 
include 'includes/header.php'; 

$success_msg = "";
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $subject = sanitize($_POST['subject']);
    $message = sanitize($_POST['message']);

    if(empty($name) || empty($email) || empty($message)) {
        $error_msg = "Please fill in all required fields.";
    } elseif (!$conn) {
        $error_msg = "Database connection error. Please ensure your MySQL server is running.";
    } else {
        $sql = "INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        
        if ($stmt->execute()) {
            $success_msg = "Your message has been sent successfully. We will get back to you soon!";
        } else {
            $error_msg = "Error sending message. Please try again later.";
        }
        $stmt->close();
    }
}
?>

<section class="hero reveal" style="padding: 6rem 0;">
    <div class="container">
        <h1>Contact Us</h1>
        <p>We are here to help you. Reach out to us with any questions about admissions, academics, or events.</p>
    </div>
</section>

<div class="container" style="margin-bottom: 6rem; margin-top: -3rem;">
    <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 3rem;">
        <div class="reveal">
            <h2 style="font-size: 2rem; color: var(--primary); margin-bottom: 2rem;">Get in Touch</h2>
            <div style="display: flex; flex-direction: column; gap: 2rem;">
                <div style="display: flex; gap: 1.5rem; align-items: start;">
                    <div style="width: 50px; height: 50px; background: var(--bg-alt); color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;"><i class="fas fa-location-dot"></i></div>
                    <div>
                        <h4 style="font-size: 1.1rem; color: var(--primary);">School Address</h4>
                        <p style="color: var(--text-muted);">123 Education Square, Scholastic City, PIN-567890</p>
                    </div>
                </div>
                <div style="display: flex; gap: 1.5rem; align-items: start;">
                    <div style="width: 50px; height: 50px; background: var(--bg-alt); color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;"><i class="fas fa-phone"></i></div>
                    <div>
                        <h4 style="font-size: 1.1rem; color: var(--primary);">Phone Number</h4>
                        <p style="color: var(--text-muted);">+91 98765 43210 / +91 0123 45678</p>
                    </div>
                </div>
                <div style="display: flex; gap: 1.5rem; align-items: start;">
                    <div style="width: 50px; height: 50px; background: var(--bg-alt); color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;"><i class="fas fa-envelope"></i></div>
                    <div>
                        <h4 style="font-size: 1.1rem; color: var(--primary);">Email Address</h4>
                        <p style="color: var(--text-muted);">contact@shwastik.edu / admissions@shwastik.edu</p>
                    </div>
                </div>
            </div>

            <!-- Map Placeholder -->
            <div style="margin-top: 3rem; background: #e2e8f0; height: 300px; border-radius: 12px; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative;">
                <i class="fas fa-map-marked-alt" style="font-size: 3rem; color: var(--text-muted); opacity: 0.3;"></i>
                <p style="position: absolute; color: var(--text-muted); font-weight: 500;">Google Map Placeholder</p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115330.4564030462!2d82.89312948754167!3d25.402226154625292!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x398e2db763f017e7%3A0x7d39406623348108!2sVaranasi%2C%20Uttar%20Pradesh!5e0!3m2!1sen!2sin!4v1711200000000" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <div class="reveal">
            <div style="background: white; padding: 3rem; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: var(--shadow-sm);">
                <h2 style="font-size: 2rem; color: var(--primary); margin-bottom: 2rem;">Send Us a Message</h2>
                
                <?php if($success_msg): ?>
                    <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 8px; margin-bottom: 2rem; border-left: 5px solid #10b981;"><i class="fas fa-check-circle"></i> <?php echo $success_msg; ?></div>
                <?php endif; ?>
                <?php if($error_msg): ?>
                    <div style="background: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 8px; margin-bottom: 2rem; border-left: 5px solid #ef4444;"><i class="fas fa-exclamation-circle"></i> <?php echo $error_msg; ?></div>
                <?php endif; ?>

                <form action="contact.php" method="POST">
                    <div class="form-group">
                        <label for="name">Your Name *</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Full Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="example@email.com" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" class="form-control" placeholder="Topic of inquiry">
                    </div>
                    <div class="form-group">
                        <label for="message">Your Message *</label>
                        <textarea id="message" name="message" class="form-control" rows="5" placeholder="How can we help you?" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-size: 1.1rem; margin-top: 1rem;">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
