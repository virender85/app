<?php
class Testimonials_Clients_Block_Adminhtml_Client_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        // instantiate a new form to display our brand for editing
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'testimonials_clients_admin/client/edit', 
                array(
                    '_current' => true,
                    'continue' => 0,
                )
            ),
            'method' => 'post',
			'enctype' => 'multipart/form-data'
        ));
        $form->setUseContainer(true);
        $this->setForm($form);
        
        // define a new fieldset, we only need one for our simple entity
        $fieldset = $form->addFieldset(
            'general',
            array(
                'legend' => $this->__('Brand Details')
            )
        );
        
        $brandSingleton = Mage::getSingleton(
            'testimonials_clients/client'
        );
        // add the fields we want to be editable
        $this->_addFieldsToFieldset($fieldset, array(
            'name' => array(
                'label' => $this->__('Name'),
                'input' => 'text',
                'required' => true,
            ),
            'location' => array(
                'label' => $this->__('Location'),
                'input' => 'text',
                'required' => true,
            ),
            'description' => array(
                'label' => $this->__('Description'),
                'input' => 'textarea',
                'required' => true,
            ),
			'image' => array(
                'label' => $this->__('Image'),
                'input' => 'file',
                'required' => true,
            ),
            'visibility' => array(
                'label' => $this->__('Visibility'),
                'input' => 'select',
                'required' => true,
                'options' => $brandSingleton->getAvailableVisibilies(),
            ),
            
           
        ));

        return $this;
    }
    
    
    protected function _addFieldsToFieldset(
        Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()
            ->getPost('clientData'));
        
        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }
            
            // wrap all fields with brandData group
            $_data['name'] = "clientData[$name]";
            
            // generally label and title always the same
            $_data['title'] = $_data['label'];
            
            // if no new value exists, use existing brand data
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getBrand()->getData($name);
            }
            
            // finally call vanilla functionality to add field
            $fieldset->addField($name, $_data['input'], $_data);
        }
        
        return $this;
    }
  
    protected function _getBrand() 
    {
        if (!$this->hasData('client')) {
            // this will have been set in the controller
            $brand = Mage::registry('current_client');
            
            // just in case the controller does not register the brand
            if (!$brand instanceof 
                    Testimonials_Clients_Model_Client) {
                $brand = Mage::getModel(
                    'testimonials_clients/client'
                );
            }
            
            $this->setData('client', $brand);
        }
        
        return $this->getData('client');
    }
}