<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;
use app\models\Users;
use app\models\City;
use app\models\Country;
use app\models\Region;
use app\models\Education;
use app\models\Client;
use app\models\Educationtype;
use app\models\Imgusers;
use app\models\News;
use app\models\View;

/**
 * Site controller
 */
class CabinetController extends Controller
{

  public $ENCRYPTION_KEY = 'ab86d144e3f080b61c7c2e43';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [];
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
     * @return mixed
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;

        $id = $session->get('userId');
        $usersInf = Users::findOne($id);
        $imgUsers = Imgusers::find()->where(['idUsers'=> $id])->one();


          $clients = Client::find()->where(['user_id_add'=> $session->get('userId')])->orderBy('client_id DESC');
           $education = Education::find()->all();
           $city = City::find()->all();
           $educationtype = Educationtype::find()->all();


           // подключаем класс Pagination, выводим по 10 пунктов на страницу
           $pages = new Pagination(['totalCount' => $clients->count(), 'pageSize' => 20]);
           // приводим параметры в ссылке к ЧПУ
           $pages->pageSizeParam = false;
           $models = $clients->offset($pages->offset)
               ->limit($pages->limit)
               ->all();


               $idNews = News::find()->all();
               $idNewsAll = News::find()->count();
               $countNewsTotal;
               foreach ($idNews as $valueNews) {
                  $view = View::find()->where(['idNews' => $valueNews['id'], 'idUser'=> $id])->count();
                  $countNewsTotal += (int) $view;
               }
               $countNews = $idNewsAll - $countNewsTotal;
              Yii::$app->params['countNews'] = $countNews;

            if ($_GET['delete'] == 'del') {
                $idClient = $_POST['id'];
                $findClient = Client::findOne($idClient);
                 $findClient->delete();
            }


