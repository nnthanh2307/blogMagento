<?php
namespace NgocThanh\Blog\Controller\Adminhtml\Export;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\FileSystemException;

/**
 * Class GridToCsv
 * @package NgocThanh\Blog\Controller\Adminhtml\Export
 */
class GridToCsv extends Action
{
    /**
     * @var \NgocThanh\Blog\Model\ResourceModel\Reponsitory\CollectionFactory
     */
    protected $_colectionFactory;

    /**
     * GridToCsv constructor.
     * @param Action\Context $context
     * @param \Magento\Framework\App\Response\Http\FileFactory $fileFactory
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \NgocThanh\Blog\Model\ResourceModel\Reponsitory\CollectionFactory $collectionFactory
     * @throws FileSystemException
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Magento\Framework\Filesystem $filesystem,
        \NgocThanh\Blog\Model\ResourceModel\Reponsitory\CollectionFactory $collectionFactory
    ) {
        $this->_colectionFactory = $collectionFactory;
        $this->_fileFactory = $fileFactory;
        $this->directory = $filesystem->getDirectoryWrite(DirectoryList::VAR_DIR);
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws FileSystemException
     */
    public function execute()
    {
        $listProduct = $this->_colectionFactory->create()->getData();
        $name = date('m_d_Y_H_i_s');
        $filepath = 'export/custom' . $name . '.csv';
        try {
            $this->directory->create('export');
        } catch (FileSystemException $e) {
        }
        /* Open file */
        $stream = $this->directory->openFile($filepath, 'w+');
        $stream->lock();
        $columns = $this->getColumnHeader();
        foreach ($columns as $column) {
            $header[] = $column;
        }
        /* Write Header */
        $stream->writeCsv($header);

        foreach ($listProduct as $item) {
            $stream->writeCsv($item);
        }

        $content = [];
        $content['type'] = 'filename'; // must keep filename
        $content['value'] = $filepath;
        $content['rm'] = '1'; //remove csv from var folder
        $csvfilename = 'post_' . $name . '.csv';
        return $this->_fileFactory->create($csvfilename, $content, DirectoryList::VAR_DIR);
    }

    /**
     * @return string[]
     */
    public function getColumnHeader()
    {
        $headers = ['post_id','post_title','short_description',
            'content','thumbnail','status','url_key','publish_date_from','publish_date_to'];
        return $headers;
    }
}
