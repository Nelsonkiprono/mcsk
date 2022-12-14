<?php
/**
 * @package Helix3 Framework
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2014 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/
//no direct accees
defined ('_JEXEC') or die('resticted aceess');

class Helix3FeatureContact {
 
	private $helix3;

	public function __construct($helix3){
		$this->helix3 = $helix3;
		$this->position = $this->helix3->getParam('contact_position');
	}

	public function renderFeature() {

		if($this->helix3->getParam('enable_contactinfo')) {

			$output = '<ul class="sp-contact-info">';
			
			
			if($this->helix3->getParam('contact_email')) $output .= '<li class="sp-contact-email"><span class="simple-envelope-open" aria-hidden="true"></span> <a href="mailto:'. $this->helix3->getParam('contact_email') .'">' . $this->helix3->getParam('contact_email') . '</a></li>';
			if($this->helix3->getParam('contact_phone')) $output .= '<li class="sp-contact-phone"><span class="simple-call-in" aria-hidden="true"></span>' . $this->helix3->getParam('contact_phone') . '</li>';
			$output .= '</ul>';

			return $output;
		}
		
	}    
}