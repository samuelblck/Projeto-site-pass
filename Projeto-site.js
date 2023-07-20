function entrar(){
    var user = window.document.getElementById ("user1").value;
    var pass = window.document.getElementById("pass1").value
    var ent = window.document.getElementById("entrada1")
    ent.innerHTML = `Bem vindo ${user}`
    }