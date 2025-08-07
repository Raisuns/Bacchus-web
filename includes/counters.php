<?php
require_once __DIR__ . '/db.php';

$sql = "SELECT value, title, delay_class 
        FROM counters 
        WHERE is_active = 1 
        ORDER BY sort_order, id";
$res = $conn->query($sql);

if ($res && $res->num_rows > 0) {
    echo '<ul class="counter-widget">';
    while ($row = $res->fetch_assoc()) {
        $val   = htmlspecialchars($row['value']);
        $title = htmlspecialchars($row['title']);
        $delay = trim($row['delay_class']);
        $classes = 'animate';
        if ($delay !== '') {
            $classes .= ' ' . htmlspecialchars($delay);
        }
        echo '  <li class="' . $classes . '">';
        echo '      <p class="count">' . $val . '</p>';
        echo '      <span>' . $title . '</span>';
        echo '  </li>';
    }
    echo '</ul>';
} else {
    echo '<p class="text-center">Belum ada data counter.</p>';
}
