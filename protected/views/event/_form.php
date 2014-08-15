<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
    'id'=>'event-form',
    'enableAjaxValidation'=>true,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldGroup($model,'name',array('size'=>60,'maxlength'=>300)); ?>

    <?php echo $form->ckEditorGroup($model,'about',array('size'=>60,'maxlength'=>3000)); ?>

    <?php echo $form->dropDownListGroup($model, 'postAs', array('widgetOptions'=>array('data'=>User::getPostAsList()))); ?>

    <?php echo $form->dateTimePickerGroup($model, 'time', array(
        'htmlOptions' => array(
            'css'=>'form-control',
            'placeholder'=>'Birthday'
        )
    ));
    ?>

    <?php
    echo $form->select2Group($model, 'tags',
        array(
            'widgetOptions'=>array(
                'asDropDownList' => false,
                'options'=>array(
                    'tags' => $model->skills->getAllTags()
                )
            ),
        )
    );
    ?>
<?php
print_r($model->skills->getAllTags());
?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'location_lat'); ?>
    <?php
        Yii::import('ext.egmap.*');

        $gMap = new EGMap();
        $gMap->zoom = 15;
        $gMap->setWidth('100%');
        $gMap->setHeight(400);
        $mapTypeControlOptions = array(
            'position'=> EGMapControlPosition::LEFT_BOTTOM,
            'style'=>EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
        );

        $gMap->mapTypeControlOptions= $mapTypeControlOptions;

        if($model->location_lat == 0 || $model->location_lng ==0){
            $model->location_lat = Yii::app()->params['eventLat'];
            $model->location_lng = Yii::app()->params['eventLng'];
        }


        $gMap->setCenter($model->location_lat, $model->location_lng);

        // Saving coordinates after user dragged our marker.
        $dragevent = new EGMapEvent('dragend', "function (event) { $('#Event_location_lat').val(event.latLng.lat());$('#Event_location_lng').val(event.latLng.lng())}", false, EGMapEvent::TYPE_EVENT_DEFAULT);


        // Create marker with label
        $marker = new EGMapMarkerWithLabel($model->location_lat, $model->location_lng, array('title' => 'Event Location'), 'marker', array('dragevent'=>$dragevent));

        $label_options = array(
            'backgroundColor'=>'#ccc',
            'opacity'=>'0.7',
            'color'=>'black',
            'margin-top'=>'30px'
        );

        echo $form->hiddenField($model, 'location_lat');
        echo $form->hiddenField($model, 'location_lng');


        $marker->draggable=true;
        $marker->raiseOnDrag= true;

        $marker->setLabelAnchor(new EGMapPoint(22,0));
        $gMap->addMarker($marker);

        // enabling marker clusterer just for fun
        // to view it zoom-out the map
        $gMap->enableMarkerClusterer(new EGMapMarkerClusterer());

        $gMap->renderMap();
    ?>
</div>

    <?php $this->widget(
        'booster.widgets.TbButton',
        array('buttonType' => 'submit', 'label' => 'Submit')
    ); ?>


<?php $this->endWidget(); ?>
