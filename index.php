
<?php
    include("config/config.php");
    include("config/connessione.php");
    include("config/utils.php");
/*
L'autentificazione al sito avviene tramite due modalità:
1. l'identificatore uniqid dell'utente viene passato alla index.php tramite parametro GET
2. viene verificata la presenza di una precedente sessione memorizzata tramite cookie uniqid

 */

?>

<!DOCTYPE html>

<html>
    <?php include("include/head.php") ?>
    <body onLoad="show_score()">


        <?php include("include/header.php"); ?>

			<div class="container-fluid">
				<div class="row">
					<div class="col-7 col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-7 mt-2 p-5">
						<h1> Linee guida per l’annotazione </h1>
						<p class="intro">Le tecnologie di rilevazione automatica degli <a class="a-card-header" href="https://controlodio.it/cosa-hate-speech/" >Hate Speech</a>, sviluppate dall’<a class="a-card-header" href="https://www.unito.it" >Università di Torino</a> per <a class="a-card-header" href="https://controlodio.it" >Contro l’odio</a>, <sottolineato>imparano da testi valutati da esseri umani</sottolineato>.</p>
						<!--<p class="intro">Infatti, analizzando questi dati il nostro sistema impara automaticamente grandi quantità di discorsi d’odio.</p>-->

						<p class="intro">Con il trascorrere del tempo è però necessario avere un numero sempre maggiore di <sottolineato>testi annotati manualmente</sottolineato> per fare in modo che il sistema continui a rilevare in modo preciso gli Hate Speech.</p>
						<p class="intro"><b>Per questo motivo abbiamo bisogno del tuo aiuto!</b></p>

						<p class="guida">Accedendo alla piattaforma di annotazione, potrai valutare dei tweet indicando il livello di odio che, <sottolineato>secondo te</sottolineato>, ogni tweet esprime nei confronti di tre gruppi vulnerabili alle discriminazioni: minoranze etniche, minoranze religiose e rom.<br>
							Ti verranno proposti <b>15</b> tweet diversi alla volta; potrai interropere e riprendere in qualsiasi momento la tua sessione di annotazione e partecipare quante volte vorrai <b>(N.B. Per eseguire correttamente i compiti a casa, completa almeno due sessioni intere, annotando così un totale di 30 tweet)</b>.
						</p>

						<p class="guida">Abbiamo scelto come strumento per l’annotazione una scala di colore dove il <sottolineato>bianco</sottolineato> è associato alla totale assenza di odio mentre la tonalità più scura di <sottolineato>rosso</sottolineato> si abbina al livello massimo.
						<br> Il tasto <sottolineato>fuori tema</sottolineato> serve invece a segnalare i testi che non parlano dell’argomento.</p>

						<!--<center><img src="img/scala.png" class="img-fluid m-2" alt="Responsive image"></center>--->
						<div class="row m-5 btn-group-toggle" data-toggle="buttons">
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

				
<p class="guida">Inoltre ti chiediamo di annotare l’eventuale presenza di ironia/sarcasmo/humor, di offensività e di stereotipo, utilizzando gli appositi pulsanti:</p>				
						<!--<center><img src="img/bottoni.png" class="img-fluid m-2" alt="Responsive image"></center>-->
					
					
					
					<div class="row  m-3 ml-5" >
						<div class="col-4 mb-3"></div>
						<div class="col-8">
							  <div class="form-check form-check-group">
								<input name='dimensione_1' id="checkbox1" type="checkbox" data-toggle="toggle" data-onstyle="danger" data-offstyle="secondary" data-on="Presente" data-off="Non presente">
								  <label for="checkbox1"><h3>Ironia/Sarcasmo/Humor</h3></label>
							  </div>
						</div>
						<div class="col-4 mb-3"></div>
						<div class="col-8">
							  <div class="form-check form-check-group">
								<input name='dimensione_2' id="checkbox2" type="checkbox" data-toggle="toggle" data-onstyle="danger" data-offstyle="secondary"  data-on="Presente" data-off="Non presente">
								<label for="checkbox2"><h3>Offensività</h3></label>
							  </div>
						</div>
						<div class="col-4 mb-3"></div>
						<div class="col-8">
							  <div class="form-check form-check-group">
								<input name='dimensione_3' id="checkbox3" type="checkbox"  data-toggle="toggle" data-onstyle="danger" data-offstyle="secondary"  data-on="Presente" data-off="Non presente">
								<label for="checkbox3" class="disabled"><h3>Stereotipo</h3></label>
							  </div>
						</div>
				   </div>

					
					
						<p class="guida">Potrai inoltre confrontare costantemente quanto la tua valutazione sia simile a quella del nostro sistema automatico.</p>

						<!--<center><img src="img/punteggio.png" class="img-fluid m-2" alt="Responsive image"></center>-->
					<div class="row m-5" >
						<div class="card pt-3 pl-3 pr-3 pb-3" style="background-image: url('<?php echo $base_url;?>/img/computer.jpg');   background-position: center;    background-repeat: repeat;">
						<?php
						$punteggio=array();
						$punteggio['punteggio_macchina']= rand(1, 99) / 100;
						$test=true;
						include("include/score.php");  

						?>
						</div>
					</div>

						<p class="guida">Durante o dopo le tue sessioni di annotazione, potrai aiutarci ulteriormente compilando un <sottolineato>questionario anonimo</sottolineato>.
						<br>Anche questo per noi è un aspetto importante per imparare a conoscere meglio l’Hate Speech.
						<br>Infatti, persone con caratteristiche diverse possono percepire l’odio in modo molto diverso tra loro.
						<br>Il questionario è facoltativo così come ogni risposta. Per esempio, puoi decidere di indicare solo la tua età.</p>

						<p class="guida">Se qualcosa non ti fosse chiaro e avessi bisogno di ulteriori informazioni puoi scriverci a <sottolineato>simona.frenda@unito.it</sottolineato>.</p>


						<center><p class="guida"><b>Grazie e buona annotazione.</b></p></center>

						


						
						
