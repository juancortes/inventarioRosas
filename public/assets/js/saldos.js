$(document).ready(function(){
	$("#lands_id").change(function () {
		let table = "<table class='table'>";
		table += "<thead>";
		table += "<tr>";
		table += "<th>Remision</th>"
		table += "<th>Variedad</th>"
		table += "<th>Producción</th>"
		table += "<th>Devolucion</th>"
		table += "<th>Valor</th>"
		table += "<th>Valor a Pagar</th>"
		table += "</tr>";
		table += "</thead>";
		table += "<tbody>";

		var obj = {
	       id: $("#lands_id").val()
	    }; 

		$.ajax({
	        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	        type: "GET",
	        dataType: 'JSON',
	        url: "/saldosRemisiones/getRemisionData",
	        data: obj,
	        cache: false,
	        beforeSend: function(){
	          // Show image container
	          $("#loader").show();
	        },
	        success: function (data) {
	          console.log("SUCCESS : ", data);
	          $("#lands_id").val(data.finca);
	          $("#lands_id1").val(data.finca);
	          $("#varietie_id").val(data.variedad);
	          $("#varietie_id1").val(data.variedad);
	          $("#table_id").val(data.mesa);
	          $("#table_id1").val(data.mesa);
	          $("#grades_id").val(data.grado);
	          $("#grades_id1").val(data.grado);
	          $("#type_branche_id").val(data.tipo_ramo);
	          $("#type_branche_id1").val(data.tipo_ramo);
	          $("#quantity").val(data.cantidad);
	          $("#staticBackdrop").modal('hide');
	          error = "";
	          if(data.finca == -1)
	            error += " Finca no encontrada. ";
	          if(data.variedad == -2)
	            error += " Variedad no encontrada. ";
	          if(data.mesa == -3)
	            error += " Mesa no encontrada. ";
	          if(data.grado == -4)
	            error += " Grado no encontrada. ";
	          if(data.tipo_ramo == -5)
	            error += " Tipo de Ramo no encontrada. ";

	          if(error != "")
	            alert(error);
	        },
	        complete:function(data){
	          // Hide image container
	          $("#loader").hide();
	        },
	        error: function (e) {
	          console.log("ERROR : ", e);
	          //$("#btnSubmit").prop("disabled", false);
	        }
	    });

		table += "</tbody>";
		table += "<table>";

		$("#div_tabla_saldos").html("");
		$("#div_tabla_saldos").html(table);
	});
});