<?php

namespace app\modules\v1\models;

use Yii;
use yii\helpers\Console;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "wp_mapa_csirt".
 *
 * @property int $id
 * @property string $nombreCsirt
 * @property string $direccion
 * @property string $telefono
 * @property string $email
 * @property string $gpgEmail
 * @property string $comunidadObj
 * @property string $sitioWeb
 * @property string $horario
 * @property string $nombreReprePrincipal
 * @property string $telefonoReprePrincipal
 * @property string $correoReprePrincipal
 * @property string $GPGReprePrincipal
 * @property string $nombreRepreAlterno
 * @property string $telefonoRepreAlterno
 * @property string $correoRepreAlterno
 * @property string $GPGRepreAlterno
 * @property string|null $mensajeOpc
 * @property string $latitud
 * @property string $longitud
 * @property string $token
 */
class Csirt extends \yii\db\ActiveRecord implements IdentityInterface
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
            [['nombreCsirt', 'direccion', 'telefono', 'email', 'gpgEmail', 'comunidadObj', 'sitioWeb', 'horario', 'nombreReprePrincipal', 'telefonoReprePrincipal', 'correoReprePrincipal', 'GPGReprePrincipal', 'nombreRepreAlterno', 'telefonoRepreAlterno', 'correoRepreAlterno', 'GPGRepreAlterno', 'latitud', 'longitud', 'token'], 'required'],
            [['nombreCsirt', 'email', 'horario', 'latitud', 'longitud'], 'string', 'max' => 50],
            [['direccion', 'gpgEmail', 'comunidadObj', 'sitioWeb', 'nombreReprePrincipal', 'correoReprePrincipal', 'GPGReprePrincipal', 'nombreRepreAlterno', 'correoRepreAlterno', 'GPGRepreAlterno'], 'string', 'max' => 100],
            [['telefono', 'telefonoReprePrincipal', 'telefonoRepreAlterno'], 'string', 'max' => 20],
            [['mensajeOpc', 'token'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
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
            'token' => 'Token',
        ];
    }

/*
    public function fields()
    {
        $fields = array_diff(parent::fields(), ['id', 'token']); //Nunca devuelve id ni token
        return $fields;
    }*/

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
        //echo var_dump(static::findOne(['token' => $token]));
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

    /*
     *  curl -X POST "http://csirt-api.test/csirt?token=ABCDEF" --header "Content-Type: application/json" --data-binary @datos.json
     *  curl -X PUT "http://csirt-api.test/csirt/1?token=ABCDEF" --header "Content-Type: application/json" --data-binary @datos2.json
     *  curl -X GET "http://csirt-api.test/csirt?token=ABCDEF"
     * */
}
