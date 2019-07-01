<?php

/**
 * En este archivo se incluyen las funciones del tema
 *
 */


/** ==============================================================================================================
 *                                              FUNCIONES DEL TEMA
 *  ==============================================================================================================
 */



// funciones aqui ...


function is_active($slug)
{
	return strpos($_SERVER['REQUEST_URI'], $slug) !== false;
}

?>
