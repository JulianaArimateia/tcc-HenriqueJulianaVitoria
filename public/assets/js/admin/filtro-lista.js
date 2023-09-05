const filtroInput = document.querySelector('#filtro')
const produtos = document.querySelectorAll('#produto')

filtroInput.addEventListener('input', function (e) {
    e.preventDefault()

    let filtro = filtroInput.value.toLowerCase()

    for (let i = 0; i <= produtos.length; i++) {
        let texto = produtos[i].textContent.toLowerCase()
        if (texto.includes(filtro)) {
            produtos[i].classList.remove('none')
        } else {
            produtos[i].classList.add('none')
        }
    }
})