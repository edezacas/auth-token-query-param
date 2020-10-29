<?php

namespace digitalAscetic\humhub\modules\authtokenqueryparam;

use humhub\models\Setting;
use humhub\modules\user\models\Password;
use humhub\modules\user\models\Profile;
use humhub\modules\user\models\User;
use Yii;
use yii\httpclient\Client;


class Events
{
    public static function onBeforeRequest($event)
    {

        // Only prepare if Login Request
        if (substr(Yii::$app->request->pathInfo, 0, 15) != 'user/auth/login') {
            return;
        }

        $request = Yii::$app->request;
        $token = $request->get('token');

        // Login with token query param
        if (isset($token)) {
            $client = new Client;
            $urlAuthServer = Setting::Get('urlAuthServer', 'auth-token-query-param');
            $request = $client->post($urlAuthServer, array('token' => $token));
            $response = $request->send();

            if ($response->getIsOk()) {
                $body = json_decode($response->getContent());
                $data = $body->data;

                if (isset($data)) {
                    $userData = $data->user;

                    $identity = User::find()->active()->andWhere(['or', 'user.username = "' . $userData->username . '"', 'user.email = "' . $userData->email . '"'])->one();

                    if (!isset($identity)) {
                        $user = new User();
                        $user->username = $userData->username;
                        $user->email = $userData->email;
                        $user->validate();

                        if ($user->hasErrors()) {
                            $user->email .= '@lacasa.net';
                            $user->validate();
                        }

                        $profile = new Profile();
                        $profile->user_id = $user->id;
                        $profile->firstname = $userData->person->firstName;
                        $lastName = isset($userData->person->lastName) ? $userData->person->lastName : $userData->person->firstName;
                        $profile->lastname = $lastName;
                        $profile->validate();

                        $password = new Password();
                        $password->newPassword = "piripino9030";
                        $password->newPasswordConfirm = $password->newPassword;
                        $password->validate();

                        if ($user->hasErrors() || $password->hasErrors()) {
                            Yii::$app->response->statusCode = 400;
                            return array_merge(['code' => 400, 'message' => 'Validation failed']);
                        }

                        if ($user->save()) {
                            $profile->user_id = $user->id;
                            $password->user_id = $user->id;
                            $password->setPassword($password->newPassword);
                            if ($profile->save() && $password->save()) {
                                Yii::$app->user->login($user);
                            }
                        }
                    } else {
                        Yii::$app->user->login($identity);
                    }
                }
            }
        }
    }
}
