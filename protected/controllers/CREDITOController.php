<?php

class CREDITOController extends Controller {

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
            CHtml::error($model, $e->getMessage());
            throw new CHttpException(500, 'No tiene permisos para realizar esta acción.');
            throw new CHttpException(500, $e->getMessage());
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        try {
            $model = new CREDITO;


            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['CREDITO'])) {
                $model->attributes = $_POST['CREDITO'];
                $next = $this->__getValor('seq_credito.nextval');
                $model->K_ID_CREDITO = $next;

                if ($model->save()) {
                    $this->__createPlanPagos($model->K_ID_CREDITO);
                    $this->redirect(array('planpagos/admin', 'id' => $model->K_ID_CREDITO));
                }
            }


            $this->render('create', array(
                'model' => $model,
            ));
        } catch (Exception $e) {
            //var_dump($e);
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

            if (isset($_POST['CREDITO'])) {
                $model->attributes = $_POST['CREDITO'];
                if ($model->save())
                    $this->redirect(array('view', 'id' => $model->K_ID_CREDITO));
            }

            $this->render('update', array(
                'model' => $model,
            ));
        } catch (Exception $e) {
            throw new CHttpException(500, 'No tiene permisos para realizar esta acción.');
            throw new CHttpException(500, $e->getMessage());
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
            throw new CHttpException(500, $e->getMessage());
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        try {
            $dataProvider = new CActiveDataProvider('CREDITO');
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        } catch (Exception $e) {
            //throw new CHttpException(500, 'No tiene permisos para realizar esta acción.');
            throw new CHttpException(500, $e->getMessage());
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        try {
            $model = new CREDITO('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['CREDITO']))
                $model->attributes = $_GET['CREDITO'];

            $this->render('admin', array(
                'model' => $model,
            ));
        } catch (Exception $e) {
            throw new CHttpException(500, $e->getMessage());
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return CREDITO the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        try {
            $model = CREDITO::model()->findByPk($id);
            if ($model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
            return $model;
        } catch (Exception $e) {
            throw new CHttpException(500, 'No tiene permisos para realizar esta acción.');
            throw new CHttpException(500, $e->getMessage());
        }
    }

    /**
     * Performs the AJAX validation.
     * @param CREDITO $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        try {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'credito-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        } catch (Exception $e) {
            throw new CHttpException(500, 'No tiene permisos para realizar esta acción.');
            throw new CHttpException(500, $e->getMessage());
        }
    }
    private function __getValor($seq_name) {
        $list = Yii::app()->db->createCommand('select ' . $seq_name . ' from dual')->queryAll();
        return $list[0]["NEXTVAL"];
    }
    private function __createPlanPagos($idCredito){
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
