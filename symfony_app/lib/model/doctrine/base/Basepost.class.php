<?php

/**
 * Basepost
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $title
 * @property string $body
 * @property integer $category_id
 * @property integer $user_id
 * @property sfGuardUser $User
 * @property category $Category
 * 
 * @method string      getTitle()       Returns the current record's "title" value
 * @method string      getBody()        Returns the current record's "body" value
 * @method integer     getCategoryId()  Returns the current record's "category_id" value
 * @method integer     getUserId()      Returns the current record's "user_id" value
 * @method sfGuardUser getUser()        Returns the current record's "User" value
 * @method category    getCategory()    Returns the current record's "Category" value
 * @method post        setTitle()       Sets the current record's "title" value
 * @method post        setBody()        Sets the current record's "body" value
 * @method post        setCategoryId()  Sets the current record's "category_id" value
 * @method post        setUserId()      Sets the current record's "user_id" value
 * @method post        setUser()        Sets the current record's "User" value
 * @method post        setCategory()    Sets the current record's "Category" value
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Basepost extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('post');
        $this->hasColumn('title', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('body', 'string', 1000, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 1000,
             ));
        $this->hasColumn('category_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id'));

        $this->hasOne('category as Category', array(
             'local' => 'category_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'fields' => 
             array(
              0 => 'title',
             ),
             'unique' => true,
             ));
        $this->actAs($timestampable0);
        $this->actAs($sluggable0);
    }
}