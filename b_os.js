$(document).ready( function () {/*
    // Get the modal
    var modal = document.getElementById('myModal');
    var modal2 = document.getElementById('myModal2');
    var imgModal = document.getElementById('imgModal');

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");
    var btn2 = document.getElementById("myBtn2");
    var imgBtn = document.getElementById("imgBtn");

    var cancelBtn = document.getElementById("cancelBtn");
    var cancelBtn2 = document.getElementById("cancelBtn2");
    var cancelBtn3 = document.getElementById("cancelBtn3");

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    btn2.onclick = function() {
        modal2.style.display = "block";
    }

    imgBtn.onclick = function() {
        imgModal.style.display = "block";
    }
    // When the user clicks anywhere outside of the modal, close it
    cancelBtn.onclick = function(event) {
        if(confirm("Você deseja cancelar a operação? (Você perderá todos os dados preenchidos até o momento)")){
            document.getElementById("archinput").value = "";
            modal.style.display = "none";
        }
            
    }

    cancelBtn2.onclick = function(event) {
        modal2.style.display = "none";
    }

    cancelBtn3.onclick = function (event) {
        console.log("Clicou em cancelar.")
        imgModal.style.display = "none";
    }*/


} );

function verficaInputs(inputsa) {
    var inputs = inputsa;
    console.log("-----------------------------");
    inputs.forEach(element => {
        console.log(element);
        var x = document.getElementsByName(element)[0];
        if(x.value == "") {
            //console.log(x.id + " está vazio.");
            //console.log(x.type);
            if(x.type == "datetime-local") {
                alert("Não preencheu cabaço");
            }
        }
        else {
            if(x.type == "datetime-local") {
                console.log("É do tipo DATA");
                if(!(new Date(x.value))) {
                    alert("Preencha os dados corretamente. As datas devem ser preenchidas no formato: dd/mm/aa hh:mm .");
                }
                else {
                    alert("Foi de boa");
                }
            }
        }
    });
    console.log("-----------------------------");
    return false;
}

function confirmarForm () {
    var nos = document.getElementsByName("nos")[0];
    var tag = document.getElementsByName("tag")[0];
    var pat = document.getElementsByName("pat")[0];
    var equip = document.getElementsByName("equip")[0];
    var set = document.getElementsByName("set")[0];
    var ost = document.getElementsByName("ost")[0];
    var data1 = document.getElementsByName("data1")[0];
    var data2 = document.getElementsByName("data2")[0];

    console.log(nos.value);
    var inputs = ["nos","tag","pat","equip","set","ost","data1","data2"];
    if(verficaInputs(inputs)) {
        if(confirm("Confirme os dados da OS. Quando estiver pronto para prosseguir, aperte OK.\nNúmero da OS: " + nos.value + "\nTAG: " + tag.value + "\nPatrimônio: " + pat.value + "\nEquipamento: " + equip.value + "\nSetor: " + set.value + "\nTipo da OS: " + ost.value + "\nData/Horário de Abertura: " + new Date(data1.value).toLocaleString().replace(" "," - ") + "\nData/Horário de Fechamento: " + new Date(data2.value).toLocaleString().replace(" "," - "))) {
            document.form1.submit() 
        }
    }
    else {
        alert("Preencha todos os dados antes de adicionar a OS!");
    }
}

function abrirVisualizacao (numero_da_os, n_arquivos) {
    console.log("teste");
    var h1Img = document.getElementById("h1Img");
    var modal_body = document.getElementById("imgBody");
    console.log(numero_da_os);
    h1Img.innerHTML = "Número da OS: " + numero_da_os;
    modal_body.innerHTML = "<button id=\"cancelBtn3\" class=\"formBtn\">Cancelar</button>";

    /*
        "<a target=\"_blank\" href=\"download.php?file=" . $row["Numero da OS"] . "\">
                            <img id=\"download\" style=\"border: solid; border-radius: 2px; border-color: transparent; box-shadow: 4px 5px 15px rgba(0,0,0); width: 3em;\" src=\"_imgs/folder-img.png\"/>
                        </a>"
    */
}

function AjaxF()
{
 var ajax;

 try
 {
  ajax = new XMLHttpRequest();
 } 
 catch(e) 
 {
  try
  {
   ajax = new ActiveXObject("Msxml2.XMLHTTP");
  }
  catch(e) 
  {
   try 
   {
    ajax = new ActiveXObject("Microsoft.XMLHTTP");
   }
   catch(e) 
   {
    alert("Seu browser não da suporte à AJAX!");
    return false;
   }
  }
 }
 return ajax;
}

