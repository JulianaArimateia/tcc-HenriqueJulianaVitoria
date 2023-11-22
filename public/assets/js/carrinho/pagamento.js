const btn = document.querySelector('#btn__pag')
const divMensagem = document.querySelector('.alert')
const msg = "Compra sendo executada!!!"
const form = document.querySelector('#form')

btn.addEventListener('click', function (e){

     e.preventDefault()
     const mensagem = document.createElement('div')
     divMensagem.appendChild(mensagem)
     mensagem.classList.add("mensagem")
     mensagem.innerText = msg

setTimeout(() => {
                   mensagem.style.display = "none" 
form.submit()
}, 3000);
})