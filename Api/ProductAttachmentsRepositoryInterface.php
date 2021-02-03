<?php
/**
 * Copyright © Kashyap Software Product Attachments All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Kashyap\ProductAttachments\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ProductAttachmentsRepositoryInterface
{

    /**
     * Save ProductAttachments
     * @param \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterface $productAttachments
     * @return \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterface $productAttachments
    );

    /**
     * Retrieve ProductAttachments
     * @param string $productattachmentsId
     * @return \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($productattachmentsId);

    /**
     * Retrieve ProductAttachments matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete ProductAttachments
     * @param \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterface $productAttachments
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Kashyap\ProductAttachments\Api\Data\ProductAttachmentsInterface $productAttachments
    );

    /**
     * Delete ProductAttachments by ID
     * @param string $productattachmentsId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($productattachmentsId);
}

