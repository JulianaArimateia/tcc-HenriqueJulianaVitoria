let checkboxes = document.querySelectorAll('.opcao');
let produtos = document.querySelectorAll('.card__cardapio');

checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function () {
        let filtroSelecionado = [];

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                filtroSelecionado.push(checkbox.value);
            }
        });

        produtos.forEach(produto => {
            let produtoClasses = produto.classList;
            let correspondeAoFiltro = false;

            filtroSelecionado.forEach(filtro => {
                if (produtoClasses.contains(filtro)) {
                    correspondeAoFiltro = true;
                }
            });

            if (correspondeAoFiltro) {
                produto.classList.remove('none');
            } else {
                produto.classList.add('none');
            }
        });

        if (filtroSelecionado.length == 0) {
            produtos.forEach(produto => {
                produto.classList.remove('none')
            })
        }
    });
});



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