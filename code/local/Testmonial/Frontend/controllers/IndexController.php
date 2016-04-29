<?php
class Testmonial_Frontend_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $testimonials = Mage::getModel('testimonials_clients/client');
		$output = '<link rel="stylesheet" href="/magento/js/slider/reset.css"><link rel="stylesheet" href="/magento/js/slider/style.css"><script src="/magento/js/slider/modernizr.js"></script><div class="cd-testimonials-wrapper cd-container"><ul class="cd-testimonials">';
		foreach($testimonials->getCollection() as $testimonial){
			$output .='<li><p>' . $testimonial->getDescription() . '</p><div class="cd-author"><img src="/magento/media/default/' . $testimonial->getImage() . '" alt="Author image"><ul class="cd-author-info"><li>' . $testimonial->getName() . '</li><li>' . $testimonial->getLocation() . '</li></ul></div></li>';
		}
		
		$output .='</ul></div><script src="/magento/js/slider/masonry.pkgd.min.js"></script><script src="/magento/js/slider/jquery.flexslider-min.js"></script><script src="/magento/js/slider/main.js"></script> ';
		echo $output;
			
    }
}