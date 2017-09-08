<?php

namespace app\models;

/**
 * UsersSearch represents the model behind the search form of `app\models\Users`.
 */
class BaseModel
{
    public function getuserFullName($userid){
        $user = UsersInformation::findone($userid);
        if ($user == '' || $user == NULL){
            return '';
        } else {
            $userFullName = $user->firstName . ' ' . substr($user->middleName, 0,1) . '. ' . $user->lastName;
            return $userFullName;
        }
    }

    public function getuserFullName1($userid){
        $user = UsersInformation::find()->joinWith('users')->where(['user_id'=>$userid])->one();
        if ($user == '' || $user == NULL){
            return '';
        } else {
            $userFullName = $user->users->username . ' - ' . $user->firstName . ' ' . substr($user->middleName, 0,1) . '. ' . $user->lastName;
            return $userFullName;
        }
    }

    public function getUsernames(){
        $user = Users::find()->joinWith('userinfo')->where(['!=','user.id',1])->all();
        foreach($user as $row){
            if ($row->id == '' || $row->id == NULL){
                $usernames = '';
            } else {
                $usernames[$row->id] = $row->username . ' - ' . $row->userinfo->lastName . ', ' . $row->userinfo->firstName . ' ' . substr($row->userinfo->middleName, 0,1) . '.';
            }
        }

        if ($user == '' || $user == NULL){
            return [];
        } else {
            return $usernames;
        }
    }

    public function getUsernames1(){
        $user = Users::find()->joinWith('userinfo')->where(['!=','user.id',1])->all();
        foreach($user as $row){
            if ($row->id == '' || $row->id == NULL){
                $usernames = '';
            } else {
                $usernames[$row->id] = $row->username . ' - ' . $row->userinfo->lastName . ', ' . $row->userinfo->firstName . ' ' . substr($row->userinfo->middleName, 0,1) . '.';
            }
        }

        if ($user == '' || $user == NULL){
            return [];
        } else {
            return $usernames;
        }
    }

    public function getUseraccess(){
        $auth_item = AuthItem::find()->where(['!=','name','_SUPER-USER'])->all();
        foreach($auth_item as $row){
            if ($row->name == '' || $row->name == NULL){
                $useraccess = '';
            } else {
                $useraccess[$row->name] = $row->description;
            }
        }

        if ($auth_item == '' || $auth_item == NULL){
            return [];
        } else {
            return $useraccess;
        }

        
    }

    public function getEncodedby(){
        $user = DocumentTracker::find()->joinWith('encodedby')->all();
        foreach($user as $row){
            if ($row->dtr_from_user_id == '' || $row->dtr_from_user_id == NULL){
                $usernames = '';
            } else {
                $usernames[$row->dtr_encoded_user_id] = $row->encodedby->lastName . ', ' . $row->encodedby->firstName . ' ' . substr($row->encodedby->middleName, 0,1) . '.';
            }         
        }

        if ($user == '' || $user == NULL){
            return [];
        } else {
            return $usernames;
        }
    }

    public function itemnameDescription($item_name){
        $item_name = AuthItem::findone($item_name);
        if ($item_name == '' || $item_name == NULL){
            return '';
        } else {
            $itemName = $item_name->description;
            return $itemName;
        }
    }

    public function getSex(){
        $data=['Male'=>'Male', 'Female'=>'Female'];
        return $data;
    }

    public function getYesNo(){
        $data=['0'=>'No', '1'=>'Yes'];
        return $data;
    }

    public function getYesNo1($id){
        if ($id == 0 || $id == NULL || $id == ''){
            return 'NO';
        } else {
            return 'YES';
        }
    }

    public function getPosition(){
        $position = Position::find()->all();
        foreach($position as $row){
            if ($row->name == '' || $row->name == NULL){
                $positions = '';
            } else {
                $positions[$row->id] = $row->name . ' - ' . $row->description;
            }
        }
        if ($position == '' || $position == NULL){
            return [];
        } else {
            return $positions;
        }
    }

    public function getPositionName($id){
        $position = Position::findone($id);
        if ($position == '' || $position == NULL){
            return '';
        } else {
            $position_name = $position->name;
            return $position_name;
        }
    }

    public function getSalary(){
        $salary = Salary::find()->all();
        foreach($salary as $row){
            if ($row->name == '' || $row->name == NULL){
                $salarys = '';
            } else {
                $salarys[$row->id] = $row->name . ' - ' . $row->description . ' ' . number_format($row->amount,'2','.',',');
            }
        }
        if ($salary == '' || $salary == NULL){
            return [];
        } else {
            return $salarys;
        }
    }

    public function getSalaryDescription($id){
        $salary = Salary::findone($id);
        if ($salary == '' || $salary == NULL){
            return '';
        } else {
            $salary_description = $salary->description;
            return $salary_description;
        }
    }

    public function getAccountTitleDirectLabor(){
        $accountTitle = AccountTitle::find()->where(['name' => 'Direct Labor'])->all();
        foreach($accountTitle as $row){
            if ($row->name == '' || $row->name == NULL){
                $accountTitles = '';
            } else {
                $accountTitles[$row->id] = $row->name . ' - ' . $row->description;
            }
        }
        if ($accountTitle == '' || $accountTitle == NULL){
            return [];
        } else {
            return $accountTitles; 
        }
    }

    public function getModeOfPayment(){
        $modeOfPayment = ModeOfPayment::find()->all();
        foreach($modeOfPayment as $row){
            if ($row->name == '' || $row->name == NULL){
                $modeOfPayments = '';
            } else {
                $modeOfPayments[$row->id] = $row->name . ' - ' . $row->description;
            }
        }
        if ($modeOfPayment == '' || $modeOfPayment == NULL){
            return [];
        } else {
            return $modeOfPayments; 
        }
    }

    public function getAccountTitle1($id){
        $accountTitle = AccountTitle::findone($id);
        if ($accountTitle == '' || $accountTitle == NULL){
            return '';
        } else {
            $accountTitles = $accountTitle->name;
            return $accountTitles;
        }
    }

    public function getModeOfPayment1($id){
        $modeOfPayment = ModeOfPayment::findone($id);
        if ($modeOfPayment == '' || $modeOfPayment == NULL){
            return '';
        } else {
            $modeOfPayments = $modeOfPayment->name;
            return $modeOfPayments;
        }
    }
}
