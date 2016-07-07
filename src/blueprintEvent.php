<?php
namespace Concrete\Package\BlueprintEvents\Src;

use \Concrete\Core\Legacy\Model;

defined('C5_EXECUTE') or die(_("Access Denied."));

class BlueprintEvent extends Model
{

    var $_table = 'BlueprintEvents';

    public function getDate()
    {
        return utf8_encode(strftime('%d. %b %Y', strtotime($this->event_date)));
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getId()
    {
        return $this->id;
    }
}