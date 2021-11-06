<?php   
   include("config/config.php");
    include("config/connessione.php");
    include("config/utils.php");



    if(!isset($_SESSION['aiutaci_uniqid'])) { //sessione ancora attiva
        header("Location:index.php?message=accesso richiesto");
    }
    else{
        if(isset($_POST['id']) && isset($_POST['options']) && is_numeric($_POST['options'])){

            $label   = mysqli_real_escape_string($connessione,$_POST['options']);
            $dimensione_1   = isset($_POST['dimensione_1']) ? 'YES' : 'NO';
            $dimensione_2   = isset($_POST['dimensione_2']) ? 'YES' : 'NO';
            $dimensione_3   = isset($_POST['dimensione_3']) ? 'YES' : 'NO';

            for($i=0;$i<count($_SESSION['aiutaci_istanze_totali']);$i++){
                
                if ($_SESSION['aiutaci_istanze_totali'][$i]['id']==$_POST['id']){
                    $_SESSION['aiutaci_istanze_totali'][$i]['label']=intval($label);
					
                    $_SESSION['aiutaci_istanze_totali'][$i]['dimensione_1']=$dimensione_1;
                    $_SESSION['aiutaci_istanze_totali'][$i]['dimensione_2']=$dimensione_2;
                    $_SESSION['aiutaci_istanze_totali'][$i]['dimensione_3']=$dimensione_3;

                    $_SESSION['aiutaci_istanze_totali'][$i]['done']=1;
                    break;
                }

            }
            //fare un salvataggio intermedio _annotazioni_temp
            inserisci_istanze_temp(
                $_SESSION['aiutaci_uniqid'],
                $_SESSION['aiutaci_istanze_totali'][$i]['id'],
                $_SESSION['aiutaci_istanze_totali'][$i]['label'],
				
				$_SESSION['aiutaci_istanze_totali'][$i]['dimensione_1'],
                $_SESSION['aiutaci_istanze_totali'][$i]['dimensione_2'],
                $_SESSION['aiutaci_istanze_totali'][$i]['dimensione_3'],
				
            $server,$user,$password,$database);


            if( array_sum(array_column($_SESSION['aiutaci_istanze_totali'], 'done')) == $GLOBALS['aiutaci_istanze_sessione']){ 
                //salva sessione e annotazioni su _annotazioni
                //usare un uid come codice sessione

                $sessione_id=uniqid("SESSION:",true);
                foreach($_SESSION['aiutaci_istanze_totali'] as $istanza){

                    inserisci_istanze(
                        $_SESSION['aiutaci_uniqid'],
                        $istanza['id'],
                        $istanza['label'],
						
						$istanza['dimensione_1'],
                        $istanza['dimensione_2'],
                        $istanza['dimensione_3'],

                        $sessione_id,
                        $server,$user,$password,$database);
                }

                $punteggio=calcola_punteggio($_SESSION['aiutaci_istanze_totali']);
                
                inserisci_sessione(
                    $_SESSION['aiutaci_uniqid'],
                    $sessione_id,
                    $punteggio['punteggio_umano'],
                    $punteggio['punteggio_macchina'],
                    $server,$user,$password,$database);


                header("Location:punteggio.php?message=sessione terminata&macchina=$punteggio[punteggio_macchina]&uomo=$punteggio[punteggio_umano]");

            }else{
 
        
                header("Location:annota.php?message=entità annotata");

            }



        }else{

            header("Location:annota.php?message=Errore, dati insufficienti");

        }


      

?>





















<?php
    }
?>