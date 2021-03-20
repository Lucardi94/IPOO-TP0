<?php

function pregunta()
{
    /**
     * *
     * Funcion que retorna un booleano de modo de pregunta para hacer un ciclo interactivo al menu.
     */
    /* string resp */
    echo "¿Desea continuar? >> n << para salir\n";
    $resp = trim(fgets(STDIN));

    if ($resp == "n" || $resp == "N") {
        return false;
    } else
        return true;
}

function menu()
{
    /**
     * *
     * Retorna un entero como la opcion desea en el menu principal,
     */
    echo "1. Para ingresar una nueva variedad de vino\n2. Para mostrar cantidad de botellas y promedio de precio de cada tipo\n3. Mostrar todos los vinos de la coleccion";

    return trim(fgets(STDIN));
}

function preguntaTipo()
{
    /**
     * *
     * Retorna un entero con la variedad seleccionada, para el menu opcion 1.
     */
    echo "Que tipo de vino es 1.Malbec 2.Cabernet Sauvignon 3.Merlot";
    return trim(fgets(STDIN));
}

function cargarNuevoVinos($listVinos)
{
    /**
     * *
     * Ingresa la lista del tipo de vino seleccionado, igresan los nuevos datos por teclados y si este vino no existe (es decir, su variedad y año no deben coicidir con otro), lo
     * agrega en la lista.
     * Si este ya existe este le agrega la cantidad al stock.
     */
    /* boolean existe */
    /* int i */
    $newVino = array();
    echo "Ingrese variedad / cantidad de botellas / año de produccion / precio unitario --- Cada uno seguido de un enter \n";
    $newVino = [
        "variedad" => trim(fgets(STDIN)),
        "cantidadBotellas" => trim(fgets(STDIN)),
        "anioProduccion" => trim(fgets(STDIN)),
        "precioUnidad" => trim(fgets(STDIN))
    ];

    $existe = false;
    $i = 0;
    while ($i < count($listVinos) && ! $existe) {
        if ($listVinos[$i]["variedad"] == $newVino["variedad"] && $listVinos[$i]["anioProduccion"] == $newVino["anioProduccion"]) {
            $existe = true;
            $e = $i;
        }
        $i ++;
    }

    if ($existe) {
        $listVinos[$e]["cantidadBotellas"] = $listVinos[$e]["cantidadBotellas"] + $newVino["cantidadBotellas"];
        echo "El vino existia si agregaron las cantidades al stock\n";
    } else {
        array_push($listVinos, $newVino);
        echo "El vino se ha agregado con existo\n";
    }
    return $listVinos;
}

function cargarVinos()
{
    /**
     * *
     * Retorna un arreglo asociativo para no tener que ingresar todos los vinos manuales
     */
    $listVinos = array();
    $listMalbec = array();
    $listCabernet = array();
    $listMerlot = array();

    $listMalbec[0] = [
        "variedad" => "a",
        "cantidadBotellas" => 15,
        "anioProduccion" => 1990,
        "precioUnidad" => 100
    ];
    $listMalbec[1] = [
        "variedad" => "Tinturri",
        "cantidadBotellas" => 9,
        "anioProduccion" => 1995,
        "precioUnidad" => 120
    ];
    $listMalbec[2] = [
        "variedad" => "Blanquillo",
        "cantidadBotellas" => 18,
        "anioProduccion" => 1998,
        "precioUnidad" => 150
    ];

    $listCabernet[0] = [
        "variedad" => "Tintirijillo",
        "cantidadBotellas" => 10,
        "anioProduccion" => 1990,
        "precioUnidad" => 200
    ];
    $listCabernet[1] = [
        "variedad" => "Tinturrijillo",
        "cantidadBotellas" => 19,
        "anioProduccion" => 1995,
        "precioUnidad" => 220
    ];
    $listCabernet[2] = [
        "variedad" => "Blanquillojillo",
        "cantidadBotellas" => 8,
        "anioProduccion" => 1998,
        "precioUnidad" => 250
    ];
    $listCabernet[3] = [
        "variedad" => "Oscurrillojillo",
        "cantidadBotellas" => 5,
        "anioProduccion" => 2000,
        "precioUnidad" => 400
    ];

    $listMerlot[0] = [
        "variedad" => "Tintillo",
        "cantidadBotellas" => 15,
        "anioProduccion" => 1990,
        "precioUnidad" => 300
    ];
    $listMerlot[1] = [
        "variedad" => "Tinturri",
        "cantidadBotellas" => 9,
        "anioProduccion" => 1995,
        "precioUnidad" => 320
    ];
    $listMerlot[2] = [
        "variedad" => "Blanquillo",
        "cantidadBotellas" => 18,
        "anioProduccion" => 1998,
        "precioUnidad" => 350
    ];
    $listMerlot[3] = [
        "variedad" => "Oscurrillo",
        "cantidadBotellas" => 20,
        "anioProduccion" => 2000,
        "precioUnidad" => 400
    ];

    $listVinos[0] = $listMalbec;
    $listVinos[1] = $listCabernet;
    $listVinos[2] = $listMerlot;

    return $listVinos;
}

