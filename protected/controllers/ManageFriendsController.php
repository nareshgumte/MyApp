<?php

class ManageFriendsController extends Controller {

    public function actionIndex() {


        $this->render('index');
    }

    public function actionFacebookFriends() {
        require Yii::app()->basePath . "/facebook/facebook.php";
        $facebook = new Facebook(array(
                    'appId' => Yii::app()->params['fb_api_key'], //"327963737297629", //
                    'secret' => Yii::app()->params['fb_api_key_secret'], //"f8a694c90e7df3b55c6e6a4e1734e3a8"//
                ));
        // echo $facebook->getLoginUrl();exit;
        $user = $facebook->getUser();
        // var_dump($facebook);exit;
        $list = array();
        if ($user) {
            try {
                $user_friends = $facebook->api('/me/friends');
            } catch (FacebookApiException $e) {
                error_log($e);
                $user = NULL;
            }
        }
        if (isset($user_friends)) {
            $i = 0;
            foreach ($user_friends['data'] as $user_friend) {
                $list[$i]['friend_name'] = $user_friend['name'];
                $username = explode(" ", $list[$i]['friend_name']);
                $firstname = $username[0];
                if (isset($username[1]) || !empty($username[1])) {

                    $lastname = $username[1];
                } else {
                    $lastname = $username[0];
                }
                $list[$i]['friend_uid'] = $user_friend['id'];
                $list[$i]['friend_image'] = "https://graph.facebook.com/" . $user_friend['id'] . "/picture?type=large";

                $condition = Yii::app()->db->createCommand()
                        ->select('*')
                        ->from('int_friends')
                        ->where('uniq_id=:id', array(':id' => $list[$i]['friend_uid']))
                        ->queryRow();

                if (!$condition) {
                    $user = Yii::app()->db->createCommand()
                            ->insert("int_friends", array(
                        "user_id" => Yii::app()->user->id, //dynamically change this
                        "firstname" => $firstname,
                        "lastname" => $lastname,
                        "uniq_id" => $list[$i]['friend_uid'],
                        "email" => $list[$i]['friend_uid'] . "@facebook.com",
                        "image_url" => "https://graph.facebook.com/" . $list[$i]['friend_uid'] . "/picture?type=large",
                        "network" => 'facebook'));
                }
                $i++;
            }
        }
        header("Location:" . Yii::app()->request->baseUrl . "/site/manageFriends");
    }

}