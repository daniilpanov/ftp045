<?php
use loading as l;
?>

<div class="row">
    <div class="col-md-3" id="sidebar">
        <?php
        l\showview("sidebar");
        ?>
    </div>

    <div class="col-md-9" id="content">
        <?php
        l\showview("content");
        ?>
    </div>
</div>