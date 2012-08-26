<?php

/**
 * sfGuardRegisterForm for registering new users
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: BasesfGuardChangeUserPasswordForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardRegisterForm extends BasesfGuardRegisterForm
{

    /**
     * @see sfForm
     */
    public function configure()
    {

        $this->validatorSchema['email_address'] = new sfValidatorEmail(array(), array('invalid' => 'You should provide valid email address'));

        $myDecorator = new myFormDecorator($this->getWidgetSchema());
        $this->widgetSchema->addFormFormatter('custom', $myDecorator);
        $this->widgetSchema->setFormFormatterName('custom');
        $this->widgetSchema->setNameFormat('%s');
    }

}