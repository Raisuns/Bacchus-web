<?php
session_start();
require_once __DIR__ . '/db.php';

// Cek login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Ambil data user dari session
$username = htmlspecialchars($_SESSION['user']['username']);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Dashboard <?= $username ?></title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/daisyui@2.51.6/dist/full.js"></script>
</head>
<body class="min-h-screen bg-slate-900 text-slate-100">
  <div class="flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-slate-800 min-h-screen border-r border-slate-700 relative">
      <div class="p-4 text-center border-b border-slate-700">
        <div class="text-xl font-bold"><?= $username ?></div>
        <div class="text-sm text-slate-400">Admin Panel</div>
      </div>
      <nav class="p-4 space-y-1">
        <a href="dashboard.php" class="block p-2 rounded hover:bg-slate-700">Dashboard</a>
        <a href="https://wa.me/6285712646255" class="block p-2 rounded hover:bg-slate-700">Wa</a>
        <a href="https://github.com/Raisuns" class="block p-2 rounded hover:bg-slate-700">Github</a>
        <a href="https://raisuns.github.io/portfolio-web/" class="block p-2 rounded hover:bg-slate-700">Portfolio-Github</a>
      </nav>
      <div class="absolute bottom-4 left-4 right-4">
        <a href="logout.php" class="block bg-red-600 text-center py-2 rounded">Logout</a>
      </div>
    </aside>

    <main class="flex-1 p-6">
      <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Welcome, <?= $username ?></h1>
        <div class="text-sm text-slate-400">Last login: <?= date('Y-m-d H:i') ?></div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-slate-800 p-4 rounded shadow">
          <div class="text-sm text-slate-400">Total Sliders</div>
          <?php
            $r = $conn->query("SELECT COUNT(*) AS c FROM sliders");
            $count = $r ? intval($r->fetch_assoc()['c']) : 0;
            echo '<div class="text-2xl font-bold mt-2">'.$count.'</div>';
          ?>
        </div>

        <div class="bg-slate-800 p-4 rounded shadow">
          <div class="text-sm text-slate-400">Active Admin</div>
          <div class="text-2xl font-bold mt-2">1</div>
        </div>

        <div class="bg-slate-800 p-4 rounded shadow">
          <div class="text-sm text-slate-400">Change the Logo</div>
          <div class="mt-2 space-x-2">
            <a href="./logo_list.php" class="btn btn-sm btn-primary">Manage Logo</a>
          </div>
        </div>

        <div class="bg-slate-800 p-4 rounded shadow">
          <div class="text-sm text-slate-400">Quick Actions</div>
          <div class="mt-2 space-x-2">
            <a href="slider_list.php" class="btn btn-sm btn-primary">Manage Slider</a>
          </div>
        </div>

        <div class="bg-slate-800 p-4 rounded shadow">
          <div class="text-sm text-slate-400">Manage Services Step 1</div>
          <div class="mt-2 space-x-2">
            <a href="services_section.php" class="btn btn-sm btn-primary">Manage Services</a>
          </div>
        </div>

        <div class="bg-slate-800 p-4 rounded shadow">
          <div class="text-sm text-slate-400">Manage Services Step 2</div>
          <div class="mt-2 space-x-2">
            <a href="services_items.php" class="btn btn-sm btn-primary">Manage Services</a>
          </div>
        </div>

        <div class="bg-slate-800 p-4 rounded shadow">
          <div class="text-sm text-slate-400">Manage Portfolio</div>
          <div class="mt-2 space-x-2">
            <a href="portfolio_items.php" class="btn btn-sm btn-primary">Manage Portfolio item</a>
          </div>
        </div>

        <div class="bg-slate-800 p-4 rounded shadow">
          <div class="text-sm text-slate-400">Manage Portfolio</div>
          <div class="mt-2 space-x-2">
            <a href="portfolio_steps.php" class="btn btn-sm btn-primary">Manage Portfolio steps</a>
          </div>
        </div>


        <div class="bg-slate-800 p-4 rounded shadow">
          <div class="text-sm text-slate-400">Manage News</div>
          <div class="mt-2 space-x-2">
            <a href="news_section.php" class="btn btn-sm btn-primary">Manage News</a>
          </div>
        </div>

        <div class="bg-slate-800 p-4 rounded shadow">
          <div class="text-sm text-slate-400">Manage Support</div>
          <div class="mt-2 space-x-2">
            <a href="support_items.php" class="btn btn-sm btn-primary">Manage support items</a>
          </div>
        </div>

        <div class="bg-slate-800 p-4 rounded shadow">
          <div class="text-sm text-slate-400">Manage Support</div>
          <div class="mt-2 space-x-2">
            <a href="support_section.php" class="btn btn-sm btn-primary">Manage Support section</a>
          </div>
        </div>

        <div class="bg-slate-800 p-4 rounded shadow">
          <div class="text-sm text-slate-400">Manage focus</div>
          <div class="mt-2 space-x-2">
            <a href="focus_section.php" class="btn btn-sm btn-primary">Manage focus-section</a>
          </div>
        </div>

        <div class="bg-slate-800 p-4 rounded shadow">
          <div class="text-sm text-slate-400">Manage Testimonial</div>
          <div class="mt-2 space-x-2">
            <a href="testimonials.php" class="btn btn-sm btn-primary">Manage Testimonial</a>
          </div>
        </div>

        <div class="bg-slate-800 p-4 rounded shadow">
          <div class="text-sm text-slate-400">Manage pricing</div>
          <div class="mt-2 space-x-2">
            <a href="pricing_features.php" class="btn btn-sm btn-primary">Manage pricing-features</a>
          </div>
        </div>

        <div class="bg-slate-800 p-4 rounded shadow">
          <div class="text-sm text-slate-400">Manage pricing</div>
          <div class="mt-2 space-x-2">
            <a href="pricing_plans.php" class="btn btn-sm btn-primary">Manage pricing-plans</a>
          </div>
        </div>

        <div class="bg-slate-800 p-4 rounded shadow">
          <div class="text-sm text-slate-400">Manage team</div>
          <div class="mt-2 space-x-2">
            <a href="team_members.php" class="btn btn-sm btn-primary">Manage team-members</a>
          </div>
        </div>

        <div class="bg-slate-800 p-4 rounded shadow">
          <div class="text-sm text-slate-400">Manage team-skills</div>
          <div class="mt-2 space-x-2">
            <a href="team_skills.php" class="btn btn-sm btn-primary">Manage team-skills</a>
          </div>
        </div>

        <div class="bg-slate-800 p-4 rounded shadow">
          <div class="text-sm text-slate-400">Manage Counters</div>
          <div class="mt-2 space-x-2">
            <a href="counters.php" class="btn btn-sm btn-primary">Manage Counters</a>
          </div>
        </div>

        <div class="bg-slate-800 p-4 rounded shadow">
          <div class="text-sm text-slate-400">Manage Contact-info</div>
          <div class="mt-2 space-x-2">
            <a href="contact_info.php" class="btn btn-sm btn-primary">Manage Contact-info</a>
          </div>
        </div>

        <div class="bg-slate-800 p-4 rounded shadow">
          <div class="text-sm text-slate-400">Manage Contact-messages</div>
          <div class="mt-2 space-x-2">
            <a href="contact_messages.php" class="btn btn-sm btn-primary">Manage Contact-messages</a>
          </div>
        </div>

      </div>
    </main>
  </div>
</body>
</html>
