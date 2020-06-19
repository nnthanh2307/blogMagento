<?php
namespace NgocThanh\Blog\Helper\Cache;

use Magento\Framework\App\Cache\Frontend\Pool;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\PageCache\Version;

/**
 * Class CleanCache
 * @package NgocThanh\Blog\Helper\Cache
 */
class CleanCache
{
    /**
     * @var TypeListInterface
     */
    protected $cacheTypeList;
    protected $cacheFrontendPool;

    public function __construct(
        TypeListInterface $cacheTypeList,
        Pool $cacheFrontendPool
    ) {
        $this->cacheTypeList = $cacheTypeList;
        $this->cacheFrontendPool = $cacheFrontendPool;
    }

    public function cacheFunction()
    {
        $types = ['config','layout','block_html','collections','reflection','db_ddl','eav',
            'config_integration','config_integration_api','full_page','translate','config_webservice'];

        foreach ($types as $type) {
            $this->cacheTypeList->cleanType($type);
        }
        foreach ($this->cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }
    }
}
