<?php
/**
 * Copyright © Kashyap Software Product Attachments All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Kashyap\ProductAttachments\Model\ResourceModel\ProductAttachments;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'productattachments_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Kashyap\ProductAttachments\Model\ProductAttachments::class,
            \Kashyap\ProductAttachments\Model\ResourceModel\ProductAttachments::class
        );
    }
}

