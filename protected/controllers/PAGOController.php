<?php

class PAGOController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
                'actions' => array('create', 'update', 'admin', 'delete'),
                'users' => array('@'),
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
        try {
            $this->render('view', array(
                'model' => $this->loadModel($id),
            ));
        } catch (Exception $e) {
            throw new CHttpException(500, 'No tiene permisos para realizar esta acción.');
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        try {
            $model = new PAGO;
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            if (isset($_POST['PAGO'])) {
                $variables=$_POST['PAGO'];
                $model->attributes = $_POST['PAGO'];
                $model->F_PAGO=$variables["F_PAGO"];
                if ($model->save())
                    $this->redirect(array('view', 'id' => $model->K_NUMCONSIGNACION));
                
            }
            $this->render('create', array(
                'model' => $model,
            ));
        } catch (Exception $e) {
            throw new CHttpException(500, $e->getMessage());
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        try {
            $model = $this->loadModel($id);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['PAGO'])) {
                $model->attributes = $_POST['PAGO'];
                if ($model->save())
                    $this->redirect(array('view', 'id' => $model->K_NUMCONSIGNACION));
            }

            $this->render('update', array(
                'model' => $model,
            ));
        } catch (Exception $e) {
            throw new CHttpException(500, 'No tiene permisos para realizar esta acción.');
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        try {
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } catch (Exception $e) {
            throw new CHttpException(500, 'No tiene permisos para realizar esta acción.');
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        try {
            $dataProvider = new CActiveDataProvider('PAGO');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        } catch (Exception $e) {
            throw new CHttpException(500, 'No tiene permisos para realizar esta acción.');
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        try {
            $model = new PAGO('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['PAGO']))
                $model->attributes = $_GET['PAGO'];

            $this->render('admin', array(
                'model' => $model,
            ));
        } catch (Exception $e) {
            //throw new CHttpException(500, 'No tiene permisos para realizar esta acción.');
            throw new CHttpException(500, $e->getMessage());
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return PAGO the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        try {
            $model = PAGO::model()->findByPk($id);
            if ($model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
            return $model;
        } catch (Exception $e) {
            throw new CHttpException(500, 'No tiene permisos para realizar esta acción.');
        }
    }

    /**
     * Performs the AJAX validation.
     * @param PAGO $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        try {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'pago-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        } catch (Exception $e) {
            throw new CHttpException(500, 'No tiene permisos para realizar esta acción.');
        }
    }

    private function __updateSaldoCredito($idCredito){
        $command = Yii::app()->db->createCommand('
                            DECLARE
                            P_K_ID_CREDITO CREDITO.K_ID_CREDITO%TYPE:='.$idCredito.';
                            begin
                            pk_creditos.PR_CREAR_PLANPAGOS(P_K_ID_CREDITO);
                            end;         
                    ');
        $command->execute();
    }
}
