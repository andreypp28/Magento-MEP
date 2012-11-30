<?php
class Flagbit_MEP_Adminhtml_Profil_AttributeController extends Mage_Adminhtml_Controller_Action
{

    /**
     * Render grid action
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('fields.grid')
            ->setProfile($this->getRequest()->getParam('profile_id', null));
        $this->renderLayout();
    }

    /**
     * Add attribute field mappings to profile
     */
    public function addAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            $model = Mage::getModel('mep/mapping');
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->setId($id);
            }
            $model->setData($data);
            $model->save();
        }
    }

    /**
     * Create ui dialog to add attribute field mappings to profile
     */
    public function popupAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * delete a field mapping.
     */
    public function deleteAction()
    {
        if ($this->getRequest()->has('id')) {
            $id = $this->getRequest()->getParam('id');
            $mapping = Mage::getModel('mep/mapping')->load($id);
            if ($mapping) {
                $mapping->delete();
            }
        }
        if ($this->getRequest()->has('profile_id')) {
            $profile_id = $this->getRequest()->getParam('profile_id');
            $this->_redirect('*/profil/edit', array('id' => $profile_id, 'tab' => 'rule_tabs_form_fields'));
        }
    }

    /**
     * Grid for AJAX request
     */
    public function gridAction()
    {
        $this->getResponse()->setBody($this->getLayout()->createBlock('mep/adminhtml_profil_view_gridmapping')->toHtml());
    }
}