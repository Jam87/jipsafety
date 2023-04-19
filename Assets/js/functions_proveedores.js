let tableProveedor;

document.addEventListener("DOMContentLoaded", function () {
  //*** MOSTRAR DATOS EN DATATABLE Y TRADUCCIÓN ***//
  tableProveedor = $("#table-proveedor").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
    ajax: {
      url: " " + base_url + "Proveedores/getProveedores",
      dataSrc: "",
    },
    columns: [
      { data: "nombre_proveedor" },
      { data: "nombre_impreso" },
      { data: "numero_ruc" },
      { data: "persona_contacto" },
      { data: "descripcion" },
      { data: "activo" },
      { data: "options" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "desc"]],
  });
});

// --- CARGAR SELECT PAIS --- //
let comboxPais = document.querySelector("#comboxpais");

//Cargo Todos los paises que tengo en la BD
function cargarPais() {
  $.ajax({
    type: "GET",
    url: base_url + "Pais/mostrarPais",
    success: function (response) {
      //departamentos:Tengo el resultado en objeto
      const Pais = JSON.parse(response);
     // console.log(Pais)
     
      let template =
        '<option class="form-control" selected disabled>-- Seleccione --</option>';

      Pais.forEach((tipo) => {
        template += `<option class="form-control" value="${tipo.cod_pais}">${tipo.descripcion}</option>`;
      });

      comboxPais.innerHTML = template;
    },
  });
}

//Llamo a la funcion
cargarPais();

// --- CARGAR SELECT FORMA DE PAGO --- //
let comboxPago = document.querySelector("#comboxpago");

//Cargo Todos los paises que tengo en la BD
function cargarPago() {
  $.ajax({
    type: "GET",
    url: base_url + "Pago/mostrarPago",
    success: function (response) {
      //departamentos:Tengo el resultado en objeto
      const Pagos = JSON.parse(response);

      let template =
        '<option class="form-control" selected disabled>-- Seleccione --</option>';

      Pagos.forEach((tipo) => {
        template += `<option class="form-control" value="${tipo.cod_forma_pago}">${tipo.descripcion}</option>`;
      });

      comboxPago.innerHTML = template;
    },
  });
}

//Llamo a la funcion
cargarPago();

// --- CARGAR SELECT BANCOS --- //
let comboxBancos = document.querySelector("#comboxbanco");

console.log(comboxBancos)

//Cargo Todos los paises que tengo en la BD
function cargarBancos() {
  $.ajax({
    type: "GET",
    url: base_url + "Banco/mostrarBanco",
    success: function (response) {
      //departamentos:Tengo el resultado en objeto
      const Bancos = JSON.parse(response);
      //console.log(Bancos)

      let template =
        '<option class="form-control" selected disabled>-- Seleccione --</option>';

      Bancos.forEach((tipo) => {
        template += `<option class="form-control" value="${tipo.cod_bancos}">${tipo.nombre_banco}</option>`;
      });

      comboxBancos.innerHTML = template;
    },
  });
}

//Llamo a la funcion
cargarBancos();


// --- CARGAR SELECT MONEDA --- //
let comboxMoneda = document.querySelector("#comboxMoneda");

//Cargo Todos los paises que tengo en la BD
function cargarMonedas() {
  $.ajax({
    type: "GET",
    url: base_url + "Moneda/mostrarMoneda",
    success: function (response) {
      //departamentos:Tengo el resultado en objeto
      const Moneda = JSON.parse(response);

      let template =
        '<option class="form-control" selected disabled>-- Seleccione --</option>';

      Moneda.forEach((tipo) => {
        template += `<option class="form-control" value="${tipo.cod_moneda}">${tipo.nombre_moneda}</option>`;
      });

      comboxMoneda.innerHTML = template;
    },
  });
}

//Llamo a la funcion
cargarMonedas();

//*** GUARDAR NUEVO PROVEEDOR ***//
let formProveedor = document.querySelector("#formProveedor");

formProveedor.addEventListener("submit", function (e) {
  e.preventDefault();

  let intIdProveedor = document.querySelector("#idProveedor").value; //Lo obtengo a la hora que voy a Editar

  let request = new XMLHttpRequest();
  let ajaxUrl = base_url + "Proveedores/setProveedor";
  let formDta = new FormData(formProveedor);
  request.open("POST", ajaxUrl, true);
  request.send(formDta);

  //console.log(request);

  request.onload = function () {
    if (request.status == 200) {
      let objData = JSON.parse(request.responseText);

      if (objData.status) {
        $("#table-proveedor").DataTable().ajax.reload();
        document.querySelector("#formProveedor").reset();

        //Modal exito Toast aviso parte superior

        /*if(objData.status == true){
           document.querySelector('.accordion-button').className = 'collapsed';
        }*/

        Swal.fire({
          position: "top-end",
          toast: "true",
          icon: "success",
          title: "Correcto!",
          text: objData.msg,
          icon: "success",
          confirmButtonText: "Aceptar",
          showConfirmButton: false,
          timer: 5000,
          timerProgressBar: true,
        });
      } else {
        //Modal error Toast aviso parte superior

        Swal.fire({
          position: "top-end",
          toast: "true",
          icon: "warning",
          title: "Error!",
          text: objData.msg,
          icon: "warning",
          confirmButtonText: "Aceptar",
          showConfirmButton: false,
          timer: 5000,
          timerProgressBar: true,
        });
      }
    }
  };
});

