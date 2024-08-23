$(document).ready(function(){
	$("#lands_id").change(function () {
		

		let obj = {
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
          	let table = "<table class='table'>";
						table += "<thead>";
						table += "<tr>";
						table += "<th>Remision</th>"
						table += "<th>Variedad</th>"
						table += "<th>N° Tallos Remision</th>"
						table += "<th>Producción</th>"
						table += "<th>Devolucion</th>"
						table += "<th>Valor</th>"
						table += "<th>Valor a Pagar</th>"
						table += "</tr>";
						table += "</thead>";
						table += "<tbody>";
        		table += "<tr>";
	          data.forEach((item) => {
							if(item.freedom === true)
							{
								table += "<td>"+ $("#lands_id option:selected").text() +"</td>";
								table += "<td>FREEDOM</td>";
								table += "<td>"+ item.cantidad +"</td>";
								table += "<td><input type='text' id='produccion_freedom' name='produccion_freedom'></td>";
								table += "<td><input type='text' id='devolucion_freedom' name='devolucion_freedom'></td>";
								table += "<td><input type='text' id='valor_freedom' name='valor_freedom'></td>";
								table += "<td><input type='text' id='valor_pagar_freedom' name='valor_pagar_freedom'></td>";
							}
							else
							{
								table += "<td>"+ $("#lands_id option:selected").text() +"</td>";
								table += "<td>COLOR</td>";
								table += "<td>"+ item.cantidad +"</td>";
								table += "<td><input type='text' id='produccion_color' name='produccion_color'></td>";
								table += "<td><input type='text' id='devolucion_color' name='devolucion_color'></td>";
								table += "<td><input type='text' id='valor_color' name='valor_color'></td>";
								table += "<td><input type='text' id='valor_pagar_color' name='valor_pagar_color'></td>";
							}
							table += "</tr>";
	          });	 
	          table += "</tbody>";
						table += "<table>"; 
						$("#div_tabla_saldos").html("");
						$("#div_tabla_saldos").html(table);   
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

		

		
	});
});