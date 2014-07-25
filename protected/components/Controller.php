<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

	public $layout='//layouts/main';
	public $breadcrumbs=array();

    public function render($view, $data = null) {
        if (isset($_SERVER['HTTP_X_PJAX'])) {
            echo "<title>{$this->pageTitle}</title>";
            $this->renderPartial($view, $data);
        }
        else
            parent::render($view, $data);
    }

    public function filterMineOnly($filterChain){
        if(!Yii::app()->user->checkAccess('mineOnly', array('id' => $_GET['id'])))
            throw new CHttpException(403,'Cant perform this action.');
        $filterChain->run();
    }

}