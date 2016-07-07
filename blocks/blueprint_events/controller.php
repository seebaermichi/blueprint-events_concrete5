<?php
namespace Concrete\Package\BlueprintEvents\Block\BlueprintEvents;

use \Concrete\Core\Block\BlockController;
use \Concrete\Package\BlueprintEvents\Src\BlueprintEvent;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends BlockController
{

    protected $btTable = "btBlueprintEvents";
    protected $btInterfaceWidth = "350";
    protected $btInterfaceHeight = "300";

    public function getBlockTypeName()
    {
        return t('Events List');
    }

    public function getBlockTypeDescription()
    {
        return t('A list of events!');
    }

    public function view()
    {
        $e = new BlueprintEvent();
        $events = $e->find('1=1 ORDER BY event_date LIMIT ' . $this->item_limit);
        $this->set('events', $events);
    }
}