        return $this->render('index', [
                'clients' => $models,
                'pages' => $pages,
                'city' => $city,
                'education' => $education,
                'educationType' => $educationtype,
                'usersInf' => $usersInf,
                'idSort' => $_POST['idSort'],
                'avatars' => $imgUsers,
                'countNews' => $countNews,
            ]);
    }


    public function actionAdd(){

            if($_GET['search'] == 'city'){
            $nameCity = $_POST['nameCity'];
            $query = "SELECT * FROM city WHERE name LIKE '$nameCity%' ";
            $result = City::findBySql($query)->all();
            $region = Region::find()->all();
       }

       /*Если приходит запрос с вузами то ищем в таблице все вузы соответсвующие поиску*/
       if($_GET['search'] == 'education'){
            $nameEducation = $_POST['nameEducation'];
            $query = "SELECT * FROM education WHERE name LIKE '$nameEducation%' or subName LIKE '$nameEducation%'";
            $resultEducation = Education::findBySql($query)->all();
       }

        if ($_GET['add'] == 'clients') {
                $name = strip_tags(trim($_POST['name']));
                $surName = strip_tags(trim($_POST['surName']));
                $patronymic = strip_tags(trim($_POST['patronymic']));
                $brithDay = strip_tags(trim($_POST['brithDay']));
                $gender = strip_tags(trim($_POST['gender']));
                $idCity = strip_tags(trim($_POST['idCity']));
                $idEducation = strip_tags(trim($_POST['idEducation']));
                $levelEducation = strip_tags(trim($_POST['levelEducation']));
                $typeEducation = strip_tags(trim($_POST['typeEducation']));
                $email = strip_tags(trim($_POST['email']));
                $phone = strip_tags(trim($_POST['phone']));
                $idUsers = strip_tags(trim($_POST['idUsers']));
                $dataThis = date("Y-m-d H:i:s");


                $users = new Client();
                $users->name = $name;
                $users->surname = $surName;
                $users->patronymic = $patronymic;
                $users->brithDay = date("Y-m-d", strtotime($brithDay));
                $users->gender = $gender;
                $users->cityId = (int)$idCity;
                $users->educationTypeId = (int)$typeEducation;
                $users->nameEducationId = (int)$idEducation;
                $users->educationLevel = (int)$levelEducation;
                $users->email = $email;
                $users->phone = $phone;
                $users->user_id_add = (int)$idUsers;
                $users->statusId = 0;
                $users->sumOrder = 0;
                $users->sumUsers = 0;
                $users->createTime = $dataThis;
                $users->updateTime = $dataThis;
                $users->save();

                $url = Url::to(['cabinet/index']);

                $findUser = Users::findOne((int)$idUsers);
                $findType = Educationtype::findOne((int)$typeEducation);
                $findEducation = Education::findOne((int)$idEducation);
                $message;
                $message .= "<h1>".$findUser['name']." ".$findUser['surname']." ".$findUser['patronymic']." создал нового клиента</h1>";
                $message .= "<h4>Информация о клиенте:</h4>";
                $message .= "<p><strong>Имя: </strong>".$name."</p>";
                $message .= "<p><strong>Фамилия: </strong>".$surName."</p>";
                $message .= "<p><strong>Отчество: </strong>".$patronymic."</p>";
                $message .= "<p><strong>Номер телефона: </strong>".$phone."</p>";
                $message .= "<p><strong>Вид: </strong>".$findType['name']."</p>";
                $message .= "<p><strong>Учебное заведение: </strong>".$findEducation['name']."</p>";
                $message .= "<p><strong>Дата добавления: </strong>".date("d.m.Y H:i", strtotime($dataThis))."</p>";

                Yii::$app->mailer->compose()
                 ->setFrom('info@manufaktoring.com')
                 ->setTo('lead.manufaktoring@bk.ru')
                 ->setSubject('Клиенты торговых агентов')
                 ->setHtmlBody($message)
                 ->send();

            }


        return $this->render('add', [
                'cityArray' => $result,
                'regionArray' => $region,
                'educationArr' => $resultEducation,
                'url' => $url
                ]);
    }



        public function actionEdit(){
            if($_GET['edit']){
              $id = $_GET['edit'];
               $findClient = Client::findOne($id);
               $findCity = City::findOne($findClient['cityId']);
               $findEducation = Education::findOne($findClient['nameEducationId']);
               $findEducationType = Educationtype::findOne($findClient['educationTypeId']);

            }

            if ($_GET['update'] == "update") {
                $id = strip_tags(trim($_POST['id']));
                $name = strip_tags(trim($_POST['name']));
                $surName = strip_tags(trim($_POST['surName']));
                $patronymic = strip_tags(trim($_POST['patronymic']));
                $brithDay = strip_tags(trim($_POST['brithDay']));
                $gender = strip_tags(trim($_POST['gender']));
                $idCity = strip_tags(trim($_POST['idCity']));
                $idEducation = strip_tags(trim($_POST['idEducation']));
                $levelEducation = strip_tags(trim($_POST['levelEducation']));
                $typeEducation = strip_tags(trim($_POST['typeEducation']));

                $email = strip_tags(trim($_POST['email']));
                $phone = strip_tags(trim($_POST['phone']));
                $idUsers = strip_tags(trim($_POST['idUsers']));
                $dataThis = date("Y-m-d H:i:s");


                $users = Client::findOne($id);
                $users->name = $name;
                $users->surname = $surName;
                $users->patronymic = $patronymic;
                $users->brithDay = date("Y-m-d", strtotime($brithDay));
                $users->gender = $gender;
                $users->cityId = (int)$idCity;
                $users->educationTypeId = (int)$typeEducation;
                $users->nameEducationId = (int)$idEducation;
                $users->educationLevel = (int)$levelEducation;
                $users->email = $email;
                $users->phone = $phone;
                $users->user_id_add = (int)$idUsers;
                $users->statusId = 0;
                $users->sumOrder = 0;
                $users->sumUsers = 0;
                $users->updateTime = $dataThis;
                $users->save();

                $url = Url::to(['cabinet/index']);

            }


            return $this->render('edit', [
                    'client' => $findClient,
                    'city' => $findCity,
                    'education' => $findEducation,
                    'educationType' => $findEducationType
            ]);
        }



          public function actionEditprofile(){
            $session = Yii::$app->session;
            if($_GET['edit'] == "profile"){
              $id = $_POST['idUser'];
               $findClient = Users::findOne($id);
               $findCity = City::findOne($findClient['cityId']);
               $findEducation = Education::findOne($findClient['nameEducationId']);
               $findEducationType = Educationtype::findOne($findClient['educationTypeId']);
               // дешифрация пароля
                     $c = base64_decode($findClient['password']);
                     $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
                     $iv = substr($c, 0, $ivlen);
                     $hmac = substr($c, $ivlen, $sha2len=32);
                     $ciphertext_raw = substr($c, $ivlen+$sha2len);
                     $password = openssl_decrypt($ciphertext_raw, $cipher, $this->ENCRYPTION_KEY, $options=OPENSSL_RAW_DATA, $iv);
                     $calcmac = hash_hmac('sha256', $ciphertext_raw, $this->ENCRYPTION_KEY, $as_binary=true);
            }

            if ($_GET['update'] == "update") {
                $id = $session->get('userId');
                $name = strip_tags(trim($_POST['name']));
                $surName = strip_tags(trim($_POST['surName']));
                $patronymic = strip_tags(trim($_POST['patronymic']));
                $brithDay = strip_tags(trim($_POST['brithDay']));
                $gender = strip_tags(trim($_POST['gender']));
                $idCity = strip_tags(trim($_POST['idCity']));
                $idEducation = strip_tags(trim($_POST['idEducation']));
                $levelEducation = strip_tags(trim($_POST['levelEducation']));
                $typeEducation = strip_tags(trim($_POST['typeEducation']));
                $password = strip_tags(trim($_POST['password']));
                $email = strip_tags(trim($_POST['email']));
                $phone = strip_tags(trim($_POST['phone']));
                $hashSession = hash('md5', $name.$surName.$patronymic.$email);
                $dataThis = date("Y-m-d H:i:s");

                // Шифрование пароля
                $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
                $iv = openssl_random_pseudo_bytes($ivlen);
                $ciphertext_raw = openssl_encrypt($password, $cipher, $this->ENCRYPTION_KEY, $options=OPENSSL_RAW_DATA, $iv);
                $hmac = hash_hmac('sha256', $ciphertext_raw, $this->ENCRYPTION_KEY, $as_binary=true);
                $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );

                $usersEmail = Users::find()->where(['email' => $email])->andWhere(['!=', 'user_id', $id])->all();
                    if (count($usersEmail) > 0) {
                        $url = "errorEmail";
                    }else{
                $users = Users::findOne($id);
                $users->name = $name;
                $users->surname = $surName;
                $users->patronymic = $patronymic;
                $users->brithDay = date("Y-m-d", strtotime($brithDay));
                $users->gender = $gender;
                $users->cityId = (int)$idCity;
                $users->educationTypeId = (int)$typeEducation;
                $users->nameEducationId = (int)$idEducation;
                $users->educationLevel = (int)$levelEducation;
                $users->password = $ciphertext;
                $users->email = $email;
                $users->phone = $phone;
                $users->hashSession = $hashSession;
                $users->groups = 1;
                $users->updateTime = $dataThis;
                $users->save();

                $usersFind = Users::find()->where(['email'=> $email, 'password'=>$ciphertext])->one();
                //date in mm/dd/yyyy format; or it can be in other formats as well


                $session = Yii::$app->session;
                $session->set('hash', $hashSession);
                $session->set('year', date("Y-m-d", strtotime($brithDay)));
                $session->set('nameUser', $usersFind['name']);
                $session->set('userId', $usersFind['user_id']);
                    }

            }

            return $this->render('editprofile', [
              'user' => $findClient,
              'city' => $findCity,
              'psw' => $password,
              'education' => $findEducation,
              'educationType' => $findEducationType,
              'url' => $url,
            ]);
          }

            public function actionPhotoedit(){

              $session = Yii::$app->session;
                if ($_GET['upload'] == 'file') {
                    $files = $_FILES['avatar'];
                    $stringName = $this->generateRandomString();
                    $name = $stringName.$session->get("hash").$_FILES['avatar']['name'].".jpg";
                    $uploadfile = __DIR__."/../web/img/upload/".$name;
                    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile)) {
                          //Загрузилась картинка
                          $usersImg = Imgusers::find()->where(['idUsers' => $session->get("userId")])->all();
                              if (count($usersImg) > 0) {
                                foreach ($usersImg as $valueImg) {
                                  unlink(__DIR__."/../web/img/upload/".$valueImg['name']);
                                }

                                $imgUsers = Imgusers::find()->where(['idUsers'=> $session->get("userId")])->one();
                                $imgUsers->name = $name;
                                $imgUsers->idUsers = $session->get("userId");
                                $session->set('img', $imgUsers['name']);
                                $imgUsers->save();
                              }else{
                                $imgUsers= new Imgusers();
                                $imgUsers->name = $name;
                                $imgUsers->idUsers = $session->get("userId");
                                $session->set('img', $imgUsers['name']);
                                $imgUsers->save();
                              }
                  } else {
                        //Картинка не загрузилась
                  }
                }
              return $this->render('photoedit', [
                  'file' => $files
              ]);
            }

            public function generateRandomString($length = 50) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

      public function actionNews(){
        $session = Yii::$app->session;

        $id = $session->get('userId');
        $idNews = News::find()->all();
        $idNewsAll = News::find()->count();
        $countNewsTotal;
        foreach ($idNews as $valueNews) {
           $view = View::find()->where(['idNews' => $valueNews['id'], 'idUser'=> $id])->count();
           $countNewsTotal += (int) $view;
        }
        $countNews = $idNewsAll - $countNewsTotal;
       Yii::$app->params['countNews'] = $countNews;

            $news = News::find()->orderBy('id DESC');
           // подключаем класс Pagination, выводим по 10 пунктов на страницу
           $pages = new Pagination(['totalCount' => $news->count(), 'pageSize' => 5]);
           // приводим параметры в ссылке к ЧПУ
           $pages->pageSizeParam = false;
           $models = $news->offset($pages->offset)
               ->limit($pages->limit)
               ->all();
        return $this->render('news', [
                'news' => $models,
                'pages' => $pages
        ]);
      }

      public function actionPost(){
        if ($_GET['id']) {
           $session = Yii::$app->session;

           $id = $_GET['id'];
            $news = News::findOne($id);
            $newsLast = News::find()->where(['!=', 'id', $id])->orderBy('id DESC')->limit('3')->all();
            $viewFind = View::find()->where(['idNews' => $id])->andWhere(['idUser' => $session->get("userId")])->all();
            if(count($viewFind) < 1){
                $view = new View();
                $view->idUser = $session->get("userId");
                $view->idNews = $id;
                $view->dateView = date("Y-m-d H:i:s");
                $view->save();
            }


        }


        return $this->render('post', [
            'news' => $news,
            'newsLast' => $newsLast
        ]);
      }




}
