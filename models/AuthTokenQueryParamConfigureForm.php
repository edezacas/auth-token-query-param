<?php

namespace digitalAscetic\humhub\modules\authtokenqueryparam\models;

use yii\base\Model;

/**
 * AuthTokenQueryParamConfigureForm defines the configurable fields.
 *
 */
class AuthTokenQueryParamConfigureForm extends Model
{

    public $urlAuthServer;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            array('urlAuthServer', 'required'),
            array('urlAuthServer', 'string'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return array(
            'urlAuthServer' => 'Url for server authentication',
        );
    }

}
