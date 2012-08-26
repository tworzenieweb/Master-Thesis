<?php use_helper('I18N') ?>

<h1>Register <small>to have full access to application</small></h1>


<?php echo get_partial('sfGuardRegister/form', array('form' => $form)) ?>

<script>

processForm = function(form) {
 
    var toSend = $(form).serializeArray();
    
    for(var key in toSend) {
        
        if(toSend[key].name == 'email_address') {
            
            toSend[key].name = 'email';
        }
        
        if(toSend[key].name in {'id': 1, 'password_again': 1, '_csrf_token': 1, 'email_address': 1})
            delete toSend[key];
        
        
    }
 
    $.post('<?php echo sfConfig::get('app_gae') ?>register/', toSend, function(data) {
    
            alert(data);
            
            
    
    }, 'json').error(function(data) {
        var d = $.parseJSON(data.responseText);
        
        console.log(d);
    });
 
}

</script>