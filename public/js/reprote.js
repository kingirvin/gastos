//window.onload = iniciarTabla;
function buscarReporte(params) {
    
    
}
function actualizarTabla() {
    tabla.destroy();  
    var datastring = {
        inicio:document.getElementById('datepicker-inicio').value,
        fin:document.getElementById('datepicker-fin').value,
        };
      tabla= $('#t_gastos').DataTable({
          processing: true,
          serverSider: true,
          ajax: {
            url:  reporte=="Reporte garantia" ? "/json/garantias/reporteBuscar": "/json/devolucion/reporteDevolucion",
            type: 'POST',
            data: datastring,     
            },
            "columns":[
                {"data":null,"orderable": false, "searchable": false,
                    render: function ( data, type, full ) {                                             
                        var fecha=full.created_at; 
                        var temp=fecha.substr(0,10); 
                        return   temp;                
                    }                                        
                },
                {"data":'exp_siaf'},
                {"data":'oc_os'},
                {"data":'proveedor'},
                {"data":'voucher'},
                {"data":'siaf'},
                {"data":'registro'},
                {"data":'monto'},
                {"data":'mes'},
                {"data":'recibo'},
                {"data":null,"orderable": false, "searchable": false,
                    render: function ( data, type, full ) {                         
                        if(full.estado=="1")
                        return "<p style='color: green;'>Ingreso</p>";
                        else
                        return "<p style='color: red;'>Devuelto</p>";
                    }                                        
                },             
            ],
            language: {
              processing:     "Traitement en cours...",
              search:         "Buscar",
              lengthMenu:     "Mostrar _MENU_ registros",
              info:           "Mostrar de _START_ a _END_ de _TOTAL_ registros",
              infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
              infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
              infoPostFix:    "",
              loadingRecords: "Chargement en cours...",
              zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
              emptyTable:     "No se encontraron registros",
              paginate: {
                  first:      "Primero",
                  previous:   "Antes",
                  next:       "Siguiente",
                  last:       "Ultima"
              },
              aria: {
                  sortAscending:  ": activer pour trier la colonne par ordre croissant",
                  sortDescending: ": activer pour trier la colonne par ordre décroissant"
              }
          }
      })}
function restaurar() {
    const date = new Date();
    document.getElementById('datepicker-inicio').value=date.getFullYear()+"-01-01";
    tabla.ajax.reload(null, false);               
}
function verPdf(id) {
    
    //url:  reporte=="Reporte garantia" ? "/json/garantias/reporteBuscar": "/json/devolucion/reporteDevolucion",
    window.location.href = reporte=="Reporte garantia" ?"/vista/reporte/pdf/"+document.getElementById('datepicker-inicio').value+"/"+document.getElementById('datepicker-fin').value+"/1" :"/vista/reporte/pdf/"+document.getElementById('datepicker-inicio').value+"/"+document.getElementById('datepicker-fin').value+"/2";
}
