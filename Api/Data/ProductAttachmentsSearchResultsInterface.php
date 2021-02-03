<?php
/**
 * Copyright © Kashyap Software Product Attachments All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Kashyap\ProductAttachments\Api\Data;

interface ProductAttachmentsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get ProductAttachments list.
     * @return \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

