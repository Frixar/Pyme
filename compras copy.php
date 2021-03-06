<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- tabs -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

         <!-- Estilo Menú -->
        <link rel="stylesheet" href="estilos/menu.css">

        <!-- Estilo Contenido -->
        <link rel="stylesheet" href="estilos/estilos.css">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- ===== CSS ===== -->
        <script src="https://kit.fontawesome.com/c8ea4ccf97.js" crossorigin="anonymous"></script>

        <!--Datatables/Modal  -->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"><!-- 
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css"> -->
         <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.8/css/responsive.bootstrap.min.css">

         <title>MYPYME</title>

    <script>
        function newInputProd(){
            
            var select = document.getElementById('producto');
            var option = select.options[select.selectedIndex];

            if(option.value == "0 - Otro Producto"){
                Swal.fire({
                title: 'Atención: Se recomienda realizar el registro del producto con anterioridad',
                text: " Desea Continuar?",
                icon: 'warning',
                iconColor: '#F1C40F',
                showCancelButton: true,
                confirmButtonColor: '#154360',
                cancelButtonText: 'Cancelar',
                cancelButtonColor: '#F39C12',
                confirmButtonText: 'Confirmar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        document.getElementById('newInputProd').style.display = 'table';
                        document.getElementById('producto').style.display = 'none';
                    
                    }else{
                
                        document.getElementById('newInputProd').style.display = 'none';
                        document.getElementById("producto").selectedIndex = 0;
                        document.getElementById('producto').style.display = 'block';

                    }
                })
            }
        }

        function showSelectProd(){
            document.getElementById('newInputProd').style.display = 'none';
            document.getElementById("producto").selectedIndex = 0;
            document.getElementById('producto').style.display = 'block';
        }

         function newInput(){
             
            var select = document.getElementById('proveedor');
            var option = select.options[select.selectedIndex];

            if(option.value == "Otro Proveedor"){
                Swal.fire({
                title: 'Atención: Se recomienda realizar el registro del proveedor con anterioridad',
                text: " Desea Continuar?",
                icon: 'warning',
                iconColor: '#F1C40F',
                showCancelButton: true,
                confirmButtonColor: '#154360',
                cancelButtonText: 'Cancelar',
                cancelButtonColor: '#F39C12',
                confirmButtonText: 'Confirmar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        document.getElementById('newInput').style.display = 'table';
                        document.getElementById('proveedor').style.display = 'none';
                        
                    }else{
                
                        document.getElementById('newInput').style.display = 'none';
                        document.getElementById("proveedor").selectedIndex = 0;
                        document.getElementById('proveedor').style.display = 'block';

                    }
                })
            }
        }

        function showSelect(){
             
            document.getElementById('newInput').style.display = 'none';
            document.getElementById("proveedor").selectedIndex = 0;
            document.getElementById('proveedor').style.display = 'block';

         }

        function update(){
            var precioU = document.getElementById('precioU');

            var select = document.getElementById('iva');
            var option = select.options[select.selectedIndex];

            if (precioU.value.length != "0" && option.value != "" ){
                if(option.value != "0" ){
                    var porcentajeIva = parseFloat(option.value)/100 ;
                    var sum = (parseFloat(precioU.value) * parseFloat(porcentajeIva));
                    sum = sum + parseFloat(precioU.value);
                    document.getElementById('precioF').value = sum;
                }else{
                    
                    document.getElementById('precioF').value = precioU.value;
                }
            }
        }
    </script>
    </head>
