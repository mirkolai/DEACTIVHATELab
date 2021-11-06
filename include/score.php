<?php  if (isset($test)){ ?>
                        <svg id="fillgauge1" width="97%" height="200"></svg>
						<script type="text/javascript">



							function show_score(){
							   d3.select("#fillgauge1").call(d3.liquidfillgauge, <?php echo intval($punteggio['punteggio_macchina']*100); ?>, {
									circleColor: "#343a40",
									textColor: "#343a40",
									waveTextColor: "#FFFFFF",
									waveColor: "#c60000",
									circleThickness: 0.1,
									textVertPosition: 0.2,
									waveAnimateTime: 1000,
									backgroundColor: "#FFFFFF",
									valueCountUpAtStart: false,
									waveRiseAtStart: false
								});

							   /*d3.select("#fillgauge2").call(d3.liquidfillgauge, <?php //echo intval($punteggio['punteggio_uomo']*100); ?>, {
									circleColor: "#343a40",
									textColor: "#343a40",
									waveTextColor: "#FFFFFF",
									waveColor: "#c60000",
									circleThickness: 0.1,
									textVertPosition: 0.2,
									waveAnimateTime: 1000,
									backgroundColor: "#FFFFFF",
									valueCountUpAtStart: false,
									waveRiseAtStart: false
									});*/ 
								}; 

						</script>


<?php
} else {

?>
<div class="card mb-4 box-shadow m-3 p-0">

    <div class="container-fluid">


        <div class="row">
			<div class="col-3 col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-3">
            </div>

            <div class="col-6 col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-6">
                <div class="card mb-4 box-shadow ">
                    <div class="card-header">
                        <span class="my-0 font-weight-normal h4">Confronto con sistema automatico</span>
                        <div class="circle red-background-white-border p-0 pt-1">
                                    <a href="#" data-toggle="tooltip" title="La percentuale delle volte che la tua valutazione ha coinciso con quella del nostro sistema automatico">
                                        i
                                    </a>
                        </div>
                    </div>
                    <div class="card pt-3 pl-3 pr-3 pb-3" style="background-image: url('<?php echo $base_url;?>/img/computer.jpg');   background-position: center;    background-repeat: repeat;">
                        <svg id="fillgauge1" width="97%" height="200"></svg>
                    </div>
                </div>
            </div>
            <!--<div class="col-6 col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-6">
                <div class="card mb-4 box-shadow ">
                    <div class="card-header">
                        <div>
                            <span class="my-0 font-weight-normal h4">Confronto con altri utenti</span>
                            <div class="circle red-background-white-border p-0 pt-1">
                                        <a href="#" data-toggle="tooltip" title="La percentuale delle volte che la tua valutazione ha coinciso con quella degli altri utenti della nostra piattaforma">
                                            i
                                        </a>
                            </div>
                        </div>
                    </div>
                    <div class="card pt-3 pl-3 pr-3 pb-3" style="background-image: url('<?php echo $base_url;?>/img/peoples.jpg');   background-position: center;    background-repeat: repeat;">
                           <svg id="fillgauge2" width="97%" height="200"></svg>
                    </div>
                </div>
            </div>-->
        </div>

    </div>
	
	    <script type="text/javascript">



        function show_score(){
           d3.select("#fillgauge1").call(d3.liquidfillgauge, <?php echo intval($punteggio['punteggio_macchina']*100); ?>, {
                circleColor: "#343a40",
                textColor: "#343a40",
                waveTextColor: "#FFFFFF",
                waveColor: "#c60000",
                circleThickness: 0.1,
                textVertPosition: 0.2,
                waveAnimateTime: 1000,
                backgroundColor: "#FFFFFF",
                valueCountUpAtStart: false,
                waveRiseAtStart: false
            });
            
           /*d3.select("#fillgauge2").call(d3.liquidfillgauge, <?php //echo intval($punteggio['punteggio_uomo']*100); ?>, {
                circleColor: "#343a40",
                textColor: "#343a40",
                waveTextColor: "#FFFFFF",
                waveColor: "#c60000",
                circleThickness: 0.1,
                textVertPosition: 0.2,
                waveAnimateTime: 1000,
                backgroundColor: "#FFFFFF",
                valueCountUpAtStart: false,
                waveRiseAtStart: false
                });*/ 
            }; 

    </script>




</div>
<?php
	 }

?>
