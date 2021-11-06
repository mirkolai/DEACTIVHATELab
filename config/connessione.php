<?php

$connessione = mysqli_connect($server,$user,$password,$database);
mysqli_set_charset($connessione,"utf8mb4");

if(!$connessione) {

    header("Location:error.php?message=Errore imprevisto");
    #die("Errore nella connessione: " . mysqli_connect_error());
}

function inserisci_nuovo_accesso($uniqid,$server,$user,$password,$database){
    $connessione = mysqli_connect($server,$user,$password,$database);
    mysqli_set_charset($connessione,"utf8mb4");
    
    if(!$connessione) {
    
        header("Location:error.php?message=Errore imprevisto");
        #die("Errore nella connessione: " . mysqli_connect_error());  
         
     }
    
    $query = "INSERT INTO `_accessi`(`user_id`) VALUES ('$uniqid') ";

    $result = mysqli_query($connessione, $query) or die (
        header("Location:error.php?message=Errore imprevisto nuov accesso"));
    #mysqli_error($connessione));

    mysqli_close($connessione);
}


function inserisci_nuovo_accesso_tramite_mail($uniqid,$email,$server,$user,$password,$database){
    $connessione = mysqli_connect($server,$user,$password,$database);
    mysqli_set_charset($connessione,"utf8mb4");
    $hashemail=hash('md5', $email);
    if(!$connessione) {
    
        #header("Location:error.php?message=Errore imprevisto");
        die("Errore nella connessione: " . mysqli_connect_error());
    }
    
    $query = "INSERT INTO `_user`(`user_id`, `hash_mail`) 
    VALUES ('$uniqid','$hashemail') ";
    $result = mysqli_query($connessione, $query) or die (
        header("Location:error.php?message=Errore imprevisto accesso con email"));
        #mysqli_error($connessione));

    mysqli_close($connessione);
}

function verifica_accesso_tramite_mail($email,$server,$user,$password,$database){

    $connessione = mysqli_connect($server,$user,$password,$database);
    mysqli_set_charset($connessione,"utf8mb4");
    
    $hashemail=hash('md5', $email);

    if(!$connessione) {
        #header("Location:error.php?message=Errore imprevisto");
        die("Errore nella connessione: " . mysqli_connect_error());  
    }
    
    $query = "SELECT user_id FROM `_user` WHERE hash_mail='$hashemail' ";
    $result = mysqli_query($connessione, $query) or die (
        header("Location:error.php?message=Errore imprevisto accesso con email"));
        #mysqli_error($connessione));
   
    if(mysqli_num_rows($result)==1){
        $result=mysqli_fetch_assoc($result);

        $result=$result['user_id'];
    }else{
        $result=null;
    }

    mysqli_close($connessione);

    return $result; 

}

function restituisci_survey_completato($uniqid,$server,$user,$password,$database){

    $connessione = mysqli_connect($server,$user,$password,$database);
    mysqli_set_charset($connessione,"utf8mb4");
    
    if(!$connessione) {
    
    
        header("Location:error.php?message=Errore imprevisto");
        #die("Errore nella connessione: " . mysqli_connect_error());  
   }
    
    $query = "SELECT count(*) as number FROM `_survey` WHERE user_id='$uniqid' ";
    $result = mysqli_query($connessione, $query) or die (header("Location:error.php?message=Errore imprevisto ricerca questionario"));#mysqli_error($connessione));
   
    $result=mysqli_fetch_assoc($result);
    $result=$result['number'];

    mysqli_close($connessione);

    if ($result>0)
        return true; 
    else
        return false; 
        
}

function restituisci_nazioni($server,$user,$password,$database){

    $connessione = mysqli_connect($server,$user,$password,$database);
    mysqli_set_charset($connessione,"utf8mb4");
    
    if(!$connessione) {
    
    
        header("Location:error.php?message=Errore imprevisto");
        #die("Errore nella connessione: " . mysqli_connect_error());  
    }
    
    $query = "SELECT Code, Name FROM `_country` ";
    $result = mysqli_query($connessione, $query) or die (header("Location:error.php?message=Errore imprevisto recupero città"));#mysqli_error($connessione));
   
    $countries=[];
    while($row=mysqli_fetch_assoc($result)){

        $countries[]=$row;

    }

    mysqli_close($connessione);


    return $countries; 

}

