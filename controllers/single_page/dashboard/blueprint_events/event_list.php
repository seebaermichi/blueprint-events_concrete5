<?php
namespace Concrete\Package\BlueprintEvents\Controller\SinglePage\Dashboard\BlueprintEvents;

use \Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Package\BlueprintEvents\Controller\SinglePage\Dashboard\BlueprintEvents;
use \Concrete\Package\BlueprintEvents\Src\BlueprintEvent;
use Core;

defined('C5_EXECUTE') or die(_("Access Denied."));

class EventList extends DashboardPageController
{
    public function on_start()
    {
        $html = Core::make('helper/html');
        $this->addHeaderItem($html->css('event_list.css', 'blueprint_events'));
        $this->addFooterItem($html->javascript('event_list.js', 'blueprint_events'));
    }

    public function view()
    {
        $event = new BlueprintEvent();
        $events = $event->find('1=1 ORDER BY event_date');
        $this->set('events', $events);
        $this->set('recentEdited', $this->getRecentEdited($event));

        if ($this->get('deleted') && $this->get('title')) {
            $this->set('deletedEvent', $this->get('title'));
        }
    }

    public function delete($id = null)
    {
        if ($id) {
            $event = new BlueprintEvent();
            $event->load('id = ?', $id);
            $eventTitle = $event->getTitle();
            $event->delete();
            $this->redirect('/dashboard/blueprint_events/event_list?deleted&title=' . $eventTitle);
        }
    }

    private function getRecentEdited($event)
    {
        $value = false;

        if (isset($_GET['updated']) && $this->get('id')) {
            $value = $this->get('id');
        } else if (isset($_GET['success'])) {
            $event->load('1=1 ORDER BY created_at DESC LIMIT 1');
            $value = $event->getId();
        }

        return $value;
    }

}