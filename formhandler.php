<?php
    function deleteDirectory($dirPath) {
        if (is_dir($dirPath)) {
            if(!($objects = scandir($dirPath))) {
                return false;
            }
            foreach ($objects as $object) {
                if ($object != "." && $object !="..") {
                    if (filetype($dirPath . DIRECTORY_SEPARATOR . $object) == "dir") {
                        deleteDirectory($dirPath . DIRECTORY_SEPARATOR . $object);
                    } else {
                        if(!(unlink($dirPath . DIRECTORY_SEPARATOR . $object))) {
                            echo "Passou do segundo";
                            return false;
                        }
                    }
                }
            }
            reset($objects);
            rmdir($dirPath);
            return true;
        }
        else {
            return false;
        }
    }

    $nos = $_POST['nos'];
    $tag = $_POST['tag'];
    $pat = $_POST['pat'];
    $equip = $_POST['equip'];
    $set = $_POST['set'];
    $ost = $_POST['ost'];
    $data1 = $_POST['data1'];
    $data2 = $_POST['data2'];

    /*if($data) {
        die("V");
    }*/
/*
    echo $nos . "<br/>";
    echo $tag . "<br/>";
    echo $pat . "<br/>";
    echo $equip . "<br/>";
    echo $set . "<br/>";
    echo $ost . "<br/>";
    echo $data1 . "<br/>";
    echo $data2 . "<br/>";
    */
    echo "<!doctype html>
    <html>

    <head>
        <meta charset=\"UTF-8\"/>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css\">
        <link rel=\"stylesheet\" href=\"index.css\"/>
        <title>Banco de OS's</title>
    </head>
    <body>
    <h1><span class=\"blue\">&lt;</span>Banco de OS's<span class=\"blue\">&gt;</span> <span class=\"yellow\">Experimento</span></h1>";
    // VAMO LA
    if(isset($_FILES['img'])) {
        $path = "";
        $i = 0;
        $quantidade_de_arquivos = count($_FILES['img']['name']);
        $nome_da_pasta1 = "_OS/";
        if(!(is_dir($nome_da_pasta1))) {
            mkdir($nome_da_pasta1, 0755, true);
        }
        $nome_da_pasta = $nome_da_pasta1 . $_POST['nos'] . "/";
        if(!(is_dir($nome_da_pasta))) {
            mkdir($nome_da_pasta, 0755, true);
        }
        $zip = new ZipArchive;
        $zip->open( $nome_da_pasta1 . $_POST['nos'] . "/" . $_POST['nos'] . '.zip', ZipArchive::CREATE);
        while($i < $quantidade_de_arquivos) {
            $extensao = strtolower(substr($_FILES['img']['name'][$i], -4));
            $extensoes_compativeis = [".jpg",".bmp",".tif",".png"];
/*
            if(is_writable($nome_da_pasta1)) {
                echo "Da pra escrever mlk<br/>";
            }
            else {
                echo "Nao vai da nao<br/>";
            }*/
            if(in_array($extensao,$extensoes_compativeis)) {
                $novo_nome = $_POST['nos'] . "_" . $i . $extensao;
                //echo "Caminho do arquivo: " . $nome_da_pasta.$novo_nome . "<br/>";
                
                if(!(move_uploaded_file($_FILES['img']['tmp_name'][$i], $nome_da_pasta.$novo_nome )))
                    //echo "Arquivo enviado!!<br/>";
                    die("Falha ao mover arquivo.");
                /*else
                    //echo "Arquivo não enviado!!<br/>";
                    die("Falha ao remover arquivo.");*/
            }////////////////////////////////////////////////////////////////////////////////////////////////////////// Printar arquivo incompatível ( ENCAPSULAR TUDO )
            if (!($zip->addFile( 
                $nome_da_pasta.$novo_nome , 
                $novo_nome 
            ))) //{
                die("Houve um problema ao compactar o(s) arquivo(s).");
                /*echo "COMPACTOU MANO <br/>";
            }
            else {
                echo "ñ COMPACTOU MANO :( <br/>";
            }*/
            $path .= $nome_da_pasta.$novo_nome . ";";
            $i++;
        }
        $zip->close();

        $nome_do_servidor = "localhost";
        $username = "root";
        $senha = "engclin1234";
        $dbname = "OS";
        $conn = new mysqli($nome_do_servidor, $username, $senha, $dbname);
        if( $conn->connect_error) {
            die("Falha de conexão: " . $conn->connect_error);
        }
    $sql = "INSERT INTO `OS's` (`Numero da OS`, `TAG`, `Patrimonio`, `Nome do Equipamento`, `Setor`, `Tipo da OS`, `Data/Horario de Abertura`, `Data/Horario de Fechamento`, `path`) VALUES (\"" . $nos . "\",\"" . $tag . "\",\"" . $pat . "\",\"" . $equip . "\",\"" . $set . "\",\"" . $ost . "\",\"" . $data1 . "\",\"" . $data2 . "\",\"" . $path . "\")";
    //echo $sql . "<br/>";
        if($conn->query($sql)) {
            echo "<h2><span class=\"yellow\">Informações adicionas com sucesso.</span></h2> <br/>";
        }
        else {
            deleteDirectory($nome_da_pasta);
            echo "<h2><span class=\"yellow\">Informações não adicionadas: " . $conn->error . "</span></h2><br/>";
        }
    }
    echo "<form>
                <button formaction=\"index.php\">Voltar para a página inicial</button>
            </form>";
                echo "</body></html>";
    $conn->close()
?>