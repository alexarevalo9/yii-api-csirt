<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\StaleObjectException;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{

    public $expire_at = 3442;
    /**
     * @return string the name of the db table associated with this model class.
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 80],
            [['password', 'auth_key'], 'string', 'max' => 250],
            [['email_hash'], 'string', 'max' => 50],
            [['active'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'hash' => 'Hash',
            'active' => 'Active',
        ];
    }

    /**
     * When using API auth by bearer token, find which user the token belongs to
     *
     * @param string $token
     * @param string $type
     * @return User|null
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Find a user by their unique id
     *
     * @param string $id
     * return app\models\User
     * @return User|null
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * Validate User by email and password
     *
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function validateUser($email, $password)
    {
        $cryptpassword = crypt($password, Yii::$app->params["salt"]);
        $user = static::findOne(["email" => $email, "password" => $cryptpassword]);
        if ($user != null) {
            return $user;
        } else {
            return null;
        }
    }

    public static function findByEmail($email)
    {
        $user = static::findOne(["email" => $email]);
        return $user ? $user : null;
    }

    public static function validatePassword($email, $password){
        $cryptpassword = crypt($password, Yii::$app->params["salt"]);
        $user = static::findOne(["email" => $email, "password" => $cryptpassword]);
        return $user ? true : false;
    }

    /**
     * Generate authentication token
     *
     * @param string $str
     * @param int $long
     * @return string|null
     */
    public function generateAuthToken($str = '', $long = 0)
    {
        $authToken = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str) - 1;
        for ($x = 0; $x < $long; $x++) {
            $authToken .= $str[rand($start, $limit)];
        }

        return $authToken;
    }

    public function saveAuthToken($id, $authToken)
    {
        $user = static::findOne($id);
        $user->auth_key = $authToken;
        $user->update();
    }
}
