<?php

/**
 * Wrapper sobre var_dump
 * @param   $variable
 * @return  var_dump con <pre> tags
 */
function vd()
{
	foreach (func_get_args() as $value) {
		echo "<pre>";
			var_dump($value);
		echo "</pre>";
	}

}

/**
 * Wrapper sobre var_dump que además ejecuta die
 * @param   $variable
 * @return  var_dump con <pre> tags
 */
function dd()
{
	foreach (func_get_args() as $value) {
		vd($value);
	}
	die;
}
