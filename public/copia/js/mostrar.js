function mostrar () {
    var id =$('#txtCodigo').val();
    var dataString = "id="+id;
    $.ajax({
	async: true,
	dataType: "html",
	type: "POST",
	contentType: "application/x-www-form-urlencoded",
	url: url+"/reportes/reportes",
	data: dataString,
	beforeSend: function (data){
	    $("#msjconfirmacion").html("<label style='color:green;'>* Enviando datos...</label>"); 
	},
	success: function(requestData){
	    if (requestData != 0) {
		var options = requestData;
		$('#mySelect').html(options);
		$('#myModal').modal('show');
 	    } else {
		alert("Servidor respondio"+requestData);
		//$('#myModal').modal('show');
	    }
	},
	error: function(requestData, strError, strTipoError) {
	    alert("Error"+strTipoError+": "+strError);
	},
	complete: function(requestData, exito) {
	}
    })
}
