<div id="demo-page" class="my-page">
    <div role="main" class="ui-content">
        <ul data-role="listview" data-inset="true">
            <?php foreach ($images as $image): ?>
                <li>
                    <a href="#<?php echo $image['Image']['id']; ?>">
                        <img src="/cakephp/img/uploads/<?php echo $image['Image']['imageurl']; ?>" class="ui-li-thumb">
                        <h2><?php echo $image['Image']['title']; ?></h2>
                        <p><?php echo $image['Image']['description']; ?></p>
                    </a>
                </li>
            <?php endforeach; ?>
            <?php unset($image) ?>
        </ul>
    </div><!-- /content -->
</div>