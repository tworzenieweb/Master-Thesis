<?php

function authors_list($authors) 
{
    $list = '';
    
    foreach($authors as $author) {
        
        $list .= $author['name'] . ' ' . $author['lastname'] . ',';
        
    }
    
    return substr($list, 0, strlen($list) -1);
    
}