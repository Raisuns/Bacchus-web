<?php
require_once __DIR__ . '/db.php';

/* Ambil semua plan */
$sqlPlans = "SELECT id, title, price, currency, delay_class 
             FROM pricing_plans 
             WHERE is_active = 1 
             ORDER BY sort_order, id";
$resPlans = $conn->query($sqlPlans);

if ($resPlans && $resPlans->num_rows > 0) {
    while ($plan = $resPlans->fetch_assoc()) {
        $pid    = (int)$plan['id'];
        $title  = htmlspecialchars($plan['title']);
        $price  = htmlspecialchars(rtrim(rtrim($plan['price'], '0'), '.')); // 29, 49, 69
        $curr   = htmlspecialchars($plan['currency']);
        $delay  = trim($plan['delay_class']);

        // class col
        // Template: <div class="col-md-4"><div class="pricing-holder price1 animate wait-03s">...
        // Kita nggak punya price1/2/3 di DB; bisa generate dari loop index.
        // Ambil index via static counter:
        static $colIdx = 0; $colIdx++;
        $priceClass = 'price' . $colIdx;

        $classes = 'pricing-holder ' . $priceClass . ' animate';
        if ($delay !== '') {
            $classes .= ' ' . htmlspecialchars($delay);
        }

        echo '<div class="col-md-4">';
        echo '  <div class="' . $classes . '">';
        echo '      <p class="pricing-title">' . $title . '</p>';
        echo '      <div class="pricing-content">';

        // fitur
        $sqlFeat = "SELECT feature_text, is_included 
                    FROM pricing_features 
                    WHERE plan_id = $pid 
                    ORDER BY sort_order, id";
        $resFeat = $conn->query($sqlFeat);
        if ($resFeat && $resFeat->num_rows > 0) {
            while ($f = $resFeat->fetch_assoc()) {
                $fText = htmlspecialchars($f['feature_text']);
                $inc   = (int)$f['is_included'];
                if ($inc) {
                    echo '          <p>' . $fText . '</p>';
                } else {
                    echo '          <p><del>' . $fText . '</del></p>';
                }
            }
        }

        echo '      </div>'; // pricing-content
        echo '      <p class="pricing-price"><span>' . $curr . '</span>' . $price . '</p>';
        echo '      <a class="pricing-buy" href="single.php">BUY</a>';
        echo '  </div>'; // pricing-holder
        echo '</div>';   // col
    }
} else {
    echo '<p class="text-center">Belum ada paket pricing.</p>';
}
