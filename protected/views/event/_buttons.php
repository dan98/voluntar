<?php
$this->widget(
    'booster.widgets.TbButtonGroup',
    array(
        'buttons' => array(
            array(
                'buttonType'=>'link',
                'url'=>array('update', 'id'=>$model->id),
                'label'=>'Update',
                'visible'=>Yii::app()->user->checkAccess('updateEvent', array('id' => $model->id))
            ),
            array(
                'buttonType'=>'submitLink',
                'htmlOptions'=>array('submit'=>array('saveStatus', 'id'=>$model->id, 'status'=>'ACCEPTED')),
                'label'=>'Accept',
                'visible'=>Yii::app()->user->checkAccess('setEventStatusAccepted', array('id' => $model->id))
            ),
            array(
                'buttonType'=>'submitLink',
                'htmlOptions'=>array('submit'=>array('saveStatus', 'id'=>$model->id, 'status'=>'NOTACCEPTED')),
                'label'=>'Not Accept',
                'visible'=>Yii::app()->user->checkAccess('setEventStatusNotAccepted', array('id' => $model->id))
            ),
            array(
                'buttonType'=>'submitLink',
                'htmlOptions'=>array('submit'=>array('saveStatus', 'id'=>$model->id, 'status'=>'CLOSED')),
                'label'=>'Close',
                'visible'=>Yii::app()->user->checkAccess('setEventStatusClosed', array('id' => $model->id))
            ),
            array(
                'buttonType'=>'button',
                'htmlOptions'=>array('onclick'=>'$("#join-skills").show()'),
                'label'=>'Join',
                'visible'=>Yii::app()->user->checkAccess('joinEvent', array('id' => $model->id))
            ),
            array(
                'buttonType'=>'submitLink',
                'htmlOptions'=>array('submit'=>array('leaveEvent', 'id'=>$model->id)),
                'label'=>'Leave',
                'visible'=>Yii::app()->user->checkAccess('leaveEvent', array('id' => $model->id))
            )
        )
    )
);
?>


<?php if(Yii::app()->user->checkAccess('joinEvent', array('id' => $model->id))){ ?>

    <?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
        'id'=>'join-skills',
        'action'=>array('joinEvent', 'id'=>$model->id),
        'htmlOptions'=>array(
            'style'=>'display:none'
        )
    )); ?>
        <?php
        foreach($model->skills->getAllTags() as $tag)
            $data[$tag]=$tag;
        $this->widget(
            'booster.widgets.TbSelect2',
            array(
                'name' => 'skills',
                'data' => $data,
                'htmlOptions' => array(
                    'multiple' => 'multiple',
                ),
            )
        );
        ?>
        <?php $this->widget(
            'booster.widgets.TbButton',
            array('buttonType' => 'submit', 'label' => 'Join')
        ); ?>
    <?php $this->endWidget(); ?>

<?php } ?>

<?php if(Yii::app()->user->checkAccess('evaluateEvent', array('id' => $model->id))){ ?>

    <?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
        'id'=>'evaluate-skills',
        'action'=>array('evaluateEvent', 'id'=>$model->id)
    )); ?>

    <?php $this->widget('booster.widgets.TbGroupGridView', array(
        'type'=>'striped ',
        'dataProvider' => $joinskills,
        'template' => "{items}",
        'columns' => array(
            'id',
            'join.user.first_name',
            'skill.name',
            array(
                'name'=>'rating',
                'type'=>'raw',
                'value'=>'TbHtml::radioButtonList("JoinSkill[{$data->id}]", null, array(1=>1, 2=>2, 3=>3, 4=>4, 5=>5));'
            )
        ),
        'mergeColumns' => array('join.user.first_name')
    )); ?>

    <?php $this->widget(
        'booster.widgets.TbButton',
        array('buttonType' => 'submit', 'label' => 'Evaluate')
    ); ?>
    <?php $this->endWidget(); ?>

<?php } ?>

<?php if(Yii::app()->user->checkAccess('setEventStatusModerated', array('id' => $model->id))){ ?>

    <?php $this->widget('booster.widgets.TbGroupGridView', array(
        'type'=>'striped ',
        'dataProvider' => $joinskills,
        'template' => "{items}",
        'columns' => array(
            'id',
            'join.user.first_name',
            'skill.name',
            'rating'
        ),
        'mergeColumns' => array('join.user.first_name')
    )); ?>

    <?php $this->widget(
        'booster.widgets.TbButton',
        array('buttonType' => 'submit',
            'htmlOptions'=>array(
                'submit'=>array('saveStatus', 'id'=>$model->id, 'status'=>'MODERATED')
            ),
            'label' => 'Moderate'
        )
    ); ?>

<?php } ?>