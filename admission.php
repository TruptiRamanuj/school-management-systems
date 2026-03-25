<?php 
include 'includes/header.php'; 

$success_msg = "";
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = sanitize($_POST['full_name']);
    $dob = sanitize($_POST['dob']);
    $gender = sanitize($_POST['gender']);
    $parent_name = sanitize($_POST['parent_name']);
    $address = sanitize($_POST['address']);
    $phone = sanitize($_POST['phone']);
    $email = sanitize($_POST['email']);
    $class_selected = sanitize($_POST['class_selected']);

    if(empty($full_name) || empty($phone) || empty($email)) {
        $error_msg = "Please fill in all required fields.";
    } elseif (!$conn) {
        $error_msg = "Database connection error. Please ensure your MySQL server is running and dummy data is imported.";
    } else {
        $sql = "INSERT INTO admissions (full_name, dob, gender, parent_name, address, phone, email, class_selected) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $full_name, $dob, $gender, $parent_name, $address, $phone, $email, $class_selected);
        
        if ($stmt->execute()) {
            $success_msg = "Admission form submitted successfully! We will contact you soon.";
        } else {
            $error_msg = "Error submitting form. Please try again later.";
        }
        $stmt->close();
    }
}
?>

<section style="background: var(--primary); color: white; padding: 6rem 0 10rem; text-align: center;">
    <div class="container">
        <h1 style="font-size: 3rem; margin-bottom: 1rem;">Online Admission</h1>
        <p style="opacity: 0.9; max-width: 600px; margin: 0 auto;">Take the first step towards a bright future. Fill out the form below to apply for admission.</p>
    </div>
</section>

<div class="container">
    <div class="admission-form-wrapper reveal">
        <?php if($success_msg): ?>
            <div style="background: #dcfce7; color: #166534; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem; border-left: 5px solid #10b981;">
                <i class="fas fa-check-circle"></i> <?php echo $success_msg; ?>
            </div>
        <?php endif; ?>
        <?php if($error_msg): ?>
            <div style="background: #fee2e2; color: #991b1b; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem; border-left: 5px solid #ef4444;">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error_msg; ?>
            </div>
        <?php endif; ?>

        <form action="admission.php" method="POST">
            <h3 style="margin-bottom: 2rem; border-bottom: 2px solid var(--bg-alt); padding-bottom: 1rem; color: var(--primary);">Student Information</h3>
            <div class="form-row">
                <div class="form-group">
                    <label for="full_name">Student's Full Name *</label>
                    <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Enter Full Name" required>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth *</label>
                    <input type="date" id="dob" name="dob" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="gender">Gender *</label>
                    <select id="gender" name="gender" class="form-control" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="class_selected">Class Seeking Admission *</label>
                    <select id="class_selected" name="class_selected" class="form-control" required>
                        <option value="">Select Class</option>
                        <option value="Nursery">Nursery</option>
                        <option value="KG">KG</option>
                        <option value="Class 1">Class 1</option>
                        <option value="Class 2">Class 2</option>
                        <option value="Class 3">Class 3</option>
                        <option value="Class 4">Class 4</option>
                        <option value="Class 5">Class 5</option>
                        <option value="Class 6">Class 6</option>
                        <option value="Class 7">Class 7</option>
                        <option value="Class 8">Class 8</option>
                        <option value="Class 9">Class 9</option>
                        <option value="Class 10">Class 10</option>
                    </select>
                </div>
            </div>

            <h3 style="margin: 2rem 0; border-bottom: 2px solid var(--bg-alt); padding-bottom: 1rem; color: var(--primary);">Parent / Guardian Details</h3>
            <div class="form-row">
                <div class="form-group">
                    <label for="parent_name">Parent/Guardian Name *</label>
                    <input type="text" id="parent_name" name="parent_name" class="form-control" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number *</label>
                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="10-digit mobile number" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="example@email.com" required>
                </div>
                <div class="form-group">
                    <label for="address">Full Residential Address *</label>
                    <textarea id="address" name="address" class="form-control" rows="1" required></textarea>
                </div>
            </div>

            <div style="text-align: center; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary" style="padding: 1rem 3rem; font-size: 1.1rem;">Submit Application</button>
            </div>
        </form>
    </div>
</div>

<section style="height: 10rem;"></section>

<?php include 'includes/footer.php'; ?>
