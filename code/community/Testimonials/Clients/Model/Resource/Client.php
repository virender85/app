<?php
class Testimonials_Clients_Model_Resource_Client
    extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('testimonials_clients/client', 'entity_id');
    }
}