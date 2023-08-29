const btn__favorito = document.querySelector('#favoritar')
let card = document.querySelector('#card')

btn__favorito.addEventListener('click', function(e){
    e.preventDefault()

    btn__favorito.classList.toggle('favoritar')
    btn__favorito.classList.toggle('favoritado')
    card.classList.toggle('favorito')

})