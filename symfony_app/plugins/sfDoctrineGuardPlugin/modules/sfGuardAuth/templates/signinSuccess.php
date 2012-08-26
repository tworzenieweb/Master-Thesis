<?php use_helper('I18N') ?>

<div class="page-header">
<h1><?php echo __('Signin', null, 'sf_guard') ?></h1>
</div>
<?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>