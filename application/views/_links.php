<?php

echo "Welcome $username!";

foreach ($menu as $menu_item)
{
    echo '<a href="' . $menu_item['url'] . '" title="' . $menu_item['description'] . '">'. $menu_item['title'] . '</a>';
}

?>
