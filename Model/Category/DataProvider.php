<?php
declare(strict_types=1);

namespace Terenbro\CategoryBanner\Model\Category;

class DataProvider extends \Magento\Catalog\Model\Category\DataProvider
{
    /**
     * List of fields groups and fields.
     *
     * @return array
     * @since 101.0.0
     */
    protected function getFieldsMap(): array
    {
        $fields = parent::getFieldsMap();
        $fields['content'][] = 'category_banner';

        return $fields;
    }
}