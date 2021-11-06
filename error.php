   <!DOCTYPE html>
    <html lang="en">
    <?php include("include/head.php") ?>
    <body  class="index" onLoad="initialize()">
        <?php include("include/notice.php") ?>

        <header class="bg-dark">

            <nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
                
                <?php include("include/notice.php") ?>

                <div class="nav-container container">
                    <div class="navbar-brand">
                        <a href="<?php echo $base_url."index.php"; ?>" class="navbar-item">
                            <img src="img/logo.png" alt="Logo"/>
                        </a>
                    </div>
                    <div id="navbarBasicExample" class="navbar-menu">
                        <div class="navbar-end is-lowercase">

                        
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="card mb-4 box-shadow m-3">
        
            <div class="card black-background error_message pt-3 pl-3 pr-3 pb-0">

                <h2>Ci scusiamo per il disagio! </h2>

                <h3>Si è verificato un errore imprevisto! </h3>

                <p><i class="fas fa-exclamation-triangle fa-10x"></i></p>

                <a class="red-background-white-border error_message btn btn-lg btn-block btn-primary mt-auto mb-3"
                   href="<?php echo $base_url."index.php"; ?>" >
                   Home             
                </a>
            </div>
        </div>            
        

        <?php include("include/footer.php") ?>


    </body>
    </html>



