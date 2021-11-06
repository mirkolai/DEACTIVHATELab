<?php #echo (extension_loaded('openssl')?'SSL loaded':'SSL not loaded')."\n"; ?>

<?php   
    include("config/config.php");
    include("config/connessione.php");
    include("config/utils.php");
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require 'vendor/autoload.php';

    if(isset($_SESSION['aiutaci_uniqid'])) { //sessione ancora attiva
        header("Location:home.php");
    }else if(!isset($_POST['email'])){

        header("Location:index.php?message=email richiesta");

    }
    else{
          $email=mysqli_real_escape_string($connessione,$_POST['email']);

          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location:index.php?message=formato email non valido");
          }
          else{
            $uniqid=verifica_accesso_tramite_mail($email,$server,$user,$password,$database);
            #verificare che l'utente esista o no
            #print_r($uniqid);
            if(is_null($uniqid)){
                $uniqid=uniqid("",true);
                inserisci_nuovo_accesso_tramite_mail($uniqid,$email,$server,$user,$password,$database);
            }

       

            $txt = ' 
            <html> 
            <head> 
                <title>Benvenuto nella sezione di annotazione di controlodio.it</title> 
            </head> 
            <body> 
                <h1>Grazie per esserti unito alla nostra comunità!</h1>
                <p>Utilizzeremo la tua e-mail esclusivamente per consentire l’accesso al nostro servizio.
                Inoltre, memorizzeremo nel nostro database una funzione di hash che non ci consentirà in alcun modo di risalire al tuo indirizzo e-mail
                </p>
                <p>Nel caso in cui tu perda questo messaggio, in futuro potrai riutilizzare la tua email per ricevere il link di accesso.</p>
                <p>Ciò ti permetterà di continuare a contribuire al nostro servizio conservando le tue vecchie sessioni.</p>

                <p>Ora puoi accedere a <a href="'.$base_url."login.php?uniqid=".$uniqid.'">'.$base_url.'</a> </p>

            </body> 
            </html>';
			  
			$alttxt = ' 

                Benvenuto nella sezione di annotazione di controlodio.it\n\n
                Grazie per esserti unito alla nostra comunità!\n\n
                Utilizzeremo la tua e-mail esclusivamente per consentire l’accesso al nostro servizio.
                Inoltre, memorizzeremo nel nostro database una funzione di hash che non ci consentirà in alcun modo di risalire al tuo indirizzo e-mail\n
                Nel caso in cui tu perda questo messaggio, in futuro potrai riutilizzare la tua email per ricevere il link di accesso.\n
                Ciò ti permetterà di continuare a contribuire al nostro servizio conservando le tue vecchie sessioni.\n\n

                Ora puoi accedere alla piattaforma tramite il seguente link: '.$base_url."login.php?uniqid=".$uniqid.'';
            
            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);
            
            try {
                //Server settings
                $mail->SMTPDebug = 0;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'in.postassl.it';                       // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'annota@controlodio.it';                // SMTP username
                $mail->Password   = '4n7kG$aS';                             // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                             // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                
                
                //Recipients
                $mail->setFrom('annota@controlodio.it', 'controlodio');
                //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
                $mail->addAddress($email);               // Name is optional
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');
            
                // Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            
                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Accedi a annota.controlodio.it';
                $mail->Body    = $txt;
                $mail->AltBody = $alttxt;
            
                $mail->send();
                //echo 'Message has been sent';


?>


   <!DOCTYPE html>
    <html lang="en">
    <?php include("include/head.php") ?>
    <body  class="index" onLoad="initialize()">
        <?php include("include/notice.php") ?>

        <header class="bg-dark">

            <nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
                
                <?php include("include/notice.php") ?>

                <div class="nav-container container">
                    <div class="navbar-brand">
                        <a href="<?php echo $base_url."index.php"; ?>" class="navbar-item">
                            <img src="img/logo.png" alt="Logo"/>
                        </a>
                    </div>
                    <div id="navbarBasicExample" class="navbar-menu">
                        <div class="navbar-end is-lowercase">

                        
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="card mb-4 box-shadow m-3">
        
            <div class="card black-background error_message pt-3 pl-3 pr-3 pb-0">

                <h2>Registrazione effettuata! </h2>

                <h3>Tra poco riceverai una mail con le credenziali d'accesso! </h3>

                <p><i class="fa fa-paper-plane fa-10x" aria-hidden="true"></i></p>

                <a class="red-background-white-border error_message btn btn-lg btn-block btn-primary mt-auto mb-3"
                   href="<?php echo $base_url."index.php"; ?>" >
                   Home             
                </a>
            </div>
        </div>            
        

        <?php include("include/footer.php") ?>


    </body>
    </html>
















<?php
		    } catch (Exception $e) {
                //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				header("Location:error.php?message=Errore imprevisto");
            }			
					
					
          }
    }
?>