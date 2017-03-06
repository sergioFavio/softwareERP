<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( !function_exists('copiar')){
    function copiar($fuente, $destino){
	    if(is_dir($fuente))
	    {
	        $dir=opendir($fuente);
	        while($archivo=readdir($dir))
	        {
	            if($archivo!="." && $archivo!="..")
	            {
	                if(is_dir($fuente."/".$archivo))
	                {
	                    if(!is_dir($destino."/".$archivo))
	                    {
	                        mkdir($destino."/".$archivo);
	                    }
	                    copiar($fuente."/".$archivo, $destino."/".$archivo);
	                }
	                else
	                {
	                    copy($fuente."/".$archivo, $destino."/".$archivo);
	                }
	            }
	        }
	        closedir($dir);
	    }
	    else
	    {
	        copy($fuente, $destino);
	    }
	} 
	  
}		//...fin IF function_exists ...
