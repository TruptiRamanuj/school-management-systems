<?php
include_once 'db.php';
$active_page = basename($_SERVER['PHP_SELF'], ".php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shwastik School | Excellence in Education</title>
    <meta name="description" content="Shwastik School is dedicated to providing high-quality education and holistic development for students. Apply today!">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <nav class="navbar">
                <div class="logo">
                    <a href="index.php">
                        <h1>Shwastik <span>School</span></h1>
                    </a>
                </div>
                <ul class="nav-links">
                    <li><a href="index.php" class="<?php echo $active_page == 'index' ? 'active' : ''; ?>">Home</a></li>
                    <li><a href="about.php" class="<?php echo $active_page == 'about' ? 'active' : ''; ?>">About</a></li>
                    <li class="dropdown">
                        <a href="departments.php" class="<?php echo $active_page == 'departments' ? 'active' : ''; ?>">Departments <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <?php 
                            $deps = get_departments();
                            if(!empty($deps)):
                            foreach($deps as $dep):
                            ?>
                            <li><a href="departments.php?id=<?php echo $dep['id']; ?>"><?php echo $dep['name']; ?></a></li>
                            <?php endforeach;
                            else: ?>
                            <li><a href="#">No departments listed</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li><a href="admission.php" class="<?php echo $active_page == 'admission' ? 'active' : ''; ?>">Admission</a></li>
                    <li><a href="gallery.php" class="<?php echo $active_page == 'gallery' ? 'active' : ''; ?>">Gallery</a></li>
                    <li><a href="events.php" class="<?php echo $active_page == 'events' ? 'active' : ''; ?>">Events</a></li>
                    <li><a href="contact.php" class="<?php echo $active_page == 'contact' ? 'active' : ''; ?>">Contact</a></li>
                </ul>
                <div class="nav-cta">
                    <a href="admission.php" class="btn btn-secondary">Apply Now</a>
                </div>
                <div class="mobile-toggle">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>
        </div>
    </header>
