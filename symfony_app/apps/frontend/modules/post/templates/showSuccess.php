<div class="page-header">
    <h1><?php echo $book['title']; ?> <small>
        <?php foreach($book['categories_list'] as $cat) { echo sprintf('<a href="%s"><span class="badge badge-success">%s</span></a>', url_for('@category_slug?slug=' . $cat['slug']), $cat['name']); } ?>
        </small></h1>
    
    <h2><?php foreach($book['authors_list'] as $author) { echo $author['name'] . ' ' . $author['lastname'] . ', '; } ?></h2>
</div>
<div class="row-fluid">
    <p>Ocena: <?php echo str_repeat('<i class="icon-star"></i>', ceil($book['average'])) ?><?php echo str_repeat('<i class="icon-star-empty"></i>', 5 - ceil($book['average'])) ?></p>
<div class="span4"><?php echo strip_tags($book['description'], '<p><a><strong><h3><h4><b><i><em>'); ?><br /><br /></div>



</div>

<div class="row-fluid">
    <div class="span4" id="comments">
        
    </div>
</div>

<?php if($sf_user->isAuthenticated()): ?>
<div class="row-fluid">
    <div class="span4">
    <h3>Dodaj komentarz</h3>
    
    <form class="well" method="post" id="commentForm" action="<?php echo url_for('@comment_post'); ?>">
        <label>Tytuł</label>
        <input type="text" class="span12" name="title" placeholder="Wpisz tytuł…">
        
        <label>Ocena</label>
        <select class="span2" name="grade">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
        
        <textarea class="span12" name="content" placeholder="Wpisz treść"></textarea>
        <input type="hidden" name="book" value="<?php echo $book['id'] ?>" />
        <input type="hidden" name="user" value="<?php echo $sf_user->getGuardUser()->id; ?>" />
        
        <button type="submit" class="btn">Dodaj</button>
    </form>
    </div>
</div>
<?php else: ?>

Musisz się <?php echo link_to('zalogować', '@sf_guard_signin'); ?> by móc dodać komentarz

<?php endif; ?>

<script id="commentTemplate" type="text/x-jquery-tmpl"> 
    <div class="row-fluid">
          <h4>${title} {{html $item.getStars()}}</h4>
           <p>${content}</p>
          <p>${date}${user.first_name} ${user.last_name} (${user.username})</p>
    </div>
</script>

<script>
    var url = "<?php echo sfConfig::get('app_gae') . 'comments/' . $book['id'] . '/'; ?>";
    
    var reloadComments = function() {
        $("#comments").html('');
        $.getJSON(url, function(data) {
           
           /* Render the template with the movies data */
           $( "#commentTemplate" ).tmpl( data, { 
    getStars: function( ) {
        var str = '';
        for(i=0; i < this.data.grade; i++) {
            str += '<i class="icon-star"></i>'
        }
        
        for(j=i; j < 5; j++) {
            str += '<i class="icon-star-empty"></i>'
        }
        
        return str;
    }
}).appendTo( "#comments" );
           
       });
        
    }
    
    $(function() {
       
       reloadComments();
       
       
       $('#commentForm').submit(function (e){
           e.preventDefault();
           
           $.ajax({
               url: url,
               data: $(this).serialize(),
               xhrFields: {
                   withCredentials: true
                   
               },
               type: 'POST',
               
               beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "<?php echo $sf_user->getAttribute('user_authorization', null, 'sfGuardSecurityUser') ?>");
               },
               
               success: function(data) {
                   reloadComments();
               }
           });
           
       });
       
    });
</script>