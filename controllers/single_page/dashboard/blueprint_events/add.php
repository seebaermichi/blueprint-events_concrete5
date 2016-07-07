<?php
namespace Concrete\Package\BlueprintEvents\Controller\SinglePage\Dashboard\BlueprintEvents;

use \Concrete\Core\Page\Controller\DashboardPageController;
use \Concrete\Package\BlueprintEvents\Src\BlueprintEvent;
use Core;
use User;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Add extends DashboardPageController
{
    public function on_start()
    {
        $html = Core::make('helper/html');
        $this->addHeaderItem($html->css('add.css', 'blueprint_events'));
    }

    public function edit($id = null)
    {
        if ($id) {
            $event = new BlueprintEvent();
            $event->load('id = ?', $id);

            $this->set('data', (array)$event);
        }
    }

    public function save()
    {
        $data = $_POST;
        $redirectFlag = 'success';

        $val = Core::make('helper/validation/form');
        $val->setData($data);

        $val->addRequired('title', t('Please enter a title.'));
        $val->addRequired('location', t('Please enter a location.'));

        $passed = $val->test();

        if (!$passed) {
            $this->set('errors', $val->getError()->getList());
        } else {
            $dth = Core::make('helper/form/date_time');
            $event = new BlueprintEvent();

            if ($data['id']) {
                $event->load('id = ?', $data['id']);
                $redirectFlag = 'updated&id=' . $data['id'];
            }

            $event->title = $data['title'];
            $event->event_date = $dth->translate('event_date');

            if ($data['location']) {
                $event->location = $data['location'];
            }

            if ($data['description']) {
                $event->description = $data['description'];
            }

            if (!$data['id']) {
                $user = new User();
                $event->created_by = $user->getUserID();
                $event->created_at = date('Y-m-d H:i:s');
            }

            $event->save();

            $this->redirect('/dashboard/blueprint_events/event_list?' . $redirectFlag . '&title=' . $data['title']);
        }
    }

}