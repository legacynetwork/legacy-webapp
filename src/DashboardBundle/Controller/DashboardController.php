<?php

namespace DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
    	
    	return $this->redirect($this->generateUrl('dashboard_service_list'));
    }

    public function contactListAction() {
    
    	return $this->render('DashboardBundle:Dashboard:contactList.html.twig');
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
