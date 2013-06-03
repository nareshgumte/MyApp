<?php

class CommonController extends Controller {

    public function actionSendFbInvitation() {
        $this->layout='emptyLayout';
        $this->render('sendFbInvitation');
    }

}