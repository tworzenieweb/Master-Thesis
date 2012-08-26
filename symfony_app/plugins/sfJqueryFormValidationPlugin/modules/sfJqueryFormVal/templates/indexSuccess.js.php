<?php $sf_jq_rules = $sf_data->getRaw('sf_jq_rules') ?>

processForm = function(form) {

    form.submit();

}

jQuery(function($){
  
  $('#<?php echo $sf_jq_rules->getFirstFieldHtmlId() ?>').parents('form').validate({
    rules: <?php echo ($sf_jq_rules->generateRules()) ?>,
    messages: <?php echo ($sf_jq_rules->generateMessages()) ?>,
    onkeyup: false,
    wrapper: 'span class="help-inline"',
    errorElement: 'span',
    errorPlacement: function(error, element) 
    {
    
    
     element.parent().parent().addClass('error');
    
     if(element.parents('.radio_list').is('*') || element.parents('.checkbox_list').is('*'))
     {
       error.appendTo( element.parent().parent().parent() );
     }
     else
     {
       error.appendTo( element.parent() );
     }

   },
   submitHandler: function(form) {
     
    processForm(form);
     
   }
   
  
  });
  
  <?php if($sf_jq_rules->getPostValidators()): ?>
    <?php foreach($sf_jq_rules->getPostValidators() as $pv): ?>
        <?php echo $pv . "\n" ?>
    <?php endforeach ?>
  <?php endif; ?>

});

/* for some reason the jQuery Validate plugin does not incluce a generic regex method */
jQuery.validator.addMethod(
  "regex",
  function(value, element, regexp) {
      if (regexp.constructor != RegExp)
          regexp = new RegExp(regexp);
      else if (regexp.global)
          regexp.lastIndex = 0;
      return this.optional(element) || regexp.test(value);
  },
  "Invalid."
);