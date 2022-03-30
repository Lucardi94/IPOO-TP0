<?php

    function calcularFactorial ($n){
        /**
         * Dado un número N retornar su factorial. 
         */
        $acum=1;
        for($i=2;$i<=$n;$i++){      // A partir de 2 porque 1*1=1
            $acum*=$i;              // Va almacenando el factorial
        }
        return $acum;
    }

    function esPar($n){
        /**
         * Dado un número N retornar verdadero si el número es par y falso en caso contrario.
         */
        if ($n%2==0){
            return true;
        } else return false;
    }

    function esDivisible($n,$m){
        /**
         * Dado dos números N y M retornar verdadero si el número N es divisible por M y falso en caso contrario. 
         */
        if ($n%$m==0){
            return true;
        } else return false;
    }

    function minimoMayor($listaNum){
        /**
         * Dada un arreglo de números enteros, determinar los valores máximo y mínimo, y las posiciones en que éstos se encontraban en el arreglo.
         * Retorna un arreglo indexado con cada posicion
         */
        $min = 0;
        $max = 0;
        $i = 1;
        while ($i<count($listaNum)){
            if ($listaNum[$i]<$listaNum[$min]){
                $min=$i;
            }
            if ($listaNum[$i]>$listaNum[$max]){
                $max=$i;
            }
            $i++;
        }
        return array ("maximo"=>$max, "minimo"=>$min);
    }