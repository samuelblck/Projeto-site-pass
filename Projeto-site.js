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
