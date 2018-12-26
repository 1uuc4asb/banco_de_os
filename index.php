<!doctype html>
<html>

    <head>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
        <link rel="stylesheet" href="index.css"/>
        <title>Banco de OS's</title>
        <script src="jquery.min.js"></script>
        <script type="text/javascript" charset="utf8" src="datatables.js"></script>
        <script type="text/javascript" charset="utf8" src="tablejs.js"></script>
        <script type="text/javascript" charset="utf8" src="b_os.js"></script>
    </head>
    <body>
        <h1><span class="blue">&lt;</span>Banco de OS's<span class="blue">&gt;</span> <span class="yellow">Experimento</span></h1>
        <!--<h2>Created with love by <a href="http://pablogarciafernandez.com" target="_blank">Pablo García Fernández</a></h2>-->
        <button id="addBtn">
            Adicionar OS
        </button>
        <button id="remBtn">
            Remover OS
        </button>
        <button id="updBtn" style="display: none;">
            Editar OS marcada
        </button>
        <button id="downloadManyBtn" style="display: none;">
            Baixar OS's marcadas
        </button>
        <button id="remManyManyBtn" style="display: none;">
            Remover OS's marcadas
        </button>

        <table id ="bancodeos" class="container">
            <thead>
                <tr>
                    <!--<th><h1>ID</h1></th>-->
                    <th id="selectAllHead"><input id="selectAll" type="checkbox" class="selectAll" ></th>
                    <th><h1>Numero da OS</h1></th>
                    <th><h1>TAG</h1></th>
                    <th><h1>Patrimonio</h1></th>
                    <th><h1>Nome do Equipamento</h1></th>
                    <th><h1>Setor</h1></th>
                    <th><h1>Tipo da OS</h1></th>
                    <th><h1>Data/Horário de Abertura</h1></th>
                    <th><h1>Data/Horário de Fechamento</h1></th>
                    <th><h1>Imagem da OS</h1></th>
                </tr>
            </thead>
            <tbody>
            <?php
                $nome_do_servidor = "localhost";
                $username = "root";
                $senha = "engclin1234";
                $dbname = "OS";

                $conn = new mysqli($nome_do_servidor, $username, $senha, $dbname);
                if( $conn->connect_error) {
                    die("Falha de conexão: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM `OS's`";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td id=\"checktd_". $row["Numero da OS"] . "\" class=\"checktd\" style=\"padding: 8px 18px\">"
                        . "<input id=\"check_" . $row["Numero da OS"]  . "\" type=\"checkbox\" class=\"oscheckboxes\">"
                        . "</td><td>" 
                        . $row["Numero da OS"] 
                        . "</td><td>" 
                        . $row["TAG"] 
                        . "</td><td>" 
                        . $row["Patrimonio"] 
                        . "</td><td>" 
                        . $row["Nome do Equipamento"] 
                        . "</td><td>" 
                        . $row["Setor"] 
                        . "</td><td>" 
                        . $row["Tipo da OS"] 
                        . "</td><td>" 
                        . ($date1 = new Datetime($row["Data/Horario de Abertura"]))->format('m/d/Y - H:i')
                        . "</td><td>"
                        . ($date1 = new Datetime($row["Data/Horario de Fechamento"]))->format('m/d/Y - H:i') 
                        . "</td><td style=\"text-align: center;\">"
                        . "<button id=\"". $row["Numero da OS"] . "\" class = \"imgBtn\">Abrir visualização da OS</button>" 
                            //"Algum link para imagem"//$row["Imagem da OS"]
                        . "</td></tr>";
                    }
                }
                else {
                    echo "0 results";
                }
                $conn->close();
            ?>
            </tbody>
        </table>
        <!--
        <table class="container">
            <thead>
                <tr>
                    <th><h1>Sites</h1></th>
                    <th><h1>Views</h1></th>
                    <th><h1>Clicks</h1></th>
                    <th><h1>Average</h1></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Google</td>
                    <td>9518</td>
                    <td>6369</td>
                    <td>01:32:50</td>
                </tr>
                <tr>
                    <td>Twitter</td>
                    <td>7326</td>
                    <td>10437</td>
                    <td>00:51:22</td>
                </tr>
                <tr>
                    <td>Amazon</td>
                    <td>4162</td>
                    <td>5327</td>
                    <td>00:24:34</td>
                </tr>
            <tr>
                    <td>LinkedIn</td>
                    <td>3654</td>
                    <td>2961</td>
                    <td>00:12:10</td>
                </tr>
            <tr>
                    <td>CodePen</td>
                    <td>2002</td>
                    <td>4135</td>
                    <td>00:46:19</td>
                </tr>
            <tr>
                    <td>GitHub</td>
                    <td>4623</td>
                    <td>3486</td>
                    <td>00:31:52</td>
                </tr>
            </tbody>
        </table>
            -->
        

            <section id="addModal" class="modal">
            <!-- Modal content -->
                <article class="modal-content">
                    <div class="modal-header">
                        <h1>Adicionar uma OS ao banco <br/> <span class="yellow">Em produção...</span></h1>
                        Já é possível adicionar dados ao banco. Ainda não foi feito qualquer tipo de tratamento de dado. (N° de OS repetida e horário de início/fechamento);
                    </div>
                    <div class="modal-body">
                        <p id="formP"> Preencha os dados abaixo para registrar a OS: </p>
                        <form id="form1" name="form1" action="formhandler.php" method="POST" enctype="multipart/form-data">
                            <div class="input-wrap">
                                <input type="text" name="nos" class="formInputs" placeholder="Número da OS" required>
                            </div>
                            <div class="input-wrap">
                                <input type="text" name="tag" class="formInputs" placeholder="TAG" required>
                            </div>
                            <div class="input-wrap">
                                <input type="text" name="pat" class="formInputs" placeholder="Patrimônio" required>
                            </div>
                            <div class="input-wrap">
                                <input type="text" name="equip" class="formInputs" placeholder="Nome do equipamento" required>
                            </div>
                            <!--<input type="text" name="set" class="formInputs" placeholder="Setor" required>-->
                            <div class="input-wrap">
                                <label for="set"> Setor : </label> 
                                <select id="setorselect" name="set" class="formInputs" form="form1">
                                    <?php
                                        $setores = array("Acolhimento" ,
                                        "Administração",
                                        "Administração 6° andar",
                                        "Almoxarifado Central",
                                        "Almoxarifado Engenharia Clínica",
                                        "Almoxarifado Manutenção",
                                        "Almoxarifado Nutrição",
                                        "Ambulância",
                                        "Ambulatório",
                                        "Anatomia Patológica",
                                        "Anexo",
                                        "Apartamento 01",
                                        "Apartamento 02",
                                        "Arquitetura",
                                        "Arquivo",
                                        "Assistente ADM-Financeira",
                                        "Auditoria",
                                        "Auditório",
                                        "Banco de Sangue",
                                        "Biblioteca",
                                        "Brinquedoteca",
                                        "Call Center",
                                        "Campanha Sua Nota é um Show",
                                        "Capela",
                                        "Captação de Recursos",
                                        "Cardiopediatria",
                                        "Central de Material Esterelizável",
                                        "Central Telefônica",
                                        "Centro Cirúrgico",
                                        "Centro de Controle e Infecção Hospitalar",
                                        "Centro de Pediatria de ROMA",
                                        "Centro de Referência para o Autismo",
                                        "Cine Martaguinho",
                                        "CIPE",
                                        "Clínica Cirúrgica",
                                        "Clínica Oncológica",
                                        "Clínica Pediátrica A",
                                        "Clínica Pediátrica B",
                                        "Clínica Pediátrica C",
                                        "Compras",
                                        "Comunicação",
                                        "Conforto Enfermaria",
                                        "Conforto Médico",
                                        "Consultório 03 HMG",
                                        "Consultório 04 HMG",
                                        "Consultório 05 HMG",
                                        "Consultório 06 HMG",
                                        "Consultório 07 HMG",
                                        "Consultório 08 HMG",
                                        "Consultório 1",
                                        "Consultório 10 HMG",
                                        "Consultório 13 HMG",
                                        "Consultório 14 HMG",
                                        "Consultório 15 HMG",
                                        "Consultório 2",
                                        "Consultório 3",
                                        "Consultório Ortopedia 01",
                                        "Consultório Ortopedia 02",
                                        "Consultório Ortopedia 03",
                                        "Consultórios",
                                        "Contabilidade",
                                        "Coordenação de Contratos e Projetos",
                                        "Coordenação de Enfermagem",
                                        "Coordenação de Hotelaria",
                                        "Coordenação de Suprimentos",
                                        "Coordenação P.A.",
                                        "Coreme",
                                        "Consultório 02 HMG",
                                        "Desenvolvimento de Pessoas",
                                        "Diretoria ADM/FIN",
                                        "Diretoria de Projetos",
                                        "Diretoria Técnica",
                                        "Ecografia",
                                        "Enfermaria 1",
                                        "Enfermaria 2",
                                        "Engenharia Clínica",
                                        "Engenharia Civil",
                                        "Entrega de Resultados",
                                        "Farmácia",
                                        "Farmácia Central",
                                        "Farmácia Centro Cirúrgico",
                                        "Farmácia de Manipulação ( Oncologia )",
                                        "Farmácia UTI NEO",
                                        "Farmácia UTI Pediátrica",
                                        "Faturamento",
                                        "Financeiro",
                                        "Fisioterapia",
                                        "Fissurados",
                                        "Fonoaudiologia",
                                        "Fotocopia",
                                        "Gerência",
                                        "Gerência Médica",
                                        "Gerência Operacional",
                                        "Gerência RH",
                                        "Gestão de Pessoas",
                                        "Higienização",
                                        "HMG PA (SOBABY VILAS)",
                                        "Homecare UTD",
                                        "Hospital São Lucas",
                                        "Internamento/NIRP",
                                        "Jurídico",
                                        "Laboratório",
                                        "Lactário HMG",
                                        "Lactário Vilas",
                                        "Lavanderia",
                                        "LIGA - ADM",
                                        "Ludoteca",
                                        "Manutenção",
                                        "Marcação de Cirurgia",
                                        "Marcação de Consulta",
                                        "Medicina Ocupacional",
                                        "Memorial",
                                        "Necrotério",
                                        "Nutrição",
                                        "Nutrição Enteral",
                                        "Nutrição Parenteral",
                                        "Observação",
                                        "Odontologia",
                                        "Oncologia Ambulatório",
                                        "Operacional",
                                        "Ortopedia Consultório 2",
                                        "Ouvidoria",
                                        "Patrimônio",
                                        "PAVD",
                                        "Planejamento 6° andar",
                                        "Portaria",
                                        "Posto de Enfermagem",
                                        "Prescrição Médica",
                                        "Procedimento de Gesso",
                                        "Pronto Atendimento",
                                        "Psicologia",
                                        "Radiologia",
                                        "Raio X - SO KIDS",
                                        "Raio X Telecomandado",
                                        "Recepção",
                                        "Recepção 2° andar",
                                        "Recepção Oncologia",
                                        "Recepção Principal",
                                        "Recrutamento e Seleção",
                                        "Residência Médica",
                                        "Rouparia e Costura",
                                        "SAE",
                                        "Sala de curativos",
                                        "Sala de D. Romilza",
                                        "Sala de Gesso",
                                        "Sala de Reanimação",
                                        "Sala de Reunião",
                                        "SAME",
                                        "Santa Casa de Misericórdia de Cruz das Almas",
                                        "Santa Casa de Misericórdia de Nazaré",
                                        "Santa Casa de Misericórdia de Ruy Barbosa",
                                        "Segurança do Trabalho",
                                        "SERPEQ",
                                        "Serviço de Controle de Infecção Hospitalar - SCIH",
                                        "Serviço Social",
                                        "Setor Pessoal",
                                        "SOKIDS",
                                        "Subestação",
                                        "Superintendência",
                                        "Telemarketing",
                                        "Terapia Ocupacional",
                                        "TI/Sistema",
                                        "TI/Suporte",
                                        "Tomografia",
                                        "Transporte",
                                        "Ultrassonografia",
                                        "Uroanálise",
                                        "UTD/SESAB",
                                        "UTI",
                                        "UTI Convênios",
                                        "UTI NEO",
                                        "UTI Pediátrica B",
                                        "Voluntariado");
                                            for($i = 0; $i < count($setores); $i++) {
                                                echo "<option value=\"" . $setores[$i] . "\">" . $setores[$i] . "</option>";
                                            }                              
                                    ?>
                                </select>
                            </div>
                            <div class="input-wrap">
                                <label for="ost"> Tipo da OS : </label>
                                <select form="form1" name="ost" class="formInputs" required>
                                    <option value="Corretiva"> Corretiva </option>
                                    <option value="Preventiva"> Preventiva </option>
                                    <option value="Recebimento"> Recebimento </option>
                                    <option value="Instalação"> Instalação </option>
                                    <option value="Desinstalação"> Desinstalação </option>
                                    <option value="Treinamento"> Treinamento </option>
                                </select>
                            </div>
                            <div class="input-wrap">
                                <label for="data1">Data/Horário de Abertura : </label>
                                <input type="datetime-local" class="formInputs" placeholder="Data/Horário de Abertura" name="data1" required>
                            </div>
                            <div class="input-wrap">
                                <label for="data2">Data/Horário de Fechamento : </label> 
                                <input type="datetime-local" class="formInputs" name="data2" required>
                            </div>
                            <div class="input-wrap">
                                <label for="img">Imagem(ns) da OS : </label> 
                                <input id="img-wrap" type="file" class="formInputs" name="img[]" multiple required>
                            </div>
                            <input type="button" class="formBtn" value="Adicionar OS" onclick="confirmarForm()">
                        </form>
                        <button id="cancelBtn1" class="cancelBtn">Cancelar</button>
                    </div>
                </article>

            </section>
            <section id="remModal" class="modal">
                <article class="modal-content">
                    <div class="modal-header">
                        <h1>Remover uma OS do banco<br/><span class="yellow">Em produção...</span></h1>
                        Já é possível remover dados do banco. Ainda não foi feito qualquer tipo de tratamento de dado. (Remoção de dado que não existe no banco).
                    </div>
                    <div class="modal-body">
                        <p id="formP">  Digite o número da OS que você deseja remover do banco:  </p>
                        <form id="form2" action="remData.php" method="POST" enctype="multipart/form-data">
                            <div class="input-wrap">
                                <?php 
                                    $nome_do_servidor = "localhost";
                                    $username = "root";
                                    $senha = "engclin1234";
                                    $dbname = "OS";
                    
                                    $conn = new mysqli($nome_do_servidor, $username, $senha, $dbname);
                                    if( $conn->connect_error) {
                                        die("Falha de conexão: " . $conn->connect_error);
                                    }
                    
                                    $sql = "SELECT `Numero da OS` FROM `OS's`";
                                    $result = $conn->query($sql);
                                    
                                    echo "<select name=\"n_os\" form=\"form2\" class=\"formInputs\">";
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<option value=\"" . $row["Numero da OS"] ."\">". $row["Numero da OS"] . "</option>";
                                        }
                                    } 
                                    else {
                                        echo "0 results";
                                    }
                                    echo "</select>";
                                    $conn->close();
                                ?>
                                <input class="formBtn" type="submit">
                            </div>
                        </form>
                        <button id="cancelBtn2" class="cancelBtn">Cancelar</button>
                    </div>
                </article>
            </section>

            <section id="imgModal" class="modal">
                <article id="img-article" class="modal-content">
                    
                </article>
            </section>
            <h2> Por Lucas Borges </h2>
    </body>
    
