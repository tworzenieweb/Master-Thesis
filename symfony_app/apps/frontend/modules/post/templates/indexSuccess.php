<?php echo use_helper('Text'); ?>
<div class="page-header">
<h1>My posts list</h1>
</div>

<?php if(count($posts)): ?>

<table class="table table-condensed">

  <thead>
    <tr>
      <th>Title</th>
      <th>Body</th>
      <th>Category</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($posts as $post): ?>
    <tr>
      <td><a href="<?php echo url_for('@post_slug?slug='.$post->getSlug()) ?>"><?php echo $post->getTitle() ?></a></td>
      <td><?php echo truncate_text(preg_replace('/<[^>]*>/', '', html_entity_decode($post['body'])), 200 ) ?></td>
      <td><?php echo $post->getCategory() ?></td>
      <td><?php echo $post->getCreatedAt() ?></td>
      <td><?php echo $post->getUpdatedAt() ?></td>
      <td><?php echo link_to('<i class="icon-edit"></i> Edit','[pst/edit?id=' . $post->getId(), array('class' => 'btn')) ?> 
      <?php echo link_to('Delete','post/delete?id=' . $post->getId(), array('method'  => 'delete', 
                 'confirm' => 'Do you really want to delete this post?', 'class' => 'btn btn-danger')) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php else: ?>
  <p>Sorry currently no posts available</p>
  <?php endif; ?>

  <a href="<?php echo url_for('post/new') ?>" class="btn btn-info">Add New Post</a>