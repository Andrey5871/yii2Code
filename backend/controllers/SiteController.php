<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
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
use yii\helpers\Url;
use yii\data\Pagination;


/**
 * Site controller
 */
class SiteController extends Controller
{
  public $ENCRYPTION_KEY = 'ab86d144e3f080b61c7c2e43';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {

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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
      $session = Yii::$app->session;

      $id = $session->get('userId');
      $usersInf = Users::findOne($id);
      $imgUsers = Imgusers::find()->where(['idUsers'=> $id])->one();


          $clients = Client::find()->orderBy('client_id DESC');
         $education = Education::find()->all();
         $city = City::find()->all();
         $educationtype = Educationtype::find()->all();
         $usersFrom = Users::find()->all();


         // подключаем класс Pagination, выводим по 10 пунктов на страницу
         $pages = new Pagination(['totalCount' => $clients->count(), 'pageSize' => 20]);
         // приводим параметры в ссылке к ЧПУ
         $pages->pageSizeParam = false;
         $models = $clients->offset($pages->offset)
             ->limit($pages->limit)
             ->all();





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
              'avatars' => $imgUsers,
              'usersFrom' => $usersFrom,
          ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
     // Авторизация
    public function actionLogin()
    {
        if($_GET["loginIn"] == "auth"){
          $email = strip_tags(trim($_POST['email']));
          $passw = strip_tags(trim($_POST['password']));
          $users = Users::find()->where(['email'=> $email])->one();
          // дешифрация пароля
                $c = base64_decode($users['password']);
                $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
                $iv = substr($c, 0, $ivlen);
                $hmac = substr($c, $ivlen, $sha2len=32);
                $ciphertext_raw = substr($c, $ivlen+$sha2len);
                $password = openssl_decrypt($ciphertext_raw, $cipher, $this->ENCRYPTION_KEY, $options=OPENSSL_RAW_DATA, $iv);
                $calcmac = hash_hmac('sha256', $ciphertext_raw, $this->ENCRYPTION_KEY, $as_binary=true);

          if($users == NULL){
            $action = "Пользователь не найден";
          }else if($users['groups'] == "1"){
              $action = "Этот пользователь не является администратором!";
          }else{
            if ($password == $passw) {
              $imgUsers = Imgusers::find()->where(['idUsers'=> $users['user_id']])->one();
                $session = Yii::$app->session;
                $session->open();
                $session->set('hash', $users['hashSession']);
                $session->set('nameUser', $users['name']);
                $session->set('userId', $users['user_id']);
                $session->set('img', $imgUsers['name']);
                $session->set('year', $users['brithDay']);
                $session->set('group', $users['groups']);
                $url = Url::to(['site/index']);
            }else{
               $action = "Неверный email или пароль";
            }

          }
        }

    return $this->render('login', [
        'action' => $action,
    ]);
    }

    /*выход*/
public function actionLogout(){
session_destroy();
return $this->redirect(['site/index']);
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
      $users->groups = 0;
      $users->updateTime = $dataThis;
      $users->save();

      $usersFind = Users::find()->where(['email'=> $email, 'password'=>$ciphertext])->one();
      $session = Yii::$app->session;
      $session->set('hash', $hashSession);
      $session->set('nameUser', $usersFind['name']);
      $session->set('year', $usersFind['brithDay']);
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
            $users->brithDay = $brithDay;
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
        $status = strip_tags(trim($_POST['status']));
        $orderSum = strip_tags(trim($_POST['orderSum']));
        $dataThis = date("Y-m-d H:i:s");
        //Магистр 14%
        //Бакалавр 12%
        $sumUsers;
        if ($typeEducation == 2) {
          $sumUsers = $orderSum/100*14;
        }else if($typeEducation == 1){
          $sumUsers = $orderSum/100*12;
        }else if($typeEducation == 3){
            $sumUsers = $orderSum/100*12;
        }


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
        $users->statusId = $status;
        $users->sumOrder = $orderSum;
        $users->sumUsers = $sumUsers;
        $users->updateTime = $dataThis;
        $users->save();

        $url = Url::to(['site/index']);

    }


    return $this->render('edit', [
            'client' => $findClient,
            'city' => $findCity,
            'education' => $findEducation,
            'educationType' => $findEducationType
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
                                $imgUsers->save();
                                $session = Yii::$app->session;
                                $session->set('img', $name);
                              }else{
                                $imgUsers= new Imgusers();
                                $imgUsers->name = $name;
                                $imgUsers->idUsers = $session->get("userId");
                                $imgUsers->save();
                                $session = Yii::$app->session;
                                $session->set('img', $name);
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

    public function actionUsers(){
        $users = Users::find()->where(['!=', 'groups', '0'])->orderBy('user_id DESC');
        $education = Education::find()->all();
        $city = City::find()->all();
       // подключаем класс Pagination, выводим по 10 пунктов на страницу
       $pages = new Pagination(['totalCount' => $users->count(), 'pageSize' => 10]);
       // приводим параметры в ссылке к ЧПУ
       $pages->pageSizeParam = false;
       $models = $users->offset($pages->offset)
           ->limit($pages->limit)
           ->all();

           $sumAgent = array();
           $sumResult = array();

           foreach ($models as $valueSum) {
              $clientsUsers = Client::find()->where(['user_id_add' => $valueSum['user_id']])->sum('sumUsers');
              $clientsOrder = Client::find()->where(['user_id_add' => $valueSum['user_id']])->sum('sumOrder');

              $sumAgent[] = array(
                'id' => $valueSum['user_id'],
                'sum' => $clientsUsers,
              );
              $sumResult[] = array(
                'id' => $valueSum['user_id'],
                'sum' => $clientsOrder,
              );
           }
          return $this->render('users', [
              'users' => $models,
              'city' => $city,
              'education' => $education,
              'pages' => $pages,
              'sumAgent' => $sumAgent,
              'sumResult' => $sumResult,
          ]);
    }

    public function actionUser(){
      $users = Users::findOne($_GET['idUser']);
      $clients = Client::find()->where(['user_id_add'=> $_GET['idUser']])->orderBy('client_id DESC');
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
      return $this->render('user', [
        'user' => $users,
        'clients' => $models,
        'pages' => $pages,
        'city' => $city,
        'education' => $education,
        'educationType' => $educationtype,
      ]);
    }

    public function actionNews(){
      $news = News::find()->orderBy('id DESC');
      $view = View::find()->all();
       // подключаем класс Pagination, выводим по 10 пунктов на страницу
       $pages = new Pagination(['totalCount' => $news->count(), 'pageSize' => 20]);
       // приводим параметры в ссылке к ЧПУ
       $pages->pageSizeParam = false;
       $models = $news->offset($pages->offset)
           ->limit($pages->limit)
           ->all();

           if ($_GET['delete'] == 'del') {
               $idNews = $_POST['id'];
               View::deleteAll(['idNews' => $idNews]);
               $findNews = News::findOne($idNews);
                $findNews->delete();
           }
      return $this->render('news', [
        'news' => $models,
        'pages' => $pages,
        'view' => $view,
      ]);
    }

    public function actionEditnews(){
          if ($_GET['editnews']) {
            $id = $_GET['editnews'];
            $findNews = News::findOne($id);
          }
            if($_GET['update'] == 'update'){
              $session = Yii::$app->session;
              $files = $_FILES['img'];
              $titile = strip_tags(trim($_POST['title']));
              $minDesc = strip_tags(trim($_POST['minDesc']));
              $description = strip_tags(trim($_POST['description']));
              $id = strip_tags(trim($_POST['id']));
              $dataThis = date("Y-m-d H:i:s");
              $stringName = $this->generateRandomString();
              $name = $stringName.$session->get("hash").$_FILES['img']['name'].".jpg";
              $uploadfile = Yii::getAlias('@common')."/img/".$name;
              $news = News::find()->where(['id'=> $id])->one();
              if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile)) {
                    //Загрузилась картинка
                    if (count($files) < 1) {
                      //Если изображение пользователь не отправил
                    }else{

                      if ($news['img'] == "") {
                        //если изображения нет
                      }else{
                          unlink(Yii::getAlias('@common')."/img/".$news['img']);
                      }

                    }
                          $news->title = $titile;
                          $news->minDesc = $minDesc;
                          $news->description = $description;
                          $news->description = $description;
                          $news->dateUpdate = $dataThis;
                          $news->idUser = $session->get("userId");
                          $news->img = $name;
                          $news->save();
            } else {
                  //Картинка не загрузилась
                  $news->title = $titile;
                  $news->minDesc = $minDesc;
                  $news->description = $description;
                  $news->description = $description;
                  $news->dateUpdate = $dataThis;
                  $news->idUser = $session->get("userId");
                  $news->save();
            }

            }
      return $this->render('editnews', [
            'news' => $findNews
      ]);
    }

    public function actionAddnews(){

      if($_GET['add'] == 'add'){
        $session = Yii::$app->session;
        $files = $_FILES['img'];
        $titile = strip_tags(trim($_POST['title']));
        $minDesc = strip_tags(trim($_POST['minDesc']));
        $description = strip_tags(trim($_POST['description']));
        $dataThis = date("Y-m-d H:i:s");
        $stringName = $this->generateRandomString();
        $name = $stringName.$session->get("hash").$_FILES['img']['name'].".jpg";
        $uploadfile = Yii::getAlias('@common')."/img/".$name;
        $news = new News();

        if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile)) {

                    $news->title = $titile;
                    $news->minDesc = $minDesc;
                    $news->description = $description;
                    $news->dateCreate = $dataThis;
                    $news->dateUpdate = $dataThis;
                    $news->idUser = $session->get("userId");
                    $news->img = $name;
                    $news->save();

      } else {
            //Картинка не загрузилась
            $news->title = $titile;
            $news->minDesc = $minDesc;
            $news->description = $description;
            $news->dateUpdate = $dataThis;
            $news->dateCreate = $dataThis;
            $news->idUser = $session->get("userId");
            $news->save();
      }

      }
        return $this->render('addnews', [
            'news' => $news
        ]);
    }

}
