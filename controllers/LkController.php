<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Article;
use app\models\ArticleCreateForm;
use app\models\Category;
use app\models\ArticleSearch;
use app\models\RegForm;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * UserController implements the CRUD actions for User model.
 */
class LkController extends Controller
{

    public function beforeAction($action){
        if(Yii::$app->user->isGuest){
            $this->redirect(['site/login']);
            return false;
        }
        if(!parent::beforeAction($action)){
            return false;
        }
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->searchForUser(Yii::$app->request->queryParams, Yii::$app->user->identity->id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

   

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }






















     /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ArticleCreateForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->image = UploadedFile::getInstance($model, 'image');
            $newFileName = md5($model->image->baseName .'.'. $model->image->extension. time()) .'.'. $model->image->extension;
            $model->image->saveAs('@app/web/images/articles/' . $newFileName );
            $model->image = $newFileName;
            $model->idUser = Yii::$app->user->identity->id;
            $model->save();
            return $this->redirect(['/lk']);
        }
        $model->date = date('Y-m-d H:i:s');
        $category = Category::find()->all();
        $category = ArrayHelper::map($category, 'id', 'name');
        return $this->render('create', [
            'model' => $model,
            'category' => $category,
        ]);
    }

   
}
