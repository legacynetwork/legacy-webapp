<?php

namespace DashboardBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Entity\User;

class CapsuleType extends AbstractType
{

	private $user;
	
	public function __construct(User $user)
	{
		$this->user = $user;
	}
	
	
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	
    	
        $builder->add('name', 'text')
		        
		        ->add('files', 'entity', array(
		        		'class'         => 'DashboardBundle:File',
		        		'property'      => 'title',
		        		'multiple'      => true,
		        		'expanded'      => true,
		        		'label' => "Files",
		        		'empty_value'      => '',
		        		'choices' => $this->user->getFiles()
		        		
		        ))
        
        		->add('contacts', 'entity', array(
        				'class'         => 'DashboardBundle:Contact',
        				'property'      => 'fullname',
		        		'multiple'      => true,
		        		'expanded'      => true,
        				'label' => "Contacts",
        				'empty_value'      => '',
        			'choices' => $this->user->getContacts(),
        				
        		));
        				
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DashboardBundle\Entity\Capsule'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'dashboardbundle_capsule';
    }


}