function restituisci_cap($server,$user,$password,$database){

    $connessione = mysqli_connect($server,$user,$password,$database);
    mysqli_set_charset($connessione,"utf8mb4");
    
    if(!$connessione) {
    
    
        header("Location:error.php?message=Errore imprevisto connesione db");
        #die("Errore nella connessione: " . mysqli_connect_error());  
    }
    
    $query = "SELECT code FROM `_cap` ";
    $result = mysqli_query($connessione, $query) or die (header("Location:error.php?message=Errore imprevisto recupero CAP"));#mysqli_error($connessione));
   
    $countries=[];
    while($row=mysqli_fetch_assoc($result)){

        $countries[]=$row;

    }

    mysqli_close($connessione);


    return $countries; 

}

function restituisci_sessioni_completate($uniqid,$server,$user,$password,$database){

    $connessione = mysqli_connect($server,$user,$password,$database);
    mysqli_set_charset($connessione,"utf8mb4");
    
    if(!$connessione) {
    
    
        header("Location:error.php?message=Errore imprevisto");
        #die("Errore nella connessione: " . mysqli_connect_error());  
    }
    
    $query = "SELECT count(*) as number FROM `_sessioni` WHERE user_id='$uniqid' ";
    $result = mysqli_query($connessione, $query) or die (header("Location:error.php?message=Errore imprevisto sessioni completate"));#mysqli_error($connessione));
   
    $result=mysqli_fetch_assoc($result);
    $result=$result['number'];

    mysqli_close($connessione);


    return $result; 

}

function restituisci_accessi($uniqid,$server,$user,$password,$database){

    $connessione = mysqli_connect($server,$user,$password,$database);
    mysqli_set_charset($connessione,"utf8mb4");
    
    if(!$connessione) {
    
    
        header("Location:error.php?message=Errore imprevisto connessione db");
        #die("Errore nella connessione: " . mysqli_connect_error());  
    }
    
    $query = "SELECT count(*) as number FROM `_accessi` WHERE user_id='$uniqid' ";
    $result = mysqli_query($connessione, $query) or die (header("Location:error.php?message=Errore imprevisto"));#mysqli_error($connessione));
   
    $result=mysqli_fetch_assoc($result);
    $result=$result['number'];

    mysqli_close($connessione);


    return $result; 

}

function restituisci_ultimo_accesso($uniqid,$server,$user,$password,$database){

    $connessione = mysqli_connect($server,$user,$password,$database);
    mysqli_set_charset($connessione,"utf8mb4");
    
    if(!$connessione) {
    
    
        header("Location:error.php?message=Errore imprevisto");
        #die("Errore nella connessione: " . mysqli_connect_error());  
    }
    
    $query = "SELECT data FROM `_accessi` WHERE user_id='$uniqid' order by data desc limit 1,1";
    $result = mysqli_query($connessione, $query) or die (header("Location:error.php?message=Errore imprevisto recupero ultimo accesso"));#mysqli_error($connessione));
   

    if (mysqli_num_rows($result) > 0) {
        $result=mysqli_fetch_assoc($result);

        $result=$result['data'];
    } else {
        $result=NULL;
    }

    mysqli_close($connessione);

    return $result; 

}


function restituisci_punteggio_totale($uniqid,$server,$user,$password,$database){

    $connessione = mysqli_connect($server,$user,$password,$database);
    mysqli_set_charset($connessione,"utf8mb4");
    
    if(!$connessione) {
    
    
        header("Location:error.php?message=Errore imprevisto");
        #die("Errore nella connessione: " . mysqli_connect_error());  
    }
    
    $query = "SELECT avg(affidabilita) punteggio  FROM `_sessioni` where user_id = '$uniqid'  
    UNION all
    SELECT avg(agreement_macchina) punteggio FROM `_sessioni` where user_id = '$uniqid' ";
    
    $result = mysqli_query($connessione, $query) or die (header("Location:error.php?message=Errore imprevisto calcolo punteggio"));#mysqli_error($connessione));
   
    $result_return=[];
    if (mysqli_num_rows($result) == 2) {
        $row=mysqli_fetch_assoc($result);
        $result_return["punteggio_uomo"]= $row['punteggio'];
        $row=mysqli_fetch_assoc($result);
        $result_return["punteggio_macchina"]= $row['punteggio'];

    } else {
        $result_return=NULL;
    }

    mysqli_close($connessione);

    return $result_return; 

}



