function getCiudades(estado_id) {
  $.get(myFullUrl + "/data/ajax-state?estado_id=" + estado_id, function (data) {
    $("#cbCiudades").empty();
    $("#cbCiudades").append('<option value="">Ciudad</option>');
    if (data.length === 0) {
      $("#cbTiendas").empty();
      $("#cbTiendas").append('<option value="">Tienda RAC</option>');
    }
    $.each(data, function (index, item) {
      if ($("#cbCiudades_initial").val() == item.id)
        $("#cbCiudades").append(
          `<option value="${item.id}" selected="selected">${item.nombre}</option>`
        );
      else
        $("#cbCiudades").append(
          `<option value="${item.id}">${item.nombre}</option>`
        );
    });
    if ($("#fproducto").val() === "Motos") {
      const bikesEnabled = [
        1, // Aguascalientes
        11, // Jesus Maria
        1741, // San Luis Potosi
        1742, // Soledad de Graciano Sanchez
        1717, // Querétaro
        902, // Monterrey
        918, // Garcia
        2320, // Guadalupe
        2323, // Juarez
        514, // Zapopan
        523, // Tlajomulco
        2321, // Tlaquepaque
      ];
      $("#cbCiudades")
        .find("option")
        .each((_, item) => {
          if (bikesEnabled.includes(parseInt($(item).val()))) {
            $(item).prop("disabled", false);
          } else {
            $(item).prop("disabled", true);
          }
        });
    } else {
      $("#cbCiudades")
        .find("option")
        .each((_, item) => $(item).prop("disabled", false));
    }
    getTiendas($("#cbCiudades").val());
  });
}

function getTiendas(ciudad_id) {
  $.get(
    myFullUrl + "/data/ajax-tienda?ciudad_id=" + ciudad_id,
    function (data) {
      $("#cbTiendas").empty();
      $("#cbTiendas").append('<option value="">Tienda RAC</option>');
      $.each(data, function (index, item) {
        if ($("#cbTiendas_initial").val() == item.id)
          $("#cbTiendas").append(
            `<option value="${item.id}" selected="selected">${item.nombre}</option>`
          );
        else
          $("#cbTiendas").append(
            `<option value="${item.id}">${item.nombre}</option>`
          );
      });
      if ($("#fproducto").val() === "Motos") {
        const bikesEnabled = [
          8525,
          8528,
          8586,
          8522,
          8524,
          8532,
          8609,
          8635,
          8673,
          8574,
          8596,
          8633,
          8636,
          8646,
          8560,
          8590,
          8592,
          8637,
          8625,
          8651,
        ];
        $("#cbTiendas")
          .find("option")
          .each((_, item) => {
            if (bikesEnabled.includes(parseInt($(item).val()))) {
              $(item).prop("disabled", false);
            } else {
              $(item).prop("disabled", true);
            }
          });
      } else {
        $("#cbTiendas")
          .find("option")
          .each((_, item) => $(item).prop("disabled", false));
      }
    }
  );
}

