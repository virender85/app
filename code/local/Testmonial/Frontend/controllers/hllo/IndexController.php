<?php
 
class Testmonial_Frontend_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
	$collection = Mage::getModel('brands/brands')->getCollection();
	print_r($collection);
	die();
		$output = '<link rel="stylesheet" href="/magento/js/slider/reset.css"><link rel="stylesheet" href="/magento/js/slider/style.css"><script src="/magento/js/slider/modernizr.js"></script><div class="cd-testimonials-wrapper cd-container"><ul class="cd-testimonials">';
		
		$output .='<li><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><div class="cd-author"><img src="/magento/img/avatar-1.jpg" alt="Author image"><ul class="cd-author-info"><li>MyName</li><li>CEO, AmberCreative</li></ul></div></li><li><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus ea, perferendis error repudiandae numquam dolor fuga temporibus. Unde omnis, consequuntur.</p><div class="cd-author"><img src="/magento/img/avatar-2.jpg" alt="Author image"><ul class="cd-author-info"><li>MyName</li><li>Designer, CodyHouse</li></ul></div></li><li><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam totam nulla est, illo molestiae maxime officiis, quae ad, ipsum vitae deserunt molestias eius alias.</p><div class="cd-author"><img src="/magento/img/avatar-3.jpg" alt="Author image"><ul class="cd-author-info"><li>MyName</li><li>CEO, CompanyName</li></ul></div></li>';
		
		$output .='</ul></div><script src="/magento/js/slider/masonry.pkgd.min.js"></script><script src="/magento/js/slider/jquery.flexslider-min.js"></script><script src="/magento/js/slider/main.js"></script> ';
		echo $output;
		
    }
 
}
?>