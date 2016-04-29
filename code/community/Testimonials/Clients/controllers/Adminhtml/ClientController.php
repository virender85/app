<?php
class Testimonials_Clients_Adminhtml_ClientController
    extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        // instantiate the grid container
        $brandBlock = $this->getLayout()
            ->createBlock('testimonials_clients_adminhtml/client');
        $this->loadLayout()
            ->_addContent($brandBlock)
            ->renderLayout();
    }
    
    /**
     * This action handles both viewing and editing of existing brands.
     */
    public function editAction()
    {
        /**
         * retrieving existing brand data if an ID was specified,
         * if not we will have an empty Brand entity ready to be populated.
         */
        $brand = Mage::getModel('testimonials_clients/client');
        if ($brandId = $this->getRequest()->getParam('id', false)) {
            $brand->load($brandId);
            if ($brand->getId() < 1) {
                $this->_getSession()->addError(
                    $this->__('This Testimonial no longer exists.')
                );
                return $this->_redirect(
                    'testimonials_clients_admin/client/index'
                );
            }
        }
        
        // process $_POST data if the form was submitted
		//echo "<pre>"; print_r($_FILES); echo "</pre>";
		//die();
        if ($postData = $this->getRequest()->getPost('clientData')) {
            try {
				$uploader = new Varien_File_Uploader('clientData[image]');
				$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png')); 
				$uploader->setAllowRenameFiles(false);
				$uploader->setFilesDispersion(false);
				$path = Mage::getBaseDir('media') . '/default' ;
				$uploader->save($path, $_FILES['clientData']['name']['image']);
				$postData['image'] = $_FILES['clientData']['name']['image'];
                $brand->addData($postData);
                $brand->save();
                
                $this->_getSession()->addSuccess(
                    $this->__('The testimonial has been saved.')
                );
                
                // redirect to remove $_POST data from the request
                return $this->_redirect(
                    'testimonials_clients_admin/client/edit', 
                    array('id' => $brand->getId())
                );
            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }
            
            /**
             * if we get to here then something went wrong. Continue to
             * render the page as before, the difference being this time 
             * the submitted $_POST data is available.
             */
        }
        
        // make the current brand object available to blocks
        Mage::register('current_client', $brand);
   
        // instantiate the form container
        $brandEditBlock = $this->getLayout()->createBlock(
            'testimonials_clients_adminhtml/client_edit'
        );
            
        // add the form container as the only item on this page
        $this->loadLayout()
            ->_addContent($brandEditBlock)
            ->renderLayout();
    }
    
    public function deleteAction()
    {
        $brand = Mage::getModel('testimonials_clients/client');

        if ($brandId = $this->getRequest()->getParam('id', false)) {
            $brand->load($brandId);
        }
        
        if ($brand->getId() < 1) {
            $this->_getSession()->addError(
                $this->__('This testimonial no longer exists.')
            );
            return $this->_redirect(
                'testimonials_clients_admin/client/index'
            );
        }
        
        try {
            $brand->delete();
            
            $this->_getSession()->addSuccess(
                $this->__('The testimonial has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'testimonials_clients_admin/client/index'
        );
    }
    
    /**
     * Thanks to Ben for pointing out this method was missing. Without 
     * this method the ACL rules configured in adminhtml.xml are ignored.
     */
    protected function _isAllowed()
    {
   
        $actionName = $this->getRequest()->getActionName();
        switch ($actionName) {
            case 'index':
            case 'edit':
            case 'delete':
                // intentionally no break
            default:
                $adminSession = Mage::getSingleton('admin/session');
                $isAllowed = $adminSession
                    ->isAllowed('testimonials_clients/client');
                break;
        }
        
        return $isAllowed;
    }
}