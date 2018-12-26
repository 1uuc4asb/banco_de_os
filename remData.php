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

    $n_os = $_POST["n_os"];
    $nome_do_servidor = "localhost";
    $username = "root";
    $senha = "engclin1234";
    $dbname = "OS";
    $conn = new mysqli($nome_do_servidor, $username, $senha, $dbname);

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

    if($conn->connect_error) {
        echo "Falha de conexão com o banco de dados: " . $conn->connect_error;
    }
    $sql = "DELETE FROM `OS's` WHERE `Numero da OS`=\"" . $n_os . "\"";
    //echo $sql . "<br/>";
    if(deleteDirectory("_OS/" . $n_os . "/")) {
        if($conn->query($sql))
            echo "<h2><span class=\"yellow\">OS removida com sucesso!</span></h2><br/>";
        else 
            echo "<h2><span class=\"yellow\">Falha na remoção da OS: " . $conn->error . "</span></h2><br/>";
    }
    else {
        echo "<h2><span class=\"yellow\">Falha na remoção da OS: Falha ao deletar arquivos. </span></h2><br/>";
    }
    echo "<form>
    <button formaction=\"index.php\">Voltar para a página inicial</button>
  </form>";
    echo "</body></html>";
    $conn->close()
?>