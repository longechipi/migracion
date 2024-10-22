//-------- FUNCION PARA BLOQUEAR LETRAS ---------//
function numeros(input,event){    
    var keyCode = event.which ? event.which : event.keyCode;
    var lisShiftkeypressed = event.shiftKey;
        if(lisShiftkeypressed && parseInt(keyCode) != 9){
            return false;
        }
    if((parseInt(keyCode)>=48 && parseInt(keyCode)<=57) || keyCode==37/*LFT ARROW*/ || keyCode==39/*RGT ARROW*/ || keyCode==8/*BCKSPC*/ || keyCode==46/*DEL*/ || keyCode==9/*TAB*/  || keyCode==45/*minus sign*/ || keyCode==43/*plus sign*/){
        return true;
    }     
    alert("SOLO SE PERMITEN NUMEROS"); 
    input.focus();
    return false;           
}

//-------- FUNCION PARA BLOQUEAR NUMEROS ---------//
function letras(input,event){
    var keyCode = event.which ? event.which : event.keyCode;
    //Small Alphabets
    if(parseInt(keyCode)>=97 && parseInt(keyCode)<=122){
        return true;
    }
    //Caps Alphabets
    if(parseInt(keyCode)>=65 && parseInt(keyCode)<=90){
        return true;
    }
    if(parseInt(keyCode)==32 || parseInt(keyCode)==13 || parseInt(keyCode)==46 || keyCode==9/*TAB*/ || keyCode==8/*BCKSPC*/ || keyCode==37/*LFT ARROW*/ || keyCode==39/*RGT ARROW*/ ){
        return true;
    }
    alert("SOLO SE PERMITEN LETRAS"); 
    input.focus();
    return false; 
}

//-------- FUNCION PARA VALIDAR PESO DE ARCHIVOS ---------//
function validarArchivo(input) {
    const archivo = input.files[0];
    if (archivo) {
      const extension = archivo.name.split('.').pop().toLowerCase();
      const tamañoEnMegabytes = archivo.size / (1024 * 1024);
      const extensionesPermitidas = ['jpeg', 'png', 'jpg', 'webp', 'pdf'];

      if (!extensionesPermitidas.includes(extension)) {
        alert('Solo se permiten archivos .jpeg, .png, .jpg, .webp y .pdf');
      } else if (tamañoEnMegabytes > 2) {
        Swal.fire({
            icon: "error",
            title: "Error en Archivo",
            text:"El peso permitido para la carga de documentos es de 2MB",
            confirmButtonText: "Volver",
            confirmButtonColor: "#007ebc",
        })
      } else {
        console.log('Archivo válido');
      }
  
      if (!extensionesPermitidas.includes(extension) || tamañoEnMegabytes > 2) {
        input.value = '';
      }
    }
}
//-------- FUNCION PARA VALIDAR SERVICIO AFILIADOS DEL MEDICO ---------//
function fcheckafilia(id){
    const idmed = $("#id_user").val();
    jQuery.ajax({
        type: "POST",   
        url: "../model/perfil/medicos/serv_afiliados_med.php",
        data: {id: id, idmed: idmed},
        success:function(data){ 
        if (data!='1') {
        }
    }
});
}
//-------- FUNCION PARA ELIMINAR SERVICIO AFILIADO DEL MEDICO ---------//
function borrar(id) {
    const idmed = $("#id_user").val();
    $.ajax({
        type: "POST",
        url: "../model/perfil/medicos/del_espe.php",
        data: { id: id, idmed: idmed },
        success: function (data) {
            var tabla = document.getElementById("tblesp");
            var filas = tabla.getElementsByTagName("tr");
            for (var i = 0; i < filas.length; i++) {
                var celdas = filas[i].getElementsByTagName("td");
                if (celdas.length > 0) {
                    var boton = celdas[celdas.length - 1].getElementsByTagName("button")[0];
                        if (boton.getAttribute("onclick").includes(id)) {
                            tabla.deleteRow(i);
                            break;
                        }
                }
            }
            Swal.fire({
                title: 'Actualización Exitosa!',
                text: 'Elimino Correctamente la Especialidad',
                icon: 'success',
                confirmButtonColor: "#007ebc",
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "perfil";
                }
            });
        }
    });
}

//-------- FUNCION PARA ELIMINAR HORARIO DE ATENCION DEL MEDICO ---------//
function borrarcli(id) {
    const idmed = $("#id_user").val();
    $.ajax({
        type: "POST",
        url: "../model/perfil/medicos/del_cli.php",
        data: { id: id, idmed: idmed },
        success: function (data) {
            var tabla = document.getElementById("user2");
            var filas = tabla.getElementsByTagName("tr");
            for (var i = 0; i < filas.length; i++) {
                var celdas = filas[i].getElementsByTagName("td");
                if (celdas.length > 0) {
                    var boton = celdas[celdas.length - 1].getElementsByTagName("button")[0];
                        if (boton.getAttribute("onclick").includes(id)) {
                            tabla.deleteRow(i);
                            break;
                        }
                }
            }
            Swal.fire({
                title: 'Actualización Exitosa!',
                text: 'Elimino Correctamente el Horario de Atención',
                icon: 'success',
                confirmButtonColor: "#007ebc",
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "perfil";
                }
            });
        }
    });
}