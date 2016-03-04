jQuery(document).ready(function(){
});


	function carga_ajax(){
		$.ajax({
			url : '/efi/peticion_ajax',
			dataType : 'JSON',
			beforeSend : function(){ 
				$("#mensaje_loading").html('Cargando datos...');
				$("#mensaje_loading").fadeToggle();
			},
			success : function(resp){ 
				console.log(resp);
			}, 
			error : function(err){
				console.log(err);
			},
			complete : function(resp){
				$("#mensaje_loading").html('');
				$("#mensaje_loading").fadeToggle();
			}
		});
	}

	function peticionAjax(datos){
		$.ajax({
			data: datos,
			method: 'POST',
			url : '/efi/peticion_ajax',
			dataType : 'JSON',
			beforeSend : function(){ 
				$("#mensaje_loading").attr('class','alert alert-success');
				$("#mensaje_loading").html('Cargando datos...');
				$("#mensaje_loading").fadeToggle();
			},
			success : function(resp){ 
				if(resp.estado === 'OK'){
					$("#contenido_principal").html(resp.mensaje);
				}
			}, 
			error : function(err){
				$("#mensaje_loading").attr('class','alert alert-danger');
				$("#mensaje_loading").html('Error en la peticion');
				if(err.responseText.length>0){
					$('#ModalEFI_contenido').html(err.responseText);
				}else{
					$('#ModalEFI_contenido').html('Error a nivel de servidor<br>Estado: '+err.status+'<br>Mensaje: '+err.statusText);
				}
				$("#ModalEFI_error").modal();
			},
			complete : function(resp){
				$("#mensaje_loading").html('');
				$("#mensaje_loading").fadeToggle();
			}
		});
	}

	function peticion_general(m, f, p, event){
		event.preventDefault();
		arr = {m:m, f:f, p:p};
		peticionAjax(arr);
	}

	function peticion_form(m, f, p, form, event){
		event.preventDefault();
		$('#input_m').val(m);
		$('#input_f').val(f);
		$('#input_p').val(p);
		data = $("#"+form).serialize();
		peticionAjax(data);
	}

	function peticion_param(m,f,p,param,event){
		event.preventDefault();
		param['m'] = m;
		param['f'] = f;
		param['p'] = p;
		peticionAjax(param);
	}

	function peticion_paramF(m,f,p,param,form,event){
		event.preventDefault();
		$('#input_m').val(m);
		$('#input_f').val(f);
		$('#input_p').val(p);
		for (var nmp in param){
			$("#"+form).append("<input name='"+nmp+"' value='"+param[nmp]+"' type='hidden' />");
		}
		data = $("#"+form).serialize();
		peticionAjax(data);
	}	
