<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "we_rule".
 *
 * @property integer $r_id
 * @property string $r_name
 * @property string $r_keyword
 * @property string $r_type
 * @property integer $p_id
 * @property string $p_content
 */
class WeRule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'we_rule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p_id'], 'integer'],
            [['r_name', 'r_keyword', 'r_type', 'p_content'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r_id' => 'R ID',
            'r_name' => 'R Name',
            'r_keyword' => 'R Keyword',
            'r_type' => 'R Type',
            'p_id' => 'P ID',
            'p_content' => 'P Content',
        ];
    }
}
