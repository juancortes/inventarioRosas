$(document).ready(function(){
  $("#staticBackdrop").modal('show');
  $("input:text:visible:first").focus();
  $("#codigo_barras").change(function (e) {
    let codigo      = $("#codigo_barras").val().match(/.{1,2}/g);
    let finca       = codigo[0];
    let variedad    = codigo[1];
    let mesa        = codigo[2];
    let grado       = codigo[3];
    let tipo_ramo   = codigo[4];
    let consecutivo = "";
    for (let i = 5; i <= codigo.length -1; i++) {
      consecutivo += codigo[i]
    }

    $("#consecutive").val(consecutivo);

    var obj = {
       finca: finca,                 
       variedad: variedad,
       mesa: mesa,                 
       grado: grado,                 
       tipo_ramo: tipo_ramo
    }; 
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "GET",
        dataType: 'JSON',
        url: "/products/getCodes",
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
          $("#staticBackdrop").modal('hide');
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

