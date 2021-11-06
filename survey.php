<?php
    include("config/config.php");
    include("config/connessione.php");
    include("config/utils.php");


    if(!isset($_SESSION['aiutaci_uniqid'])) { //sessione ancora attiva
        header("Location:index.php?message=accesso richiesto");
    } else if(restituisci_survey_completato($_SESSION['aiutaci_uniqid'],$server,$user,$password,$database)){
        
        header("Location:home.php?message=Sondaggio già compilato");

    }
    else{

        $countries=restituisci_nazioni($server,$user,$password,$database);
        $cap=restituisci_cap($server,$user,$password,$database);

?>


    <!DOCTYPE html>
    <html lang="en">
    <?php include("include/head.php") ?>
    <script>

        $(document).ready(function() {
            $(".js-example-basic-single").select2({
                width: 'element',
                placeholder: "Ricerca",
                minimumInputLength:0,
                maximumDisplayOptionsLength:5,
                language: {

                    noResults: function () { return "Nessuna corrispondenza trovata"; },
                    inputTooShort: function () {  return "Inserisci almeno un carattere"; },
                    formatSearching: function () { return "Ricerca in corso..."; }

                }
            });
        });

    </script>
    <body  class="index" onLoad="initialize()">

        <?php include("include/header.php") ?>
        <div class="container">
            <div class="row m-5">
                <div class="col-sm">


                    <h1>Il nostro sondaggio</h1>
                    <p> Ci è di aiuto che tu ci fornisca qualche informazione su di te.</p>
                    <p> Queste informazioni rimarranno anonime e riservate e saranno utilizzate solo ed esclusivamente in forma aggregata.<br>
                    <p> Non inserire informazioni personali che non vuoi condividere con noi nel campo <strong>note</strong>. <br>
                    Questo campo potrebbe essere letto dai mebri del nostro team.</p>
                    <p> Ricordati che tutti i campi sono facoltativi quindi puoi compilare solamente i campi che desideri.</p>

                    <p>Se non vuoi compilare il form, puoi tornare alla dashboard.</p>

                </div>
                <!--`genere`, `eta`, `cittadinanza`, `istruzione`, `professione`, `area_politica`, `CAP`, `note`-->
                <div class="col-sm">

                        <form method='post' action='salva-survey.php'>
                            <div class="form-group">
                                <label for="campogenere">Genere</label>
                                <select 
                                class="js-example-basic-single dropdownlist custom-select custom-select-lg" 
                                id="campogenere" name="genere">
                                    <option value=''>Genere</option>
                                    <option value='uomo'>Uomo</option>
                                    <option value='donna'>Donna</option>
                                    <option value='altro'>Altro</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="campoeta">Età</label>
                                <select  class="js-example-basic-single dropdownlist custom-select custom-select-lg" 
                                        id="campoeta" name="eta">
                                    <option value=''>Età</option>
                                    <option value='10-14'>10-14</option>
                                    <option value='15-19'>15-19</option>
                                    <option value='20-24'>20-24</option>
                                    <option value='25-29'>25-29</option>
                                    <option value='30-34'>30-34</option>
                                    <option value='35-39'>35-39</option>
                                    <option value='40-44'>40-44</option>
                                    <option value='45-49'>45-49</option>
                                    <option value='50-54'>50-54</option>
                                    <option value='55-59'>55-59</option>
                                    <option value='60-64'>60-64</option>
                                    <option value='65-69'>65-69</option>
                                    <option value='70-74'>70-74</option>
                                    <option value='75-79'>75-79</option>
                                    <option value='80-84'>80-84</option>
                                    <option value='85-89'>85-89</option>
                                    <option value='90-94'>90-94</option>
                                    <option value='95-99'>95-99</option>
                                    <option value='100+'>100+</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="campocittadinanza">Cittadinanza</label>
                                    <select 
                                    title="Scegli una opzione"
                                    data-live-search="true" 
                                    data-live-search-placeholder="Cerca opzioni" 
                                    class="js-example-basic-single dropdownlist custom-select custom-select-lg" 
                                    id="campocittadinanza" 
                                    name="cittadinanza">
                                            <option value="">Prima Nazionalità</option>
                                            <?php
                                   
                                            foreach ($countries as $country){

                                            ?>
                                                <option value="<?php echo $country['Code']; ?>"><?php echo $country['Name']; ?></option>
                                            <?php }?>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="campoistruzione">Grado di istruzione</label>
                                <select 
                                class="js-example-basic-single dropdownlist custom-select custom-select-lg" 
                                id="campoistruzione" name="istruzione">
                                    <option value="" class='default'>Grado di istruzione</option>
                                    <option value="Diploma di scuola elementare">Diploma di scuola elementare</option>
                                    <option value="Diploma di scuola media">Diploma di scuola media</option>
                                    <option value="Diploma di scuola superiore">Diploma di scuola superiore</option>
                                    <option value="Diploma di laurea">Diploma di laurea</option>
                                    <option value="Dottorato di ricerca">Dottorato di ricerca</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="campoprofessione">Professione</label>
                                <select 
                                class="js-example-basic-single dropdownlist custom-select custom-select-lg" 
                                id="campoprofessione" name="professione">
                                    <option value="" class='default'>Professione</option>
                                    <option value="dirigente">Dirigente</option>
                                    <option value="quadro">Quadro</option>
                                    <option value="impiegato">Impiegato</option>
                                    <option value="operaio">Operaio</option>
                                    <option value="apprendista">Apprendista</option>
                                    <option value="indipendente">Lavoratore indipendente</option>
                                    <option value="disoccupato">Disoccupato</option>
                                    <option value="studente">Studente</option>
                                    <option value="insegnante">Insegnante</option>
                                    <option value="altro">Altro</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="campoareapolitica">Area Politica</label>
                                <select 
                                class="js-example-basic-single dropdownlist custom-select custom-select-lg" 
                                id="campoareapolitica" name="areapolitica">
                                    <option value="" class='default'>Area politica</option>
                                    <option value="Nessuna">Nessuna</option>
                                    <option value="Sinistra">Sinistra</option>
                                    <option value="Centro_Sinistra">Centro-Sinistra</option>
                                    <option value="Centro">Centro</option>
                                    <option value="Centro_Destra">Centro-Destra</option>
                                    <option value="Destra">Destra</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="campocap">CAP</label>
                                    <select 
                                    title="Scegli una opzione"
                                    data-live-search="true" 
                                    data-live-search-placeholder="Cerca opzioni" 
                                    class="js-example-basic-single dropdownlist custom-select custom-select-lg" 
                                    id="campocap" 
                                    name="cap">
                                            <option value="">CAP</option>
                                            <?php
                                   
                                            foreach ($cap as $c){

                                            ?>
                                                <option value="<?php echo $c['code']; ?>"><?php echo $c['code']; ?></option>
                                            <?php }?>
                                    </select>
                            </div>
                            <!--<div class="form-group">
                                <label for="camponote">Note</label>
                                <textarea name="note" class="form-control" id="camponote" rows="3"></textarea>
                            </div>-->

                            <button type="submit" class="red-background-white-border btn btn-primary">Invia</button>
                        </form>



                </div>

            </div>
        </div>
       
        <?php include("include/footer.php") ?>


    </body>
    </html>
<?php
    }
?>