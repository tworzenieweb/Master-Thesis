<?php

class BasesfGuardRegisterActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    if ($this->getUser()->isAuthenticated())
    {
      $this->getUser()->setFlash('notice', 'You are already registered and signed in!');
      $this->redirect('@homepage');
    }

    $this->form = new sfGuardRegisterForm();

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());
      if ($this->form->isValid())
      {
          
       $url = sfConfig::get('app_gae') . 'register/';
       
       $client = new Zend_Http_Client($url);
       
       $client->setHeaders('Accept: application/json');
       
       
       foreach($this->form->getValues() as $key => $value) {
           
           if($key == 'password_again')
               continue;
           
           
           $key = $key == 'email_address' ? 'email' : $key;
           
           $client->setParameterPost($key, $value);
           
       }
       
       $response = $client->request(Zend_Http_Client::POST);
       
       
       if($response->getStatus() == 201) {
           
           $url = sfConfig::get('app_gae') . 'auth/';

            $client = new Zend_Http_Client($url);
            
            $v = $this->form->getTaintedValues();
            
            
            $client->setAuth($this->form->getValue('username'), $v['password']);
            $client->setHeaders('Accept: application/json');
            $response = json_decode($client->request()->getBody(), true);

            if ($response['auth']) {
                $this->getUser()->signIn($response['user']);
            }
           
       }
       
       
          
        
        

        $this->redirect('@homepage');
      }
    }
  }
}