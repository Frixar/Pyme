const db = firebase.firestore();//liga la constante db a firebase
const auth = firebase.auth(); //liga la constante con la autenticacion de Firebase
var user = auth.currentUser; // estado actual del usuario
var usuario; //variable para guardar el UID del user
//var table = $('#clients').DataTable(); //tabla que se va a completar con los registros de firebase
const userData = document.getElementById("userData");
var editStatus = false;
var documento = '';
var id = '';
var nameU, email, photoUrl, uid, emailVerified;
const contador = document.getElementById("conta");
const contador_ventas = document.getElementById("conta_ventas");
const contador_prove = document.getElementById("conta_prove");


   /* Función para obtener datos con firebase ----- */


   const getClient = () => db.collection('clientes').doc(usuario)
   .collection('listClientes').get(); //lo que se le dice es que desde la base de datos de firebase, obtenga todas las "tasks"   
   //importante, hay que ponerle el nombres a como aparece en la colección de firebase 


   /*CLIENTES*/
  const onGetClient = (callback) => db.collection('clientes').doc(usuario)
  .collection('listClientes').onSnapshot(callback);

  const deleteClient = (id) => db.collection('clientes').doc(usuario)
  .collection('listClientes').doc(id).delete();

  const getClients= (id) => db.collection('clientes').doc(usuario)
  .collection('listClientes').doc(id).get();


  /*VENTAS*/
  const getSale = () => db.collection('Ventas').doc(usuario)
  .collection('listVentas').get(); //lo que se le dice es que desde la base de datos de firebase, obtenga todas las "tasks"   
  //importante, hay que ponerle el nombres a como aparece en la colección de firebase 
  
  const onGetSale = (callback) => db.collection('ventas').doc(usuario)
  .collection('listVentas').onSnapshot(callback);

  const deleteSale = (id) => db.collection('ventas').doc(usuario)
  .collection('listVentas').doc(id).delete();

  const getSales= (id) => db.collection('producventastos').doc(usuario)
  .collection('listVentas').doc(id).get();

  const updateSale= (id, updatedClient) => db.collection('ventas').doc(usuario)
  .collection('listVentas').doc(id).update(updatedClient);

  /*PROVEEDORES*/
  const getProv = () => db.collection('proveedor').doc(usuario)
  .collection('listProveedores').get(); //lo que se le dice es que desde la base de datos de firebase, obtenga todas las "tasks"   
  //importante, hay que ponerle el nombres a como aparece en la colección de firebase 

  


  window.addEventListener("DOMContentLoaded", async (e) => {

    /* consultar si hay un usuario activo que esté logeado */
 auth.onAuthStateChanged(function(user) {
   if (user) { 
     //console.log(user.uid) // si hay un usuario activo se muestra el id del user en consola
     usuario = user.uid; // y se guarda el id del usuario en la variable correspondiente 
     nameU = user.displayName;
     email = user.email;
     photoUrl = user.photoURL;
     emailVerified = user.emailVerified;
     console.log(usuario);
     console.log(nameU);
     console.log(photoUrl);

     if(photoUrl == null){
       userData.innerHTML += `
       <img src="imagenes/user.png" alt="" class = "radiusImg"></img>`;
     }
     else{
       userData.innerHTML += `
       <img src="${photoUrl}" alt="" class = "radiusImg"></img>
       
       `;

     }
   } else {
     console.log("no")
   }
 });

   const querySnapshot = await getClient();
     onGetClient((querySnapshot) => {  
       arrayDatos = [];        
       //table.innerHTML = ''
       var cont = 0
       querySnapshot.forEach((doc) => {
         const client = doc.data();
         client.id = doc.id;       
         if(client.id = true){
             cont++;

             
         }  
         contador.innerHTML = cont;              
        

                                 
       })


     });

     const querySnapshotSales = await getSale();
     onGetSale((querySnapshotSales) => {  
       arrayDatos = [];        
       //table.innerHTML = ''
       var cont = 0
       querySnapshotSales.forEach((doc) => {
         const sale = doc.data();
         sale.id = doc.id;       
         if(sale.id = true){
             cont++;             
         }  
         contador_ventas.innerHTML = cont;              
        

                                 
       })


     });

     const querySnapshotProve = await getProv();
     onGetSale((querySnapshotProve) => {  
       arrayDatos = [];        
       //table.innerHTML = ''
       var cont = 0
       querySnapshotProve.forEach((doc) => {
         const prov = doc.data();
         prov.id = doc.id;       
         if(prov.id = true){
             cont++;             
         }  
         contador_prove.innerHTML = cont;              
        

                                 
       })

     });



});

  


