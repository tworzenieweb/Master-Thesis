<?php

/**
 * post actions.
 *
 * @package    sf_sandbox
 * @subpackage post
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class postActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->posts = Doctrine_Core::getTable('post')
      ->createQuery('a')
      ->where('a.user_id = ?', $this->getUser()->getGuardUser()->id)
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
     



      
     $url = sfConfig::get('app_gae') . 'book/' . $request->getParameter('slug') . '/';

        $client = new Zend_Http_Client($url);

        $client->setHeaders('Accept: application/json');
        $this->book = json_decode($client->request()->getBody(), true);
  }
  
  public function executeLatest(sfWebRequest $request)
    {


        $url = sfConfig::get('app_gae') . 'latest/';

        $client = new Zend_Http_Client($url);

        $client->setHeaders('Accept: application/json');
        $this->books = json_decode($client->request()->getBody(), true);
    }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new postForm();
    $this->form->setDefault('user_id', $this->getUser()->getGuardUser()->id);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new postForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($post = Doctrine_Core::getTable('post')->find(array($request->getParameter('id'))), sprintf('Object post does not exist (%s).', $request->getParameter('id')));
    $this->form = new postForm($post);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($post = Doctrine_Core::getTable('post')->find(array($request->getParameter('id'))), sprintf('Object post does not exist (%s).', $request->getParameter('id')));
    $this->form = new postForm($post);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($post = Doctrine_Core::getTable('post')->find(array($request->getParameter('id'))), sprintf('Object post does not exist (%s).', $request->getParameter('id')));
    $post->delete();

    $this->redirect('post/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $post = $form->save();

      $this->redirect('post/edit?id='.$post->getId());
    }
  }
}
