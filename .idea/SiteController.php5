namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\User;
use app\models\Request;

class SiteController extends Controller
{
public function actionIndex()
{
$users = User::find()->all();
return $this->render('index', ['users' => $users]);
}

public function actionRequest()
{
$model = new Request();
if ($model->load(Yii::$app->request->post()) && $model->save()) {
Yii::$app->session->setFlash('success', 'Request submitted successfully!');
return $this->redirect(['site/index']);
}
$users = User::find()->all();
return $this->render('request', ['model' => $model, 'users' => $users]);
}

public function actionUser($alias)
{
$user = User::find()->where(['alias' => $alias])->one();
$model = new Request();
if ($model->load(Yii::$app->request->post()) && $model->save()) {
Yii::$app->session->setFlash('success', 'Request submitted successfully!');
return $this->redirect(['site/user', 'alias' => $alias]);
}
return $this->render('user', ['user' => $user, 'model' => $model]);
}

public function actionLoadUser($id)
{
Yii::$app->response->format = Response::FORMAT_JSON;
$user = User::findOne($id);
if (!$user) {
throw new NotFoundHttpException('User not found.');
}
return [
'success' => true,
'data' => [
'name' => $user->name,
'email' => $user->email,
// add more fields as needed
]
];
}
}

