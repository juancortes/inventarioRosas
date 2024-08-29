$(document).ready(function(){

  alertify.genericDialog || alertify.dialog('genericDialog',function(){
    return {
        main:function(content){
            this.setContent(content);
        },
        setup:function(){
            return {
                focus:{
                    element:function(){
                        return this.elements.body.querySelector(this.get('selector'));
                    },
                    select:true
                },
                options:{
                    basic:true,
                    maximizable:false,
                    resizable:false,
                    padding:false
                }
            };
        },
        settings:{
            selector:undefined
        }
    };
});
//force focusing password box
alertify.genericDialog ($('#loginForm')[0]).set('selector', 'input[id="codigo_barras"]');

  //$("#staticBackdrop").modal('show');
  $("input:text:visible:first").focus();
  $("#codigo_barras").trigger('onclick');
  $("#codigo_barras").focus();
  document.getElementById("codigo_barras").focus();

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


    var obj = {
       finca: finca,                 
       variedad: variedad,
       mesa: mesa,                 
       grado: grado,                 
       consecutivo: consecutivo,                 
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
          if(data.consecutive == -6)
            error += " Consecutivo ya tomado. ";

          if(error != "")
            alert(error);
          else
          {
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
            $("#consecutive").val(consecutivo);
            alertify.genericDialog().destroy();
          }
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

  $("#codigo_barras").focus();
    
     
  });
  $("#codigo_barras").focus();
});

