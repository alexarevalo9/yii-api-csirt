<?php

namespace app\modules\v1\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Console;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "wp_mapa_csirt".
 *
 * @property string $token
 * @property string $nombreCsirt
 * @property string $direccion
 * @property string $telefono
 * @property string $email
 * @property string|null $gpgEmail
 * @property string|null $comunidadObj
 * @property string|null $sitioWeb
 * @property string $horario
 * @property string|null $nombreReprePrincipal
 * @property string|null $telefonoReprePrincipal
 * @property string|null $correoReprePrincipal
 * @property string|null $GPGReprePrincipal
 * @property string|null $nombreRepreAlterno
 * @property string|null $telefonoRepreAlterno
 * @property string|null $correoRepreAlterno
 * @property string|null $GPGRepreAlterno
 * @property string|null $mensajeOpc
 * @property string $latitud
 * @property string $longitud
 */
class Csirt extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wp_mapa_csirt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['token', 'nombreCsirt', 'direccion', 'telefono', 'email', 'horario', 'latitud', 'longitud'], 'required'],
            [['token', 'latitud', 'longitud'], 'string', 'max' => 50],
            [['nombreCsirt', 'telefono', 'email', 'gpgEmail', 'sitioWeb', 'horario', 'nombreReprePrincipal', 'telefonoReprePrincipal', 'correoReprePrincipal', 'GPGReprePrincipal', 'nombreRepreAlterno', 'telefonoRepreAlterno', 'correoRepreAlterno', 'GPGRepreAlterno'], 'string', 'max' => 100],
            [['direccion', 'comunidadObj', 'mensajeOpc'], 'string', 'max' => 500],
            [['token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'token' => 'Token',
            'nombreCsirt' => 'Nombre Csirt',
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
            'email' => 'Email',
            'gpgEmail' => 'Gpg Email',
            'comunidadObj' => 'Comunidad Obj',
            'sitioWeb' => 'Sitio Web',
            'horario' => 'Horario',
            'nombreReprePrincipal' => 'Nombre Repre Principal',
            'telefonoReprePrincipal' => 'Telefono Repre Principal',
            'correoReprePrincipal' => 'Correo Repre Principal',
            'GPGReprePrincipal' => 'Gpg Repre Principal',
            'nombreRepreAlterno' => 'Nombre Repre Alterno',
            'telefonoRepreAlterno' => 'Telefono Repre Alterno',
            'correoRepreAlterno' => 'Correo Repre Alterno',
            'GPGRepreAlterno' => 'Gpg Repre Alterno',
            'mensajeOpc' => 'Mensaje Opc',
            'latitud' => 'Latitud',
            'longitud' => 'Longitud',
        ];
    }

    public function fields(){
        $fields=array_diff(parent::fields(),['token']); //Nunca devuelve el token
        return $fields;
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Find Csirt by token
     *
     * @param string $token
     * @return Csirt|null
     */
    public function findCsirt($token)
    {
        return static::findOne(["token" => $token]);
    }

}