$(document).on("click","#addBtn",function () {
    var modal = document.getElementById('addModal');
    modal.style.display = "block";
});

$(document).on("click","#remBtn",function () {
    var modal = document.getElementById('remModal');
    modal.style.display = "block";
});

$(document).on("click",".imgBtn",function () {
    var ajax = AjaxF();
    ajax.onreadystatechange = function(){
        if(ajax.readyState == 4)
        {
            document.getElementById('img-article').innerHTML = ajax.responseText;
        }
    }
    var dados = "n_os=" + this.id;
    ajax.open("GET", "img.php?"+dados, true);
    ajax.setRequestHeader("Content-Type", "text/html");
    ajax.send();
    var imgModal = document.getElementById('imgModal');
    imgModal.style.display = "block";
});
/*
function retornaFormato (file) {
    var formato;
    var fs = require('fs');
    if(fs.exists(file + ".jpg")) {
        return ".jpg";
    }
    else if(fs.exists(file + ".png")) {
        return ".png";
    }

    return formato;
}*/

$(document).on("click","#cancelBtn1",function () {
    var modal = document.getElementById('addModal');
    modal.style.display = "none";
});

$(document).on("click","#cancelBtn2",function () {
    var modal = document.getElementById('remModal');
    modal.style.display = "none";
});

$(document).on("click","#cancelBtn3",function () {
    var imgModal = document.getElementById('imgModal');
    imgModal.style.display = "none";
});

$(document).on("click",".btnImgNav",function () {
    var imgs_length = this.id[2];
    var img_id = this.id;
    for(var i=1; i <= imgs_length; i++) {
        var tmp_id = i + "/" + imgs_length;
        var tmp_img = document.getElementById(tmp_id);
        if(tmp_id != img_id) {
            tmp_img.style.display = "none";
        }
        else {
            tmp_img.style.display = "inline-block";
        }
    }
});

$(document).on("click", ".selectAll",function () {
    var updBtn = document.getElementById('updBtn');
    var downloadManyBtn = document.getElementById('downloadManyBtn');
    var remManyManyBtn = document.getElementById('remManyManyBtn');
    if($(".selectAll").is(":checked")) {
        $(".oscheckboxes").prop("checked", true);
    }
    else {
        $(".oscheckboxes").prop("checked", false);
    }
    if($(".oscheckboxes").filter(":checked").length == 1) {
        updBtn.style.display = "block";
        downloadManyBtn.style.display = "block";
        remManyManyBtn.style.display = "block";
    }
    else if (($(".oscheckboxes").filter(":checked").length == 0)){
        updBtn.style.display = "none";
        downloadManyBtn.style.display = "none";
        remManyManyBtn.style.display = "none";
    }
    else {
        downloadManyBtn.style.display = "block";
        remManyManyBtn.style.display = "block";
    }
});

$(document).on("click", ".oscheckboxes",function () {
   /* if(this.lenght) {
        
    }*/
    console.log($(".oscheckboxes").filter(":checked").length);
    var updBtn = document.getElementById('updBtn');
    var downloadManyBtn = document.getElementById('downloadManyBtn');
    var remManyManyBtn = document.getElementById('remManyManyBtn');
    if($(".oscheckboxes").filter(":checked").length == 1) {
        updBtn.style.display = "block";
        downloadManyBtn.style.display = "block";
        remManyManyBtn.style.display = "block";
    }
    else if (($(".oscheckboxes").filter(":checked").length == 0)){
        updBtn.style.display = "none";
        downloadManyBtn.style.display = "none";
        remManyManyBtn.style.display = "none";
    }
    else {
        updBtn.style.display = "none";
    }

    if($(".oscheckboxes").length != $(".oscheckboxes").filter(":checked").length) {
        if($(".selectAll").prop("checked")) {
            $(".selectAll").prop("checked", false);
        }
    }
    else {
        if(!($(".selectAll").prop("checked"))) {
            $(".selectAll").prop("checked",true);
        }
    }
});


/*
    MUDAR TUDO PARA USAR JQUERY
    http://api.jquery.com/on/
    https://stackoverflow.com/questions/17365262/call-on-dynamic-added-html-elements-a-jquery-method
    https://stackoverflow.com/questions/20515459/onclick-does-not-function-inside-a-dynamically-generated-div
*/