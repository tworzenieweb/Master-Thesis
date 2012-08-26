<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of contactForm
 *
 * @author tworzenieweb
 */
class contactForm extends sfForm
{
    public function configure()
    {
        
        $this->setWidgets(array(
            'title' => new sfWidgetFormInputText(),
            'sender_email' => new sfWidgetFormInputText(),
            'sender' => new sfWidgetFormInputText(),
            'content' => new sfWidgetFormTextarea(),
            'phone' => new sfWidgetFormInputText(),
            'zip_code' => new sfWidgetFormInputText(),
        ));
        
        $this->setValidators(array(
            'title' => new sfValidatorString(array('min_length' => '5', 'max_length' => '100', 'required' => true)),
            'sender' => new sfValidatorString(array('min_length' => '5', 'max_length' => '100', 'required' => true)),
            'sender_email' => new sfValidatorEmail(array('required' => true)),
            'content' => new sfValidatorString(array('required' => true)),
            'phone' => new sfValidatorPhone(array('required' => true)),
            'zip_code' => new sfValidatorZip(),
        ));
        
        $this->widgetSchema->setNameFormat('contact[%s]');
        
        $myDecorator = new myFormDecorator($this->getWidgetSchema());
        $this->widgetSchema->addFormFormatter('custom', $myDecorator);
        $this->widgetSchema->setFormFormatterName('custom');
        
        
    }
}

?>
