<?php
/**
 * Copyright © Kashyap Software Product Attachments All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Kashyap\ProductAttachments\Api\Data;

interface ProductAttachmentsInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const KS_PRODUCTS = 'ks_products';
    const PRODUCTATTACHMENTS_ID = 'productattachments_id';
    const NAME = 'name';

    /**
     * Get productattachments_id
     * @return string|null
     */
    public function getProductattachmentsId();

    /**
     * Set productattachments_id
     * @param string $productattachmentsId
     * @return \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterface
     */
    public function setProductattachmentsId($productattachmentsId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterface
     */
    public function setName($name);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsExtensionInterface $extensionAttributes
    );

    /**
     * Get ks_products
     * @return string|null
     */
    public function getKsProducts();

    /**
     * Set ks_products
     * @param string $ksProducts
     * @return \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterface
     */
    public function setKsProducts($ksProducts);
}

