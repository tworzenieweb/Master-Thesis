<?php

/**
 * BasebookAuthor
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $book_id
 * @property integer $author_id
 * 
 * @method integer    getBookId()    Returns the current record's "book_id" value
 * @method integer    getAuthorId()  Returns the current record's "author_id" value
 * @method bookAuthor setBookId()    Sets the current record's "book_id" value
 * @method bookAuthor setAuthorId()  Sets the current record's "author_id" value
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasebookAuthor extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('book_author');
        $this->hasColumn('book_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('author_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}