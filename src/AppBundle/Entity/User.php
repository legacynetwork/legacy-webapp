<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
	
	public function getRolesInString() {
		$rolesInString = "";
		foreach($this->getRoles() as $currentRole) {
			
				if (!empty($rolesInString)) {
					$rolesInString .= " ; ";
				}
				$rolesInString .= $currentRole;
			
		}
	
		return $rolesInString;
	}
	
	
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}