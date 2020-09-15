<?php

function quicksort($A, $izq, $der )
    {
        $i = $izq;
        $j = $der;
        $x = $A[ ($izq + $der) /2 ];
    do{
        while( ($A[$i] < $x) && ($j <= $der) )
        {
            $i++;
        }
 
        while( ($x < $A[$j]) && ($j > $izq) )
        {
            $j--;
        }
 
        if( $i <= $j )
        {
            $aux = $A[$i]; $A[$i] = $A[$j]; $A[$j] = $aux;
            $i++;  $j--;
        }
 
    }while( $i <= $j );
 
    if( $izq < $j )
        quicksort( $A, $izq, $j );
    if( $i < $der )
        quicksort( $A, $i, $der );
 
        return $A;
    }
