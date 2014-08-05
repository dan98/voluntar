<?php
class WebUser extends CWebUser
{
    const USER_MODER = 1;
    const USER_SIMPLE = 0;

    public function checkAccess($operation = null, $params=array())
    {
        if (empty($this->id)) {
            // Not identified => no rights
            return false;
        }
        $role = $this->getState("role");

        switch($operation){

            // Only for Moderators
            case 'setEventStatusAccepted':
                $event=Event::model()->findByPk($params['id']);
                if($event->status != Event::STATUS_OPEN && $event->status != Event::STATUS_NOTACCEPTED)
                    return false;
                break;
            case 'setEventStatusNotAccepted':
                $event=Event::model()->findByPk($params['id']);
                if($event->status != Event::STATUS_OPEN)
                    return false;
                break;
            case 'setEventStatusModerated':
                $event=Event::model()->findByPk($params['id']);
                if($event->status != Event::STATUS_EVALUATED)
                    return false;
                break;


            // All users
            case 'evaluateEvent':
                $event=Event::model()->findByPk($params['id']);
                if($event->status == Event::STATUS_CLOSED)
                    return true;
                else
                    return false;
                break;

            case 'evaluateJoinskill':
                $joinskill=JoinSkill::model()->findByPk($params['id']);
                if(Yii::app()->user->checkAccess('evaluateEvent', array('id'=>$joinskill->join->event->id)) && $joinskill->status == JoinSkill::STATUS_OPEN)
                    return true;
                break;

            case 'updateUser':
                if($this->id == $params['id'])
                    return true;
                break;

            case 'updateEvent':
                $event=Event::model()->findByPk($params['id']);
                if($event->user_id == $this->id && $event->status < Event::STATUS_ACCEPTED)
                    return true;
                break;

            case 'setEventStatusClosed':
                $event=Event::model()->findByPk($params['id']);
                if($event->status == Event::STATUS_ACCEPTED && time() > strtotime($event->time))
                    return true;
                break;

            case 'updateOrganization':
                $user=User::model()->findByPk($this->id);
                if(in_array($params['id'], $user->organizations->getTagsIds()))
                    return true;
                break;

            case 'postAsOrganization':
                $user=User::model()->findByPk($this->id);
                if(in_array($params['id'], $user->organizations->getTagsIds()))
                    return true;
                break;

            case 'joinEvent':
                $event=Event::model()->findByPk($params['id']);
                if($event->status == Event::STATUS_ACCEPTED && $event->joinedEvent() == false)
                    return true;
                else
                    return false;
                break;

            case 'leaveEvent':
                $event=Event::model()->findByPk($params['id']);
                if($event->status == Event::STATUS_ACCEPTED && $event->joinedEvent() == true)
                    return true;
                else
                    return false;
                break;

        }

        if($role == self::USER_MODER)
            return true;

        return false;
    }
}