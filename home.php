<?php
    include("config/config.php");
    include("config/connessione.php");
    include("config/utils.php");


    if(!isset($_SESSION['aiutaci_uniqid'])) { //sessione ancora attiva
        header("Location:index.php?message=accesso richiesto");
    }
    else{

        inserisci_nuovo_accesso($_SESSION['aiutaci_uniqid'],$server,$user,$password,$database);
        $numero_sessioni_completate=restituisci_sessioni_completate($_SESSION['aiutaci_uniqid'],$server,$user,$password,$database);
        $numero_accessi=restituisci_accessi($_SESSION['aiutaci_uniqid'],$server,$user,$password,$database);
        $ultimo_accesso=restituisci_ultimo_accesso($_SESSION['aiutaci_uniqid'],$server,$user,$password,$database);


        $punteggio=restituisci_punteggio_totale($_SESSION['aiutaci_uniqid'],$server,$user,$password,$database);
?>


    <!DOCTYPE html>
    <html lang="en">
    <?php include("include/head.php") ?>
    <body  class="index" onLoad="initialize()">

        <?php include("include/header.php") ?>
			<div class="row">
				<div class="col-12 float-right">
					<div class="text-right">
			  <a class="btn btn-primary red-background-white-border m-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
				Linee guida dettagliate
			  </a>
					</div>
				</div>
			</div>
		
		
		
				<div class="m-5 collapse" id="collapseExample">
		  		<div class="card card-body">
				<h1>Linee guida dettagliate</h1>
				<ol>
					<li class="mt-3"><strong>HATE SPEECH</strong><br>
						<p>Per ogni tweet che annoterai ti verrà posta la seguente domanda: <i>“Qual è il livello di hate speech (HS) nei confronti di musulmani, immigrati o rom presente in questo tweet?”</i></p>

												<!--<center><img src="img/scala.png" class="img-fluid m-2" alt="Responsive image"></center>-->
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

						<p>Potrai selezionare dei valori da bianco a rosso scuro (1-7), dove bianco è associato alla totale assenza di odio mentre la tonalità più scura di rosso si abbina al livello massimo.  Il tasto grigio “fuori tema” serve invece a segnalare i testi che non parlano dell’argomento.</p>
					</li>

					<li class="mt-3"><strong>I DIVERSI TARGET</strong><br>
				<p>Quando stai per scegliere una delle diverse sfumature da bianco a rosso scuro, per l’annotazione dell’HS, ricordati sempre di pensare se il target del messaggio è uno dei seguenti: musulmani, immigrati o rom.</p>
						<ul>
							<li><b>Musulmani</b><br>
							L’HS contro i musulmani può includere:
								<ul>
									<li>insulti, minacce, espressioni denigratorie o di odio motivate dalla diversità di fede,</li>
									<li>incitamento a odio, violenza o violazione dei diritti verso singoli individui o gruppi motivato dalla diversità di fede,</li>
									<li>associazione tra fede islamica e propensione al fondamentalismo, al terrorismo, al crimine o a piani di invasione o conquista dell'Europa.</li>
								</ul>	

							</li>

							<li><b>Immigrati</b><br>
							L’HS contro gli immigrati può includere:
								<ul>
							<li>insulti, minacce, espressioni denigratorie o di odio motivate da differenze di etnia, provenienza, tratti somatici (colore della pelle), lingua o cultura,</li>
							<li>incitamento a odio, violenza o violazione dei diritti verso singoli individui o gruppi motivato da differenze di etnia, provenienza, tratti somatici (colore della pelle), lingua o cultura,</li>
							<li>associazione tra etnia/provenienza/cultura e abilità cognitive, propensione al crimine, pigrizia o altre caratteristiche antisociali,</li>
							<li>riferimenti alla presunta inferiorità o superiorità di alcuni gruppi etnici rispetto ad altri,</li>
							<li>delegittimazione di status sociale o affidabilità in base a etnia o provenienza,</li>
							<li>riferimenti ad alcune etnie o provenienze come una minaccia per la sicurezza o il benessere degli italiani, o come avversari nella distribuzione delle risorse pubbliche,</li>
							<li>espressioni disumanizzanti o associazione con animali o soggetti considerati inferiori/incivili</li>
								</ul>
							</li>

							<li><b>Rom</b><br>
							L’HS contro i rom può includere:
								<ul>
							<li>insulti, minacce, espressioni denigratorie o di odio motivate dal riferimento all'etnia rom</li>
							<li>associazione di persone rom con una presunta predisposizione alla delinquenza, al crimine, alla sporcizia e in generale a abitudini antisociali</li>
									<li>uso, anche verso soggetti terzi, di epiteti offensivi o denigratori per le persone rom</li>
								</ul>
								</li>
						</ul>
					</li>
					<li class="mt-3"> <strong>IRONIA/SARCASMO/HUMOR </strong><br>
				<p>In alcuni casi i contenuti di odio possono essere veicolati in maniera sottile e indiretta, tramite una frase ironica, sarcastica o umoristica che rende l'HS più difficile da individuare, ma non per questo meno tagliente. Tramite l’apposito pulsante, seleziona se secondo te è presente ironia, sarcasmo o humor. </p>

					<!--<center><img src="img/humor.png" class="img-fluid m-2" alt="Responsive image"></center>-->
					<div class="row  m-3 ml-5" >
						<div class="col-4 mb-3"></div>
						<div class="col-8">
							  <div class="form-check form-check-group">
								<input name='dimensione_1' id="checkbox1" type="checkbox" data-toggle="toggle" data-onstyle="danger" data-offstyle="secondary" data-on="Presente" data-off="Non presente">
								  <label for="checkbox1"><h3>Ironia/Sarcasmo/Humor</h3></label>
							  </div>
						</div>

				   </div>


				Alcuni esempi di tweet ironici:
						<ul>
				<li><i>«Immigrati: Salvini, genio Gentilini si accorge ora che terroristi sono anche in carcere? ROMA, 5 gen "Quel genio... https://t.co/S187bnF3uH»</i></li>
				<li><i>«Che bella Europa non solo ci lascia soli davanti alla tragedia dei migranti costringendoci ad indebitarci per salvarli ed assisterli grazie»</i></li>
				<li><i>«Oh guarda caso il terrorista di Berlino era in Italia......»</i></li>
				<li><i>«rom....parmi strano: si saranno sbagliati i Carabinieri!!!! https://t.co/Zq3At22qJQ»</i></li>
						</ul>
					</li>
					<!-------------->
					
									<li class="mt-3"><strong>OFFENSIVITÀ</strong><br>

<p>Un tweet è considerato offensivo se sono presenti parolacce, insulti o espressioni degradanti nei confronti di uno dei tre target. Tramite l’apposito pulsante, seleziona se secondo te  il messaggio è offensivo e ha effetti potenzialmente dannosi sul target. </p>
					<!--<center><img src="img/offensività.png" class="img-fluid m-2" alt="Responsive image"></center>-->
				   <div class="row  m-3 ml-5" >

						<div class="col-4 mb-3"></div>
						<div class="col-8">
							  <div class="form-check form-check-group">
								<input name='dimensione_2' id="checkbox2" type="checkbox" data-toggle="toggle" data-onstyle="danger" data-offstyle="secondary"  data-on="Presente" data-off="Non presente">
								<label for="checkbox2"><h3>Offensività</h3></label>
							  </div>
						</div>
						<div class="col-4 mb-3"></div>

				   </div>
						
<p>Un messaggio contiene offensività se presenta almeno una delle seguenti caratteristiche:</p>
						
<ul>
	<li>il target è associato a vizi spiacevoli (soprattutto pigrizia):<br>
		<i>«Italiani sfrattati e immigrati viziati»«E meno male che dovevano pagare le nostre pensioni... #migranti #parassiti»</i><br>
		<i>«@RaiStoria  @MassimoMasini  Gli  immigrati  africani  in  Italia,  invece,  sono  ospitati  a  oziare  in alberghi a 3-4 stelle. Bella differenza.»
		</i>
	</li>
	<li>o, in generale, a caratteristiche negative:<br>
		<i>«Apparte voto subito quando iniziamo a cacciare gli usurpatori migranti anche siriani in mare si sta 'nn ci importa!»</i>
	</li>
	<li>si mette in dubbio lo status di minoranza svantaggiata o discriminata:<br>
		<i>«@ilmessaggeroit Quattro poveri #profughi” fra cui un minore nn accompagnato?»</i><br>
		<i>«PONTIFEX....insiste:  il  popolo  italiano  deve  essere  sommerso  e  cancellato  da  finti  profughi  che vogliono ciò che non hanno mai saputo fare!»</i><br>
		<i>«#dallavostraparte ok occupare non va bene però perché se rom od immigrati fanno vedere bimbi restano ed italiano no, pagava pure per di più»</i>
	</li>
	<li>i  membri  del  gruppo  target  sono  descritti  o  considerati  come  persone  spiacevoli  da  cui  è meglio tenersi alla larga:<br>
		<i>«@DrunkyBorghy fai una cosa; portateli tutti a casa tua!!! Io a casa mia non li voglio, terroristi o non terroristi che siano!!!»
		</i><br>
		<i>«Questo  vedevano  gli  abitanti  di  Roma  quando  aprivano  gli  occhi.  Adesso  solo  immondizia,immigrati, caos e tasse»</i>
	</li>
	<li>c'è un intento derisorio:<br>
		<i>«Facciamo partecipare i ““leader rom”” anche al prossimo G8.»</i>
	</li>
	<li>ci si riferisce al gruppo target con espressioni chiaramente offensive o degradanti:<br>
		<i>«Barletta, sgomberato mega-campo rom... #raccoltadifferenziata»</i><br>
		<i>«Che strano, il terrorista cotechino si e suicidato in carcere. Impiccandosi con una t-shirt alla porta»</i>
	</li>
	<li>sono presenti insulti o parole volgari:<br>
		<i>«A tutti i musulmani dell'isis, vi sentite forti adesso? Bravi coglioni!»</i><br>
		<i>«@Fcoglioni @erpedrini sti comunisti zecche perché non emigrano in Algeria Arabia ecc. visto che si trovano bene con i loro fratelli islamici»</i>
	</li>
</ul>
<p>N.B. Un messsaggio può essere non offensivo anche se contiene hs, linguaggio aggressivo o uno stereotipo:<br>
	<i>«Trovato in Croazia il tesoro della “regina” rom: sequestro da 6 milioni di euro»</i></p>

	
					
					
					
					
					<!--------------->
					<li><strong>STEREOTIPO</strong><br>
					La presenza di stereotipo determina se il messaggio contiene riferimenti, idee o tratti negativi attribuiti genericamente ad un intero gruppo. In alcuni casi gli stereotipi possono essere alla base dei discorsi che promuovono o veicolano odio verso alcuni gruppi di minoranza. Tramite l’apposito pulsante, seleziona se secondo te sono presenti uno o più stereotipi. 
					<div class="row  m-3 ml-5" >
						<div class="col-4 mb-3"></div>
						<div class="col-8">
							  <div class="form-check form-check-group">
								<input name='dimensione_3' id="checkbox3" type="checkbox"  data-toggle="toggle" data-onstyle="danger" data-offstyle="secondary"  data-on="Presente" data-off="Non presente">
								<label for="checkbox3" class="disabled"><h3>Stereotipo</h3></label>
							  </div>
						</div>
				   </div>

					<!--<center><img src="img/stereotipo.png" class="img-fluid m-2" alt="Responsive image"></center>-->

					Un messaggio contiene uno stereotipo se presenta almeno una delle seguenti caratteristiche:
					<ul>
						<li>i membri di una categoria target sono descritti come invasori (o simili attributi)<br>

					<i>«Se gli italiani continuiamo a non fare figli ci ritroveremo presto sottomessi dai musulmani.</i>
							Fermiamoli prima che sia troppo tardi»</li>
					<li>o come opportunisti, buoni a nulla, parassiti <br>
						<i>«Gli immigrati non muoiono di fatica . Sono spesati di tutto.»</i>
					</li>
					<li>o come criminali o delinquenti <br>
					<i>«@TutteLeNotizie @MediasetTgcom24 e ce l'hai ancora visto che appoggi clandestini rom
						iussoli e stanieri criminali liberi impuniti a zonzo»</i></li>
					<li>o come persone sporche e ripugnanti <br>
					<i>«Mentre la #Raggi investe 12 milioni di euro in favore dei #rom un migrante CAGA
						tranquillamente davanti all'altare del...»</i></li>
					<li>quando un titolo di giornale relativo a notizie di cronaca riporta la nazionalità, etnia o religione dei soggetti interessati senza che questo sia necessario per la comprensione dell'informazione, contribuendo così ad associare determinati comportamenti a determinate identità<br>
					 <i>«Identificato l'autore della rapina all'anziano di Annone Veneto: è un giovane nomade» </i>
					[ad esempio, in questo caso non è necessario specificare che l'autore è un nomade, e farlo suggerisce che ci sia una correlazione tra questa caratteristica e il compimento della rapina]
						 </li>
					<li>per quanto riguarda in particolare i musulmani, sono frequenti alcuni stereotipi che li rappresentano come misogini, antidemocratici e violenti <br>
					<i>«e quelle col burqua dov'erano? Non gli hanno consentito di manifestare i maritini islamici integrati?» </i><br>
					<i>«@marini_valerio il bello della democrazia a cui siamo abituati noi è questo, tu hai la tua opinione e io la mia. Chissà nei paesi islamici?»</i><br>
						<i>«#islam “religione” di pace e amore...»</i>
						</ul>
					</li>


				</ol>
</div>
</div>	
		
		
		
		
		
		
		
		
        <div class="card mb-4 mt-4 box-shadow m-3">
            <div class="card black-background pt-3 pl-3 pr-3 pb-0">

                    <?php if($numero_accessi==1){ ?>
                        <p class="lead text-center">
                            Benvenuto
                        </p>
                    <?php } else { ?>
                        <p class="lead text-center">

                            Bentornato  <?php if($ultimo_accesso){ echo "(ultimo accesso $ultimo_accesso)"; } ?>

                        </p>

                    <?php } ?>

 
                    <p class="lead text-center">
                        fino ad ora hai completato <?php echo $numero_sessioni_completate; ?> sessioni
                    </p>   


                    <?php if(isset($_SESSION['aiutaci_istanze_totali'] ) 
                                && count($_SESSION['aiutaci_istanze_totali'])>0 
                                && array_sum(array_column($_SESSION['aiutaci_istanze_totali'], 'done')) < $GLOBALS['aiutaci_istanze_sessione']){  ?>
                        <a class="red-background-white-border btn btn-lg btn-block btn-primary mt-auto mb-3"
                               href="<?php echo $base_url."annota.php"; ?>" >
                                Riprendi Sessione <?php echo"(".array_sum(array_column($_SESSION['aiutaci_istanze_totali'], 'done'))."/$GLOBALS[aiutaci_istanze_sessione])"; ?>
                        </a>
                    <?php }?>
                    <a class="red-background-white-border btn btn-lg btn-block btn-primary mt-auto mb-3"
                               href="<?php echo $base_url."annota.php?type=new"; ?>" >
                                Nuova Sessione
                    </a>
            </div>
        </div>

        <?php 

            include("include/score.php"); 
            
        ?>

		
		

		
		
		
		
        <?php include("include/footer.php") ?>


    </body>
    </html>



<?php
    }
?>