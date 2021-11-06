<?php

function verify_valid_UUID($uuid){

    if (!is_string($uuid) ||
        (preg_match('/^[0-9a-f]{14}\.[0-9a-f]{8}$/', $uuid) == 0)) {
        return false;
    }else{
        return true;
    }

}



function calcola_punteggio($istanze_totali){
        
        $punteggio_vs_umani=0;
        $etichette_umani=0;
        $punteggio_VS_macchina=0;
        $etichette_macchina=0;

        foreach($istanze_totali as $istanza){
            if ($istanza['label']<=4) 
                $label= 'no';
            else 
                $label= 'yes';

            if($istanza['type']=='labeled'){
                $etichette_umani+=1;
                if($istanza['hs']==$label){
                    $punteggio_vs_umani+=1;
                }
            }
            if($istanza['type']=='unlabeled'){
                $etichette_macchina+=1;
                if($istanza['hs']==$label){
                    $punteggio_VS_macchina+=1;
                }
            }




        }


        /*echo "Punteggio macchina :".$punteggio_VS_macchina/$etichette_macchina;
        echo "$punteggio_VS_macchina/$etichette_macchina";

        echo "Punteggio umani :".$punteggio_vs_umani/$etichette_umani;
        echo "$punteggio_vs_umani/$etichette_umani";*/
        return ["punteggio_macchina" => $punteggio_VS_macchina/$etichette_macchina, "punteggio_umano" => $punteggio_vs_umani/$etichette_umani];
}