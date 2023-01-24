<?php
declare(strict_types=1);

namespace Terenbro\CategoryBanner\Model\Category;

use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\Category\FileInfo;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Category Banner Service
 */
class Banner
{
    private const ATTRIBUTE_NAME = 'category_banner';
    /**
     * @var FileInfo
     */
    private FileInfo $fileInfo;
    /**
     * @var StoreManagerInterface
     */
    private StoreManagerInterface $storeManager;

    /**
     * Initialize dependencies.
     *
     * @param FileInfo $fileInfo
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        FileInfo $fileInfo,
        StoreManagerInterface $storeManager
    ) {
        $this->fileInfo = $fileInfo;
        $this->storeManager = $storeManager;
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
        $url = '';
        $image = $category->getData($attributeCode);
        if ($image) {
            if (is_string($image)) {
                $store = $this->storeManager->getStore();
                $mediaBaseUrl = $store->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
                if ($this->fileInfo->isBeginsWithMediaDirectoryPath($image)) {
                    $relativePath = $this->fileInfo->getRelativePathToMediaDirectory($image);
                    $url = rtrim($mediaBaseUrl, '/') . '/' . ltrim($relativePath, '/');
                } elseif (substr($image, 0, 1) !== '/') {
                    $url = rtrim($mediaBaseUrl, '/') . '/' . ltrim(FileInfo::ENTITY_MEDIA_PATH, '/') . '/' . $image;
                } else {
                    $url = $image;
                }
            } else {
                throw new LocalizedException(
                    __('Something went wrong while getting the image url.')
                );
            }
        }
        return $url;
    }
}
