<?php

namespace app\controllers;

use Yii;
use app\models\Model;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

/**
 * TestController implements the CRUD actions for Model model.
 */
class TestController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['get', 'post', 'delete', 'put'],
                ],
            ],
        ];
    }

    /**
     * Lists all Model models.
     * @return mixed
     */
    public function actionIndex()
    {
		print_r(Yii::$app->request->get());
		print_r(Yii::$app->request->post());
		$query = new Query;
		$orders = $query->select('order_id, COUNT(*) as amount')->from('table')->groupBy('order_id');
		
		//print_r($orders);

        $dataProvider = new ActiveDataProvider([
            'query' => $orders,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Model model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$dataProvider = new ActiveDataProvider([
            'query' => Model::find()->where(['order_id' => $id]),
        ]);

        return $this->render('view', [
			'order_id' => $id,
            'models' => $dataProvider
        ]);
    }

    /**
     * Creates a new Model model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $models[] = new Model();

		if (Yii::$app->request->getMethod() == 'POST') {
			$query = new Query;
			$order = $query->select('max(order_id) as max_order_id')->from('table')->one();

			$success = true;
			if ($order){
				$new_order_id = $order['max_order_id'] + 1;
				foreach(Yii::$app->request->post('Model') as $row) {
					$row['order_id'] = $new_order_id;
					$model = new Model();
					$success = $success && $model->load($row, '') && $model->save();
				}
			}
		
            return $this->redirect(['view', 'id' => $new_order_id]);
        } else {
            return $this->render('create', [
				'order_id' => 0,
                'models' => $models,
            ]);
        }
    }

    /**
     * Updates an existing Model model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $models = Model::find()->where(['order_id' => $id])->all();

		if (Yii::$app->request->getMethod() == 'POST') {
			$success = true;

			$update_data = [];
			foreach(Yii::$app->request->post('Model') as $row) {
				if (isset($row['id']))	
					$update_data[$row['id']] = $row;
				else {
					$model = new Model();
					$success = $success && $model->load($row, '') && $model->save();
				}
			}

			foreach($models as $model) {
				if (isset($update_data[$model->id]))
					$success = $success && $model->load($update_data[$model->id], '') && $model->save();
				else
					$model->delete();
			}
			
			return $this->redirect(['view', 'id' => $id]);
		} else {
            return $this->render('update', [
				'order_id' => $id,
                'models' => $models,
            ]);
        }
    }

    /**
     * Deletes an existing Model model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		Model::deleteAll('order_id = :order_id', [':order_id' => $id]);
		echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/>".$id;
        return $this->redirect(['index']);
    }

    /**
     * Finds the Model model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Model the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Model::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
