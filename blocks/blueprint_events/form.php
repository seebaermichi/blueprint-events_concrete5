<?php
defined('C5_EXECUTE') or die(_("Access Denied."));

$form = Core::make('helper/form');
?>

<div class="form-group">
    <?php echo $form->label('item_limit', t('Maximum events to show')); ?>
    <?php echo $form->text('item_limit', $item_limit) ?>
</div>