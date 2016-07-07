<?php
namespace Concrete\Package\BlueprintEvents;

use Package;
use BlockType;
use SinglePage;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends Package
{
    protected $pkgHandle = 'blueprint_events';
    protected $appVersionRequired = '5.7.4.0';
    protected $pkgVersion = '1.0.0';

    public function getPackageName()
    {
        return t('Blueprint Events');
    }

    public function getPackageDescription()
    {
        return t('A calendar of events for our website.');
    }

    public function install()
    {
        $pkg = parent::install();

        // Add the dashboard pages
        $mainPage = SinglePage::add('/dashboard/blueprint_events', $pkg);
        $listPage = SinglePage::add('/dashboard/blueprint_events/event_list', $pkg);
        $addPage = SinglePage::add('/dashboard/blueprint_events/add', $pkg);

        // install the block type
        BlockType::installBlockType('blueprint_events', $pkg);
    }

}
