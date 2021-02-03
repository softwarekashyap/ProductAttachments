<?php
/**
 * Copyright © Kashyap Software Product Attachments All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Kashyap\ProductAttachments\Model;

use Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterface;
use Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class ProductAttachments extends \Magento\Framework\Model\AbstractModel
{

    protected $dataObjectHelper;

    protected $_eventPrefix = 'kashyap_productattachments_productattachments';
    protected $productattachmentsDataFactory;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ProductAttachmentsInterfaceFactory $productattachmentsDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Kashyap\ProductAttachments\Model\ResourceModel\ProductAttachments $resource
     * @param \Kashyap\ProductAttachments\Model\ResourceModel\ProductAttachments\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        ProductAttachmentsInterfaceFactory $productattachmentsDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Kashyap\ProductAttachments\Model\ResourceModel\ProductAttachments $resource,
        \Kashyap\ProductAttachments\Model\ResourceModel\ProductAttachments\Collection $resourceCollection,
        array $data = []
    ) {
        $this->productattachmentsDataFactory = $productattachmentsDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve productattachments model with productattachments data
     * @return ProductAttachmentsInterface
     */
    public function getDataModel()
    {
        $productattachmentsData = $this->getData();
        
        $productattachmentsDataObject = $this->productattachmentsDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $productattachmentsDataObject,
            $productattachmentsData,
            ProductAttachmentsInterface::class
        );
        
        return $productattachmentsDataObject;
    }
}

