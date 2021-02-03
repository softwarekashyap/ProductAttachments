<?php
/**
 * Copyright © Kashyap Software Product Attachments All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Kashyap\ProductAttachments\Model;

use Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterfaceFactory;
use Kashyap\ProductAttachments\Api\Data\ProductAttachmentsSearchResultsInterfaceFactory;
use Kashyap\ProductAttachments\Api\ProductAttachmentsRepositoryInterface;
use Kashyap\ProductAttachments\Model\ResourceModel\ProductAttachments as ResourceProductAttachments;
use Kashyap\ProductAttachments\Model\ResourceModel\ProductAttachments\CollectionFactory as ProductAttachmentsCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class ProductAttachmentsRepository implements ProductAttachmentsRepositoryInterface
{

    protected $productAttachmentsFactory;

    protected $dataObjectHelper;

    protected $extensionAttributesJoinProcessor;

    private $collectionProcessor;

    protected $productAttachmentsCollectionFactory;

    protected $searchResultsFactory;

    protected $dataObjectProcessor;

    protected $dataProductAttachmentsFactory;

    protected $extensibleDataObjectConverter;
    protected $resource;

    private $storeManager;


    /**
     * @param ResourceProductAttachments $resource
     * @param ProductAttachmentsFactory $productAttachmentsFactory
     * @param ProductAttachmentsInterfaceFactory $dataProductAttachmentsFactory
     * @param ProductAttachmentsCollectionFactory $productAttachmentsCollectionFactory
     * @param ProductAttachmentsSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceProductAttachments $resource,
        ProductAttachmentsFactory $productAttachmentsFactory,
        ProductAttachmentsInterfaceFactory $dataProductAttachmentsFactory,
        ProductAttachmentsCollectionFactory $productAttachmentsCollectionFactory,
        ProductAttachmentsSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->productAttachmentsFactory = $productAttachmentsFactory;
        $this->productAttachmentsCollectionFactory = $productAttachmentsCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataProductAttachmentsFactory = $dataProductAttachmentsFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterface $productAttachments
    ) {
        /* if (empty($productAttachments->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $productAttachments->setStoreId($storeId);
        } */
        
        $productAttachmentsData = $this->extensibleDataObjectConverter->toNestedArray(
            $productAttachments,
            [],
            \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterface::class
        );
        
        $productAttachmentsModel = $this->productAttachmentsFactory->create()->setData($productAttachmentsData);
        
        try {
            $this->resource->save($productAttachmentsModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the productAttachments: %1',
                $exception->getMessage()
            ));
        }
        return $productAttachmentsModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($productAttachmentsId)
    {
        $productAttachments = $this->productAttachmentsFactory->create();
        $this->resource->load($productAttachments, $productAttachmentsId);
        if (!$productAttachments->getId()) {
            throw new NoSuchEntityException(__('ProductAttachments with id "%1" does not exist.', $productAttachmentsId));
        }
        return $productAttachments->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->productAttachmentsCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterface $productAttachments
    ) {
        try {
            $productAttachmentsModel = $this->productAttachmentsFactory->create();
            $this->resource->load($productAttachmentsModel, $productAttachments->getProductattachmentsId());
            $this->resource->delete($productAttachmentsModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the ProductAttachments: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($productAttachmentsId)
    {
        return $this->delete($this->get($productAttachmentsId));
    }
}

