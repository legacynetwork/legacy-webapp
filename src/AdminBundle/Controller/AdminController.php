<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Entity\Question;
use AdminBundle\Form\QuestionType;

class AdminController extends Controller
{
 

    public function questionListAction(Request $request) {
    
    	return $this->render('AdminBundle:Admin:questionList.html.twig', array(
    			"listQuestions" => $this->getDoctrine()->getManager()->getRepository('AdminBundle:Question')->findAll()
    	));
    }

    public function emailListAction(Request $request) {
    
    	return $this->render('AdminBundle:Admin:emailList.html.twig', array(
    			"listEmails" => $this->getDoctrine()->getManager()->getRepository('AppBundle:Email')->findAll()
    	));
    }

    public function userListAction(Request $request) {
    
    	return $this->render('AdminBundle:Admin:userList.html.twig', array(
    			"listUsers" => $this->getDoctrine()->getManager()->getRepository('UserBundle:User')->findAll()
    	));
    }
    
    public function questionDeleteAction(Question $question, Request $request) {
    	$em = $this->getDoctrine()->getManager();
    	 
    	
    	$em->remove($question);
    	$em->flush();
    	

    	$request->getSession()->getFlashBag()->add('notice', 'Question deleted');
    	
    	return $this->redirect($this->generateUrl('admin_question_list'));
    }
    
    public function questionSaveAction($id, Request $request) {
    	$question = new Question();
    	
    	if ($id > 0) {
    		$question = $this->getDoctrine()->getManager()->getRepository('AdminBundle:Question')->find($id);
    	}
    	
    	
    	$form = $this->createForm(new QuestionType(), $question);
    	 
    	 
    	if ($form->handleRequest($request)->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		 

    		$em->persist($question);
    		$em->flush();
    		 
	    	
	   		$request->getSession()->getFlashBag()->add('notice', 'Question saved');
	
	   		
	   		return $this->redirect($this->generateUrl('admin_question_list', array()));
	   	}
	   	 
	
	
	   	return $this->render('AdminBundle:Admin:questionSave.html.twig', array(
	   			'form' => $form->createView(),
	   			'question' => $question,
	   				
	   	));
    	
    	
    }
}
