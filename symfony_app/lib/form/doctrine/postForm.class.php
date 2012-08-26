<?php

/**
 * post form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class postForm extends BasepostForm
{

    public function configure()
    {

        unset($this['created_at']);
        unset($this['updated_at']);
        unset($this['slug']);

        
        $this->widgetSchema['body'] = new sfWidgetFormTextareaTinyMCE(array(
            'config' => 'width: "100%", height: "400px"'
        ));
        
        $myDecorator = new myFormDecorator($this->getWidgetSchema());
        $this->widgetSchema->addFormFormatter('custom', $myDecorator);
        $this->widgetSchema->setFormFormatterName('custom');


        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
    }

}
