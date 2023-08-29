const detalhe = document.querySelector('#detalhe')
const alternar__1 = document.querySelector('#alternar__1')
const alternar__2 = document.querySelector('#alternar__2')

alternar__1.addEventListener('click', function (e) {
    e.preventDefault()
    detalhe.classList.add('alternar')
})

alternar__2.addEventListener('click', function (e) {
    e.preventDefault()
    detalhe.classList.remove('alternar')
})