<?php

namespace xj\rbac\models;

use yii\base\Model;
use yii\rbac\Role;

class ItemForm extends Model {

    const TYPE_ROLE = Role::TYPE_ROLE;
    const TYPE_PERM = Role::TYPE_PERMISSION;

    public $name;
    public $type;
    public $desc;
    public $data;

    public function rules() {
        return [
            [['name'], 'required'],
            ['type', 'in', 'range' => array_keys($this->getTypeOptions())],
            [['desc'], 'string', 'max' => '128'],
            [['data'], 'string', 'max' => '128'],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Name',
            'type' => 'Type',
            'desc' => 'Desc',
            'data' => 'Data',
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['name', 'desc', 'data'];
        $scenarios['update'] = ['desc', 'data'];
        return $scenarios;
    }

    public function getTypeOptions() {
        return [
            static::TYPE_ROLE => 'Role',
            static::TYPE_PERM => 'Permission',
        ];
    }

    public function getTypeText() {
        $options = $this->getTypeOptions();
        return isset($options[$this->type]) ? $options[$this->type] : '';
    }

}
