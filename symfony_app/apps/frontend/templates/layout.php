<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    
  </head>
  <body>
      <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
            <a class="brand" href="<?php echo url_for('@homepage') ?>"><?php echo $sf_context->getResponse()->getTitle(); ?></a>
          
          <?php if($sf_user->isAuthenticated()): ?>
          <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="icon-user"></i> <?php echo sprintf('Hi %s', $sf_user->getGuardUser()) ?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="#">Profile</a></li>
              <li class="divider"></li>
              <li><a href="<?php echo url_for('@sf_guard_signout'); ?>">Sign Out</a></li>
            </ul>
          </div>
          <?php else: ?>
          <div class="btn-group pull-right">
            <a class="btn" href="<?php echo url_for('@sf_guard_signin'); ?>">
              <i class="icon-user"></i> Login
            </a>
          </div>
          <?php endif; ?>
          <div class="nav-collapse">
<!--            <ul class="nav">
              <li class="active"><a href="<?php echo url_for('@homepage') ?>">Home</a></li>
              
              <li><a href="<?php echo url_for('@contact'); ?>">Contact</a></li>
            </ul>-->
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        
          <?php if (has_slot('sidebar')): ?>
                <?php include_slot('sidebar') ?>
            <?php else: ?>
  
              <div class="span3">
                  <div class="well sidebar-nav">
                      
                      
                      <ul class="nav nav-list">
                          <li class="nav-header">Kategorie książek</li>
                          <?php include_component('default', 'categories'); ?>
                          
                      </ul>
                  </div><!--/.well -->
              </div><!--/span-->
              
          <?php endif; ?>
        <div class="span9">
          <div class="hero-unit">
            <h1>BOOczeK</h1>
            <p>Elektroniczna księgarnia na miarę twoich potrzeb</p>
            <p><a class="btn btn-primary btn-large" href="<?php echo url_for('@latest') ?>">Zobacz nowości &raquo;</a></p>
          </div>
            
            
          <div class="row-fluid" style="min-height: 300px;">
              <?php echo $sf_content ?>
          </div>
          <?php include_component('default', 'footer'); ?>
          
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Company 2012</p>
      </footer>

    </div>
    <?php include_javascripts() ?>
  </body>
</html>
