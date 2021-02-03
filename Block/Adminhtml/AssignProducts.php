<?php

namespace Kashyap\ProductAttachments\Block\Adminhtml;

class AssignProducts extends \Magento\Backend\Block\Template
{
    /**
     * Block template
     *
     * @var string
     */
    protected $_template = 'products/assign_products.phtml';

    /**
     * @var \Magento\Catalog\Block\Adminhtml\Category\Tab\Product
     */
    protected $blockGrid;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Magento\Framework\Json\EncoderInterface
     */
    protected $jsonEncoder;

    /**
     * @var \Kashyap\ProductAttachments\Model\ResourceModel\ProductAttachments\CollectionFactory 
     */
    protected $collectionFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context                           $context
     * @param \Magento\Framework\Registry                                       $registry
     * @param \Magento\Framework\Json\EncoderInterface                          $jsonEncoder
     * @param Kashyap\ProductAttachments\Model\ResourceModel\ProductAttachments\CollectionFactory  $collectionFactory
     * @param array                                                             $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Kashyap\ProductAttachments\Model\ResourceModel\ProductAttachments\CollectionFactory  $collectionFactory,
        array $data = []
    ) {
        $this->registry = $registry;
        $this->jsonEncoder = $jsonEncoder;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * Retrieve instance of grid block
     *
     * @return \Magento\Framework\View\Element\BlockInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getBlockGrid()
    {
        if (null === $this->blockGrid) {
            $this->blockGrid = $this->getLayout()->createBlock(
                'Kashyap\ProductAttachments\Block\Adminhtml\Tab\Productgrid',
                'category.product.grid'
            );
        }
        return $this->blockGrid;
    }

    /**
     * Return HTML of grid block
     *
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getBlockGrid()->toHtml();
    }

    /**
     * @return string
     */
    public function getProductsJson()
    {
        $entity_id = $this->getRequest()->getParam('productattachments_id');
        $collectionFactory = $this->collectionFactory->create();
        $collectionFactory->addFieldToFilter('productattachments_id', $entity_id);
        $result = [];
        if (!empty($collectionFactory->getData())) {
            foreach($collectionFactory as $collection){
                return $collection->getKsProducts();
            }
        }
        return '{}';
    }

    public function getSelectedProductsJson()
    { 
        $selectedProducts = $this->getProductsJson();
        $products = implode(",",array_keys((array)json_decode($selectedProducts)));
        return json_encode(explode(",",$products));
    }

    public function getItem()
    {
        return $this->registry->registry('my_item');
    }
}