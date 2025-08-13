<?php
// Ambil koneksi database
include 'includes/db.php';

// Query ambil semua data portfolio
$sql = "SELECT * FROM portfolio_items ORDER BY id ASC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<div class="grid-sizer"></div>';
    while ($row = mysqli_fetch_assoc($result)) {
        $target = $row['target_blank'] ? ' target="_blank"' : '';
        $data_rel = '';

        // Tentukan atribut berdasarkan tipe
        if ($row['item_type'] === 'video') {
            $data_rel = 'data-rel="prettyPhoto[gallery1]"';
        } elseif ($row['item_type'] === 'image') {
            $data_rel = 'data-rel="prettyPhoto[gallery1]"';
        }

        echo '<div class="grid-item element-item '.htmlspecialchars($row['css_class']).'">';
        echo '    <a '.$data_rel.' href="'.htmlspecialchars($row['full_url']).'"'.$target.'>';
        echo '        <img src="'.htmlspecialchars($row['thumb_image']).'" alt="">';
        echo '        <div class="portfolio-text-holder">';
        echo '            <div class="portfolio-text-wrapper">';
        echo '                <p class="portfolio-type">';
        echo '                    <img src="'.htmlspecialchars($row['icon_image']).'" alt="">';
        echo '                </p>';
        echo '                <p class="portfolio-text">'.htmlspecialchars($row['text_label']).'</p>';
        echo '            </div>';
        echo '        </div>';
        echo '    </a>';
        echo '</div>';
    }
    echo '<div class="clear"></div>';
}
?>
