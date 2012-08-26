<?php

/**
 * category form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class categoryForm extends BasecategoryForm
{
  public function configure()
  {
      
      unset($this['slug']);
      
      $myDecorator = new myFormDecorator($this->getWidgetSchema());
        $this->widgetSchema->addFormFormatter('custom', $myDecorator);
        $this->widgetSchema->setFormFormatterName('custom');
      
      
  }
}
