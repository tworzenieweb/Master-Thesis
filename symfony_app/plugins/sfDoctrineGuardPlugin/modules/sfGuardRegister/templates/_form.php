<?php use_helper('I18N') ?>


<form action="<?php echo url_for('@sf_guard_register') ?>" method="post" class="well">
    <fieldset>
    <?php echo $form ?>
    
    <button type="submit" class="btn">Register</button>
    </fieldset>
</form>