function restituisci_istanze_test($uniqid,$server,$user,$password,$database){

    $connessione = mysqli_connect($server,$user,$password,$database);
    mysqli_set_charset($connessione,"utf8mb4");
    
    if(!$connessione) {
    
    
        header("Location:error.php?message=Errore imprevisto");
        #die("Errore nella connessione: " . mysqli_connect_error());  
    }

    $result_yes=[];
    $query = "SELECT `id`, `text`, `hs` FROM `tweet_test` where hs='yes' order by rand() limit 0";
    $result = mysqli_query($connessione, $query) or die (header("Location:error.php?message=Errore imprevisto resupero test"));#mysqli_error($connessione));
    while($row = mysqli_fetch_assoc($result)) {
        $row['text']=preg_replace('/@[a-zA-Z0-9\_]{1,}/', '[@utente]',$row['text']);
        $row['text']=preg_replace('/((((http|https):\/\/)|(www\.))[\/\-a-zA-Z0-9@:%._\+~#=\?]{2,256})/', '[link]',$row['text']);

        $row['type']="labeled";
        $row['done']=0;
        $result_yes[]=$row;
    }

    $result_no=[];
    $query = "SELECT `id`, `text`, `hs` FROM `tweet_test` where hs='no' order by rand() limit 0";
    $result = mysqli_query($connessione, $query) or die (header("Location:error.php?message=Errore imprevisto recupero test"));#mysqli_error($connessione));
    while($row = mysqli_fetch_assoc($result)) {
        $row['text']=preg_replace('/@[a-zA-Z0-9\_]{1,}/', '[@utente]',$row['text']);
        $row['text']=preg_replace('/((((http|https):\/\/)|(www\.))[\/\-a-zA-Z0-9@:%._\+~#=\?]{2,256})/', '[link]',$row['text']);
        $row['type']="labeled";
        $row['done']=0;
        $result_no[]=$row;
    }

    mysqli_close($connessione);

    $result=array_merge($result_yes,$result_no);

    return $result; 

}



function restituisci_istanze($uniqid,$server,$user,$password,$database){


    $connessione = mysqli_connect($server,$user,$password,$database);
    mysqli_set_charset($connessione,"utf8mb4");
    
    if(!$connessione) {
    
    
        header("Location:error.php?message=Errore imprevisto");
        #die("Errore nella connessione: " . mysqli_connect_error());  
                 
    }

    $result_yes=[];
    $query = "SELECT `id`, `text`, `hs` FROM `tweets` 
    where hs='yes' 
    and annotatori < $GLOBALS[aiutaci_numero_annotazioni_richieste]
    and id not in (select distinct tweet_id from _annotazioni where user_id='$uniqid')
	order by rand()
	limit 100";

    $result = mysqli_query($connessione, $query) or die (header("Location:error.php?message=Errore imprevisto recupero tweet"));#mysqli_error($connessione));
    while($row = mysqli_fetch_assoc($result)) {
        $row['text']=preg_replace('/@[a-zA-Z0-9\_]{1,}/', '[@utente]',$row['text']);
        $row['text']=preg_replace('/((((http|https):\/\/)|(www\.))[\/\-a-zA-Z0-9@:%._\+~#=\?]{2,256})/', '[link]',$row['text']);
        $row['type']="unlabeled";
        $row['done']=0;
        $result_yes[]=$row;
    }

    $result_yes=array_slice($result_yes, 0, 7);

    $result_no=[];
    $query = "SELECT `id`, `text`, `hs` FROM `tweets` 
    where hs='no' 
    and annotatori < $GLOBALS[aiutaci_numero_annotazioni_richieste]
    and id not in (select distinct tweet_id from _annotazioni where user_id='$uniqid')
    order by annotatori desc limit 100";
    $result = mysqli_query($connessione, $query) or die (header("Location:error.php?message=Errore imprevisto recupero tweet"));#mysqli_error($connessione));
    while($row = mysqli_fetch_assoc($result)) {
        $row['text']=preg_replace('/@[a-zA-Z0-9\_]{1,}/', '[@utente]',$row['text']);
        $row['text']=preg_replace('/((((http|https):\/\/)|(www\.))[\/\-a-zA-Z0-9@:%._\+~#=\?]{2,256})/', '[link]',$row['text']);
        $row['type']="unlabeled";
        $row['done']=0;
        $result_no[]=$row;
    }

    $result_no=array_slice($result_no, 0, 8);

    mysqli_close($connessione);

    $result=array_merge($result_yes,$result_no);


    shuffle($result);
    //print_r($result);
    return $result; 

}



