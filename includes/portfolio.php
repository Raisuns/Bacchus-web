<?php
require_once __DIR__ . '/db.php';

$sql = "SELECT step_number, step_total, text, delay_class 
        FROM portfolio_steps 
        WHERE is_active = 1 
        ORDER BY sort_order, id";
$res = $conn->query($sql);

echo '<div class="content-980">';
echo '  <div class="process-holder">';

if ($res && $res->num_rows > 0) {
    $steps = [];
    while ($row = $res->fetch_assoc()) {
        $steps[] = [
            'num'   => (int)$row['step_number'],
            'total' => (int)$row['step_total'],
            'text'  => htmlspecialchars($row['text']),
            'delay' => trim($row['delay_class'])
        ];
    }

    // Cetak semua step dengan separator di antaranya
    $totalSteps = count($steps);
    foreach ($steps as $i => $step) {
        $classes = 'process animate';
        if ($step['delay'] !== '') {
            $classes .= ' ' . htmlspecialchars($step['delay']);
        }

        echo '    <div class="' . $classes . '">';
        echo '        <span>' . $step['num'] . '</span>';
        echo '        <span>/</span>';
        echo '        <span>' . $step['total'] . '</span>';
        echo '        <p class="process-txt">' . $step['text'] . '</p>';
        echo '    </div>';

        // Tambahkan separator kecuali setelah item terakhir
        if ($i < $totalSteps - 1) {
            $sepClass = 'separator animate';
            if ($step['delay'] !== '') {
                $sepClass .= ' ' . htmlspecialchars($step['delay']);
            }
            echo '    <div class="' . $sepClass . '"></div>';
        }
    }
} else {
    // fallback jika DB kosong
    echo '    <div class="process animate">';
    echo '        <span>1</span><span>/</span><span>3</span>';
    echo '        <p class="process-txt">Explore & Collect Information</p>';
    echo '    </div>';
    echo '    <div class="separator animate"></div>';
    echo '    <div class="process animate wait-03s">';
    echo '        <span>2</span><span>/</span><span>3</span>';
    echo '        <p class="process-txt">Explore & Collect Information</p>';
    echo '    </div>';
    echo '    <div class="separator animate wait-03s"></div>';
    echo '    <div class="process animate wait-06s">';
    echo '        <span>3</span><span>/</span><span>3</span>';
    echo '        <p class="process-txt">Explore & Collect Information</p>';
    echo '    </div>';
}

echo '  </div>';
echo '</div>';
