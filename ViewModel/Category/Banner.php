<?php
declare(strict_types=1);

namespace Terenbro\CategoryBanner\ViewModel\Category;

use Magento\Catalog\Model\Category;
use Magento\Framework\Exception\LocalizedException;
use Terenbro\CategoryBanner\Model\Category\Banner as CategoryBanner;
use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * Category banner view model
 */
class Banner implements ArgumentInterface
{
    private const ATTRIBUTE_NAME = 'category_banner';

    /**
     * @var CategoryBanner
     */
    private CategoryBanner $image;

    /**
     * Initialize dependencies.
     *
     * @param CategoryBanner $image
     */
    public function __construct(CategoryBanner $image)
    {
        $this->image = $image;
    }

    /**
     * Resolve category image URL
     *
     * @param Category $category
     * @param string $attributeCode
     * @return string
     * @throws LocalizedException
     */
    public function getUrl(Category $category, string $attributeCode = self::ATTRIBUTE_NAME): string
    {
        return $this->image->getUrl($category, $attributeCode);
    }
}
