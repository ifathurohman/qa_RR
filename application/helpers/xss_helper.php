<?php 

function cetak($str){
	echo htmlentities($str, ENT_QUOTES, 'UTF-8');
}
function nonscript($str){
	return htmlentities($str, ENT_QUOTES, 'UTF-8');
}