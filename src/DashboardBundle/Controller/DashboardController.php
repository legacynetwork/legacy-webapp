<?php

namespace DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DashboardBundle\Entity\Contact;
use DashboardBundle\Form\ContactType;

class DashboardController extends Controller
{
    public function indexAction()
    {
    	
    	return $this->redirect($this->generateUrl('dashboard_service_list'));
    }

    public function contactListAction() {
    
    	return $this->render('DashboardBundle:Dashboard:contactList.html.twig');
    }
    
    public function contactEditAction($id, Request $request) {
    	
    	$contact = null;
    	
    	if ($id > 0) {
    		$contact = $this->getDoctrine()->getManager()->getRepository('DashboardBundle:Contact')->find($id);
    		if ($contact->getUser()->getId() != $this->getUser()->getId()) {
    			$contact = null;
    		}
    	}
    	
    	if ($contact == null) {
    		$contact = new Contact();
    		$contact->setUser($this->getUser());
    	}
    	
    	

    	$form = $this->createForm(new ContactType, $contact);
    	
    	if ($form->handleRequest($request)->isValid()) {
    	
    	
    		$em = $this->getDoctrine()->getManager();
    	
    		$em->persist($contact);
    		$em->flush();
    	
    		$request->getSession()->getFlashBag()->add('notice', 'Contact saved');
    	
    		return $this->redirect($this->generateUrl('dashboard_contact_list'));
    	}
    	
    	
    	return $this->render('DashboardBundle:Dashboard:contactEdit.html.twig', array(
    			'form' => $form->createView(),
    			'contact' => $contact,
    				
    	));
    	
    }
    
    public function serviceListAction() {

    	return $this->render('DashboardBundle:Dashboard:serviceList.html.twig');
    }
    public function capsuleListAction() {

    	return $this->render('DashboardBundle:Dashboard:capsuleList.html.twig');
    }
    
    public function profileSaveAction() {

    	return $this->render('DashboardBundle:Dashboard:profileSave.html.twig');
    }
}
