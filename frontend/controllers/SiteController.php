<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
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
        return $this->render('index');
    }


        public function actionGlobaldata(){


                  if($_GET['search'] == 'region'){
            $nameCity = $_POST['nameCity'];
            $query = "SELECT * FROM region WHERE name LIKE '$nameCity%' ";
            $result = Region::findBySql($query)->all();
                  }


                if ($_GET['idRegion']) {
                  $region = strip_tags(trim($_POST['idReg']));
                  $findReg = Region::findOne($region);

                  //Сумма от продаж
                  $findCity = City::find()->where(["region_id" => $region])->all();

                  $finndCityNotNull = Client::find()->where(['!=', 'sumOrder', '0'])->sum('sumOrder');
                  $finndCityNotNullAgent = Client::find()->where(['!=', 'sumOrder', '0'])->sum('sumUsers');

                  //cards
                  $sumReg;
                  $sumRegionAllMag;
                  $sumRegionAllBak;
                  $sumRegionAllSpec;
                  $sumRegionAllGendM;
                  $sumRegionAllGendF;

                  $sumAgent;
                  $countAgetRes;

                    //table
                    $educId = array();


                    foreach ($findCity as $key => $valueFindCity) {
                      $findEduc = Education::find()->where(['cityId' => $valueFindCity['id']])->all();
                          foreach ($findEduc as $valueEduc) {
                            //cards
                            $sumRegionAll = Client::find()->where(['nameEducationId' => $valueEduc['id']])->sum('sumOrder');
                            $sumRegionAllMagistr = Client::find()->where(['nameEducationId' => $valueEduc['id'], 'educationTypeId' => '2'])->sum('sumOrder');
                            $sumRegionAllBakalavr = Client::find()->where(['nameEducationId' => $valueEduc['id'], 'educationTypeId' => '1'])->sum('sumOrder');
                            $sumRegionAllSpecialitet = Client::find()->where(['nameEducationId' => $valueEduc['id'], 'educationTypeId' => '3'])->sum('sumOrder');
                            $sumRegionAllGenderM = Client::find()->where(['nameEducationId' => $valueEduc['id'], 'gender' => 'Мужской'])->sum('sumOrder');
                            $sumRegionAllGenderF = Client::find()->where(['nameEducationId' => $valueEduc['id'], 'gender' => 'Женский'])->sum('sumOrder');


                            $sumReg += $sumRegionAll;
                            $sumRegionAllMag += $sumRegionAllMagistr;
                            $sumRegionAllBak += $sumRegionAllBakalavr;
                            $sumRegionAllSpec += $sumRegionAllSpecialitet;
                            $sumRegionAllGendM += $sumRegionAllGenderM;
                            $sumRegionAllGendF += $sumRegionAllGenderF;

                            $sumAgentAll = Client::find()->where(['nameEducationId' => $valueEduc['id']])->sum('sumUsers');


                            $sumAgent += $sumAgentAll;

                            //table
                            $allClientsEducationId = Client::find()->select(['nameEducationId'])->where(['nameEducationId' => $valueEduc['id']])->orderBy('sumOrder DESC')->all();
                            foreach ($allClientsEducationId as  $valueIdEduc) {
                                  array_push($educId, $valueIdEduc['nameEducationId']);
                            }

                            $countAgent = Users::find()->where(['nameEducationId' => $valueEduc['id']])->count();
                            $countAgentRes += $countAgent;

                          }



                    }
                    $educName = array();
                    $educIdUniq = array_unique($educId);
                    $educationSum = array();
                    $sumMagistrTable = array();
                    $sumBakalavrTable = array();
                    $sumSpecialitetTable = array();
                    $agentsCountTable = array();
                    $sumStudentsTable = array();
                    $educAll;
                    foreach ($educIdUniq as $valueIdEduc) {
                      $allClientsEducationId = Client::find()->where(['nameEducationId' => $valueIdEduc])->sum('sumOrder');
                      $allClientsEducationIdStudent = Client::find()->where(['nameEducationId' => $valueIdEduc])->sum('sumUsers');
                      $sumMagistr = Client::find()->where(['nameEducationId' => $valueIdEduc, 'educationTypeId' => '2'])->sum('sumOrder');
                      $sumBakalavr = Client::find()->where(['nameEducationId' => $valueIdEduc, 'educationTypeId' => '1'])->sum('sumOrder');
                      $sumSpecialitet = Client::find()->where(['nameEducationId' => $valueIdEduc, 'educationTypeId' => '3'])->sum('sumOrder');
                      $allClientsEducationCount = Users::find()->where(['nameEducationId' => $valueIdEduc])->count();
                      $educationName = Education::findOne($valueIdEduc);

                      $agentsCountTable[] = array([
                        'id' => $valueIdEduc,
                        'count' => $allClientsEducationCount,
                        ]);

                        $educName[] = array([
                          'id' => $valueIdEduc,
                          'name' => $educationName['subName'],
                          ]);

                      $sumStudentsTable[] = array([
                        'id' => $valueIdEduc,
                        'sum' => $allClientsEducationIdStudent,
                        ]);


                      $sumMagistrTable[] = array([
                        'id' => $valueIdEduc,
                        'sum' => $sumMagistr,
                        ]);
                        $sumBakalavrTable[] = array([
                          'id' => $valueIdEduc,
                          'sum' => $sumBakalavr,
                          ]);
                          $sumSpecialitetTable[] = array([
                            'id' => $valueIdEduc,
                            'sum' => $sumSpecialitet,
                            ]);
                      $educationSum[] = array([
                        'id' => $valueIdEduc,
                        'sum' => $allClientsEducationId,
                        ]);
                        $educAll += $allClientsEducationId;
                    }



                    $sumProcentResult = round(($sumReg * 100)/$finndCityNotNull, 2);
                    $sumProcentResultAgent = round(($sumAgent * 100)/$finndCityNotNullAgent, 2);



                }

            return $this->render('globaldata', [
                    'region' => $findReg,
                    'findCity' => $findCity,
                    'findEduc' => $findEduc,
                    'finndCityNotNullTable' => $finndCityNotNullTable,
                    'educName' => $educName,
                    'sumReg' => $sumReg,
                    'sumRegionAllMag' => $sumRegionAllMag,
                    'sumRegionAllBak' => $sumRegionAllBak,
                    'sumRegionAllSpec' => $sumRegionAllSpec,
                    'sumRegionAllGendM' => $sumRegionAllGendM,
                    'sumRegionAllGendF' => $sumRegionAllGendF,
                    'cityProcent' => $sumProcentResult,
                    'agentSum' => $sumAgent,
                    'agentProcent' => $sumProcentResultAgent,
                    'countAgent' => $countAgentRes,
                    //table
                    'educId' => $educIdUniq,
                    'educSum' => $educationSum,
                    'educSumResult' => $educAll,
                    'sumMagistrTable' => $sumMagistrTable,
                    'sumBakalavrTable' => $sumBakalavrTable,
                    'sumSpecialitetTable' => $sumSpecialitetTable,
                    'agentsCountTable' => $agentsCountTable,
                    'sumStudentsTable' => $sumStudentsTable,
                    'cityArray' => $result,
              ]);
        }

        public function actionMoney1100(){
                   /*Если приходит запрос с вузами то ищем в таблице все вузы соответсвующие поиску*/
       if($_GET['search'] == 'education'){
            $nameEducation = $_POST['nameEducation'];
            $query = "SELECT * FROM education WHERE name LIKE '$nameEducation%' or subName LIKE '$nameEducation%'";
            $resultEducation = Education::findBySql($query)->all();
       }
       if ($_GET['request'] == 'request') {
            $phone = strip_tags(trim($_POST['phone']));
            $numberCards = strip_tags(trim($_POST['numberCards']));
           $explUniver = explode(',', strip_tags(trim($_POST['univers'])));
           $explEconomy = explode(',', strip_tags(trim($_POST['economy'])));
           $explImage = explode(',', $_POST['images']);
           $message;
           $message .= "<p><b>Номер телефона:</b> ".$phone."</p>";
           $message .= "<p><b>Номер денежного договора:</b> ".$numberCards."</p>";
           $message .= "<hr>";
            $message .= "<h3>Учебные заведения:</h3>";
           foreach ($explUniver as $key => $valueUniver) {
                $message .= "<p><b>Название учебного заведения:</b> ".$valueUniver."</p>";
                $message .= "<p><b>Экономическое направление:</b> ".$explEconomy[$key]."</p>";
                $message .= "<hr>";
           }

           $message .= "<h3>Прилагаемые ссылки или изображения:</h3>";
            foreach ($explImage as $valueImg) {

                if ($valueImg == "[object File]" || $valueImg == "[object FormData]") {
                    foreach ($_FILES as $valueFiles) {
                        $name = $valueFiles['name'].".jpg";
                        $uploadfile = Yii::getAlias('@common')."/img/mail/".$name;
                        if (move_uploaded_file($valueFiles['tmp_name'], $uploadfile)) {
                                $href = "http://".$_SERVER['HTTP_HOST'].".ru/common/img/mail/".$name;
                                $message .="<a href='".$href."'><img style='width:500px' src='".$href."'></a><br>";
                                $message .= "<hr>";
                        }
                    }

                }else{
                    $message .=  "<b>Ссылка на расписание: </b>".$valueImg."<br>";
                    $message .= "<hr>";
                }
            }

        Yii::$app->mailer->compose()
             ->setFrom('info@manufaktoring.com')
             ->setTo('lead.manufaktoring@bk.ru')
             ->setSubject('Страница 2200')
             ->setHtmlBody($message)
             ->send();
         }

            return $this->render('money1100', [
                    'educationArr' => $resultEducation,
            ]);
        }
        public function actionMoney2200(){

            if ($_GET['request'] == 'request') {
            $name = strip_tags(trim($_POST['name']));
            $phone = strip_tags(trim($_POST['phone']));
            $city = strip_tags(trim($_POST['city']));
            $time = strip_tags(trim($_POST['time']));



            $message;
            $message .= "<h1>Связаться по телефону</h1>";
            $message .= "<p><b>Имя:</b> ".$name."</p>";
            $message .= "<p><b>Телефон:</b> ".$phone."</p>";
            $message .= "<p><b>Город:</b> ".$city."</p>";
            $message .= "<p><b>Время:</b> ".$time."</p>";

            Yii::$app->mailer->compose()
             ->setFrom('info@manufaktoring.com')
             ->setTo('lead.manufaktoring@bk.ru')
             ->setSubject('Страница 1100')
             ->setHtmlBody($message)
             ->send();
            }

            return $this->render('money2200');
        }
        public function actionSalesoffer(){
            return $this->render('salesoffer');
        }

        /*Регистрация*/
    public function actionReg()
    {

            /*Если приходит запрос с городами то ищем в таблице все города соответсвующие поиску*/
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


            if ($_GET['reg'] == 'auth') {
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


                $usersEmail = Users::find()->where(['email' => $email])->all();

                    if (count($usersEmail) > 0) {
                        $url = "errorEmail";
                    }else{
                $users = new Users();
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
                $users->createTime = $dataThis;
                $users->updateTime = $dataThis;
                $users->save();

                $usersFind = Users::find()->where(['email'=> $email, 'password'=>$ciphertext])->one();
                $session = Yii::$app->session;
                $session->open();
                $session->set('hash', $hashSession);
                $session->set('nameUser', $usersFind['name']);
                $session->set('userId', $usersFind['user_id']);
                $session->set('img', $imgUsers['name']);
                $session->set('year', $users['brithDay']);
                $url = Url::to(['site/index']);

                $message;
                $message .= "<h1>Зарегистрирован новый торговый агент</h1>";
                $message .= "<p><strong>Имя: </strong> ".$name."</p>";
                $message .= "<p><strong>Фамилия: </strong> ".$surName."</p>";
                $message .= "<p><strong>Отчество: </strong> ".$patronymic."</p>";
                $message .= "<p><strong>Телефон: </strong> ".$phone."</p>";
                $message .= "<p><strong>Email: </strong> ".$email."</p>";
                Yii::$app->mailer->compose()
                 ->setFrom('info@manufaktoring.com')
                 ->setTo('lead.manufaktoring@bk.ru')
                 ->setSubject('Страница регистрации')
                 ->setHtmlBody($message)
                 ->send();
                    }
            }

            return $this->render('reg', [
                'cityArray' => $result,
                'regionArray' => $region,
                'educationArr' => $resultEducation,
                'url' => $url
            ]);

    }

            /*выход*/
    public function actionLogout(){
      $session = Yii::$app->session;
      // уничтожаем сессию и все связанные с ней данные.
      Yii::$app->session->destroy();
      Yii::$app->session->remove('hash');
      $session->destroy();
      session_destroy();
        return $this->redirect(['site/index']);
    }

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
          }else{
            if ($password == $passw) {
                $session = Yii::$app->session;
                //date in mm/dd/yyyy format; or it can be in other formats as well
                $birthDate = $users['brithDay'];
                //explode the date to get month, day and year
                $birthDate = explode("-", $birthDate);
                //get age from date or birthdate
                $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                  ? ((date("Y") - $birthDate[2]) - 1)
                  : (date("Y") - $birthDate[2]));

                $session->open();
                $imgUsers = Imgusers::find()->where(['idUsers'=> $users['user_id']])->one();
                $session->set('hash', $users['hashSession']);
                $session->set('nameUser', $users['name']);
                $session->set('userId', $users['user_id']);
                $session->set('img', $imgUsers['name']);
                $session->set('year', $age);
                $url = Url::to(['site/index']);
                return $this->redirect(['cabinet/index']);
            }else{
               $action = "Неверный email или пароль";
            }

          }
        }

        if ($_GET['forgoutPsw'] == 'forgoutPsw') {
          $email = strip_tags(trim($_POST['email']));
          $usersEmail = Users::find()->where(['email' => $email])->all();
          if (count($usersEmail) > 0) {
            $c = base64_decode($usersEmail[0]['password']);
            $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
            $iv = substr($c, 0, $ivlen);
            $hmac = substr($c, $ivlen, $sha2len=32);
            $ciphertext_raw = substr($c, $ivlen+$sha2len);
            $password = openssl_decrypt($ciphertext_raw, $cipher, $this->ENCRYPTION_KEY, $options=OPENSSL_RAW_DATA, $iv);
            $calcmac = hash_hmac('sha256', $ciphertext_raw, $this->ENCRYPTION_KEY, $as_binary=true);
            $linkLs = "http://".$_SERVER['HTTP_HOST']."/login";
            $message;
            $message .= "<h2>".$usersEmail[0]['name']." ".$usersEmail[0]['patronymic'].", Ваш пароль для входа в личный кабинет</h2>";
            $message .= "<p><strong>Пароль: </strong>".$password."</p>";
            $message .= "<p><a href='".$linkLs."'>Перейти в линый кабинет</a></p>";

            Yii::$app->mailer->compose()
             ->setFrom('info@manufaktoring.com')
             ->setTo($usersEmail[0]['email'])
             ->setSubject('Восстановление пароля Мануфакторинг.рф')
             ->setHtmlBody($message)
             ->send();

            $action = "emailSuccess";
          }else{
            $action = "emailError";
          }
        }

    return $this->render('login', [
        'action' => $action,
    ]);
    }


    public function actionPolicy(){
      return $this->render('policy');
    }


}
