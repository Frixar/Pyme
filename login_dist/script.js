const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');
var usuario = firebase.auth().currentUser;
var errorSpan = document.getElementById("formError");
var errorSpanLO = document.getElementById("formErrorLO");
var errorInput = document.getElementById("signup-password");

/*Inputs de login */
var InputLoginEmail = document.getElementById("login_email");
var InputLoginPass = document.getElementById("login_password");

/*Inputs de registro */
var InputSingUpname = document.getElementById("signup-name");
var InputSignUpemail = document.getElementById("signup-email");
var InputSignUppass = document.getElementById("signup-password");

firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
      location.href ="../index.php"
     
    /* auth.signOut().then(() => {
        console.log('sign out')
    }) */


    } else {
        console.log("que pasa")
       //location.href ="../login_dist/index.html"
        
    }
  });

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});


//FIREBASE REGISTRO EMAIL Y CONTRASEÑA

const signupForm = document.querySelector('#signup-form');

signupForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const signupName = document.querySelector('#signup-name').value;
    const email = document.querySelector('#signup-email').value;
    const password = document.querySelector('#signup-password').value;

    auth
        .createUserWithEmailAndPassword(email, password)
        .then(userCredential => {
            signupForm.reset();
            console.log('sign up')
            
        }).catch(function(error){
            var errorCode = error.code;
            var errorMessage = error.message;
            console.log(error)

            if (errorCode == 'auth/weak-password') {    
                errorSpan.innerHTML = "La contraseña debe tener al menos 6 caracteres";
                InputSignUppass.style.backgroundColor = "#fce4e4";           
                document.getElementById("signup-password").value="";                
                return false                
            }else if (errorCode == 'auth/email-already-in-use') {
                errorSpan.innerHTML = "El correo electronico ya se encuentra en uso por otra cuenta.";
                InputSignUpemail.style.backgroundColor = "#fce4e4";
                document.getElementById("signup-email").value="";
                return false
            } else if (errorCode == 'auth/invalid-email') {
                errorSpan.innerHTML = "El correo electronico no es invalido";
                InputSignUpemail.style.backgroundColor = "#fce4e4";
                document.getElementById("signup-email").value="";
                return false
                
            }
        })

})

//INICIAR SESIÓN FIREBASE EMAIL Y CONTRASEÑA

const signinForm = document.querySelector('#login-form')

signinForm.addEventListener('submit', e =>{
    e.preventDefault();

    const email = document.querySelector('#login_email').value;
    const password = document.querySelector('#login_password').value;


    auth.signInWithEmailAndPassword(email, password).then(userCredential => {
        console.log('sign in')
        var errorCode = error.code;
        var errorMessage = error.message;
        console.log(error)

    }).catch(function(error){
        var errorCode = error.code;
        var errorMessage = error.message;
        console.log(error)
        if (errorCode == 'auth/user-not-found') {    
            errorSpanLO.innerHTML = "No se encuentra usuario";
            InputLoginEmail.style.backgroundColor = "#fce4e4";
            document.getElementById("login_email").value="";
            return false
        }else if (errorCode == 'auth/wrong-password') {
            errorSpanLO.innerHTML = "Contraseña Incorrecta";
            InputLoginPass.style.backgroundColor = "#fce4e4";
            document.getElementById("login_password").value="";
            return false
        } else{
            rrorSpanLO.innerHTML = "Error inesperado al iniciar sesión";
        }
    })
   
    })


/*
//LOG OUT FIREBASE

//const logout1 = document.querySelector("#logout")

logout.addEventListener('click', e => {
    e.preventDefault();
    auth.signOut().then(() => {
        console.log('sign out')
    })

})
*/




//Events
//list for auth state changes


//LOGIN WITH GOOGLE
const googleButton = document.querySelector('#googlelogin')
googleButton.addEventListener('click', e => {
    const provider = new firebase.auth.GoogleAuthProvider();
    auth.signInWithPopup(provider)
        .then(result =>{
            location.href = "../index.php"
        })
        .catch(err =>{
            console.log(Object)
        })
})



        //TRAER DATOS DE FIREBASE
const postList = document.querySelector('.posts');
const setupPost = data =>{
    if(data.length){
        let html = '';
        data.forEach(doc =>{
            const post = doc.data()
            const li = `
            <li class="list-group-item list-group-item-action">
                <h5>${post.titulo}</h5>
                <p>${post.descripcion}</p>
            </li>
            `;
            html += li; 
            //postList.innerHTML = "picha";
 
        });
        //postList.innerHTML = html;
    }else{
        //postList.innerHTML = '<p classes="text-center"> Login to see posts </p>'
    }
}
auth.onAuthStateChanged(user => {
    if (user){
        fs.collection('cliente')
            .get()
            .then((snapshot) =>{
                console.log(snapshot.docs)
                setupPost(snapshot.docs)
            })
    } else{
        setupPost([])
    }
})

