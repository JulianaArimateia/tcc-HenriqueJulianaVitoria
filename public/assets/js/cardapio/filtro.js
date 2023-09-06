let opcoes = document.querySelectorAll('#opcao')
let produtos = document.querySelectorAll('.card__cardapio')

for (let i = 0; i <= opcao.length; i++) {

    let opcao = opcoes[i]

    opcao.addEventListener('change', function () {

        opcao.classList.toggle('ativo')

        for (let x = 0; x <= produtos.length; x++) {

            let produto = produtos[x]

            produto.classList.add('none')

            if (opcao.classList.value.includes('ativo') == true) {

                if (produto.classList.value.includes(opcao.value) == true) {
                    produto.classList.remove('none')
                } else {
                    produto.classList.add('none')
                }

            }

        }

    })

}

// ---------------------------------------------------------------------------------------------------------


const filtroInput = document.querySelector('#filtro')

filtroInput.addEventListener('input', function () {

    console.log('oi')

    let filtro = filtroInput.value.toLowerCase()

    for (let y = 0; y <= produtos.length; y++) {
        let texto = produtos[y].textContent.toLowerCase()
        if (texto.includes(filtro)) {
            produtos[y].classList.remove('none')
        } else {
            produtos[y].classList.add('none')
        }
    }
})