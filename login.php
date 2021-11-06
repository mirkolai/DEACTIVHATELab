
<?php
    include("config/config.php");
    include("config/connessione.php");
    include("config/utils.php");
/*
L'autentificazione al sito avviene tramite due modalità:
1. l'identificatore uniqid dell'utente viene passato alla index.php tramite parametro GET
2. viene verificata la presenza di una precedente sessione memorizzata tramite cookie uniqid

 */



if(isset($_GET['uniqid'])) { //accesso tramite URI
    $uniqid   = mysqli_real_escape_string($connessione,$_GET['uniqid']);

    if(!verify_valid_UUID($uniqid)){
        echo verify_valid_UUID($uniqid);
        #header("Location:index.php?message=invalid uniqid");
    }else{
        //Calculate 60 days in the future
        //seconds * minutes * hours * days + current time
        $inTwoMonths = 60 * 60 * 24 * 60 + time();
        setcookie('uniqid', $uniqid, $inTwoMonths);
        
        $_SESSION['aiutaci_uniqid']=$uniqid;
        header("Location:home.php?message=accesso tramite URL");
    }

}
elseif(isset($_SESSION['aiutaci_uniqid'])) { //sessione ancora attiva
    header("Location:home.php?message=accesso tramite sessione");
}
elseif(isset($_COOKIE['uniqid'])) { //accesso tramite cookies
    $uniqid=$_COOKIE['uniqid'];
    $_SESSION['aiutaci_uniqid']=$uniqid;
    header("Location:home.php?message=accesso tramite cookie");

} else { //primo accesso

?>
<!DOCTYPE html>

<html>
    <?php include("include/head.php") ?>
    <body>


        <?php include("include/header.php"); ?>

        <div class="container-fluid mb-3">

            <div class="card-header mt-2 mb-3 ">
                <p class="lead">Valuta la tua percezione personale dell’odio online leggendo dei messaggi postati nei social media.
                    Confronta la tua percezione con il nostro sistema automatico e con gli altri utenti come te.

                    Potrai accedere al nostro servizio tutte le volte che vorrai e ti verranno sempre proposti nuovi quesiti.
                    Il tuo contributo potrà inoltre permetterci di migliorare il nostro sistema di annotazione automatica.
                </p>
            </div>
            <div class="row">
                <div class="col-6 col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-6">
                    <div class="card mb-4 box-shadow ">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Accedi tramite e-mail</h4>
                        </div>
                        <div class="card black-background pt-3 pl-3 pr-3 pb-0">
                            <form method="POST" action="register.php" class="p-0 m-0">

                                <p class="lead white">Inserisci il tuo indirizzo di posta</p>
                                <div class="mb-2">
                                    <span class="lead white">
                                        Ti verrà inviata una mail contenente un link che ti permetterà di continuare a contribuire al nostro servizio conservando le tue vecchie sessioni.
                                    </span>
                                    <div class="circle red-background-white-border">
                                        <a href="#" data-toggle="tooltip" title="Utilizzeremo la tua e-mail esclusivamente per consentire l’accesso al nostro servizio.
    Inoltre, memorizzeremo nel nostro database una funzione di hash che non ci consentirà in alcun modo di risalire al tuo indirizzo e-mail.">
                                            i
                                        </a>
                                    </div>
                                </div>
                                <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Inserisci email">
                                <small id="emailHelp" class="form-text text-muted" name="email">Non memorizzeremo in alcun modo la tua e-mail.</small>
                                <button type="submit"  class="btn-custom-login-mail btn btn-lg btn-block btn-primary mt-auto">Invia</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-6">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Accedi tramite Cookies</h4>
                        </div>
                        <div class="card p-3">
                            <div class="mb-2">
                                <span class="lead">
                                    Nel caso tu non voglia inserire il tuo indirizzo di posta puoi comunque accedere al servizio, ma non sarà garantito il salvataggio delle tue vecchie sessioni.
                                </span>
                                <div class="circle red-background-black-border mb-3">
                                    <a href="#" data-toggle="tooltip" title="Tramite un cookies (che conterrà esclusivamente un codice casuale univoco) potremmo permetterti di riprendere l’utilizzo del servizio a partire dalla sua sessione precedente.
    Se cancellerai i cookies o utilizzerai un altro browser, la tua sessione ricomincerà da zero.">
                                        i
                                    </a>
                                </div>
                            </div>
                            <!--<a class="btn-custom-login-cookie btn btn-lg btn-block btn-primary mt-auto mb-2"
                               href="<?php echo $base_url."login.php?uniqid=".uniqid("",true); ?>">
                                Accedi
                            </a>-->
                        </div>
                    </div>
                </div>
            </div>




        </div>

        <?php include("include/footer.php"); ?>


    <body>
</html>


<?php } ?>