<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form=ActiveForm::begin(); ?>
	<?= $form->field($model, 'name') ?>
	<?= $form->field($model, 'email') ?>
	<div class="form-group">
		<?= Html::submitButton('Click to Submit', ['class'=>'btn btn-primary']) ?>
	</div>

<?php ActiveForm::end(); ?>