<?php
include 'includes/db.php';
$section = $conn->query("SELECT * FROM support_section LIMIT 1")->fetch_assoc();
$items = $conn->query("SELECT * FROM support_items WHERE support_id = {$section['id']}");

echo '<div class="row no-gutter">';
echo '<div class="col-md-6 offset-md-6">';
echo '<div class="quote">';
echo '<h2 class="entry-title animate">'.htmlspecialchars($section['quote_text']).'</h2>';
echo '</div></div></div>';

echo '<div class="row no-gutter">';
echo '<div class="col-md-9 offset-md-3 support-service">';
echo '<div class="row no-gutter">';
while($item = $items->fetch_assoc()){
    echo '<div class="col-sm-2 '.$item['offset_class'].'">';
    echo '<img class="support-img" src="'.$item['icon_image'].'" alt="'.$item['alt_text'].'">';
    echo '<p class="support-item-text">'.$item['label'].'</p>';
    echo '</div>';
}
echo '</div>';
echo '<div class="row no-gutter">';
echo '<div class="col-md-11 m-top-40 animate wait-03s">'.htmlspecialchars($section['description']).'</div>';
echo '</div></div></div>';
?>
