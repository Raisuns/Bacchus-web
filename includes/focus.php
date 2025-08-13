<?php
include 'includes/db.php';

$focus = $conn->query("SELECT * FROM focus_section LIMIT 1")->fetch_assoc();
?>

<div class="col-md-6">
    <img src="<?php echo htmlspecialchars($focus['image_path']); ?>" alt="<?php echo htmlspecialchars($focus['image_alt']); ?>">
</div>
<div class="col-md-6">
    <div class="focus-holder">
        <h2 class="entry-title"><?php echo htmlspecialchars($focus['title']); ?></h2>
        <br><br>
        <p><?php echo htmlspecialchars($focus['paragraph1']); ?></p>
        <br>
        <p><?php echo htmlspecialchars($focus['paragraph2']); ?></p>
    </div>
</div>
