<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Email;

class AppController extends Controller
{
   
    public function homeAction(Request $request)
    {
    	

    	return $this->render('AppBundle:App:home.html.twig', array(
    			//"listQuestions" => $this->getDoctrine()->getManager()->getRepository('AdminBundle:Question')->findAll()
    	));
    	
    }
    
    public function submitEmailAction(Request $request) {
    	$emailAddress = $request->request->get('inputEmail');	
    	
    	if (!empty($emailAddress)) {
	    	$email = new Email();
	    	$email->setEmailAddress($emailAddress);
	    	$email->setDateEmail(new \DateTime());
	    	$email->setIpAddress($request->getClientIp());
	
	    	$em = $this->getDoctrine()->getManager();
	    	$em->persist($email);
	    	$em->flush();
	    	
	    	$request->getSession ()->getFlashBag ()->add ( 'notice', 'EmailOk' );
    	
    	}
    	
    	return $this->redirect($this->generateUrl('app_home'));
    	
    }
    
    
    

    public function submitContactAction(Request $request) {
    	$contactEmail = $request->request->get('contactEmail');
    	$contactName = $request->request->get('contactName');
    	$contactSubject = $request->request->get('contactSubject');
    	$contactMessage = $request->request->get('contactMessage');
    	 
    	if (!empty($contactEmail)) {
    		$this->sendEmail($contactEmail, $contactName, $contactSubject, $contactMessage);
    
    		$request->getSession ()->getFlashBag ()->add ( 'notice', 'ContactOk' );
    		 
    	}
    	 
    	return $this->redirect($this->generateUrl('app_home'));
    	 
    }
    
    

    private function sendEmail($fromEmailAddress, $fromName, $emailSubject, $emailMessage) {
    
    	$message = (new \Swift_Message())
    	->setFrom(array($fromEmailAddress => $fromName ))
    	->setTo('contact@legacy.network')
    	->setSubject($emailSubject)
    	->setBody($emailMessage, "text/plain");
    	;
    
    	$this->get('mailer')->send($message);
    
    }
}
