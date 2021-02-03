<?php
/**
 * Copyright © Kashyap Software Product Attachments All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Kashyap\ProductAttachments\Controller\Adminhtml\ProductAttachments;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('productattachments_id');
        
            $model = $this->_objectManager->create(\Kashyap\ProductAttachments\Model\ProductAttachments::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Productattachments no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        
            $model->setData($data);
        
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Productattachments.'));
                $this->dataPersistor->clear('kashyap_productattachments_productattachments');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['productattachments_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Productattachments.'));
            }
        
            $this->dataPersistor->set('kashyap_productattachments_productattachments', $data);
            return $resultRedirect->setPath('*/*/edit', ['productattachments_id' => $this->getRequest()->getParam('productattachments_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

