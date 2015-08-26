<?php
namespace xj\rbac;

use Yii;
use yii\base\InvalidConfigException;
use yii\di\Instance;
use yii\web\ForbiddenHttpException;
use yii\web\User;

/**
 * RbacModule
 * @author xjflyttp <xjflyttp@gmail.com>
 */
class Module extends \yii\base\Module
{

    public $controllerNamespace = 'xj\rbac\controllers';
    public $userIdField;
    public $userNameField;
    public $userTableModelName;
    public $allowedIPs;
    public $roles;
    public $layout = 'main';
    public $user = 'user';

    public function init()
    {
        parent::init();
        if (null === $this->userIdField) {
            throw new InvalidConfigException('userIdField is null');
        } elseif (null === $this->userNameField) {
            throw new InvalidConfigException('userNameField is null');
        } elseif (null === $this->userTableModelName) {
            throw new InvalidConfigException('userTableModelName is null');
        } elseif (null === $this->allowedIPs && null === $this->roles) {
            throw new InvalidConfigException('allowedIPs & roles both null');
        }
        $this->user = Instance::ensure($this->user, User::className());
    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (!$this->checkAccess()) {
            throw new ForbiddenHttpException('You are not allowed to access this page.');
        }

        return true;
    }

    /**
     * @return boolean whether the module can be accessed by the current user
     */
    protected function checkAccess()
    {

        $ip = Yii::$app->getRequest()->getUserIP();
        if ($this->checkIps($ip) && $this->checkRoles($this->user)) {
            return true;
        }
        return false;
    }

    /**
     * @param string $ip
     * @return bool
     */
    protected function checkIps($ip)
    {
        foreach ($this->allowedIPs as $filter) {
            if ($filter === '*' || $filter === $ip || (($pos = strpos($filter, '*')) !== false && !strncmp($ip, $filter, $pos))) {
                return true;
            }
        }
        Yii::warning('Access to Rbac is denied due to IP address restriction. The requested IP is ' . $ip, __METHOD__);
        return false;
    }

    /**
     * @param User $user
     * @return bool
     */
    protected function checkRoles($user)
    {
        foreach ($this->roles as $role) {
            if ($role === '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            } elseif ($role === '@') {
                if (!$user->getIsGuest()) {
                    return true;
                }
            } elseif ($user->can($role)) {
                return true;
            }
        }
        Yii::warning('Access to Rbac is denied');
        return false;
    }
}
