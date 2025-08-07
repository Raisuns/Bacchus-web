<?php
require_once __DIR__ . '/db.php';

$sql = "SELECT image_url FROM sliders WHERE is_active = 1 ORDER BY sort_order, id";
$res = $conn->query($sql);

echo '<div class="image-slider-wrapper relative slider1">';
echo '  <div id="slider1" class="image-slider slider">';

if ($res && $res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $img = htmlspecialchars($row['image_url']);
        echo '    <div><img src="' . $img . '" alt=""></div>';
    }
} else {
    // fallback jika kosong
    echo '    <div><img src="images/hero_img_01.jpg" alt=""></div>';
    echo '    <div><img src="images/hero_img_02.jpg" alt=""></div>';
    echo '    <div><img src="images/hero_img_03.jpg" alt=""></div>';
}

echo '  </div>';
echo '</div>';
