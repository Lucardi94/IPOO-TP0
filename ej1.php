<?php
    /**
    * Dado un número N retornar su factorial. 
    */
    echo "Ingrese un numero para N ";
    $N=trim(fgets(STDIN));
    $acum=1;
    echo $N."!=";               // Comienzo de la salida ej=4 "4!="
    for($i=1;$i<=$N;$i++){
        if ($i==$N){
            echo $i."=";        // Si es el ultimo muestre el ultimo numero a multiplicar con =. "...4="
        } else echo $i."*";     // Muestra el numero y prepara la salida del siguiente. "1*..."
        $acum*=$i;              // Va almacenando el factorial
    }
    echo $acum;                 // Muestra el resultado final del factorial