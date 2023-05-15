<?php

namespace app\components;

use app\models\Auth;
use app\models\User;
use Yii;
use yii\authclient\ClientInterface;
use yii\helpers\ArrayHelper;

/**
 * AuthHandler handles successful authentication via Yii auth component
 */
class AuthHandler
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function handle()
    {
        $attributes = $this->client->getUserAttributes();
        $email = ArrayHelper::getValue($attributes, 'email');
        $id = ArrayHelper::getValue($attributes, 'id');
        $username = $this->client->getTitle() . '_' . ArrayHelper::getValue($attributes, 'id');
        $name = ArrayHelper::getValue($attributes, 'name');

        /* @var Auth $auth */
        $auth = Auth::find()->where([
            'source' => $this->client->getId(),
            'source_id' => $id,
        ])->one();

        if (empty($email)) {
            Yii::$app->getSession()->setFlash('error', [
                Yii::t('app', "Kirish uchun {client} tomonidan email manzil taqdim etilmadi!", ['client' => $this->client->getTitle()]),
            ]);
            return false;
        }

        if (Yii::$app->user->isGuest) {
            if ($auth) { // login
                /* @var User $user */
                $user = $auth->user;
                $this->updateUserInfo($user);
                Yii::$app->user->login($user, Yii::$app->params['user.rememberMeDuration'] ?? 1800);
            } else { // signup
                $existingUser = User::find()->where(['email' => $email])->exists();
                if ($existingUser) {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', "Ushbu email bilan foydalanuvchi ro'yhatdan o'tgan. {client} hisobini profilingizga ulash uchun oldin, email bilan tizimga kiring", ['client' => $this->client->getTitle()]),
                    ]);
                } else {
                    $password = Yii::$app->security->generateRandomString(6);
                    $user = new User([
                        'username' => $username,
                        'name' => $name,
                        'email' => $email,
                        'password' => $password,
                        'status' => User::STATUS_ACTIVE // make sure you set status properly
                    ]);
                    $user->generateAuthKey();
                    $user->generatePasswordResetToken();

                    $transaction = User::getDb()->beginTransaction();

                    if ($user->save()) {

                        $authManager = Yii::$app->authManager;
                        $role = $authManager->getRole('Administrator');
                        Yii::$app->authManager->assign($role, $user->id);

                        $auth = new Auth([
                            'user_id' => $user->id,
                            'source' => $this->client->getId(),
                            'source_id' => (string)$id,
                        ]);
                        if ($auth->save()) {
                            $transaction->commit();
                            Yii::$app->user->login($user, Yii::$app->params['user.rememberMeDuration'] ?? 1800);
                        } else {
                            $transaction->rollBack();
                            Yii::$app->getSession()->setFlash('error', [
                                Yii::t('app', '{client} hisobi ma\'lumotlarini saqlashda xatolik yuz berdi: {errors}', [
                                    'client' => $this->client->getTitle(),
                                    'errors' => json_encode($auth->getErrors()),
                                ]),
                            ]);
                        }
                    } else {
                        $transaction->rollBack();
                        Yii::$app->getSession()->setFlash('error', [
                            Yii::t('app', 'Foydalanuvchini ro\'yhatdan o\'tkazib bo\'lmadi: {errors}', [
                                'client' => $this->client->getTitle(),
                                'errors' => json_encode($user->getErrors()),
                            ]),
                        ]);
                    }
                }
            }
        } else { // user already logged in
            if (!$auth) { // add auth provider
                $auth = new Auth([
                    'user_id' => Yii::$app->user->id,
                    'source' => $this->client->getId(),
                    'source_id' => (string)$attributes['id'],
                ]);
                if ($auth->save()) {
                    /** @var User $user */
                    $user = $auth->user;
                    $this->updateUserInfo($user);
                    Yii::$app->getSession()->setFlash('success', [
                        Yii::t('app', '{client} hisobi profilingizga muvaffaqiyatli bog\'landi.', [
                            'client' => $this->client->getTitle()
                        ]),
                    ]);
                } else {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', '{client} hisobini profilingizga ulashda xatolik yuz berdi: {errors}', [
                            'client' => $this->client->getTitle(),
                            'errors' => json_encode($auth->getErrors()),
                        ]),
                    ]);
                }
            } else { // there's existing auth
                Yii::$app->getSession()->setFlash('error', [
                    Yii::t('app',
                        'Unable to link {client} account. There is another user using it.',
                        ['client' => $this->client->getTitle()]),
                ]);
            }
        }
    }

    /**
     * @param User $user
     */
    private function updateUserInfo(User $user)
    {
        $user->last_login_at = time();
        $user->save();
    }
}