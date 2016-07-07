<?php

defined('C5_EXECUTE') or die(_("Access Denied."));

$form = Core::make('helper/form');
$dth = Core::make('helper/form/date_time');
?>


<?php if (!empty($errors)): ?>
    <div class="alert alert-danger col-sm-10 col-sm-offset-2">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <p><?php echo t('There were some problems saving the event.'); ?></p>
        <ul style="margin-top: 5px;">
            <?php foreach ($errors as $e): ?>
                <li><?php echo $e; ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif; ?>


<div class="alert alert-info col-sm-10 col-sm-offset-2">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <p><?php echo t('Fields with * are required'); ?></p>
</div>

<form action=<?php echo $controller->action('save') ?> method="POST" class="form-horizontal">
    <div class="form-group">
        <?php echo $form->label('title', t('Event Title') . '*', array('class' => 'col-sm-2')); ?>
        <div class="col-sm-10">
            <?php echo $form->text('title', $data['title'], array('required'=>'required',
                'pattern' => '[a-zA-ZäöüÄÖÜ0-9\-\s]+', 'title' => t('Allowed: a-z, A-Z, äöü, ÄÖÜ, 0-9, -'))); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->label('event_date', t('Event Date') . '*', array('class' => 'col-sm-2')); ?>
        <div class="col-sm-10">
            <?php echo $dth->datetime('event_date', $data['event_date']); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->label('location', t('Location') . '*', array('class' => 'col-sm-2')); ?>
        <div class="col-sm-10">
            <?php echo $form->text('location', $data['location'], array('required' => 'required',
                'pattern' => '[a-zA-ZäöüÄÖÜ\-\s]+', 'title' => t('Allowed: a-z, A-Z, äöü, ÄÖÜ'))); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->label('description', t('Description'), array('class' => 'col-sm-2')); ?>
        <div class="col-sm-10">
            <?php
            $editor = Core::make('editor');
            print $editor->outputStandardEditor('description', $data['description']);
            ?>
        </div>
    </div>
    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <button type="submit" class="btn btn-primary pull-right"><?php echo t('Save') ?></button>
            <a href="<?php echo $this->url('/dashboard/blueprint_events/event_list'); ?>"
               class="btn btn-default pull-left"><?php echo t('Cancel'); ?></a>
        </div>
    </div>
    <?php if (!empty($data)): ?>
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
    <?php endif; ?>
</form>