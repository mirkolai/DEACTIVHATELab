<?php   
    include("config/config.php");
    include("config/connessione.php");
    include("config/utils.php");


    function highlight($text) {

        $new_text = preg_replace("/(#\w+)/", "<strong class='hashtag'>$1</strong>", $text);
        $new_text = preg_replace("/(@\w+)/", "<strong class='mention'>$1</strong>", $new_text);

        return $new_text;


    }  



    if(!isset($_SESSION['aiutaci_uniqid'])) { //sessione ancora attiva
        header("Location:index.php?message=accesso richiesto");
    }
    else{

        if(isset($_GET['type']) && $_GET['type']=='new'){

            $_SESSION['aiutaci_istanze_totali']=[];
    
        }

        if(isset($_SESSION['aiutaci_istanze_totali'] ) && count($_SESSION['aiutaci_istanze_totali'])>0 && array_sum(array_column($_SESSION['aiutaci_istanze_totali'], 'done')) < $GLOBALS['aiutaci_istanze_sessione']){ 



        }else{

        
  //no test question         //$istanze_test=restituisci_istanze_test($_SESSION['aiutaci_uniqid'],$server,$user,$password,$database);

            $istanze=restituisci_istanze($_SESSION['aiutaci_uniqid'],$server,$user,$password,$database);

            //$istanze_totali=array_merge($istanze,$istanze_test);
            //shuffle($istanze_totali);
            //$_SESSION['aiutaci_istanze_totali']=$istanze_totali;
			$_SESSION['aiutaci_istanze_totali']=$istanze;
        }
        
        
?>


<!DOCTYPE html>
    <html lang="en">
    <?php include("include/head.php") ?>
    <body  class="index" onload="twemoji.parse(document.body);">


        <?php include("include/header.php") ?>

<form method='POST' action='salva.php'>  

        <div class="card mb-4 box-shadow m-3">
            <div class="card-header">
						<?php 
                            $count=0;
                            foreach($_SESSION['aiutaci_istanze_totali'] as $istanza) {
                                $count+=1;

                                if(!$istanza['done']){
                        ?>
                                    <span  class='tweet-name h1'  id='tweet-<?php echo $istanza['id'];?>'> <?php echo html_entity_decode(htmlspecialchars(highlight($istanza['text']), ENT_NOQUOTES, "UTF-8")); ?></span>

                        <?php               
                                    echo "<input type='hidden' name='id' value='$istanza[id]'></input> ";
                                    break;
                                }

                            }

                        ?>
                <h4 class="my-0 font-weight-normal text-center">
                      <?php   echo "(".(array_sum(array_column($_SESSION['aiutaci_istanze_totali'], 'done'))+1)."/$GLOBALS[aiutaci_istanze_sessione])"; ?>          
                </h4>
            </div>
            <div class="card white-background pt-3 pl-3 pr-3 pb-0">

              
                    <div>
                			<h1 class="text-center">Qual è il livello di hate speech nei confronti di musulmani, immigrati o rom <br> presente in questo tweet?  </h1>

                        
                    </div>

                    <div class="container mb-3 mt-3">
                        <div class="row btn-group-toggle" data-toggle="buttons">
                            <div class="btn btn-secondary col value-0">
                                <input type="radio" name="options" id="option1" autocomplete="off" value=0 required> 
                            </div>
                            <div class="btn btn-secondary col value-1">
                                <input type="radio" name="options" id="option2" autocomplete="off" value=1> 
                            </div>
                            <div class="btn btn-secondary col value-2">
                                <input type="radio" name="options" id="option3" autocomplete="off" value=2>
                            </div>
                            <div class="btn btn-secondary col value-3">
                                <input type="radio" name="options" id="option4" autocomplete="off" value=3> 
                            </div>
                            <div class="btn btn-secondary col value-4">
                                <input type="radio" name="options" id="option5" autocomplete="off" value=4> 
                            </div>
                            <div class="btn btn-secondary col value-5">
                                <input type="radio" name="options" id="option6" autocomplete="off" value=5>
                            </div>
                            <div class="btn btn-secondary col value-6">
                                <input type="radio" name="options" id="option7" autocomplete="off" value=6> 
                            </div>
                            <div class="btn btn-secondary col value-7">
                                <input type="radio" name="options" id="option8" autocomplete="off" value=7>
                            </div>
                            <div class="btn btn-secondary col  value-out">
                                 <input type='radio'  name="options" id="optionoutoftopic" autocomplete="off" value=-1 > Fuori Tema </input>
                            </div>
                        </div>
                    </div>
				
				

					<!-- si e no -->
					<div class="row m-5" >
						<div class="col-12 mb-5">
							  <div class="form-check form-check-group">
								<input name='dimensione_1' id="checkbox1" type="checkbox" data-toggle="toggle" data-onstyle="danger" data-offstyle="secondary" data-on="Presente" data-off="Non presente">
								  <label for="checkbox1"><h3>Ironia/Sarcasmo/Humor</h3></label>
							  </div>
						</div>
						<div class="col-12 mb-5">
							  <div class="form-check form-check-group">
								<input name='dimensione_2' id="checkbox2" type="checkbox" data-toggle="toggle" data-onstyle="danger" data-offstyle="secondary"  data-on="Presente" data-off="Non presente">
								<label for="checkbox2"><h3>Offensività</h3></label>
							  </div>
						</div>
						<div class="col-12 mb-5">

							  <div class="form-check form-check-group">
								<input name='dimensione_3' id="checkbox3" type="checkbox"  data-toggle="toggle" data-onstyle="danger" data-offstyle="secondary"  data-on="Presente" data-off="Non presente">
								<label for="checkbox3" class="disabled"><h3>Stereotipo</h3></label>
							  </div>
						</div>
					</div>

			         <?php
                        if($count<$GLOBALS['aiutaci_istanze_sessione']){ ?>
                            <button type='submit' class="red-background-white-border btn btn-lg btn-block btn-primary mt-auto mb-3" >Prosegui</button>
                    <?php    }else{ ?>
                            <button type='submit' class="red-background-white-border btn btn-lg btn-block btn-primary mt-auto mb-3" >Termina</button>
                    <?php    }     ?>


            </div>
        </div>


</form>




        <?php include("include/footer.php") ?>


        </body>
        </html>






<?php
    }
?>