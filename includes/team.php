<?php
require_once __DIR__ . '/db.php';

/* =======================
   SKILL BARS
   ======================= */
$sqlSkills = "SELECT skill_name, percent, delay_class 
              FROM team_skills 
              WHERE is_active = 1 
              ORDER BY sort_order, id";
$resSkills = $conn->query($sqlSkills);

echo '<div class="col-md-6 m-top-40">';

if ($resSkills && $resSkills->num_rows > 0) {
    while ($s = $resSkills->fetch_assoc()) {
        $skill = htmlspecialchars($s['skill_name']);
        $pct   = (int)$s['percent'];
        $delay = trim($s['delay_class']);

        $classes = 'progress_bar animate';
        if ($delay !== '') {
            $classes .= ' ' . htmlspecialchars($delay);
        }

        // width style Hard-coded ke percent
        echo '  <div class="' . $classes . '">';
        echo '      <div class="progress_bar_field_holder" style="width:' . $pct . '%;">';
        echo '          <div class="progress_bar_title">' . $skill . '</div>';
        echo '          <div class="progress_bar_percent_text">' . $pct . '%</div>';
        echo '          <div class="progress_bar_field_perecent"></div>';
        echo '      </div>';
        echo '  </div>';
    }
}
echo '</div>'; // /col-md-6 (skills)


/* =======================
   TEAM MEMBERS
   ======================= */
$sqlMembers = "SELECT name, position, image_url, bio, delay_class, featured 
               FROM team_members 
               WHERE is_active = 1 
               ORDER BY sort_order, id";
$resMembers = $conn->query($sqlMembers);

if ($resMembers && $resMembers->num_rows > 0) {
    while ($m = $resMembers->fetch_assoc()) {
        $name  = htmlspecialchars($m['name']);
        $pos   = htmlspecialchars($m['position']);
        $img   = htmlspecialchars($m['image_url'] ?? '');
        $bio   = htmlspecialchars($m['bio'] ?? '');
        $delay = trim($m['delay_class']);
        $feat  = (int)$m['featured'];

        if ($feat) {
            // featured block (Peter) tidak ada img di markup asli include (img besar sudah di index)
            $classes = 'col-md-6 team-member featured animate';
            if ($delay !== '') {
                $classes .= ' ' . htmlspecialchars($delay);
            }
            echo '<div class="' . $classes . '">';
            echo '  <div class="member-wrapper">';
            echo '      <h4 class="member-name">' . $name . '</h4>';
            echo '      <p class="member-position">' . $pos . '</p>';
            echo '      <div class="member-content"><p>' . $bio . '</p></div>';
            echo '  </div>';
            echo '</div>';
        } else {
            // anggota biasa (dengan img)
            $classes = 'col-sm-6 col-md-6 team-member animate';
            if ($delay !== '') {
                $classes .= ' ' . htmlspecialchars($delay);
            }
            echo '<div class="' . $classes . '">';
            if ($img !== '') {
                echo '  <img src="' . $img . '" alt="' . $name . '" />';
            }
            echo '  <div class="member-wrapper">';
            echo '      <h4 class="member-name">' . $name . '</h4>';
            echo '      <p class="member-position">' . $pos . '</p>';
            echo '      <div class="member-content"><p>' . $bio . '</p></div>';
            echo '  </div>';
            echo '</div>';
        }
    }
} else {
    echo '<div class="col-md-12"><p class="text-center">Belum ada member.</p></div>';
}
