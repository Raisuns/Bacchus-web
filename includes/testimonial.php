<?php
require_once __DIR__ . '/db.php';

$sql = "SELECT author_name, author_text, author_img 
        FROM testimonials 
        WHERE is_active = 1 
        ORDER BY sort_order, id";
$res = $conn->query($sql);

echo '<div class="testimonial-slider-holder relative">';
echo '  <div class="testimonial-slider-quote">“</div>';
echo '  <div id="text1" class="testimonial-slider slider">';

if ($res && $res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $name = htmlspecialchars($row['author_name']);
        $txt  = htmlspecialchars($row['author_text']);
        $img  = htmlspecialchars($row['author_img']);

        echo '    <div>';
        echo '      <div class="testimonial-content">';
        echo '          <p class="author-text">' . $txt . '</p>';
        echo '          <img class="author-img" src="' . $img . '" alt="' . $name . '"/>';
        echo '          <p class="author-name">' . $name . '</p>';
        echo '      </div>';
        echo '    </div>';
    }
} else {
    // fallback 3 dummy item
    echo '    <div><div class="testimonial-content"><p class="author-text">No testimonials yet.</p><img class="author-img" src="images/avatar_img_01@2x.png" alt=""/><p class="author-name">Anon</p></div></div>';
}

echo '  </div>';
echo '</div>';
