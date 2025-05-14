
<?php
// Check if session is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Require database connection
require '../../connection.php';

// Function to check if user is authenticated
function is_authenticated() {
    return isset($_SESSION['user_id']) || isset($_SESSION['admin_id']) || isset($_SESSION['landlord_id']);
}

// Function to check user's role
function user_role() {
    if (isset($_SESSION['user_id'])) {
        return 'user';
    } elseif (isset($_SESSION['admin_id'])) {
        return 'admin';
    } elseif (isset($_SESSION['landlord_id'])) {
        return 'landlord';
    } else {
        return 'public';
    }
}

// Function to get user's avatar
function get_avatar() {
  if (isset($_SESSION['user_id'])) {
      return 'avatar.png';
  } elseif (isset($_SESSION['admin_id'])) {
      return 'admin.webp';
  } elseif (isset($_SESSION['landlord_id'])) {
      return 'landlord.jpg';

}}

// Function to get user's status (admin, landlord, or user)
function get_user_status() {
    // Logic to determine user's status (e.g., admin, landlord, or user)
    // Replace this with your actual implementation
    switch (user_role()) {
        case 'admin':
            return 'Admin';
        case 'landlord':
            return 'Landlord';
        case 'user':
            return 'User';
        default:
            return 'Public';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Header</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="navbar">
    <?php if (is_authenticated()) { ?>
        <a href="profile.php">
            <img src="<?php echo get_avatar(); ?>" alt="Avatar" width="40" height="40"><br>
            <?php echo $_SESSION['username']; ?> (<?php echo get_user_status(); ?>)
        </a>
        <header id="masthead">
        <div class="cover-container">
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="property.php">Properties</a></li>
                    <li><a href="adverts.php">Adverts</a></li>
                    <li><a href="inventory_details.php">Inventory</a></li>
                    <li><a href="Tenant.php">Tenancy Account</a></li>
                    <li><a href="testimonial.php">Testimonial</a></li>
                    <li><a href="contact_us.php">Contact Us</a></li>
                    <li><a href="login.php">Sign In</a></li>
                    <li><a href="landlord.php">Landlord</a></li>
                    
                </ul>
            </nav>
        </div>
    </header>
        <a href="contact_us.php">Contact Us</a>
        <?php if (user_role() === 'admin') { ?>
            <a href="testimonial_manage.php">Manage Testimonials</a>
            <a href="contact_us_manage.php">Manage Contact Messages</a>
        <?php } elseif (user_role() === 'landlord') { ?>
            <a href="landlord_dashboard.php">Landlord Dashboard</a>
        <?php } elseif (user_role() === 'user') { ?>
            <a href="property_listing.php">Properties</a>
            <a href="Adverts.php">Adverts</a>
            <a href="inventory.php">Inventory</a>
            <a href="tenancy.php">Tenancy Account</a>
            <a href="testimonial.php">Testimonial</a>
        <?php } ?>
        <a href="logout.php">Logout</a>
    <?php } else { ?>
        <a href="login.php">Login</a>
        <a href="registration.php">Register</a>
    <?php } ?>
</div>

</body>
</html>

