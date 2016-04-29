<?php

class Testimonials_Clients_Block_Adminhtml_Client_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
	
    protected function _prepareCollection()
    {
        /**
         * Tell Magento which Collection to use for displaying in the grid.
         */
		
        $collection = Mage::getResourceModel(
            'testimonials_clients/client_collection'
        );
		
        $this->setCollection($collection);
        
        return parent::_prepareCollection();
    }
    
    public function getRowUrl($row)
    {
       
        return $this->getUrl(
            'testimonials_clients_admin/client/edit', 
            array(
                'id' => $row->getId()
            )
        );
    }

    protected function _prepareColumns()
    {
        /**
         * Here we define which columns we want to be displayed in the grid.
         */
        $this->addColumn('entity_id', array(
            'header' => $this->_getHelper()->__('ID'),
            'type' => 'number',
            'index' => 'entity_id',
        ));
        
        $this->addColumn('created_at', array(
            'header' => $this->_getHelper()->__('Created'),
            'type' => 'datetime',
            'index' => 'created_at',
        ));
        
        $this->addColumn('updated_at', array(
            'header' => $this->_getHelper()->__('Updated'),
            'type' => 'datetime',
            'index' => 'updated_at',
        ));
        
        $this->addColumn('name', array(
            'header' => $this->_getHelper()->__('Name'),
            'type' => 'text',
            'index' => 'name',
        ));
        
        
        $brandSingleton = Mage::getSingleton(
            'testimonials_clients/client'
        );
        $this->addColumn('visibility', array(
            'header' => $this->_getHelper()->__('Visibility'),
            'type' => 'options',
            'index' => 'visibility',
            'options' => $brandSingleton->getAvailableVisibilies()
        ));
        
        /**
         * Finally we add an action column with an edit link.
         */
        $this->addColumn('action', array(
            'header' => $this->_getHelper()->__('Action'),
            'width' => '50px',
            'type' => 'action',
            'actions' => array(
                array(
                    'caption' => $this->_getHelper()->__('Edit'),
                    'url' => array(
                        'base' => 'testimonials_clients_admin'
                                  . '/client/edit',
                    ),
                    'field' => 'id'
                ),
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'entity_id',
        ));
        
        return parent::_prepareColumns();
    }
    
    protected function _getHelper()
    {
        return Mage::helper('testimonials_clients');
    }
}