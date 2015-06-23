<div id="sidebar">
    <h1>Sidebar Menu</h1>
    <ul class="sidemenu">
        <li><a href="<?php echo site_url() ?>">Home</a></li>
        <?php 
        foreach ($region as $key => $item) {
        ?>
            <li><a href="<?php echo site_url('data-region/' . $item->id) ?>"><?php echo $item->region_name ?></a></li>
        <?php
        }
        ?>
    </ul>
        <h1>Wise Words</h1>
    <p>&quot;Be not afraid of life. Believe that life is worth living, and your belief will help create the fact.&quot; </p>
    <p class="align-right">- William James</p>
    <h1>Support Styleshout</h1>
    <p>If you are interested in supporting my work and would like to contribute, you are welcome to make a small donation through the donate link on my website - it will be a great help and will surely be appreciated.</p>
</div>