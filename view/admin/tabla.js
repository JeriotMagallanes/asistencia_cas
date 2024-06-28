// Supongamos que tienes un arreglo llamado "registros" con los datos de la tabla
var registros = [
    { id: 1, hora_entrada: "09:00", fecha_registro: "2023-08-10", id_personal: 1 },
    { id: 2, hora_entrada: "10:30", fecha_registro: "2023-08-10", id_personal: 2 },
];
var registros = $.ajax({
    url : "./jax/admin/reporte/listar_personal_by_fecha.php",
    type : "GET",
    data : {"fecha":$("#sel_fecha").val()}
});

var registrosPorFecha = {};

// Agrupar registros por fecha
registros.forEach(function(registro) {
    var fecha = registro.fecha_registro;
    if (!registrosPorFecha[fecha]) {
        registrosPorFecha[fecha] = [];
    }
    registrosPorFecha[fecha].push(registro);
});

var tabla = document.getElementById("tablaRegistros");

// Generar filas por fecha
for (var fecha in registrosPorFecha) {
    var row = document.createElement("tr");
    var cellFecha = document.createElement("td");
    cellFecha.textContent = fecha;
    row.appendChild(cellFecha);
    
    var cellRegistros = document.createElement("td");
    cellRegistros.textContent = registrosPorFecha[fecha].map(function(registro) {
        return "ID: " + registro.id + " - Hora de Entrada: " + registro.hora_entrada + " - ID Personal: " + registro.id_personal;
    }).join("<br>");
    row.appendChild(cellRegistros);
    
    tabla.appendChild(row);
}