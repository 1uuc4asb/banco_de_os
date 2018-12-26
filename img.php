<?php
    $n_os = $_GET["n_os"];
    $nome_do_servidor = "localhost";
        $username = "root";
        $senha = "engclin1234";
        $dbname = "OS";
        $conn = new mysqli($nome_do_servidor, $username, $senha, $dbname);
        if( $conn->connect_error) {
            die("Falha de conexão: " . $conn->connect_error);
        }
        $sql = "SELECT `path` FROM `OS's` WHERE `Numero da OS`=" . $n_os;
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $path = $row["path"];
            $path_num = substr_count($path, ';', 0);
            //echo "Foram encontrados " . $path_num . " resultados";
            echo    "<div class=\"modal-header\">
                        <h1 id=\"h1Img\"> Número da OS: " . $n_os . "</h1>
                    </div>
                    <div id=\"imgBody\" class=\"modal-body\">";
            for($i=1; $i <= $path_num; $i++) {
                $img_path = substr($path,0,strpos($path,';'));
                //echo $img_path . "<br/>";
                if ($i == 1) {
                    echo "<img id=\"" . $i . "/" . $path_num . "\" style=\"display: inline-block;\" class=\"img-preview\" src=\"" . $img_path . "\">";
                }
                else {
                    echo "<img id=\"" . $i . "/" . $path_num . "\" style=\"display: none;\" class=\"img-preview\" src=\"" . $img_path . "\">";
                }
                $path = substr($path,strpos($path,';') + 1);
            }

            echo "<ul class=\"img-nav\">";
            for($i=1 ; $i <= $path_num; $i++) {
                echo "<button id=\"" . $i . "/" . $path_num . "\" class=\"btnImgNav\">" . $i . "</button>";
                
            }
            echo "</ul>";
            echo   "</div>
                    <div id=\"footer\" class=\"modal-footer\">
                        <a target=\"_blank\" href=\"download.php?n_os=" . $n_os . "\"><button id=\"". $n_os ."\" class=\"downloadBtn\">Baixar imagens</button></a>
                        <button id=\"cancelBtn3\" class=\"formBtn\">Fechar</button>
                    </div>";
        }
        else {
            "<div class=\"modal-header\">
            <h1 id=\"h1Img\"> Número da OS: " . $n_os . "</h1>
          </div>
          <div id=\"imgBody\" class=\"modal-body\">
                Nenhum imagem registrada para esta OS.
          </div>
          <div id=\"footer\" class=\"modal-footer\">
            <button id=\"cancelBtn3\" class=\"formBtn\">Fechar</button>
          </div>";
        }
        $conn->close();
    /*echo "<div class=\"modal-header\">
            <h1 id=\"h1Img\"> Número da OS: " . $n_os . "</h1>
          </div>
          <div id=\"imgBody\" class=\"modal-body\">
                aaaaaaaaaaaaaaaaaaaa
          </div>
          <div id=\"footer\" class=\"modal-footer\">
            <a target=\"_blank\" href=\"download.php?n_os=" . $n_os . "\"><button id=\"". $n_os ."\" class=\"downloadBtn\">Baixar imagens</button></a>
            <button id=\"cancelBtn3\" class=\"formBtn\">Cancelar</button>
          </div>";*/
?>