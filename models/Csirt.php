<?php

namespace app\models;

use Yii;

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
class Csirt extends \yii\db\ActiveRecord
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
            [['id', 'nombreCsirt', 'direccion', 'telefono', 'email', 'gpgEmail', 'comunidadObj', 'sitioWeb', 'horario', 'nombreReprePrincipal', 'telefonoReprePrincipal', 'correoReprePrincipal', 'GPGReprePrincipal', 'nombreRepreAlterno', 'telefonoRepreAlterno', 'correoRepreAlterno', 'GPGRepreAlterno', 'latitud', 'longitud', 'token'], 'required'],
            [['id'], 'integer'],
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
}