//*** ELIMINAR TIPO DE USUARIO ***//
function fntDelBanco(idbanco) {
  Swal.fire({
    title: "Eliminar Tipo",
    text: "¿Realmente quiere eliminar tipo de usuario?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      let request = new XMLHttpRequest();
      let ajaxUrl = base_url + "Banco/delBanco";
      let strData = "cod_bancos=" + idbanco;

      request.open("POST", ajaxUrl, true);
      request.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
      );
      request.send(strData);

      request.onload = function () {
        if (request.status == 200) {
          let objData = JSON.parse(request.responseText);

          //objData.status: Valido si es verdadero.
          //Va a mostrar el mensaje
          if (objData.status) {
            $("#table-bancos").DataTable().ajax.reload();

            Swal.fire({
              position: "top-end",
              toast: "true",
              icon: "success",
              title: "Eliminar!",
              text: objData.msg,
              icon: "success",
              confirmButtonText: "Aceptar",
              showConfirmButton: false,
              timer: 5000,
              timerProgressBar: true,
            });
          } else {
            Swal.fire({
              position: "top-end",
              toast: "true",
              icon: "warning",
              title: "Error!",
              text: objData.msg,
              icon: "warning",
              confirmButtonText: "Aceptar",
              showConfirmButton: false,
              timer: 5000,
              timerProgressBar: true,
            });
          }
        }
      };
    }
  });
}

//*** EDITAR TIPO DE USUARIO ***//
/**
 *
 * 1.Cambio estilo del modal
 * 2.Traigo los datos
 * 3.Muestro los datos en el modal de acuerdo al ID
 */
function fntEditBanco(idbanco) {
  var idbanco = idbanco;

  //Cambio estilos al modal
  document;
  //.querySelector(".modal-header")
  //.classList.replace("bg-pattern", "bg-pattern-2");
  document.querySelector("#titleModal").innerHTML = "Actualizar Banco";
  document
    .querySelector(".modal-header")
    .classList.replace("headerRegister", "headerEdit", "bg-pattern-2");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-primary", "btn-info");
  document.querySelector("#btnText").innerHTML = "Actualizar";
  document.querySelector("#formBanco").reset();

  var request = (request = new XMLHttpRequest());
  var ajaxUrl = base_url + "/Banco/getBanco/" + idbanco;
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onload = function () {
    if (request.readyState == 4 && request.status == 200) {
      var objData = JSON.parse(request.responseText);

      //Convierto a un objeto el formato .JSON que recibo desde Ajax
      var objData = JSON.parse(request.responseText);

      //status = true
      if (objData.status) {
        //Muestro los datos en modal edit
        document.querySelector("#idBanco").value = objData.data.cod_bancos;
        document.querySelector("#txtName").value = objData.data.nombre_banco;
        document.querySelector("#txtDescripcion").value =
          objData.data.nota_banco;
        document.querySelector("#listLocal").value = objData.data.listLocal;
        document.querySelector("#listStatus").value = objData.data.listStatus;

        //Localidad
        if (objData.data.es_local == 1) {
          var optionSelect =
            '<option value="1" selected class="notBlock">Nacional</option>';
        } else {
          var optionSelect =
            '<option value="2" selected class="notBlock">Internacional</option>';
        }
        var htmlSelect = `${optionSelect}
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                              `;
        document.querySelector("#listLocal").innerHTML = htmlSelect;

        //Estado
        if (objData.data.activo == 1) {
          var optionSelect =
            '<option value="1" selected class="notBlock">Activo</option>';
        } else {
          var optionSelect =
            '<option value="2" selected class="notBlock">Inactivo</option>';
        }
        var htmlSelect = `${optionSelect}
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                              `;
        document.querySelector("#listStatus").innerHTML = htmlSelect;
        $("#modalBancos").modal("show");
      } else {
        Swal.fire({
          position: "top-end",
          toast: "true",
          icon: "warning",
          title: "Error!",
          text: objData.msg,
          icon: "warning",
          confirmButtonText: "Aceptar",
          showConfirmButton: false,
          timer: 5000,
          timerProgressBar: true,
        });
      }
    }
  };
}

//*** HACER QUE EL DATATABLE FUNCIONES ***//
$("#table-proveedor").DataTable();

//*** MANDAR A LLAMAR AL MODAL: Agregar una nueva marca ***//
function openModal() {
  document.querySelector("#idBanco").value = "";
  document
    .querySelector(".modal-header")
    .classList.replace("bg-pattern-2", "bg-pattern");
  document.querySelector("#titleModal").innerHTML = "Nuevo Banco";
  document
    .querySelector(".modal-header")
    .classList.replace("headerRegister", "bg-pattern-2", "headerEdit");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#formBanco").reset();

  $("#modalBancos").modal("show");
}
