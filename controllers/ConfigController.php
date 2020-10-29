<?php

namespace digitalAscetic\humhub\modules\authtokenqueryparam\controllers;

use digitalAscetic\humhub\modules\authtokenqueryparam\models\AuthTokenQueryParamConfigureForm;
use Yii;
use humhub\models\Setting;
use humhub\modules\admin\components\Controller;

/**
 * Defines the configure actions.
 *
 */
class ConfigController extends Controller
{
    /**
     * Configuration Action for Super Admins
     */
    public function actionIndex()
    {
        $form = new AuthTokenQueryParamConfigureForm();
        $form->urlAuthServer = Setting::Get('urlAuthServer', 'auth-token-query-param');
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $form->urlAuthServer = Setting::Set('urlAuthServer', $form->urlAuthServer, 'auth-token-query-param');
            return $this->redirect(['/auth-token-query-param/config']);
        }

        return $this->render('index', array('model' => $form));
    }
}

?>