function inserisci_istanze_temp($user_id,$tweet_id,$hs,$dimensione_1,$dimensione_2,$dimensione_3,$server,$user,$password,$database){


    $connessione = mysqli_connect($server,$user,$password,$database);
    mysqli_set_charset($connessione,"utf8mb4");
    
    if(!$connessione) {
    
    
        header("Location:error.php?message=Errore imprevisto connessione DB");
        #die("Errore nella connessione: " . mysqli_connect_error());  
    
    }

    $result_yes=[];
    $query = "INSERT INTO `_annotazioni_temp`
    (`tweet_id`, `user_id`, `hs`,dimensione_1,dimensione_2,dimensione_3) 
    VALUES 
    ('$tweet_id','$user_id','$hs','$dimensione_1','$dimensione_2','$dimensione_3')";

    $result = mysqli_query($connessione, $query) or die (header("Location:error.php?message=Errore imprevisto inserimento annotazionie temp"));
    
    return $result; 

}

function inserisci_istanze($user_id,$tweet_id,$hs,$dimensione_1,$dimensione_2,$dimensione_3,$sessione_id,$server,$user,$password,$database){


    $connessione = mysqli_connect($server,$user,$password,$database);
    mysqli_set_charset($connessione,"utf8mb4");
    
    if(!$connessione) {
    
    
        header("Location:error.php?message=Errore imprevisto connessione DB");
        #die("Errore nella connessione: " . mysqli_connect_error());  
         
    }

    $query = "INSERT INTO `_annotazioni`
    (`tweet_id`, `user_id`, `hs`,dimensione_1,dimensione_2,dimensione_3,`sessione_id`) 
    VALUES 
    ('$tweet_id','$user_id','$hs','$dimensione_1','$dimensione_2','$dimensione_3','$sessione_id')";

    $result = mysqli_query($connessione, $query);// or die (header("Location:error.php?message=Errore imprevisto"));
    
    $query = "UPDATE `tweets` SET `annotatori`= `annotatori`+1 WHERE `id`='$tweet_id'";
    
    $result = mysqli_query($connessione, $query) or die (header("Location:error.php?message=Errore imprevisto inserimento annotazione"));
   
    return $result; 

}



function inserisci_sessione($user_id,$sessione_id,$affidabilita,$agreement_macchina,$server,$user,$password,$database){


    $connessione = mysqli_connect($server,$user,$password,$database);
    mysqli_set_charset($connessione,"utf8mb4");
    
    if(!$connessione) {
    
    
        header("Location:error.php?message=Errore imprevisto connessione db");
        #die("Errore nella connessione: " . mysqli_connect_error());  
         
    }

    $result_yes=[];
    $query = "INSERT INTO 
    `_sessioni`(`sessione_id`, `user_id`, `affidabilita`,`agreement_macchina`) 
    VALUES 
    ('$sessione_id','$user_id',0,$agreement_macchina)";//$affidabilita,$agreement_macchina)";
    
    $result = mysqli_query($connessione, $query) or die (header("Location:error.php?message=Errore imprevisto Inserimento Sessione"));#mysqli_error($connessione));
    
    return $result; 

}

function inserisci_survey(
    $uniqid,
    $campogenere,
    $campoeta,
    $campocittadinanza,
    $campoistruzione,
    $campoprofessione,
    $campoareapolitica,
    $campocap,
    $camponote,  
    $server,$user,$password,$database){

    $connessione = mysqli_connect($server,$user,$password,$database);
    mysqli_set_charset($connessione,"utf8mb4");
    
    if(!$connessione) {
    
    
        header("Location:error.php?message=Errore imprevisto");
        #die("Errore nella connessione: " . mysqli_connect_error());  
         
    }

    $query = "INSERT INTO `_survey`
    (`user_id`, `genere`, `eta`, `cittadinanza`, `istruzione`, `professione`, `area_politica`, `CAP`, `note`)
    VALUES
    ('$uniqid','$campogenere','$campoeta','$campocittadinanza','$campoistruzione','$campoprofessione','$campoareapolitica','$campocap','$camponote')";
    
    echo $query;

    $result = mysqli_query($connessione, $query) or die (header("Location:error.php?message=Errore imprevisto"));#mysqli_error($connessione));
    
    print_r($result);

    return $result; 

}



