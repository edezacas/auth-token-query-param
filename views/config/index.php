<?php

use yii\helpers\Html;
use yii\helpers\Url;
use humhub\compat\CActiveForm;
?>
<div class="panel panel-default">
    <div class="panel-heading">Auth Token Query Param Configuration</div>
    <div class="panel-body">

        <?php $form = CActiveForm::begin(); ?>

        <?php echo $form->errorSummary($model); ?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'urlAuthServer'); ?>
            <?php echo $form->textField($model, 'urlAuthServer', array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'urlAuthServer'); ?>
        </div>

        <hr>
        <?php echo Html::submitButton('Save', array('class' => 'btn btn-primary')); ?>
        <a class="btn btn-default" href="<?php echo Url::to(['/admin/module']); ?>"><?php echo 'Back to modules'; ?></a>

        <?php CActiveForm::end(); ?>
    </div>
</div>
