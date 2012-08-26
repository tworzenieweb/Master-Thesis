<ul id="category">
    
</ul>


<script id="categoryTemplate" type="text/x-jquery-tmpl"> 
    <li>
        <a href="${$item.url()}">${name}
        
            <span class="badge badge-success">${count}</span>
        </a>
    </li>
</script>

 
    
    
<script>
    var urlCat = "<?php echo sfConfig::get('app_gae'); ?>categories/";
    var link = "<?php echo url_for('@category_slug?slug=' . 'slug'); ?>";
    $(function() {
        
        $.getJSON(urlCat, function(data) {
            
           
           /* Render the template with the movies data */
           $( "#categoryTemplate" ).tmpl( data, {
               url: function() {
                   
                   return link.replace('slug', this.data.slug);
                   
               }
           }).appendTo( "#category" );
            
        });
        
    });
    
</script>