function contadorPromedioBotellas($listVinos)
{
    /**
     * *
     * Funcion requerida en la consigna; recorre toda los tipos de vino y luego cada una de sus lista contando y almacenando el precio de cada unos.
     * en cada bucle de tipo sacara la cantidad total de ese tipo y calculara el promedio, guardando los datos en un arreglo.
     */
    /* array listVinos, listaActual */
    /* int indice, contBotellas, sumaPrecio */
    $listResul = array();
    foreach ($listVinos as $indice => $listActual) {
        $contBotellas = 0;
        $sumaPrecio = 0;
        foreach ($listActual as $variedadActual) {
            $contBotellas = $contBotellas + $variedadActual["cantidadBotellas"];
            $sumaPrecio = $sumaPrecio + $variedadActual["precioUnidad"];
        }

        $indice = tipoVino($indice);
        $listResul[$indice] = [
            "tipo" => $indice,
            "cantidadTotal" => $contBotellas,
            "precioPromedio" => $sumaPrecio / count($listActual)
        ];
    }
    return $listResul;
}

function mostrarResultados($listResul)
{
    /**
     * *
     * Imprime los resultado de la funcion contadorPromedioBotellas.
     */
    /* array listResul, resulActual */
    foreach ($listResul as $resulActual) {
        echo "Tipo " . $resulActual["tipo"] . " tiene un total " . $resulActual["cantidadTotal"] . " de botellas y un precio promedio de " . $resulActual["precioPromedio"] . "$\n";
    }
}

function tipoVino($i)
{
    switch ($i) {
        case 0:
            return "Malbec";
        case 1:
            return "Cabernet Savignion";
        case 2:
            return "Merloc";
    }
}

function mostrarDatos($listVino)
{
    /**
     * *
     * Imprime todos los las lista y sub lista de la coleccion ingresada por parametro.
     */
    /* array listVino, vino */
    foreach ($listVino as $indice => $listActual) {
        echo "[TIPO : " . tipoVino($indice) . "]\n";
        foreach ($listActual as $vino) {
            echo "variedad " . $vino["variedad"] . " Tiene un total " . $vino["cantidadBotellas"] . " Producido en " . $vino["anioProduccion"] . " --- " . $vino["precioUnidad"] . "$\n";
        }
    }
}

/**
 * *
 * PRINCIPAL
 * Cuenta con un menu interactivo para el usuario; tiene tres opciones:
 * 1.Cargar un nuevo vino.
 * Primero pregunta el tipo y verifica que es una opcion correcta y llama a la funcion encargada.
 * 2.Contador totales de vino y promedio de precio unitario de cada tipo de vino.
 * 3.Muestra todo los contenidos almacenados en la coleccion.
 */
/* array coleccionVinos */
$coleccionVinos = cargarVinos();

do {
    switch (menu()) {
        case 1:
            $tipo = preguntaTipo() - 1;
            if ($tipo >= 0 && $tipo < count($coleccionVinos)) {
                $coleccionVinos[$tipo] = cargarNuevoVinos($coleccionVinos[$tipo]);
            } else {
                echo "El tipo de dato ingresado es incorrecto\n";
            }
            ;
            break;
        case 2:
            mostrarResultados(contadorPromedioBotellas($coleccionVinos));
            break;
        case 3:
            mostrarDatos($coleccionVinos);
            break;
        default:
            echo "Opcion no disponible";
    }
} while (pregunta());