const stores = {
  8501: { lat: 26.053761, lng: -98.365469 },
  8502: { lat: 26.071422, lng: -98.322803 },
  8503: { lat: 26.093511, lng: -98.278169 },
  8504: { lat: 26.026103, lng: -98.279281 },
  8505: { lat: 25.976458, lng: -98.060917 },
  8506: { lat: 26.026444, lng: -98.238267 },
  8508: { lat: 25.864325, lng: -97.479733 },
  8509: { lat: 25.857211, lng: -97.536083 },
  8510: { lat: 25.878367, lng: -97.522022 },
  8512: { lat: 26.056342, lng: -98.292506 },
  8513: { lat: 22.399317, lng: -97.938508 },
  8514: { lat: 22.315469, lng: -97.867108 },
  8515: { lat: 25.835789, lng: -97.497764 },
  8517: { lat: 22.214697, lng: -97.854789 },
  8518: { lat: 22.25245, lng: -97.853794 },
  8522: { lat: 20.628761, lng: -100.406769 },
  8523: { lat: 20.565117, lng: -100.375567 },
  8524: { lat: 20.631708, lng: -100.466386 },
  8525: { lat: 22.190547, lng: -101.007467 },
  8526: { lat: 22.139633, lng: -101.001206 },
  8527: { lat: 22.299064, lng: -97.876797 },
  8528: { lat: 22.167917, lng: -100.93735 },
  8529: { lat: 22.132328, lng: -100.933778 },
  8530: { lat: 20.606375, lng: -100.387128 },
  8532: { lat: 20.58515, lng: -100.411331 },
  8533: { lat: 20.386456, lng: -99.966211 },
  8535: { lat: 20.602553, lng: -100.421469 },
  8538: { lat: 27.481804, lng: -99.517241 },
  8542: { lat: 25.689389, lng: -100.453861 },
  8543: { lat: 25.750975, lng: -100.255647 },
  8544: { lat: 25.7841, lng: -100.235136 },
  8545: { lat: 25.746658, lng: -100.199128 },
  8547: { lat: 20.695958, lng: -101.342458 },
  8548: { lat: 20.54975, lng: -100.840369 },
  8550: { lat: 20.517589, lng: -100.790997 },
  8552: { lat: 27.443656, lng: -99.519847 },
  8553: { lat: 25.700822, lng: -100.308858 },
  8555: { lat: 20.568239, lng: -101.198303 },
  8560: { lat: 25.780092, lng: -100.386367 },
  8561: { lat: 25.729361, lng: -100.162619 },
  8562: { lat: 20.553486, lng: -100.394725 },
  8563: { lat: 25.722972, lng: -100.199847 },
  8566: { lat: 25.760578, lng: -100.401503 },
  8567: { lat: 29.308883, lng: -100.932025 },
  8568: { lat: 29.327167, lng: -100.975206 },
  8569: { lat: 22.24705, lng: -97.835864 },
  8574: { lat: 20.541744, lng: -103.361764 },
  8575: { lat: 25.684, lng: -100.315711 },
  8577: { lat: 20.625319, lng: -103.38805 },
  8578: { lat: 21.081728, lng: -101.629583 },
  8580: { lat: 20.641039, lng: -103.278803 },
  8583: { lat: 25.780111, lng: -100.188458 },
  8586: { lat: 22.152489, lng: -100.894961 },
  8587: { lat: 25.799892, lng: -100.314489 },
  8589: { lat: 25.667533, lng: -100.281628 },
  8590: { lat: 25.6633, lng: -100.151414 },
  8591: { lat: 25.661039, lng: -100.232522 },
  8592: { lat: 25.640253, lng: -100.087653 },
  8594: { lat: 25.577, lng: -100.002394 },
  8596: { lat: 20.795019, lng: -103.477392 },
  8597: { lat: 20.729989, lng: -103.422394 },
  8600: { lat: 25.730875, lng: -100.3468 },
  8603: { lat: 25.650683, lng: -100.111261 },
  8604: { lat: 25.907444, lng: -100.168308 },
  8606: { lat: 25.684492, lng: -100.485958 },
  8607: { lat: 25.548608, lng: -100.943036 },
  8609: { lat: 25.792131, lng: -100.489506 },
  8610: { lat: 25.707542, lng: -100.158819 },
  8612: { lat: 25.794386, lng: -100.408292 },
  8613: { lat: 25.715667, lng: -100.248247 },
  8614: { lat: 22.130672, lng: -100.925236 },
  8615: { lat: 25.388194, lng: -100.995781 },
  8616: { lat: 25.820597, lng: -100.106547 },
  8617: { lat: 20.56135, lng: -103.284169 },
  8620: { lat: 25.406853, lng: -100.978317 },
  8621: { lat: 25.423917, lng: -101.005325 },
  8622: { lat: 21.131447, lng: -101.660461 },
  8625: { lat: 21.858317, lng: -102.314986 },
  8627: { lat: 21.891264, lng: -102.274314 },
  8628: { lat: 25.587133, lng: -100.256683 },
  8629: { lat: 20.476006, lng: -103.264936 },
  8631: { lat: 25.788369, lng: -100.319958 },
  8633: { lat: 20.738289, lng: -103.401547 },
  8635: { lat: 25.797406, lng: -100.6005 },
  8636: { lat: 20.603411, lng: -103.400444 },
  8637: { lat: 25.656861, lng: -100.188353 },
  8646: { lat: 20.458264, lng: -103.428831 },
  8647: { lat: 20.608297, lng: -103.339244 },
  8650: { lat: 21.103975, lng: -101.691483 },
  8651: { lat: 21.962281, lng: -102.343314 },
  8653: { lat: 20.393747, lng: -99.984608 },
  8654: { lat: 21.886686, lng: -102.297272 },
  8655: { lat: 22.39075, lng: -97.908789 },
  8656: { lat: 25.682161, lng: -100.422139 },
  8660: { lat: 24.859719, lng: -99.5671 },
  8661: { lat: 25.277486, lng: -100.020853 },
  8663: { lat: 25.431242, lng: -100.924575 },
  8664: { lat: 20.719539, lng: -103.318786 },
  8667: { lat: 25.727333, lng: -100.278508 },
  8668: { lat: 28.685728, lng: -100.545467 },
  8672: { lat: 21.101719, lng: -101.612453 },
  8673: { lat: 25.782214, lng: -100.576242 },
  8675: { lat: 21.886792, lng: -102.250739 },
  8677: { lat: 20.745686, lng: -105.254656 },
  8678: { lat: 20.65512, lng: -105.23122 },
  8679: { lat: 20.721625, lng: -105.277642 },
  8681: { lat: 21.513978, lng: -104.891842 },
  8682: { lat: 20.684939, lng: -103.367167 },
  8683: { lat: 21.487908, lng: -104.832272 },
  8684: { lat: 20.648361, lng: -105.219042 },
  8687: { lat: 25.688553, lng: -100.114778 },
  8695: { lat: 25.823533, lng: -100.364942 },
  8696: { lat: 19.096633, lng: -104.304136 },
  8697: { lat: 19.050647, lng: -104.312008 },
  8707: { lat: 27.494394, lng: -99.549892 },
  8708: { lat: 21.175869, lng: -101.664442 },
  8709: { lat: 18.910089, lng: -103.870758 },
  8711: { lat: 25.191683, lng: -99.819131 },
  8712: { lat: 26.008278, lng: -98.275347 },
  8715: { lat: 25.639882, lng: -100.155251 },
  8717: { lat: 25.892256, lng: -100.260664 },
};
let map;
function initMap(center) {
  map = new google.maps.Map(document.getElementById("map"), {
    center,
    zoom: 16,
  });
  const marker = new google.maps.Marker({
    position: center,
    map: map,
  });
}

