<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace SaigonTechnology\Behavior\Controller\Adminhtml\Behaviors;

use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Backend\Model\View\Result\Page;
use SaigonTechnology\Behavior\Controller\Adminhtml\Behaviors;

class Index extends Behaviors implements HttpGetActionInterface
{
    const MENU_ID = 'SaigonTechnology_Behavior::user_behavior';

    /**
     * The name of this file uses the following pattern: routeId_controller_action.xml
     * Load the page defined in view/adminhtml/layout/behavior_behaviors_index.xml
     *
     * @return Page
     */
    public function execute(): Page
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(self::MENU_ID);
        $resultPage->getConfig()->getTitle()->prepend(__('Behaviors'));

        return $resultPage;
    }
}
