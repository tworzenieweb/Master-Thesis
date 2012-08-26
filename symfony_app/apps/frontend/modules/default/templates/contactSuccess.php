<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="page-header">
    <h1>Send contact email</h1>
</div>
<?php if($sf_user->hasFlash('success')): ?>
<span class="label label-info"><?php echo $sf_user->getFlash('success'); ?></span>
<?php endif; ?>

<?php if($sf_user->hasFlash('error')): ?>
<span class="label label-warning"><?php echo $sf_user->getFlash('error'); ?></span>
<?php endif; ?>

<?php echo form_tag(url_for('@contact'), array('class' => 'well')); ?>
    <fieldset>
        <?php echo $form; ?>
        <button type="submit" class="btn">Send</button>
    </fieldset>
</form>

<script>
    
    $(function() {
        
        $(function($){
            $("#contact_phone").mask("*99-999-999?9");
            $("#contact_zip_code").mask("99-999");
        });
        
    });
    
</script>