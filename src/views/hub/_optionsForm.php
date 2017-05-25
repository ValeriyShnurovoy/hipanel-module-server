<?php

use hipanel\widgets\PasswordInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php $form = ActiveForm::begin([
    'id' => 'hub-options-form',
    'validationUrl' => Url::toRoute(['validate-form', 'scenario' => $model->scenario]),
]); ?>

<div class="box">
    <div class="box-body">
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'inn') ?>
                <?= $form->field($model, 'model') ?>
                <?= $form->field($model, 'login') ?>
                <?= $form->field($model, 'password')->widget(PasswordInput::class) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'ports_num') ?>
                <?= $form->field($model, 'traf_server_id') ?>
                <?= $form->field($model, 'vlan_server_id') ?>
                <?= $form->field($model, 'community') ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'snmp_version_id')->dropDownList([], ['prompt' => '--']) ?>
                <?= $form->field($model, 'digit_capacity_id')->dropDownList([], ['prompt' => '--']) ?>
                <?= $form->field($model, 'nic_media')->dropDownList([], ['prompt' => '--']) ?>
                <?= $form->field($model, 'base_port_no') ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'oob_key') ?>
            </div>
        </div>
    </div>
    <div class="box-footer">

        <?= Html::submitButton(Yii::t('hipanel', 'Save'), ['class' => 'btn btn-success']) ?>
        &nbsp;
        <?= Html::button(Yii::t('hipanel', 'Cancel'), ['class' => 'btn btn-default', 'onclick' => 'history.go(-1)']) ?>
    </div>
</div>
<?php $form->end() ?>