<?php
use loading as l;
?>

<div id="left-sidebar">
    <?php
    l\showview("left-sidebar");
    ?>
</div>

<div id="content">
    <?php
    \app\Router::showMainView();
    ?>
</div>

<div id="right-sidebar">
    <button id="open-sidebar"><i class="icon icon-tasks"></i></button>
    <div id="right-sidebar-content">
        <?php
        l\showview("right-sidebar");
        ?>
    </div>
</div>