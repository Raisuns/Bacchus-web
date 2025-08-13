<?php
include 'includes/db.php';

$newsItems = $conn->query("SELECT * FROM news_section ORDER BY id ASC");
?>

<div class="row no-gutter news-holder">
    <?php 
    $count = 1;
    while ($news = $newsItems->fetch_assoc()): 
    ?>
        <div class="col-sm-6 col-md-6 post post-<?php echo $count; ?>">
            <p class="category"><?php echo htmlspecialchars($news['category']); ?></p>
            <h2 class="entry-title"><?php echo htmlspecialchars($news['title']); ?></h2>
            <p class="excerpt"><?php echo htmlspecialchars($news['excerpt']); ?></p>
            <a class="read-more" href="<?php echo htmlspecialchars($news['link']); ?>">Read More</a>
        </div>
    <?php 
    $count++;
    endwhile; 
    ?>
</div>
