require(['jquery'], function ($) {

    $(document).ready(function () {

	
	
  
    $.getJSON(location.protocol + "//" + location.host + '/formulario4.json.php?festados=ok' , function(resp) {
        var toAppend = '<option selected="selected"></option>';
        $.each(resp, function(k, v) {
            //toAppend += '<option id="'+k+'">'+v+'</option>';
            $.each(v, function(kk, vv) {
                if (kk == 'value') toAppend += '<option value="'+vv+'">';
                if (kk == 'estado') toAppend += vv+'</option>';
                //console.log(k + ' : ' + v);
            })
        });
        $('#festado').empty().append(toAppend);
    });
    
    $.getJSON(location.protocol + "//" + location.host + '/formulario4.json.php?fproductos=ok' , function(resp) {
        var toAppend = '<option selected="selected"></option>';
        $.each(resp, function(k, v) {
            //toAppend += '<option id="'+k+'">'+v+'</option>';
            $.each(v, function(kk, vv) {
                if (kk == 'value') toAppend += '<option>';//value="'+vv+'"
                if (kk == 'estado') toAppend += vv+'</option>';
                //console.log(k + ' : ' + v);
            })
            
        });
        $('#fproducto').empty().append(toAppend);
    });
    
    $( "#festado" ).change(function () {
        $.getJSON(location.protocol + "//" + location.host + '/formulario4.json.php?festadomunicipio=' + $('#festado').val() , function(resp) {
            var toAppend = '<option selected="selected"></option>';
            $.each(resp, function(k, v) {
                //toAppend += '<option id="'+k+'">'+v+'</option>';
                $.each(v, function(kk, vv) {
                    if (kk == 'value') toAppend += '<option value="'+vv+'">';
                    if (kk == 'estado') toAppend += vv+'</option>';
                    //console.log(k + ' : ' + v);
                });
            });
            $('#fmunicipio').empty().append(toAppend);
            $('#ftienda').empty().append('<option id=""></option>');
        });
    }).change();


    $( "#fmunicipio" ).change(function () {
        var urldest = location.protocol + "//" + location.host + '/formulario4.json.php?ftienda=ok&fmunicipio=' + $('#fmunicipio').val() + '&festado=' + $('#festado').val();
        $.getJSON(urldest, function(resp) {
            var toAppend = '<option selected="selected"></option>';
            $.each(resp, function(k, v) {
                //toAppend += '<option id="'+k+'">'+v+'</option>';
                $.each(v, function(kk, vv) {
                    if (kk == 'value') toAppend += '<option value="'+vv+'">';
                    if (kk == 'estado') toAppend += vv+'</option>';
                    //console.log(k + ' : ' + v);
                });
            });

            $('#ftienda').empty().append(toAppend);
        });

    }).change();
	
	var oonsubmit = false;
	
	$('#solicita-informes-form').submit(function(){
		
		//$('#solicita-informes-form').prop('disabled','disable');
		if ( oonsubmit ) return false;
		oonsubmit = true;
		
    var estilono = {"border":"2px solid red"};
    var paso = true;
  if ( $('#fnombre').val().trim().length == 0 )     {$('#fnombre').css( estilono );paso = false;}
  if ( $('#fmaterno').val().trim().length == 0 )    {$('#fmaterno').css( estilono );paso = false;}
  if ( $('#fpaterno').val().trim().length == 0 )    {$('#fpaterno').css( estilono );paso = false;}
  if ( $('#ftelefonofij').val().trim().length == 0 ){$('#ftelefonofij').css( estilono );paso = false;}
  if ( $('#ftelefonocel').val().trim().length == 0 ){$('#ftelefonocel').css( estilono );paso = false;}
  if ( $('#festado').val().trim().length == 0 )     {$('#festado').css( estilono );paso = false;}
  if ( $('#fmunicipio').val().trim().length == 0 )  {$('#fmunicipio').css( estilono );paso = false;}
  if ( $('#ftienda').val().trim().length == 0 )     {$('#ftienda').css( estilono );paso = false;}
  if ( $('#fproducto').val().trim().length == 0 )   {$('#fproducto').css( estilono );paso = false;}
  if ( $('#fcorreo').val().trim().length == 0 )     {$('#fcorreo').css( estilono );paso = false;}
  
  if ( !paso ){
      alert("Existen campos incompletos o no válidos");
	  oonsubmit = false;
      return false;
  }
  
  if ( !$('#faviso').is(':checked') )     {
	  $('#faviso').css( estilono );
	  alert("Favor de aceptar el aviso de privacidad.");
	  oonsubmit = false;
	  return false;
	  }
  
  
  
  var datos = '&qnombre='+$('#fnombre').val().trim()
          +'&qmaterno='+$('#fmaterno').val().trim()
          +'&qpaterno='+$('#fpaterno').val().trim()
          +'&qtelefonofij='+$('#ftelefonofij').val().trim()
          +'&qtelefonocel='+$('#ftelefonocel').val().trim() 
          +'&qestado='+$('#festado').val().trim() 
          +'&qmunicipio='+$('#fmunicipio').val().trim() 
          +'&qtienda='+$('#ftienda').val().trim() 
          +'&qproducto='+$('#fproducto').val().trim() 
          +'&qcorreo='+$('#fcorreo').val().trim(); 
//$('#demo').append('formulario4.json.php?submit=order66&' + datos);

//alert( location.protocol + "//" + location.host + '/formulario4.json.php?submit=order66&' + datos );


  $.getJSON(location.protocol + "//" + location.host + '/formulario4.json.php?submit=order66&' + datos , function(resp) {
        $.each(resp, function(k, v) {
            console.log(k + ' : ' + v);
            if( k == 'status' && v == 'ok'){
                //alert("Grac.!"); 
                document.getElementById("solicita-informes-form").reset();
				$(location).attr('href', location.protocol + "//" + location.host + '/gracias');
            }else{
                //$('#demo').append('<br />' + v);
				//$(document).append('href', location.protocol + "//" + location.host + '/formulario4.json.php?submit=order66&' + datos);
				 
				
				oonsubmit = false;
            }
        });
  });
  
  return false;
});
	
        
    });
	
	

});