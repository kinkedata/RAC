function setCookie(cname, cvalue, exdays){ 
	var d = new Date(); d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000)); var expires = "expires=" + d.toUTCString(); 
	document.cookie = cname + "=" + encodeURIComponent(cvalue) + ";" + expires + ";path=/" 
} 

function getCookie(cname) {
	var results = document.cookie.match ( '(^|;) ?' + cname + '=([^;]*)(;|$)' );
	if(results) return ( decodeURIComponent(results[2] ) );
	else return "";
}

function deleteCookie(name){
	var pathBits = location.pathname.split('/');
	var pathCurrent = ' path=';
	document.cookie = name + '=; expires=Thu, 01-Jan-1970 00:00:01 GMT;';
	for(var i = 0; i < pathBits.length; i++){
		pathCurrent += ((pathCurrent.substr(-1) != '/') ? '/' : '') + pathBits[i];
		document.cookie = name + '=; expires=Thu, 01-Jan-1970 00:00:01 GMT;' + pathCurrent + ';';
	}
}