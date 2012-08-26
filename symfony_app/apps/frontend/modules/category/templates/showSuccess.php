<div class="page-header">
    <h1>Książki w tej kategorii</h1>
</div>

<ul>
<?php foreach($books as $c): ?>

    
    <li><h4><?php echo link_to($c['title'], '@post_slug?slug=' . $c['slug']); ?></h4></li>


<?php endforeach; ?>


</ul>