<?php
include 'includes/db.php';

$result = $conn->query("SELECT * FROM contact_info LIMIT 1");
$contact = $result->fetch_assoc();
?>

<div class="col-sm-6 col-md-6 contact-info">
    <p><?php echo nl2br(htmlspecialchars($contact['description'])); ?></p>
    <br>
    <p><b>Address:</b> <?php echo htmlspecialchars($contact['address']); ?></p>
    <p><b>Phone:</b> <?php echo htmlspecialchars($contact['phone']); ?></p>
    <p><b>Hours:</b> <?php echo htmlspecialchars($contact['hours']); ?></p>
</div>
