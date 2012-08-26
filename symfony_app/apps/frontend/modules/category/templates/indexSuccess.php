<div class="page-header">
<h1>Categories list</h1>
</div>

<table class="table table-condensed">
  <thead>
    <tr>
      <th>Name</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($categorys as $category): ?>
    <tr>
      <td><a href="<?php echo url_for('category/edit?id='.$category->getId()) ?>"><?php echo $category->getName() ?></a></td>
      <td><?php echo link_to('<i class="icon-edit"></i> Edit','category/edit?id=' . $category->getId(), array('class' => 'btn')) ?> 
      <?php echo link_to('Delete','category/delete?id=' . $category->getId(), array('method'  => 'delete', 
                 'confirm' => 'Do you really want to delete this category?', 'class' => 'btn btn-danger')) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('category/new') ?>" class="btn btn-info">New</a>
