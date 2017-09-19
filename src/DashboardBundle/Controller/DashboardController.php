<?php

namespace DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Request;
use DashboardBundle\Entity\Contact;
use DashboardBundle\Entity\File;
use DashboardBundle\Entity\Capsule;
use DashboardBundle\Form\ContactType;
use DashboardBundle\Form\CapsuleType;

class DashboardController extends Controller
{
    public function indexAction()
    {
    	
    	return $this->redirect($this->generateUrl('dashboard_capsule_list'));
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
    

    public function capsuleEditAction($id, Request $request) {
    	 
    	$capsule = null;
    	 
    	if ($id > 0) {
    		$capsule = $this->getDoctrine()->getManager()->getRepository('DashboardBundle:Capsule')->find($id);
    		if ($capsule->getUser()->getId() != $this->getUser()->getId()) {
    			$capsule = null;
    		}
    	}
    	 
    	if ($capsule == null) {
    		$capsule = new Capsule();
    		$capsule->setUser($this->getUser());
    	}
    	 
    	 
    
    	$form = $this->createForm(new CapsuleType($this->getUser()), $capsule);
    	 
    	if ($form->handleRequest($request)->isValid()) {
    		 
    		 
    		$em = $this->getDoctrine()->getManager();
    		 
    		$em->persist($capsule);
    		$em->flush();
    		 
    		$request->getSession()->getFlashBag()->add('notice', 'Capsule saved');
    		 
    		return $this->redirect($this->generateUrl('dashboard_capsule_list'));
    	}
    	 
    	 
    	return $this->render('DashboardBundle:Dashboard:capsuleEdit.html.twig', array(
    			'form' => $form->createView(),
    			'capsule' => $capsule,
    
    	));
    	 
    }
    
    
    public function serviceListAction() {

    	return $this->render('DashboardBundle:Dashboard:serviceList.html.twig');
    }
    public function capsuleListAction() {

    	return $this->render('DashboardBundle:Dashboard:capsuleList.html.twig');
    }
    public function fileListAction() {

    	return $this->render('DashboardBundle:Dashboard:fileList.html.twig');
    }
    
    public function fileEditAction(Request $request) {
    	$em = $this->getDoctrine()->getManager();
    	 
    	$parameters = $this->getRequest()->request->all();
    	$files = $this->getRequest()->files;
    	 
    	$user = $this->getUser();
    	 
    	foreach($files as $currentFile) {
    		if (!empty($currentFile)) {
    			
    			$file = new File();
    			$file->setUser($user);
    			$file->setTitle($currentFile->getClientOriginalName());
    			 
    			$em->persist($file);
    			 
    			$em->flush();
    			 
    			$file->upload($currentFile);
    			 
    			$em->persist($file);
    			 
    			$em->flush();
    	
    		}
    	}
    	 
    	 
    	return new Response();
    }


    public function fileDownloadAction(File $file) {
    
    	// Check rights
    	if ($file->getUser()->getId() != $this->getUser()->getId()) {
    		return $this->redirect($this->generateUrl('app_home'));
    	}
    
    	$cheminFichier = $file->getAbsolutePath();
    
    	$filename = $file->getTitle();
    	$filename = str_replace("%", "", $filename);
    
    	$response = new BinaryFileResponse($cheminFichier);
    
    	$response->trustXSendfileTypeHeader();
    	$response->setContentDisposition(
    			ResponseHeaderBag::DISPOSITION_INLINE,
    			$filename,
    			iconv('UTF-8', 'ASCII//TRANSLIT', $filename)
    	);
    
    
    
    	return $response;
    }
    	
    
    public function profileSaveAction() {

    	return $this->render('DashboardBundle:Dashboard:profileSave.html.twig');
    }
}
