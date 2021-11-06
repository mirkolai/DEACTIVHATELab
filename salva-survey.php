<?php   
    include("config/config.php");
    include("config/connessione.php");
    include("config/utils.php");



    if(!isset($_SESSION['aiutaci_uniqid'])) { //sessione ancora attiva
        header("Location:index.php?message=accesso richiesto");
    }
    else{
        if(
         isset($_POST['genere']) &&
         isset($_POST['eta']) &&
         isset($_POST['cittadinanza']) &&
         isset($_POST['istruzione']) &&
         isset($_POST['professione']) &&
         isset($_POST['areapolitica']) &&
         isset($_POST['cap']) //&&
         //isset($_POST['note'])
		){

            $campogenere   = mysqli_real_escape_string($connessione,$_POST['genere']);
            $campoeta   = mysqli_real_escape_string($connessione,$_POST['eta']);
            $campocittadinanza   = mysqli_real_escape_string($connessione,$_POST['cittadinanza']);
            $campoistruzione   = mysqli_real_escape_string($connessione,$_POST['istruzione']);
            $campoprofessione   = mysqli_real_escape_string($connessione,$_POST['professione']);
            $campoareapolitica   = mysqli_real_escape_string($connessione,$_POST['areapolitica']);
            $campocap   = mysqli_real_escape_string($connessione,$_POST['cap']);
            $camponote   = "";//mysqli_real_escape_string($connessione,$_POST['note']);

            inserisci_survey(
                $_SESSION['aiutaci_uniqid'],
                $campogenere,
                $campoeta,
                $campocittadinanza,
                $campoistruzione,
                $campoprofessione,
                $campoareapolitica,
                $campocap,
                $camponote,  
                $server,$user,$password,$database);

        }else{
            header("Location:home.php?message=Errore durante il salvataggio del sondaggio");

        }

        header("Location:home.php?message=Sondaggio salvato.");

    }

      

?>