<?php
class Testimonials_Clients_Model_Resource_Client_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init(
            'testimonials_clients/client', 
            'testimonials_clients/client'
        );
    }
}