function restituisci_annotazioni_fatte($uniqid,$server,$user,$password,$database){


    $connessione = mysqli_connect($server,$user,$password,$database);
    mysqli_set_charset($connessione,"utf8mb4");
    
    if(!$connessione) {
    
    
        header("Location:error.php?message=Errore imprevisto");
        #die("Errore nella connessione: " . mysqli_connect_error());  
                 
    }

    $clear_result=[];
    $query = "SELECT a.tweet_id, t.text,sum(if(a.hs=-1,1,0)) \"-1\",sum(if(a.hs=0,1,0)) \"0\",sum(if(a.hs=1,1,0)) \"1\",sum(if(a.hs=2,1,0)) \"2\",sum(if(a.hs=3,1,0)) \"3\",sum(if(a.hs=4,1,0)) \"4\",sum(if(a.hs=5,1,0)) \"5\",sum(if(a.hs=6,1,0)) \"6\",sum(if(a.hs=7,1,0)) \"7\",sum(if(a.dimensione_1=\"YES\",1,0)) \"Ironia/sarcasmo/humor: si\",sum(if(a.dimensione_1=\"NO\",1,0)) \"Ironia/sarcasmo/humor: no\",sum(if(a.dimensione_2=\"YES\",1,0)) \"offensività: si\",sum(if(a.dimensione_2=\"NO\",1,0)) \"offensività: no\",sum(if(a.dimensione_3=\"YES\",1,0)) \"stereotipo: si\",sum(if(a.dimensione_3=\"NO\",1,0)) \"stereotipo: no\",sum(1) `totale annotazioni` FROM `_annotazioni` a join tweets t on t.id=a.tweet_id where t.id in (select tweet_id from `_annotazioni` where user_id = '$uniqid') group by t.id order by `totale annotazioni` desc";
//print_r($query);
    $result = mysqli_query($connessione, $query) or die (header("Location:error.php?message=Errore imprevisto recupero tweet"));#mysqli_error($connessione));
    while($row = mysqli_fetch_assoc($result)) {
        $row['text']=preg_replace('/@[a-zA-Z0-9\_]{1,}/', '[@utente]',$row['text']);
        $row['text']=preg_replace('/((((http|https):\/\/)|(www\.))[\/\-a-zA-Z0-9@:%._\+~#=\?]{2,256})/', '[link]',$row['text']);
       
        $clear_result[]=$row;
    }

   
    mysqli_close($connessione);


    return $clear_result; 

}


function restituisci_annotazioni_fatte_da_tutti($uniqid,$server,$user,$password,$database){


    $connessione = mysqli_connect($server,$user,$password,$database);
    mysqli_set_charset($connessione,"utf8mb4");
    
    if(!$connessione) {
    
    
        header("Location:error.php?message=Errore imprevisto");
        #die("Errore nella connessione: " . mysqli_connect_error());  
                 
    }

    $clear_result=[];
    $query = "SELECT a.tweet_id, t.text,sum(if(a.hs=-1,1,0)) \"-1\",sum(if(a.hs=0,1,0)) \"0\",sum(if(a.hs=1,1,0)) \"1\",sum(if(a.hs=2,1,0)) \"2\",sum(if(a.hs=3,1,0)) \"3\",sum(if(a.hs=4,1,0)) \"4\",sum(if(a.hs=5,1,0)) \"5\",sum(if(a.hs=6,1,0)) \"6\",sum(if(a.hs=7,1,0)) \"7\",sum(if(a.dimensione_1=\"YES\",1,0)) \"Ironia/sarcasmo/humor: si\",sum(if(a.dimensione_1=\"NO\",1,0)) \"Ironia/sarcasmo/humor: no\",sum(if(a.dimensione_2=\"YES\",1,0)) \"offensività: si\",sum(if(a.dimensione_2=\"NO\",1,0)) \"offensività: no\",sum(if(a.dimensione_3=\"YES\",1,0)) \"stereotipo: si\",sum(if(a.dimensione_3=\"NO\",1,0)) \"stereotipo: no\",sum(1) `totale annotazioni` FROM `_annotazioni` a join tweets t on t.id=a.tweet_id  group by t.id order by `totale annotazioni` desc";
//print_r($query);
    $result = mysqli_query($connessione, $query) or die (header("Location:error.php?message=Errore imprevisto recupero tweet"));#mysqli_error($connessione));
    while($row = mysqli_fetch_assoc($result)) {
        $row['text']=preg_replace('/@[a-zA-Z0-9\_]{1,}/', '[@utente]',$row['text']);
        $row['text']=preg_replace('/((((http|https):\/\/)|(www\.))[\/\-a-zA-Z0-9@:%._\+~#=\?]{2,256})/', '[link]',$row['text']);
       
        $clear_result[]=$row;
    }

   
    mysqli_close($connessione);


    return $clear_result; 

}


?>
