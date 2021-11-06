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

						                                  $istanze=restituisci_annotazioni_fatte($_SESSION['aiutaci_uniqid'],$server,$user,$password,$database);


	if(count( $istanze)>0){
        
        
?>


<!DOCTYPE html>
    <html lang="en">
    <?php include("include/head.php") ?>
    <body  class="index" onload="twemoji.parse(document.body);">


        <?php include("include/header.php") ?>

 	<table style="border:1px solid black;" class="m-3">
			  <tr style="border:1px solid black;">
		  <th>Testo del Tweet</th>
		  <th>Totale Annotazioni</th>
		  <th>Assenza di hate speech</th>
		  <th>Livello di hate speech 1</th>
		  <th>Livello di hate speech 2</th>
		  <th>Livello di hate speech 3</th>
		  <th>Livello di hate speech 4</th>
		  <th>Livello di hate speech 5</th>
		  <th>Livello di hate speech 6</th>
		  <th>Livello di hate speech 7</th>
		  <th>Out-off topic</th>
				  <th></th>
		  <th>Ironia/Sarcasmo/Humor Presente</th>
		  <th>Ironia/Sarcasmo/Humor Assente</th>
		  <th>Offensività Presente</th>
		  <th>Offensività Assente</th>
		  <th>Stereotipo Presente</th>
		  <th>Stereotipo Assente</th>
		
	</tr>
		<?php 
			foreach($istanze as $istanza){  ?>

      <tr style="border:1px solid black;">
		<td width="25%">
			<span id='tweet-<?php echo $istanza['id'];?>'> <?php echo 	html_entity_decode(htmlspecialchars(highlight($istanza['text']), ENT_NOQUOTES, "UTF-8")); ?></span>
		</td>
		  <td class="">
			  <?php echo $istanza['totale annotazioni'];?>
		  </td>
		  <td class="value-0">
			  <?php echo $istanza['0']; echo "<br>(".round($istanza['0']/$istanza['totale annotazioni']*100,2)."%)"; ?>

		  </td>
		  <td class="value-1">
			  <?php echo $istanza['1']; echo "<br>(".round($istanza['1']/$istanza['totale annotazioni']*100,2)."%)"; ?>		  </td>
		  <td class="value-2">
			 <?php echo $istanza['2']; echo "<br>(".round($istanza['2']/$istanza['totale annotazioni']*100,2)."%)"; ?>
		  </td>
		  <td class="value-3">
			  <?php echo $istanza['3']; echo "<br>(".round($istanza['3']/$istanza['totale annotazioni']*100,2)."%)"; ?>		  </td>
		  <td class="value-4">
			  <?php echo $istanza['4']; echo "<br>(".round($istanza['4']/$istanza['totale annotazioni']*100,2)."%)"; ?>		  </td>
		  <td class="value-5">
			  <?php echo $istanza['5']; echo "<br>(".round($istanza['5']/$istanza['totale annotazioni']*100,2)."%)"; ?>		  </td>
		  <td class="value-6">
			  <?php echo $istanza['6']; echo "<br>(".round($istanza['6']/$istanza['totale annotazioni']*100,2)."%)"; ?>		  </td>
		  <td class="value-7">
			  <?php echo $istanza['7']; echo "<br>(".round($istanza['7']/$istanza['totale annotazioni']*100,2)."%)"; ?>		  </td>
		  <td class="value-out">
			  <?php echo $istanza['-1']; echo "<br>(".round($istanza['-1']/$istanza['totale annotazioni']*100,2)."%)"; ?>		  </td>
		  <td>
		  </td>
		  <td class="value-6">
			  <?php echo $istanza['Ironia/sarcasmo/humor: si']; echo "<br>(".round($istanza['Ironia/sarcasmo/humor: si']/$istanza['totale annotazioni']*100,2)."%)"; ?>			  </td>
		  <td class="">
			  <?php echo $istanza['Ironia/sarcasmo/humor: no']; echo "<br>(".round($istanza['Ironia/sarcasmo/humor: no']/$istanza['totale annotazioni']*100,2)."%)"; ?>		  </td>  
		<td class="value-6">
			  <?php echo $istanza['offensività: si']; echo "<br>(".round($istanza['offensività: si']/$istanza['totale annotazioni']*100,2)."%)"; ?>	
		  </td>
		  <td class="">
			  <?php echo $istanza['offensività: no']; echo "<br>(".round($istanza['offensività: no']/$istanza['totale annotazioni']*100,2)."%)"; ?>	
		  </td> 
		  <td class="value-6">
			  <?php echo $istanza['stereotipo: si']; echo "<br>(".round($istanza['stereotipo: si']/$istanza['totale annotazioni']*100,2)."%)"; ?>			  </td>
		  <td class="">
			  <?php echo $istanza['stereotipo: no']; echo "<br>(".round($istanza['stereotipo: no']/$istanza['totale annotazioni']*100,2)."%)"; ?>	
		  </td>    
	 </tr>
               

<?php
										  
    }
?>
 	</table>


<?php } else {  ?>
<!DOCTYPE html>
    <html lang="en">
    <?php include("include/head.php") ?>
    <body  class="index" onload="twemoji.parse(document.body);">


        <?php include("include/header.php") ?>

								<div class="card mb-4 box-shadow">
									<div class="card-header">
										<h4 class="my-0 font-weight-normal">Non hai annotato ancota nessun tweet</h4>
									</div>
									<div class="card p-3">
										<div class="mb-2">
											Vai alla dashboard
										</div>
										<a class="btn-custom-login-cookie btn btn-lg btn-block btn-primary mt-auto mb-2"
										href="<?php echo $base_url."home.php"; ?>">
												Dashboard
										</a>
									</div>
								</div>
		        <?php include("include/footer.php") ?>


        </body>
        </html>		
				
<?php	}?>






        <?php include("include/footer.php") ?>


        </body>
        </html>






<?php
    }
?>