<?php

/**
 * author filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseauthorFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'lastname'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'book_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'book')),
    ));

    $this->setValidators(array(
      'name'      => new sfValidatorPass(array('required' => false)),
      'lastname'  => new sfValidatorPass(array('required' => false)),
      'book_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'book', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('author_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addBookListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.bookAuthor bookAuthor')
      ->andWhereIn('bookAuthor.book_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'author';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'name'      => 'Text',
      'lastname'  => 'Text',
      'book_list' => 'ManyKey',
    );
  }
}
