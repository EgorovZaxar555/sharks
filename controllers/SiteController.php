<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Article;
use app\models\Category;
use app\models\Comment;
use app\models\CommentForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $data = Article::getAll();
        $populars = Article::getPopular();
        $category = Category::getCategory();

        return $this->render('index', [
            'articles' => $data['articles'],
            'pages' => $data['pages'],
            'category' => $category,
            'populars' => $populars,
        ]);
    }


    public function actionCategory($id)
    {
        $query = Article::find()->where(['idCategory'=>$id]);
        $pages = new \yii\data\Pagination(['totalCount'=>$query->count(), 'pageSize'=>4]);
        $articles = $query->offset($pages->offset)->limit($pages->limit)->all();
        $populars = Article::getPopular();
        $category = Category::getCategory();
       
        return $this->render('index', [
            'pages' => $pages,
            'articles' => $articles,
            'category' => $category,
            'populars' => $populars,
        ]);
    }

    public function actionArticle($id)
    {
        $articles = Article::findOne($id);
        $comments = Comment::find()->where(['idArticle'=>$id])->all();
        $commentForm = new CommentForm();
        $category = Category::getCategory();
       
        return $this->render('article', [
            'articles' => $articles,
            'category' => $category,
            'comments' => $comments,
            'commentForm' => $commentForm,
        ]);
    }

    public function actionComment($id)
    {
        $model = new CommentForm();
        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if($model->saveComment($id))
            {
                return $this->redirect(['site/article','id'=>$id]);
            }
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionSidebar()
    {
        return $this->render('sidebar');
    }

    
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function getComments(){
        return $this->hasMany(Comment::className(), ['idArticle'=>'id']);
    }  
}
