<?php

class RegisterController extends Controller
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
                'class'=>'CViewAction',
            ),
        );
    }


    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex($id)
    {
        $model=new Users();
        $model->id_radiostation=$id;
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
    $settings=Radistations::model()->findbyPk($id);
        if($settings){
            if($settings->radiostationSettings->not_use_music_marker)
                $this->viewregister($settings);
        }
       else{
           $error=Yii::t('radio','404 ERROR');
           $this->render('error', $error);
       }


    }
    public function viewregister($settings){
        if($settings->radiostationSettings->id_card_registration){


        }
        else{


        }
    }
    public function actionIdcard(){
        Yii::import('application.extension.auuth_sample.*');
        Yii::import("ext.auuth_sample.include.*");
        Yii::import("ext.auuth_sample.config.");

//Base_DigiDoc::load_WSDL();
$dd = new Base_DigiDoc();

session_start();
$stage="";
$tel_no=$_GET["telno"];

$lang=$_GET["lang"];
if ($lang=="")
    $lang="EST";

$tel_no = trim($tel_no, "+");

if ($tel_no!="") {


    if (substr($tel_no,0,2)!="37") {
        $tel_no="372".$tel_no;
    }

    $dd->WSDL->__options['trace']=1;
    $result=$dd->WSDL->MobileAuthenticate("", "", $tel_no, $lang, "Testimine", "", "00000000000000000000","asynchClientServer", NULL, true, FALSE);
    //print_r($result);
    /*
        echo "MobileAuthenticate request";
        print_r($dd->WSDL->__last_request);

        echo "MobileAuthenticate response";
        print_r($dd->WSDL->__last_response);
    */

    if (
        (isset($result) && is_object($result) && is_a($result, 'SOAP_Fault'))
        ||
        !isset($result["Status"])
    )
    {
        switch ($result->backtrace[0]["args"][0]) {
            case 201:
                $errormsg = "Phone number is not registered in the service!";
                break;

            case 301:
                $errormsg = "Phone number is not registered in the service!";
                break;

            case 302:
                $errormsg = "User certificate is revoked or suspended!. <br>To use Mobile-ID, please turn to your mobile service provider!";
                break;

            case 303:
                $errormsg = "Mobiil-ID is not activated. To activate, follow URL <A HREF=\"http://mobiil.id.ee/akt/\">mobiil.id.ee/akt</A>.";
                break;


        }
        $stage="error";
    }
    else if ($result["Status"]=="OK") {
        $sid=intval($result["Sesscode"]);
        $_SESSION["ChallengeID"]=$result["ChallengeID"];
        $_SESSION["UserIDCode"]=$result["UserIDCode"];
        $_SESSION["UserGivenname"]=$result["UserGivenname"];
        $_SESSION["UserSurname"]=$result["UserSurname"];
        $_SESSION["UserCountry"]=$result["UserCountry"];
        $stage="progress";
    } else if (isset($result["Status"]) && $result["Status"]=="NOT_VALID") {
        $errormsg = "Authentication failed, user certificate is not valid!";
        $stage="error";
    }
} else {
    if ($_GET["sid"]!="") {
        $sid=intval($_GET["sid"]);
        $dd->WSDL->__options['trace']=1;
        $result=$dd->WSDL->GetMobileAuthenticateStatus($sid, false);

        /*
            echo "GetMobileAuthenticateStatus request";
            print_r($dd->WSDL->__last_request);

            echo "GetMobileAuthenticateStatus response";
            print_r($dd->WSDL->__last_response);
        */
        if (strlen($result["Status"])>3) {
            $status=$result["Status"];
        } else if (!isset($result["Status"]))
            $status=$result->backtrace[0]["args"][0];
        else
            $status=$result;

        switch ($status) {
            case "USER_AUTHENTICATED":
//				$data=base64_decode($result["Signature"]);
//				die(bin2hex($data));
                $stage="authenticated";
                break;

            case "EXPIRED_TRANSACTION":
                $errormsg = "Timeout reached!";
                $stage="error";
                break;

            case "INTERNAL_ERROR":
                $errormsg = "Authentication failed: technical error!";
                $stage="error";
                break;

            case "NOT_VALID":
                $errormsg = "Authentication failed: generated signature is not valid!";
                $stage="error";
                break;

            case "USER_CANCEL":
                $errormsg = "User canceled!";
                $stage="error";
                break;

            case "MID_NOT_READY":
                $errormsg = "Mobile-ID functionality is not ready yet, please try again after awhile!";
                $stage="error";
                break;

            case "SIM_ERROR":
                $errormsg = "SIM error!";
                $stage="error";
                break;

            case "PHONE_ABSENT":
                $errormsg = "Phone is not in coverage area!";
                $stage="error";
                break;

            case "SENDING_ERROR":
                $errormsg = "Sending error!";
                $stage="error";
                break;

            default:
                $stage="progress";
                break;
        }
    }
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>Mobile-ID authentication sample application</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="PRAGMA" content="NO-CACHE">
    <link href="style/main.css" rel="stylesheet" type="text/css">
</head>
<body background="gfx/back.gif" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="760" border="0" align="center" cellpadding="0" cellspacing="0">
    <?
    switch ($stage) {
    case "progress":
?>
                            Sending authentication request to phone �
                            <p>
                            Verification code: <b><?=$_SESSION["ChallengeID"]?></b>
                            <p>
                            Check verification code and enter Mobile-ID PIN1 on your phone.
                            <p>
                            <input type="button" value="Cancel" onclick="javascript:window.location='<?="http://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']?>'" class="button">
                            <form method="post" action="?sid=<?=$sid?>">
                            </form>
                            </center>
                            <script language="javascript">
                                setTimeout('window.location="/auth_sample/?sid=<?=$sid?>"', 5000);
                            </script>
<?
    break;

    case "authenticated":
        ?>
        <TABLE border=0 id="kasutaja">
            <TR>
                <TD colspan=2 width="250px">
                    <b>
                        Done!<p>
                            Now I know who you are:<br></b>
                </TD>
            </TR>
            <TR>
                <TD>First name:</TD>
                <TD><?=$_SESSION["UserGivenname"]?></TD>
            </TR>
            <TR>
                <TD>Last name:</TD>
                <TD><?=$_SESSION["UserSurname"]?></TD>
            </TR>
            <TR>
                <TD>Id-code:</TD>
                <TD><?=$_SESSION["UserIDCode"]?></TD>
            </TR>
            <TR>
                <TD>Country:</TD>
                <TD><?=$_SESSION["UserCountry"]?></TD>
            </TR>
        </TABLE>


        <?
        echo '<p><A HREF="' . "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] . '">Let\'s do it again</A>';
        session_unset();
        break;

    case "error":
        echo ($errormsg?$errormsg:'User authentication failed!');
        $starturl = "http://" . $_SERVER['SERVER_NAME'] . "/" . $_SERVER['PHP_SELF'];
        echo '<p><A HREF="' . "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] . '">Try again</A>';
        break;
    default:

    ?>
    <form method="GET" action="">
        <TABLE border=0 id="kasutaja">
            <TR>
                <TD>
                    Language:
                </TD>
                <TD>
                    <SELECT NAME="lang">
                        <OPTION VALUE="EST" SELECTED>Estonian</OPTION>
                        <OPTION VALUE="ENG">English</OPTION>
                        <OPTION VALUE="RUS">Russian</OPTION>
                    </SELECT>
                </TD>
            </TR>
            <TR>
                <TD>
                    Phone number:
                </TD>
                <TD>
                    <INPUT TYPE="text" NAME="telno" size="15">
                </TD>
            </TR>
            <TR>
                <TD colspan=2>
                    <input type="submit" value="Enter with Mobile-ID" class="button">
                </TD>
            </TR>
        </TABLE>
    </form>

    <p>

        <?
        break;
        }
        ?>
        </form>
        </span></div></div>
    <div align="center"><a href="./source.tar.gz" target="_blank">Download</a> source code</div>
</body>
</html>





<?php

        $this->render('login');
    }
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }




}