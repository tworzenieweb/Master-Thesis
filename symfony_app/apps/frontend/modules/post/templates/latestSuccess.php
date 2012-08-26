<?php use_helper('Author'); ?>

<div class="page-header">
    <h1>Latest books</h1>
    
</div>
<div class="row-fluid">
    
    <?php foreach($books as $book): ?>
    
    <h4><?php foreach($book['categories_list'] as $cat) { echo sprintf('<a href="%s"><span class="badge badge-success">%s</span></a>', url_for('@category_slug?slug=' . $cat['slug']), $cat['name']); } ?>
        <?php echo link_to($book['title'], '@post_slug?slug=' . $book['slug']) ?> (<small><?php echo authors_list($book['authors_list']) ?></small>)</h4>
    
    <?php endforeach; ?>
</div>
