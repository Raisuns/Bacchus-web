<?php
include 'includes/db.php';

// Ambil data section
$section = $conn->query("SELECT * FROM services_section LIMIT 1")->fetch_assoc();

// Ambil list services
$services = $conn->query("SELECT * FROM services_items");
?>

<div class="row no-gutter"> 
    <div class="col-lg-5 animate">                            
        <h2 class="big-title"><?= htmlspecialchars($section['big_title']); ?></h2> 
        <p><?= nl2br(htmlspecialchars($section['description_1'])); ?></p>
        <br>
        <p><?= nl2br(htmlspecialchars($section['description_2'])); ?></p>
    </div>
    <div class="col-lg-5 offset-lg-2 service-items-holder">
        <?php while ($srv = $services->fetch_assoc()) : ?>
            <div class="row no-gutter animate">
                <div class="service-holder">
                    <div class="service-img"> 
                        <img src="<?= htmlspecialchars($srv['icon_path']); ?>" alt="">
                    </div>
                    <div class="service-txt">
                        <h4><?= htmlspecialchars($srv['title']); ?></h4>
                        <p><?= htmlspecialchars($srv['description']); ?></p>
                    </div>
                </div>
            </div>
            <br><br>
        <?php endwhile; ?>
    </div>
</div>
