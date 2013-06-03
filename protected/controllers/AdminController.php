<?php

class AdminController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/admin_main';

    /**
     * Login
     */
    public function actionHome() {

        $this->render("index");
    }

    public function actionIndex() {
        $model = new LoginForm("Admin");

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
                $this->redirect(Yii::app()->homeUrl . "admin/users");
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'users', 'logout', 'ChangePassword', 'home'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new IntLogin;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['IntLogin'])) {
            $model->attributes = $_POST['IntLogin'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['IntLogin'])) {
            $model->attributes = $_POST['IntLogin'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionUsers() {
        $criteria = new CDbCriteria();

        $criteria->condition = "status='0'";
        $criteria->order = "firstname ASC";


        $dataProvider = new CActiveDataProvider('IntLogin', array(
                    'pagination' => array(
                        'pageSize' => Yii::app()->params['pageSize'],
                    ),
                    'criteria' => $criteria,
                ));
        $this->render('users', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {

        $model = new IntLogin('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['IntLogin']))
            $model->attributes = $_GET['IntLogin'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = IntLogin::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'int-login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionLogout() {
        //echo "exit;";exit;
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl . "admin");
    }

    public function actionChangePassword() {

        $model = new ChangePassword();


        //Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

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

                    $this->redirect(array("/admin/changePassword"));
                    $this->refresh();
                }
            }

            $this->render('changePassword', array('model' => $model));
        }
    }

}