<?php
class Testimonials_Clients_Block_Adminhtml_Client
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        parent::_construct();
        
        $this->_blockGroup = 'testimonials_clients_adminhtml';
        
        
        $this->_controller = 'client';
        
        $this->_headerText = Mage::helper('testimonials_clients')
            ->__('Manage Testimonials');
    }
    
    public function getCreateUrl()
    {
		
       return $this->getUrl(
            'testimonials_clients_admin/client/edit'
        );
		
    }
}