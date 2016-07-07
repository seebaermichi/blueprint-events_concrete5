<?php

defined('C5_EXECUTE') or die(_("Access Denied."));
?>


<?php if (isset($_GET['success']) || isset($_GET['updated'])): ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php if (isset($_GET['success'])) { ?>
            <p><?php echo t('The event "%s" was saved successfully!', $_GET['title']) ?></p>
        <?php } elseif (isset($_GET['updated'])) { ?>
            <p><?php echo t('The event "%s" was updated successfully!', $_GET['title']) ?></p>
        <?php } ?>
    </div>
<?php endif; ?>

<?php if (isset($_GET['deleted'])): ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <p><?php echo t('The event "%s" was deleted successfully!', $_GET['title']) ?></p>
    </div>
<?php endif; ?>

<?php if (!empty($events)): ?>
    <table class="table table-striped">
        <tr>
            <th><?php echo t('Event ID') ?></th>
            <th><?php echo t('Date') ?></th>
            <th><?php echo t('Title') ?></th>
            <th><?php echo t('Location') ?></th>
            <th><?php echo t('Actions') ?></th>
        </tr>
        <?php foreach ($events as $event): ?>
            <tr class="event-row<?php echo $event->id == $recentEdited ? ' info': '' ; ?>">
                <td><?php echo $event->id ?></td>
                <td><?php echo $event->getDate() ?></td>
                <td><?php echo $event->title ?></td>
                <td><?php echo $event->location ?></td>
                <td>
                    <a href="<?php echo $this->url('/dashboard/blueprint_events/add/edit/', $event->id) ?>"
                       class="btn btn-primary btn-sm"><?php echo t('Edit') ?></a>
                    <a href="<?php echo $this->action('delete', $event->id) ?>"
                       class="btn btn-danger delete btn-sm"><?php echo t('Delete') ?></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <p>
          <?php echo t('There are no events!') . ' '; ?>
          <a href="<?php echo $this->url('/dashboard/blueprint_events/add')?>"><?php echo t('Add one now!'); ?></a>
        </p>
    </div>
<?php endif; ?>
<div class="ccm-dashboard-form-actions-wrapper">
    <div class="ccm-dashboard-form-actions">
        <a href="<?php echo $this->url('/dashboard/blueprint_events/add'); ?>"
           class="btn btn-primary pull-right"><?php echo t('Add'); ?></a>
    </div>
</div>
