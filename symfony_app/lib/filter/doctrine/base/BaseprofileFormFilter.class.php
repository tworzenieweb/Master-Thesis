<?php

/**
 * profile filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseprofileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'phone'     => new sfWidgetFormFilterInput(),
      'gender'    => new sfWidgetFormChoice(array('choices' => array('' => '', 'male' => 'male', 'female' => 'female'))),
      'address'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'region_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Region'), 'add_empty' => true)),
      'user_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'phone'     => new sfValidatorPass(array('required' => false)),
      'gender'    => new sfValidatorChoice(array('required' => false, 'choices' => array('male' => 'male', 'female' => 'female'))),
      'address'   => new sfValidatorPass(array('required' => false)),
      'region_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Region'), 'column' => 'id')),
      'user_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'profile';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'phone'     => 'Text',
      'gender'    => 'Enum',
      'address'   => 'Text',
      'region_id' => 'ForeignKey',
      'user_id'   => 'ForeignKey',
    );
  }
}
