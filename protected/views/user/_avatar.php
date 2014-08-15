<?php if($model->photoURL == ''){ ?>

    <?php
        $this->widget('ext.gravatar.YiiGravatar', array(
            'email'=>$model->email,
            'size'=>80,
            'defaultImage'=>'identicon',
            'rating'=>'r',
            'emailHashed'=>false,
            'htmlOptions'=>array(
                'alt'=>$model->first_name.' '.$model->last_name,
                'title'=>$model->first_name.' '.$model->last_name,
            )
        ));
    ?>

<?php }else{ ?>

    <img
        alt="<?= $model->first_name.' '.$model->last_name ?>"
        title="<?= $model->first_name.' '.$model->last_name ?>"
        src="<?= $model->photoURL ?>"
        width="80"
        height="80"
    />

<?php } ?>