<?php
include __DIR__ . '/db.php';

$query = mysqli_query($conn, "SELECT logo_path FROM site_settings LIMIT 1");
$row = mysqli_fetch_assoc($query);
$logoPath = $row['logo_path'] ?? 'images/default-logo.png';
?>

<img class="menu-logo" src="<?php echo htmlspecialchars($logoPath); ?>" alt="Bacchus">
