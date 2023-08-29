<?php

function dd($param = [])
{
    echo '<pre>';
    print_r($param);
    echo '</pre>';
    exit();
}

function getData()
{
    $data = getdate();
    $diaHoje = date('d');
    $array_meses = array(
        1 => "janeiro", 2 => "fevereiro", 3 => "março", 4 => "abril", 5 => "maio", 6 => "junho",
        7 => "julho", 8 => "agosto", 9 => "setembro", 10 => "outubro", 11 => "novembro", 12 => "dezembro"
    );
    $hora_agora = date('H:i');
    $mesgetdate = $data['mon'];
    $anoatual   = date('Y');

    // Array com os dias da semana
    $diasemana = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sabado');

    // Aqui podemos usar a data atual ou qualquer outra data no formato Ano-mês-dia (2014-02-28)
    $data = date('Y-m-d');

    // Varivel que recebe o dia da semana (0 = Domingo, 1 = Segunda ...)
    $diasemana_numero = date('w', strtotime($data));

    // Exibe o dia da semana com o Array
    //echo $diasemana[$diasemana_numero];

    return $diasemana[$diasemana_numero] . ', ' . $diaHoje . ' de ' . $array_meses[$mesgetdate] . ' de ' . $anoatual . ' às ' . $hora_agora . '';
}    //fim function getData()


//IMAGEM
function upload($file = [], $pasta)
{
    if ($file['size'] > 0) {
        // dd($imagem);
        // selecionou uma imagem
        // $imagem = $arquivo['file_imagem'];
        $nome_file = removerEspacosTexto(md5(uniqid(rand(), true)) . $file['name']);
        $pasta_file = "assets/uploads/" . $pasta;
        $dest_file = $pasta_file . "/" . $nome_file;

        if (!move_uploaded_file($file['tmp_name'], $dest_file)) { // Executa o comando do upload no servidor
            // echo "Não foi possível enviar a imagem!"; /* Caso não foi possível enviar o arquivo, mostra o erro. */
            return "";
        }

        return $nome_file;
    }
}

//Ainda falta finalizar - se usar como esta vai dar erro
// function uploadWithResize($file = [], $pasta, $largura = 400, $altura = 400)
// {
//     $caminho_Imagem = "assets/uploads/" . $pasta . "/";

//     if (count($file) > 0) {
//         $type = $file['type'];
//         $tmpName = $file['tmp_name'];

//         // dd($file['tmp_name']);
//         $geraNome = md5(time().rand(0, 9999)). '.jpg';
//         move_uploaded_file($tmpName, $caminho_Imagem.$geraNome);

//         // dd($caminho_Imagem.$geraNome);
//         list($largura_atual, $altura_atual) = getimagesize($caminho_Imagem.$geraNome);

//         $largura_nova = $largura;
//         $altura_nova = $altura;

//         $img = imagecreatetruecolor($largura_nova, $altura_nova);
        
//         $original = imagecreatefromjpeg($caminho_Imagem.$geraNome);
//         imagecopyresampled($img, $original, 0, 0, 0, 0, $largura_nova, $altura_nova, $largura_atual, $altura_atual);
//         imagejpeg($img, $caminho_Imagem.$geraNome, 75);

//         return $geraNome;
//     }
// }

//Diferenca dias entre datas
function diasDatas($data_inicial, $data_final)
{

    if ($data_final == null) {
        $data_final = date("Y-m-d");
    }
    $diferenca = strtotime($data_final) - strtotime($data_inicial);
    $dias = floor($diferenca / (60 * 60 * 24));
    return $dias;
}

//formatar para moeda Real
function formatarMoeda($valor, $simbolo, $casasDecimais = 2)
{
    echo $simbolo . " " . number_format($valor, $casasDecimais, ",", ".");
}

//Reorganizar o array multiple vindo do input post
function formataArrayFile(&$file_post)
{
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i = 0; $i < $file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}

function removerEspacosTexto($texto)
{
    $texto = str_replace(" ", "", $texto);
    return $texto;
}

function removerArquivoServidor($pasta, $arquivo)
{
    $caminhoArquivo = "assets/uploads/" . $pasta . "/" . $arquivo;
    if (!unlink($caminhoArquivo)) {
        return false;
    } else {
        return true;
    }
}

function converteByteToMega($byte)
{
    $mega = str_replace('.', ',', number_format($byte / 1024 / 1024, 1)) . ' Mb';
    return $mega;
}