$(document).ready(function () {
  /* Combos Ajax
   */

  getCiudades($("#cbEstados").val());

  $("#fproducto").on("change", function () {
    const bikesEnabled = [
      1, // Aguascalientes
      14, // Jalisco
      19, // Nuevo León
      22, // Querétaro
      24, // San Luis
    ];
    const productSelected = $(this).val();
    // if (productSelected === "Motos") {
    //   $("#motosAdvice").show();
    //   $("#cbEstados")
    //     .find("option")
    //     .each((_, item) => {
    //       if (bikesEnabled.includes(parseInt($(item).val()))) {
    //         $(item).prop("disabled", false);
    //       } else {
    //         $(item).prop("disabled", true);
    //       }
    //     });
    // } else {
      $("#motosAdvice").hide();
      $("#cbEstados")
        .find("option")
        .each((_, item) => $(item).prop("disabled", false));
    // }
  });
  $("#cbEstados").on("change", function (e) {
    var estado_id = e.target.value;
    getCiudades(estado_id);
  });

  $("#cbCiudades").on("change", function (e) {
    var ciudad_id = e.target.value;
    getTiendas(ciudad_id);
  });
  $("#cbTiendas").on("change", function () {
    const storeId = $(this).val();
    $("#map").css({ display: "block" });
    console.log(storeId, stores[storeId]);
    initMap(stores[storeId]);
  });

  /* Contactos
   */
  $("#addAnotacion").click(function () {
    if (jQuery.trim($("#anotacion").val()).length <= 0) return;

    var contador;
    var descripcion;
    var last = $(".anotaciones tr > td:first-child");

    contador = last.length ? last.length + 1 : 1;
    contador = contador.toString();

    descripcion = jQuery.trim($("#anotacion").val());

    var anotacion =
      '<tr><td><input type="hidden" name="anotacion[]" value="' +
      descripcion +
      '" />' +
      contador +
      "</td><td>" +
      descripcion +
      "</td><td></td></tr>";
    $(".anotaciones").append(anotacion);

    $("#anotacion").val("").focus();

    return false;
  });
});

