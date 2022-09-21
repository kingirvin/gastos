//window.onload = iniciarTabla;
function buscarReporte(params) {
    
    
}
function actualizarTabla() {
    tabla.destroy();  var datastring = {
        comprobante:document.getElementById('comprobante').value,
        inicio:document.getElementById('datepicker-inicio').value,
        fin:document.getElementById('datepicker-fin').value,
        };
      tabla= $('#t_comprobante').DataTable({
        //serverSide: true,
          processing: true,
          serverSider: true,
          ajax: {
            url:  "/json/comprobante/reporteBuscar",
            type: 'POST',
            data: datastring,     
            },
            "columns":[                
                {"data":'id'},
                {"data":'siaf'},
                {"data":null,"orderable": false, "searchable": false,
                    render: function ( data, type, full ) {                      
                        var fecha=full.created_at; 
                        var temp=fecha.substr(0,10); 
                        return   temp;                
                    }                                        
                },                
                {"data":'documento_tipo'},
                {"data":null,"orderable": false, "searchable": false,
                    render: function ( data, type, full ) {                      
                        var proveedor=full.proveedor.nombre; 
                        return   proveedor;                
                    }                                        
                },
                {"data":'importe'},
                {data:null,"orderable": false, "searchable": false,
                    render: function ( data, type, full ) {                      
                        if(full.estado=="1")
                            return "<p style='color: ##329f67;'>Completo</p>"; 
                        else
                            return "<p style='color: #c70101;'>Incompleto</p>"; 
                        
                    }                                        
                },
                {data:null,"orderable": false, "searchable": false,
                    render: function ( data, type, full ) {                      
                        return full.usuario.name; 
                    }                                        
                },
            ],
            language: {
              processing:     "Traitement en cours...",
              search:         "Buscar",
              lengthMenu:     "Mostrar _MENU_ registros",
              info:           "Mostrar de _START_ a _END_ de _TOTAL_ registros",
              infoEmpty:      "0 registros",
              infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
              infoPostFix:    "",
              loadingRecords: "Chargement en cours...",
              zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
              emptyTable:     "Nose encontraron registros",
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
      })
}
function restaurar() {
    const date = new Date();
    document.getElementById('datepicker-inicio').value=date.getFullYear()+"-01-01";
    tabla.ajax.reload(null, false);               
}
function verPdf(id) {
    
    //url:  reporte=="Reporte garantia" ? "/json/garantias/reporteBuscar": "/json/devolucion/reporteDevolucion",
    window.open("/vista/reporte/comprobante_pdf/"+document.getElementById('datepicker-inicio').value+"/"+document.getElementById('datepicker-fin').value+"/"+document.getElementById('comprobante').value);
}
