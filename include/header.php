<header class="bg-dark">

    <nav class="navbar " role="navigation" aria-label="main navigation">
        
        <?php include("include/notice.php") ?>

        <div class="nav-container container">
            <div class="navbar-brand">
                <a href="<?php echo $base_url."index.php"; ?>" class="navbar-item">
                    <img src="img/logo.png" alt="Logo"/>
                </a>
            </div>
            <div id="navbarBasicExample" class="navbar-menu">
                <div class="navbar-end is-lowercase">

                    <?php     if(isset($_SESSION['aiutaci_uniqid'])) { ?>
					    <a href="<?php echo $base_url."index.php"; ?>" class="navbar-item"> Home </a>  
										    <a href="<?php echo $base_url."my_agreement.php"; ?>" class="navbar-item"> Le mie annotazioni </a> 
                        <a href="<?php echo $base_url."home.php"; ?>" class="navbar-item"> La mia dashboard </a>  
                        <!--<?php     if(!restituisci_survey_completato($_SESSION['aiutaci_uniqid'],$server,$user,$password,$database)) { ?>
                            <a href="<?php echo $base_url."survey.php"; ?>" class="navbar-item"> Sondaggio <i class="far fa-square"></i> </a>  
                        <?php } ?>
                        <?php if(restituisci_survey_completato($_SESSION['aiutaci_uniqid'],$server,$user,$password,$database)) { ?>
                           <a> Sondaggio <i class="far fa-check-square"></i>  </a>
                        <?php } ?>-->
                        <!--<a href="<?php echo $base_url."logout.php"; ?>" class="navbar-item"> Cancella Sessioni </a>  -->
                    <?php     } else { ?>
                        <!--<a href="<?php echo $base_url."login.php"; ?>" class="navbar-item"> Accedi </a>  -->

                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>
</header>