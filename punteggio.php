<?php   
    include("config/config.php");
    include("config/connessione.php");
    include("config/utils.php");



    if(!isset($_SESSION['aiutaci_uniqid'])) { //sessione ancora attiva
        header("Location:index.php?message=accesso richiesto");
    }
    else{

            if( array_sum(array_column($_SESSION['aiutaci_istanze_totali'], 'done')) == $GLOBALS['aiutaci_istanze_sessione']){ 
                //salva sessione e annotazioni su _annotazioni
                //usare un uid come codice sessione


                if(!isset($_GET['macchina'])){// || !isset($_GET['uomo'])){

                    header("Location:home.php?message=nessun punteggio da mostrare");

                }else{

                $punteggio=[];
                $punteggio['punteggio_macchina'] =$_GET['macchina'];
                //$punteggio['punteggio_uomo'] =$_GET['uomo'];


           
?>




                    <!DOCTYPE html>
                    <html lang="en">
                    <?php include("include/head.php") ?>
                    <body  class="index" onLoad="initialize()">

                        <!--<div class="container">
                            <?php if (isset($_GET['message'])){ ?>
                                <div class="alert alert-info">

                                    <?php echo $_GET['message']; ?>
                                </div>

                            <?php } ?>

                        </div>-->
                        <?php include("include/header.php") ?>




                        <div class="card mb-4 box-shadow m-3">

                            <div class="card black-background pt-3 pl-3 pr-3 pb-0">

                                


                                    <p class="lead text-center">
                                            Complimenti hai appena concluso una sessione!
                                            Ecco i risultati della tua valutazione.
                                    </p>   


                                    <!--<a class="red-background-white-border btn btn-lg btn-block btn-primary mt-auto mb-3"
                                            href="<?php echo $base_url."home.php"; ?>" >
                                            Dashboard                     
                                    </a>-->
                                    <a class="red-background-white-border btn btn-lg btn-block btn-primary mt-auto mb-3"
                                            href="<?php echo $base_url."annota.php?type=new"; ?>" >
                                                Nuova Sessione
                                    </a>
                            </div>
                        </div>




<?php  


                       include("include/score.php");  

         
?>

<div class="card mb-4 box-shadow m-3">

<div class="card black-background pt-3 pl-3 pr-3 pb-0">

    
        <p class="lead text-center">  Fai conoscere la piattaforma ai tuoi amici  </p>

        <div class="container">
        <div class="row">
            <div class="col-sm">
            </div>
            <div class="col-sm">
                <!-- AddToAny BEGIN -->
                <div class="share_button" >

                    <?php echo  '<a target= "_blank" href="https://www.facebook.com/sharer/sharer.php?u='.$base_url.'punteggio.php%3Fmacchina%3D'.$punteggio['punteggio_macchina'].
			 //'%26uomo%3D'.$punteggio['punteggio_uomo'].
			 '"><i class="fab fa-facebook-square fa-7x"></i></a>'; ?>
                    <?php echo  '<a  target= "_blank" href="https://twitter.com/share?url='.$base_url.'&text=Aiutaci a combattere l\'odio online e confronta le tue opinioni con i nostri sistemi automatici"><i class="fab fa-twitter-square fa-7x"></i></a>'; ?>
					
					 <?php #echo  '<a href="https://twitter.com/share?url='.$base_url.'img/punteggio.png"><i class="fab fa-twitter-square fa-7x"></i></a>'; ?>
                </div>
                <!-- AddToAny END -->
            </div>
            <div class="col-sm">

            </div>
        </div>
        </div>

                

</div>
</div>



                        <?php include("include/footer.php") ?>


                    </body>
                    </html>







<?php

                    }

        }else{
            
            header("Location:annota.php?message=nessun punteggio da mostrare");

        }



    }
        
?>