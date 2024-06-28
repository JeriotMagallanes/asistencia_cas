$(document).ready( function () {
    $('#dtable_adm_publicaciones').DataTable();
} );
function editar_pub(id){
    //llamar a ajax
    $.ajax({
        url:"ajax/admin/publicaciones/buscar_publicacion.php",
        data:{"id":id},
        type:"POST",
        dataType:"JSON",
        success:function(res){
            if(res.estado==1){
                res.datos.forEach(item => {
                    $("#md_ed_estado").val(item.estado)
                    $("#med_pub_desc").val(item.descripcion)
                    $("#med_url_pdf").val(item.pdf)
                    $("#med_fec_pub").val(item.publicacion)
                    $("#med_fec_ven").val(item.vencimiento)
                    $("#med_id_pub").val(id)
                })
                $("#modal_ed_pub").modal("show")
            }else{
                alert("No se encontraron datos")
            }
        }
    })
}
function update_pub(){
    let id = $("#med_id_pub").val()
    let estado = $("#md_ed_estado").val()
    let desc = $("#med_pub_desc").val()
    let url = $("#med_url_pdf").val()
    let fecpub = $("#med_fec_pub").val()
    let fecven = $("#med_fec_ven").val()
    $.ajax({
        url:"ajax/admin/publicaciones/update_publicacion.php",
        data:{
            "id":id,
            "estado":estado,
            "desc":desc,
            "url":url,
            "fecpub":fecpub,
            "fecven":fecven
        },
        type:"POST",
        dataType:"JSON",
        success:function(res){
            if (res.estado==1) {
                Swal.fire({
                    icon: 'success',
                    title: 'Exito!',
                    text: 'Datos guardados correctamente!',
                    footer: '<a href="https://undc.edu.pe/bienesyservicios">Ver cambios aqui !</a>'
                })
                table.ajax.reload()
            }
        }
    })
}
function modal_add_pub(){
 $("#modal_add_pub").modal("show")   
}