</html>


<!--
"Acolhimento" ,
"Administração",
"Administração 6° andar",
"Almoxarifado Central",
"Almoxarifado Engenharia Clínica",
"Almoxarifado Manutenção",
"Almoxarifado Nutrição",
"Ambulância",
"Ambulatório",
"Anatomia Patológica",
"Anexo",
"Apartamento 01",
"Apartamento 02",
"Arquitetura",
"Arquivo",
"Assistente ADM-Financeira",
"Auditoria",
"Auditório",
"Banco de Sangue",
"Biblioteca",
"Brinquedoteca",
"Call Center",
"Campanha Sua Nota é um Show",
"Capela",
"Captação de Recursos",
"Cardiopediatria",
"Central de Material Esterelizável",
"Central Telefônica",
"Centro Cirúrgico",
"Centro de Controle e Infecção Hospitalar",
"Centro de Pediatria de ROMA",
"Centro de Referência para o Autismo",
"Cine Martaguinho",
"CIPE",
"Clínica Cirúrgica",
"Clínica Oncológica",
"Clínica Pediátrica A",
"Clínica Pediátrica B",
"Clínica Pediátrica C",
"Compras",
"Comunicação",
"Conforto Enfermaria",
"Conforto Médico",
"Consultório 03 HMG",
"Consultório 04 HMG",
"Consultório 05 HMG",
"Consultório 06 HMG",
"Consultório 07 HMG",
"Consultório 08 HMG",
"Consultório 1",
"Consultório 10 HMG",
"Consultório 13 HMG",
"Consultório 14 HMG",
"Consultório 15 HMG",
"Consultório 2",
"Consultório 3",
"Consultório Ortopedia 01",
"Consultório Ortopedia 02",
"Consultório Ortopedia 03",
"Consultórios",
"Contabilidade",
"Coordenação de Contratos e Projetos",
"Coordenação de Enfermagem",
"Coordenação de Hotelaria",
"Coordenação de Suprimentos",
"Coordenação P.A.",
"Coreme",
"Consultório 02 HMG",
"Desenvolvimento de Pessoas",
"Diretoria ADM/FIN",
"Diretoria de Projetos",
"Diretoria Técnica",
"Ecografia",
"Enfermaria 1",
"Enfermaria 2",
"Engenharia Clínica",
"Engenharia Civil",
"Entrega de Resultados",
"Farmácia",
"Farmácia Central",
"Farmácia Centro Cirúrgico",
"Farmácia de Manipulação ( Oncologia )",
"Farmácia UTI NEO",
"Farmácia UTI Pediátrica",
"Faturamento",
"Financeiro",
"Fisioterapia",
"Fissurados",
"Fonoaudiologia",
"Fotocopia",
"Gerência",
"Gerência Médica",
"Gerência Operacional",
"Gerência RH",
"Gestão de Pessoas",
"Higienização",
"HMG PA (SOBABY VILAS)",
"Homecare UTD",
"Hospital São Lucas",
"Internamento/NIRP",
"Jurídico",
"Laboratório",
"Lactário HMG",
"Lactário Vilas",
"Lavanderia",
"LIGA - ADM",
"Ludoteca",
"Manutenção",
"Marcação de Cirurgia",
"Marcação de Consulta",
"Medicina Ocupacional",
"Memorial",
"Necrotério",
"Nutrição",
"Nutrição Enteral",
"Nutrição Parenteral",
"Observação",
"Odontologia",
"Oncologia Ambulatório",
"Operacional",
"Ortopedia Consultório 2",
"Ouvidoria",
"Patrimônio",
"PAVD",
"Planejamento 6° andar",
"Portaria",
"Posto de Enfermagem",
"Prescrição Médica",
"Procedimento de Gesso",
"Pronto Atendimento",
"Psicologia",
"Radiologia",
"Raio X - SO KIDS",
"Raio X Telecomandado",
"Recepção",
"Recepção 2° andar",
"Recepção Oncologia",
"Recepção Principal",
"Recrutamento e Seleção",
"Residência Médica",
"Rouparia e Costura",
"SAE",
"Sala de curativos",
"Sala de D. Romilza",
"Sala de Gesso",
"Sala de Reanimação",
"Sala de Reunião",
"SAME",
"Santa Casa de Misericórdia de Cruz das Almas",
"Santa Casa de Misericórdia de Nazaré",
"Santa Casa de Misericórdia de Ruy Barbosa",
"Segurança do Trabalho",
"SERPEQ",
"Serviço de Controle de Infecção Hospitalar - SCIH",
"Serviço Social",
"Setor Pessoal",
"SOKIDS",
"Subestação",
"Superintendência",
"Telemarketing",
"Terapia Ocupacional",
"TI/Sistema",
"TI/Suporte",
"Tomografia",
"Transporte",
"Ultrassonografia",
"Uroanálise",
"UTD/SESAB",
"UTI",
"UTI Convênios",
"UTI NEO",
"UTI Pediátrica B",
"Voluntariado"


-->