<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "we_public".
 *
 * @property integer $p_id
 * @property string $p_name
 * @property string $p_type
 * @property string $p_AppID
 * @property string $p_AppSecret
 * @property string $p_url
 * @property string $p_token
 * @property integer $u_id
 * @property integer $p_state
 * @property string $p_urlget
 */
class WePublic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'we_public';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['u_id', 'p_state'], 'integer'],
            [['p_name', 'p_type'], 'string', 'max' => 30],
            [['p_AppID', 'p_AppSecret', 'p_token'], 'string', 'max' => 100],
            [['p_url', 'p_urlget'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p_id' => 'P ID',
            'p_name' => 'P Name',
            'p_type' => 'P Type',
            'p_AppID' => 'P  App ID',
            'p_AppSecret' => 'P  App Secret',
            'p_url' => 'P Url',
            'p_token' => 'P Token',
            'u_id' => 'U ID',
            'p_state' => 'P State',
            'p_urlget' => 'P Urlget',
        ];
    }
}
