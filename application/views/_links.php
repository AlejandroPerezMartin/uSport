
<p class="navbar-text">Welcome <?php echo $username; ?>!</p>

<?php

foreach ($menu as $menu_item)
{
    echo '<li><a href="' . $menu_item['url'] . '" title="' . $menu_item['description'] . '">'. $menu_item['title'] . '</a></li>';
}

?>