<body id="body-pd">

        
    <?php
		include_once("segmentos/menu.inc");
	?>

    <!-- HEADER -->
    <div class="home_content home cuerpo" role="main" style="overflow-y: scroll;">
        <div class= "header" id = "userData" style="text-align:right;"></div>
            
        <div class="pad">       
            <div class="tabCliente">
                <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                    <div class="tabNav">

                    <ul class="list-inline">
                        <li class="active" ><a id = "1" onclick = "active(this);" style="color: orange; padding-right: 15px" data-toggle="tab" href="#addCompra">AGREGAR COMPRA</a></li>
                    </ul>
                    </div>
                    <div class="tab-content">
                    <div id="addCompra" class="tab-pane fade in active">
                        <form id="compras-form">                  
                            <div class="container-fluid" >   

                                <br>
					            <div class="full-width panel-tittle headerForm text-center">
                                        <h5>Registro de compras</h5>
                                </div>
                                <div class = "contenido">
                                    <div class="row ">
                                        <div class = "col-md-12" style="text-align:left; color:#F39C12;">
                                            <h5 > Complete el formulario</h5>
                                            <h6>* Espacios obligatorios</h6>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                        <label style="color: #154360; font-weight: normal; " >Fecha Compra*</label>
                                            <input 
                                                id="fecha" 
                                                class="date-picker form-control" 
                                                placeholder="Fecha Compra" 
                                                
                                                type="text" onfocus="this.type='date'" 
                                                onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                                    <script>
                                                        function timeFunctionLong(input) {
                                                            setTimeout(function() {
                                                                input.type = 'text';
                                                            }, 60000);
                                                        }
                                                    </script>
                                        </div>
                                        <div class = " col-sm-6">
                                            <label style="color: #154360; font-weight: normal; ">Proveedor*</label>
                                            <select class="form-control" type="text" id="proveedor" name="proveedor" required onChange="newInput();">
                                                <option disabled selected value="">Seleccione un proveedor</option>
                                            </select>
                                            <div class="input-group"  id="newInput"  style="display:none">
                                                <input type="text" id="otroprov" class="form-control" placeholder="Nombre Otro Proveedor"  required="required">
                                                <span class="input-group-btn">
                                                <button onclick = "showSelect();" class="btn btn-default"  style="background-color: orange; color: white; border:transaparent;" type="button"><i class="fas fa-undo-alt"></i></button>
                                                </span>
                                            </div>
                                        </div>

                                        
                                    </div>
                                    <div class="row form-group ">
                                        <label style="color: #154360; font-weight: bold; " class="col-sm-2 col-form-label">Detalle Productos</label>
                                    </div>    
                                    <div class="form-group row">
                                        <div class = " col-sm-3">
                                            <label style="color: #154360; font-weight: normal; "> Producto *</label>
                                            <select class="form-control" type="text" id="producto" name="producto" required onChange="newInputProd();">
                                                <option disabled selected value="">Seleccione un producto</option>
                                            </select>
                                            <div class="input-group"  id="newInputProd"  style="display:none">
                                                <input type="text" id="otroprod" class="form-control" placeholder="Nombre Otro Producto">
                                                <span class="input-group-btn">
                                                <button onclick = "showSelectProd();" class="btn btn-default"  style="background-color: orange; color: white; border:transaparent;" type="button"><i class="fas fa-undo-alt"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class = " col-sm-2">
                                            <label style="color: #154360; font-weight: normal; "> Cantidad *</label>
                                            <input type="number" 
                                            id="cantidad" 
                                            name="cantidad" 
                                            class="form-control"
                                            placeholder="Cantidad"
                                            required="required"
                                            min="0"/>
                                        </div>
                                        <div class = " col-sm-2">
                                            <label style="color: #154360; font-weight: normal; "> Precio Unitario *</label>
                                            <input type="number" 
                                            id="precioU" 
                                            name="precioU" 
                                            class="form-control"
                                            placeholder="Precio Unitario"
                                            required="required"
                                            min="0" onkeyup="update();"/>
                                        </div>
                                        <div class = " col-sm-2">
                                            <label style="color: #154360; font-weight: normal; "> IVA *</label>
                                            <select class="form-control" type="text" id="iva" name="iva" required onChange="update();">
                                                <option disabled selected value="">IVA</option>
                                                <option>0%</option>
                                                <option>1%</option>
                                                <option>2%</option>
                                                <option>13%</option>
                                            </select>
                                        </div>
                                        <div class = " col-sm-2">
                                            <label style="color: #154360; font-weight: normal; "> Precio Final *</label>
                                            <input type="number" 
                                            id="precioF" 
                                            name="precioF" 
                                            class="form-control"
                                            placeholder="Precio Final"
                                            required="required"
                                            min="0"/>
                                        </div>
                                    </div> 
                                    <div class="row form-group ">
                                        <div class = " col-sm-2">
                                            <button class="btnAddP "  id="addProd"><i class="fas fa-plus"></i>  Agregar Producto</button>  
                                        </div> 
                                    </div> 
                                    <div class="row form-group ">
                                        <div class = " col-sm-12">
                                            <table id="compras" class="display table-striped table-bordered" width="100%"></table>  
                                        </div> 
                                    </div>   
                                    <div class="form-group row">
                                        <div class = "col-md-12" style="text-align:right;">
                                            <button class="btnClose " onclick = "limpiar();"><i class="fas fa-times"></i></button>  
                                            <button class="confirm btnSave "  id="btn-task-form"><i class="fas fa-check"></i></button>  
                                            <br><br> 
                                        </div>  
                                    </div>   
                                </div>
                            </div>   
                        </form>
                    </div>
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </div>

   <!-- DataTable/modal -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap.min.js"></script>  -->
    <script src="https://cdn.datatables.net/responsive/2.2.8/js/dataTables.responsive.min.js"></script>

    <!-- <script src="https://cdn.datatables.net/responsive/2.2.8/js/responsive.bootstrap.min.js"></script> -->
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

    <!-- Botones exportar -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <!-- FIREBASE -->
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-app.js"></script>
        
    <script src="https://www.gstatic.com/firebasejs/8.5.0/firebase-firestore.js"></script>
    
    <script src="https://www.gstatic.com/firebasejs/8.6.2/firebase-auth.js"></script>

    <script>
        // Your web app's Firebase configuration
        var firebaseConfig = {
            apiKey: "AIzaSyDBV7dPGPZLlVOmB9dugywOKyvJPtTIhQQ",
            authDomain: "mypyme-5aa3b.firebaseapp.com",
            projectId: "mypyme-5aa3b",
            storageBucket: "mypyme-5aa3b.appspot.com",
            messagingSenderId: "622271328070",
            appId: "1:622271328070:web:3ba2823c762d4988f13f47",
            measurementId: "G-T28FYC21BS"
        
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
    </script>
    
    <!--=====  JS =====-->
    <script src="js/compras.js"></script>  
  </body>
</html>
