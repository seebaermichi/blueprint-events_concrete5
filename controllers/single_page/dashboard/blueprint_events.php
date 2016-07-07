<?php
namespace Concrete\Package\BlueprintEvents\Controller\SinglePage\Dashboard;

use \Concrete\Core\Page\Controller\DashboardPageController;

defined('C5_EXECUTE') or die(_("Access Denied."));

class BlueprintEvents extends DashboardPageController
{
    public function view()
    {
        $this->redirect('/dashboard/blueprint_events/event_list');
    }
}