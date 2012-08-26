<?php

/**
 * default actions.
 *
 * @package    sf_sandbox
 * @subpackage default
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    
      
      
  }
  
  public function executeContact(sfWebRequest $request)
  {
      
      $this->form = new contactForm();
      
      
      if($request->isMethod('post'))
      {
          $this->form->bind($request->getParameter($this->form->getName()));
          
          if($this->form->isValid()) {
              
               try {
               
               if($this->getMailer()->send($this->getMailer()
                      ->compose(array($this->form->getValue('sender_email') => $this->form->getValue('sender')), 
                              'tworzenieweb@gmail.com', 
                              $this->form->getValue('title') , 
                              $this->form->getValue('content')))) {
                   
                   $this->getUser()->setFlash('success', 'Message sent with success');
                   $this->redirect('@contact');
                   
               }
               else {
                   $this->getUser()->setFlash('error', 'Your message was not send');
               }
               
               }
               catch(Exception $e) {
                   $this->getUser()->setFlash('error', $e->getMessage());
               }
              
          }
      }
      
  }
  
}
