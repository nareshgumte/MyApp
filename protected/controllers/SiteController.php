<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
//echo "<pre>";print_r($_SESSION);exit;
        try {
            // display constants
            $API_CONFIG = array(
                'appKey' => 'jlvxnzxefq1i',
                'appSecret' => '16nUdtAzljV3xAoi',
                'callbackUrl' => NULL
            );
            define('CONNECTION_COUNT', 100);
            define('PORT_HTTP', '80');
            define('PORT_HTTP_SSL', '443');
            define('UPDATE_COUNT', 10);

            // set index
            $_REQUEST[LinkedIn::_GET_TYPE] = (isset($_REQUEST[LinkedIn::_GET_TYPE])) ? $_REQUEST[LinkedIn::_GET_TYPE] : '';

            switch ($_REQUEST[LinkedIn::_GET_TYPE]) {
                case 'initiate':
                    /**
                     * Handle user initiated LinkedIn connection, create the LinkedIn object.
                     */
                    // check for the correct http protocol (i.e. is this script being served via http or https)

                    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                    // set the callback url
                    //$API_CONFIG['callbackUrl'] = $protocol . $_SERVER['SERVER_NAME'] . ((($_SERVER['SERVER_PORT'] != PORT_HTTP) || ($_SERVER['SERVER_PORT'] != PORT_HTTP_SSL)) ? ':' . $_SERVER['SERVER_PORT'] : '') . $_SERVER['PHP_SELF'] . '?' . LinkedIn::_GET_TYPE . '=initiate&' . LinkedIn::_GET_RESPONSE . '=1';
                    $uri = explode("?", $_SERVER['REQUEST_URI']);
                    $API_CONFIG['callbackUrl'] = $protocol . $_SERVER['SERVER_NAME'] . ((($_SERVER['SERVER_PORT'] != PORT_HTTP) || ($_SERVER['SERVER_PORT'] != PORT_HTTP_SSL)) ? ':' . $_SERVER['SERVER_PORT'] : '') . "/IntroPoc/" . '?' . LinkedIn::_GET_TYPE . '=initiate&' . LinkedIn::_GET_RESPONSE . '=1';
                    //  $API_CONFIG['callbackUrl'] = $protocol . $_SERVER['HTTP_HOST'] . Yii::app()->baseUrl . "/ManageFriends" . '?' . LinkedIn::_GET_TYPE . '=initiate&' . LinkedIn::_GET_RESPONSE . '=1';

                    $OBJ_linkedin = new LinkedIn($API_CONFIG);

                    // check for response from LinkedIn
                    // check for response from LinkedIn
                    $_GET[LinkedIn::_GET_RESPONSE] = (isset($_GET[LinkedIn::_GET_RESPONSE])) ? $_GET[LinkedIn::_GET_RESPONSE] : '';


                    if (!$_GET[LinkedIn::_GET_RESPONSE]) {

                        // LinkedIn hasn't sent us a response, the user is initiating the connection
                        // send a request for a LinkedIn access token
                        $response = $OBJ_linkedin->retrieveTokenRequest();

                        if ($response['success'] === TRUE) {
                            // store the request token
                            $_SESSION['oauth']['linkedin']['request'] = $response['linkedin'];

                            // redirect the user to the LinkedIn authentication/authorisation page to initiate validation.

                            header('Location: ' . LinkedIn::_URL_AUTH . $response['linkedin']['oauth_token']);
                        } else {
                            // bad token request
                            echo "Request token retrieval failed:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LinkedIn OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
                        }
                    } else {
                        // LinkedIn has sent a response, user has granted permission, take the temp access token, the user's secret and the verifier to request the user's real secret key
                        $response = $OBJ_linkedin->retrieveTokenAccess($_SESSION['oauth']['linkedin']['request']['oauth_token'], $_SESSION['oauth']['linkedin']['request']['oauth_token_secret'], $_GET['oauth_verifier']);
                        if ($response['success'] === TRUE) {
                            // the request went through without an error, gather user's 'access' tokens
                            $_SESSION['oauth']['linkedin']['access'] = $response['linkedin'];

                            // set the user as authorized for future quick reference
                            $_SESSION['oauth']['linkedin']['authorized'] = TRUE;

                            // redirect the user back to the demo page
                            header('Location: ' . $_SERVER['PHP_SELF']);
                        } else {
                            // bad token access
                            echo "Access token retrieval failed:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LinkedIn OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
                        }
                    }
                    break;


                case 'message':
                    //echo "naresh";exit;
                    /**
                     * Handle connection messaging.
                     */
                    if (!empty($_GET['to']) || isset($_GET['to'])) {

                        $OBJ_linkedin = new LinkedIn($API_CONFIG);
                        // $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
                        $OBJ_linkedin->setTokenAccess(Yii::app()->params['access']);
                        $copy = TRUE;
                        $connections = explode(",", $_GET['to']);
                        // $body = "&lt;a href=&'http://www.linkedin.com/profile?viewProfile'gt; Testets &lt;/a&gt;";
                        $body = Yii::app()->params['defaultText'] . Yii::app()->params['defaultLink'] . "/IntroPoc/site/acceptInvitation?";
//$response = $OBJ_linkedin->message($connections, Yii::app()->params['defaultSubject'], Yii::app()->params['defaultText'] . "  " . Yii::app()->params['defaultLink'] . "/IntroPoc", $copy);
                        $response = $OBJ_linkedin->message($connections, Yii::app()->params['defaultSubject'], $body, $copy);
                        //&lt;a href='" . Yii::app()->params['defaultLink'] . "'&gt;Click&lt;&sol;a&gt;
                        //if ($response['success'] === TRUE) {
                        if ($response['success']) {
                            // message has been sent
                            echo "Message sent successfully  <input type=\"button\" value=\"Close 'myWindow'\" onclick=\"close()\">";
                            // header('Location: ' . Yii::app()->request->baseUrl . "/common/sendFbInvitation?type=linked");
                        } else {
                            // an error occured
                            echo "Message sending Failed  <input type=\"button\" value=\"Close 'myWindow'\" onclick=\"close()\">";
                            //header('Location: ' . Yii::app()->request->baseUrl . "/common/sendFbInvitation?type=linkedFailed");
                        }
                    } else {
                        echo "You must select at least one recipient.";
                    }
                    break;


                default:
                    header("Location:" . Yii::app()->request->baseUrl . "/site/login");

                    $_SESSION['oauth']['linkedin']['authorized'] = (isset($_SESSION['oauth']['linkedin']['authorized'])) ? $_SESSION['oauth']['linkedin']['authorized'] : FALSE;
                    if ($_SESSION['oauth']['linkedin']['authorized'] === TRUE) {
                        // user is already connected
                        $OBJ_linkedin = new LinkedIn($API_CONFIG);
                        $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
                        $response = $OBJ_linkedin->connections('~/connections:(id,first-name,last-name,picture-url)?start=0&count=' . CONNECTION_COUNT);
                        if ($response['success'] === TRUE) {
                            $connections = new SimpleXMLElement($response['linkedin']);
                            if ((int) $connections['total'] > 0) {
                                $i = 0;
                                // echo "<pre>";print_r($connections->person);exit;
                                foreach ($connections->person as $connection) {

                                    $list[$i]['first_name'] = $connection->{'first-name'};
                                    $list[$i]['last_name'] = $connection->{'last-name'};
                                    $list[$i]['friend_uid'] = $connection->id;

                                    if ($connection->{'picture-url'}) {
                                        $list[$i]['friend_image'] = $connection->{'picture-url'};
                                    } else {
                                        $list[$i]['friend_image'] = "";
                                    }
                                    $condition = Yii::app()->db->createCommand()
                                            ->select('*')
                                            ->from('int_friends')
                                            ->where('uniq_id=:id', array(':id' => $list[$i]['friend_uid']))
                                            ->queryRow();

                                    if (!$condition) {

                                        //insert friends in database
                                        $user = Yii::app()->db->createCommand()
                                                ->insert("int_friends", array(
                                            "user_id" => Yii::app()->user->id, //dynamically change this
                                            "firstname" => $list[$i]['first_name'],
                                            "lastname" => $list[$i]['last_name'],
                                            "uniq_id" => $list[$i]['friend_uid'],
                                            "email" => $list[$i]['friend_uid'] . "@linkedin.com",
                                            "image_url" => $list[$i]['friend_image'],
                                            "network" => 'linkedin'));
                                        header("Location:" . Yii::app()->request->baseUrl . "/site/manageFriends");
                                    }
                                }
                            } else {
                                // no connections
                                echo '<div>You do not have any LinkedIn connections to display.</div>';
                            }
                        } else {
                            // request failed
                            echo "Error retrieving connections:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response) . "</pre>";
                        }


                        break;
                    }
            }
        } catch (LinkedInException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact pageInt
     */
    public function actionManageFriends() {
        $criteria = new CDbCriteria();

        $criteria->condition = 'user_id=' . Yii::app()->user->id;
        $criteria->order = "firstname ASC";

        if (isset($_GET['q'])) {
            $q = $_GET['q'];
            $criteria->addSearchCondition('firstname', $q, true);
            $criteria->addSearchCondition('lastname', $q, true, 'OR');
            $criteria->addSearchCondition('email', $q, true, 'OR');
        }
        $dataProvider = new CActiveDataProvider('IntFriends', array(
                    'pagination' => array(
                        'pageSize' => Yii::app()->params['pageSize'],
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('manageFriends', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm("User");

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->baseUrl . "/site/manageFriends");
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        //echo "exit;";exit;
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionAcceptInvitation() {
        if (isset($_GET['request_ids'])) {
            $model = "Invitation accepted From facebook";
        } else {
            $model = "Invitation accepted From LinkedIn";
        }
        $this->render("acceptInvitation", array("message" => $model));
    }

    public function actionRegistration() {
        $model = new IntLogin;
        $model->scenario = 'registration';
        // uncomment the following code to enable ajax-based validation
        /*
          if(isset($_POST['ajax']) && $_POST['ajax']==='int-login-registration-form')
          {
          echo CActiveForm::validate($model);
          Yii::app()->end();
          }
         */

        if (isset($_POST['IntLogin'])) {

            $model->attributes = $_POST['IntLogin'];
            if ($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('success', "Registered Successfully");
                //header("Location:".Yii::app()->baseUrl."/site")
            }
        }
        $this->render('registration', array('model' => $model));
    }

    public function actionChangePassword() {

        $model = new ChangePassword();


        //Uncomment the following line if AJAX validation is needed
        //  $this->performAjaxValidation($model);

        if (Yii::app()->user->id) {

            if (isset($_POST['ChangePassword'])) {


                $model->attributes = $_POST['ChangePassword'];
                if ($model->validate()) {


                    $store = IntLogin::model()->findbyPk(Yii::app()->user->id);

                    $store->password = $model->password;


                    if ($store->save()) {
                        Yii::app()->user->setFlash('changepassword', "New password is saved.");
                    } else {
                        print_r($store->getErrors());
                    }

                    $this->redirect(array("/site/changePassword"));
                    $this->refresh();
                }
            }

            $this->render('changePassword', array('model' => $model));
        } else {
            header("Location:" . Yii::app()->baseUrl);
        }
    }

    public function loadModel($id) {
        $model = IntLogin::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}