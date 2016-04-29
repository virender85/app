<?php
class Testimonials_Clients_Model_Client
    extends Mage_Core_Model_Abstract
{
    const VISIBILITY_HIDDEN = '0';
    const VISIBILITY_DIRECTORY = '1';
    
    protected function _construct()
    {
		$this->_init('testimonials_clients/client');
    }
    
    /**
     * This method is used in grid and form for populating dropdown.
     */
    public function getAvailableVisibilies()
    {
        return array(
            self::VISIBILITY_HIDDEN 
                => Mage::helper('testimonials_clients')
                       ->__('Hidden'),
            self::VISIBILITY_DIRECTORY
                => Mage::helper('testimonials_clients')
                       ->__('Visible in Directory'),
        );
    }
    
    protected function _beforeSave()
    {
        parent::_beforeSave();
        
        /**
         * Perform some actions just before a Brand is saved.
         */
        $this->_updateTimestamps();
        $this->_prepareUrlKey();
        
        return $this;
    }
    
    protected function _updateTimestamps()
    {
        $timestamp = now();
        
        /**
         * Set the last updated timestamp.
         */
        $this->setUpdatedAt($timestamp);
        
        /**
         * If we have a brand new object, set the created timestamp.
         */
        if ($this->isObjectNew()) {
            $this->setCreatedAt($timestamp);
        }
        
        return $this;
    }
    
    protected function _prepareUrlKey()
    {
        /**
         * In this method you might consider ensuring
         * the URL Key entered is unique and contains
         * only alphanumeric characters.
         */
        
        return $this;
    }
}