<?php

namespace app\controllers;

use Yii;
use app\models\ReviewAdditionalData;
use app\models\UserReview;
use yii\web\Controller;
use yii\web\Response;


class UserReviewController extends Controller
{
    public $modelClass = 'app\models\UserReview';

    //
    //
    //
    // needs for post
    public $enableCsrfValidation = false;


    /**
     * @param string $create
     * @return Response
     */
    public function actionCreate() : Response
    {
        $request = Yii::$app->request;

        $userReview = new UserReview;
        $userReview->setAttribute('name', $request->post('name'));
        $userReview->setAttribute('email', $request->post('email'));
        $userReview->setAttribute('review', $request->post('review'));
        $userReview->setAttribute('rating', $request->post('rating'));
        if (!$userReview->save()) {
            return $this->asJson($userReview->errors);
        }

        $userReviewData = new ReviewAdditionalData();
        $userReviewData->setAttribute('ip_address', Yii::$app->getRequest()->getUserIP());
        $userReviewData->setAttribute('user_agent', Yii::$app->getRequest()->getUserAgent());
        $userReviewData->setAttribute('creation_date', date("Y-m-d/H:i:s",time()));
        $userReviewData->setAttribute('user_review_id', $userReview->id);
        $userReviewData->save();

        return $this->asJson([$userReview, $userReviewData]);
    }



//    /**
//     * @param array $data
//     * @return Response
//     */
//    public function actionCreate(array $data) : Response
//    {
//        $userReview = UserReview::findOne($data['id']);
//        return $this->asJson($userReview);
//    }

    /**
     * @return Response
     */
    public function actionIndex() : Response
    {
        $userReview = UserReview::find()->all();
        return $this->asJson($userReview);
    }


    /**
     * @param int $id
     * @return Response
     */
    public function actionId(int $id) : Response
    {
        $userReview = UserReview::findOne($id);
        return $this->asJson($userReview);
    }


    /**
     * @param string $ip
     * @return Response
     */
    public function actionIp(string $ip) : Response
    {
        $userReview = UserReview::find()
            ->joinWith('reviewAdditionalData')
            ->where(['ip_address' => $ip])
            ->all()
        ;
        return $this->asJson($userReview);
    }
}
