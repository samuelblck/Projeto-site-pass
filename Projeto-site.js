function entrar(){
    var loginTeste = 'email@email.com' // Simula um login qualquer para teste
    var senhaTeste = 'senha123'        // Simula uma senha qualquer para teste

    var user = window.document.getElementById("user1").value.toLowerCase();
    var pass = window.document.getElementById("pass1").value
    var ent = window.document.getElementById("entrada1")
    // ent.innerHTML = `Bem vindo ${user}`
    
    if (user === loginTeste && pass === senhaTeste){ // Verifica se o email e senha informado bate com o da variavel
        window.location.href = `paginaInicial.html?user=${encodeURIComponent(user)}`; // Caso o login for verdadeiro, ele vai pra pagina inicial passando o email na URL

    }else if (pass != senhaTeste || user != loginTeste ){ // Usuario ou senha incorreto apenas avisa.
        ent.style.color = 'red'
        ent.innerHTML = ''
        ent.innerHTML = `Usuario ou senha incorretos.` 

    }
}

function paginaInicial(user){
    var msgBoasVindas = document.getElementById('msgBoasVindas')
    msgBoasVindas.style.color = 'black'
    msgBoasVindas.innerHTML = `Usuario conectado: ${user}`
}

function cadastro(){
    window.location.href = 'cadastro.html' // Difeciona o usuario para a pagina cadastro
}

//função para ocultar e mostrar a senha//
function mostrarsenha(){
    var inputpass = document.getElementById('pass1')
    var btnmostrarsenha = document.getElementById('ocultar')

    if(inputpass.type === 'password'){
        inputpass.setAttribute('type','text')
        btnmostrarsenha.classList.replace('bi-eye', 'bi-eye-slash')
    }else  {
        inputpass.setAttribute('type','password')
        btnmostrarsenha.classList.replace('bi-eye-slash', 'bi-eye')   
    }
}
