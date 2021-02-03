<?php
/**
 * Copyright © Kashyap Software Product Attachments All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Kashyap\ProductAttachments\Model\Data;

use Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterface;

class ProductAttachments extends \Magento\Framework\Api\AbstractExtensibleObject implements ProductAttachmentsInterface
{

    /**
     * Get productattachments_id
     * @return string|null
     */
    public function getProductattachmentsId()
    {
        return $this->_get(self::PRODUCTATTACHMENTS_ID);
    }

    /**
     * Set productattachments_id
     * @param string $productattachmentsId
     * @return \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterface
     */
    public function setProductattachmentsId($productattachmentsId)
    {
        return $this->setData(self::PRODUCTATTACHMENTS_ID, $productattachmentsId);
    }

    /**
     * Get name
     * @return string|null
     */
    public function getName()
    {
        return $this->_get(self::NAME);
    }

    /**
     * Set name
     * @param string $name
     * @return \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get ks_products
     * @return string|null
     */
    public function getKsProducts()
    {
        return $this->_get(self::KS_PRODUCTS);
    }

    /**
     * Set ks_products
     * @param string $ksProducts
     * @return \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterface
     */
    public function setKsProducts($ksProducts)
    {
        return $this->setData(self::KS_PRODUCTS, $ksProducts);
    }
}

