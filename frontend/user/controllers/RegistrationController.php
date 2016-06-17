<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace frontend\user\controllers;

use Yii;
use dektrium\user\models\User;
use yii\web\NotFoundHttpException;
use dektrium\user\models\ResendForm;
use dektrium\user\models\RegistrationForm;
use common\models\main\DataOrder;
use dektrium\user\controllers\RegistrationController as BaseController;
use common\models\database\User as Acc;

class RegistrationController extends BaseController
{

    /**
     * Displays the registration page.
     * After successful registration if enableConfirmation is enabled shows info message otherwise redirects to home page.
     *
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionRegister()
    {
        if (!$this->module->enableRegistration) {
            throw new NotFoundHttpException();
        }

        /** @var RegistrationForm $model */
        $model = Yii::createObject(RegistrationForm::className());
        $event = $this->getFormEvent($model);

        $this->trigger(self::EVENT_BEFORE_REGISTER, $event);

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post()) && $model->register()) {

            $acc = Acc::findOne(['email' => $model->email]);

            $order = new DataOrder();
            if($order->load(Yii::$app->request->post()) && $order->validate()){
                $order->getNewOrder($acc->id);
            }
            $this->trigger(self::EVENT_AFTER_REGISTER, $event);
            $this->redirect(['/payment/one-pay', 'test' => Yii::$app->request->post('test'), 'order' => $order->order_id]);
        }
        if(!Yii::$app->request->isPost){
            return $this->renderAjax('register', [
                'model'  => $model,
                'module' => $this->module,
            ]);
        }


    }

    /**
     * Confirms user's account. If confirmation was successful logs the user and shows success message. Otherwise
     * shows error message.
     *
     * @param int    $id
     * @param string $code
     *
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionConfirm($id, $code)
    {
        $user = $this->finder->findUserById($id);

        if ($user === null || $this->module->enableConfirmation == false) {
            throw new NotFoundHttpException();
        }

        $event = $this->getUserEvent($user);

        $this->trigger(self::EVENT_BEFORE_CONFIRM, $event);

        $user->attemptConfirmation($code);

        $this->trigger(self::EVENT_AFTER_CONFIRM, $event);

        return $this->render('/message', [
            'title'  => Yii::t('user', 'Account confirmation'),
            'module' => $this->module,
        ]);
    }

    /**
     * Displays page where user can request new confirmation token. If resending was successful, displays message.
     *
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionResend()
    {
        if ($this->module->enableConfirmation == false) {
            throw new NotFoundHttpException();
        }

        /** @var ResendForm $model */
        $model = Yii::createObject(ResendForm::className());
        $event = $this->getFormEvent($model);

        $this->trigger(self::EVENT_BEFORE_RESEND, $event);

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post()) && $model->resend()) {

            $this->trigger(self::EVENT_AFTER_RESEND, $event);

            return $this->render('/message', [
                'title'  => Yii::t('user', 'A new confirmation link has been sent'),
                'module' => $this->module,
            ]);
        }

        return $this->render('resend', [
            'model' => $model,
        ]);
    }
}
