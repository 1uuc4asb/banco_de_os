<?php
    $n_os = $_GET["n_os"];
    $arquivoNome = $n_os . ".zip" ; // nome do arquivo que será enviado p/ download
    $arquivoLocal = "_OS/" . $n_os . '/' . $arquivoNome; // caminho absoluto do arquivo
    var_dump($arquivoLocal);
    // Verifica se o arquivo não existe
    if (!(file_exists($arquivoLocal))) {
        // Exiba uma mensagem de erro caso ele não exista
        echo "Arquivo não encontrado em : " . $arquivoLocal;
        exit;
    }
    else {
        echo $arquivoLocal;
    }
    // Aqui você pode aumentar o contador de downloads
    // Definimos o novo nome do arquivo
    $novoNome = $arquivoNome;
    // Configuramos os headers que serão enviados para o browser
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename="'.$novoNome.'"');
    header('Content-Type: application/octet-stream');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($arquivoLocal));
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Expires: 0');
    // Envia o arquivo para o cliente
    ob_clean();
    flush();
    readfile($arquivoLocal);
?>