</div>
					<div class="col-5 col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-5 mt-5">

						<?php  if(isset($_SESSION['aiutaci_uniqid'])) { ?> 

							<div class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12">
								<div class="card mb-4 box-shadow">
									<div class="card-header">
										<h4 class="my-0 font-weight-normal">Vai alla dashboard</h4>
									</div>
									<div class="card p-3">
										<div class="mb-2">
											Visualizza i tuoi progressi
										</div>
										<a class="btn-custom-login-cookie btn btn-lg btn-block btn-primary mt-auto mb-2"
										href="<?php echo $base_url."home.php"; ?>">
												Dashboard
										</a>
									</div>
								</div>
							</div>
							<?php  } else  { ?>

								<div class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12">
									<div class="card mb-4 box-shadow">
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
														<a href="#" data-toggle="tooltip" title="Utilizzeremo la tua e-mail esclusivamente per consentire l’accesso al nostro servizio. Inoltre, memorizzeremo nel nostro database una funzione di hash che non ci consentirà in alcun modo di risalire al tuo indirizzo e-mail.">
															i
														</a>
													</div>
												</div>
												<input name='email' type="email" class="form-control" aria-describedby="emailHelp" placeholder="Inserisci email">
												<small id="emailHelp" class="form-text text-muted" name="email">Non memorizzeremo in alcun modo la tua e-mail.</small>
												<button type="submit"  class="btn-custom-login-mail btn btn-lg btn-block btn-primary mt-auto mb-3">Invia</button>
											</form>
										</div>
									</div>
								</div>

								</div>

						<?php  } ?>

					</div>
				</div>


			<div class="card mb-4 box-shadow m-3">

			<div class="card black-background pt-3 pl-3 pr-3 pb-0">


					<p class="lead text-center">   Fai conoscere la piattaforma ai tuoi amici </p>

					<div class="container">
					<div class="row">
						<div class="col-sm">
						</div>
						<div class="col-sm">
							<!-- AddToAny BEGIN -->
							<div class="share_button" >

								<?php echo  '<a target= "_blank" href="https://www.facebook.com/sharer/sharer.php?u='.$base_url.'"><i class="fab fa-facebook-square fa-7x"></i></a>'; ?>
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

				<div class="card-footer pt-4 my-md-5 pt-md-5 border-top">
					<div class="row">
						<div class="col-11">
						</div>
						<div class="col-1">
							<small class="d-block mb-3 text-muted">&copy; 2020</small>
						</div>
					</div>
				</div>


			</div>




        <?php include("include/footer.php"); ?>


    <body>
</html>


