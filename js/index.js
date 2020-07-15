/*
EX6 Sintaxe
$(() => {

});
function nome() {}
nome = () => {}
*/
var paginationIndex,
    paginationItemPerIndex,
    paginationGroup,
    total_item;
$(function() {
    // Load all items from the database
    fetchAllItemAsync();
});
/* This function will update the text in the tips div the the text and the css */
function updateTips(tips, text) {
    tips
        .html(text)
        .removeClass("alert-light")
        .addClass("alert-danger");
}
/* This function will check the length of the JS objects is between min and max, and will update tip div */
function checkLength(tips, o, n, min, max, tips) {
    if (o.val().length > max || o.val().length < min) {
        o.addClass("alert-danger");
        updateTips(tips, "The length of " + n + " must be between " + min + " and " + max + ".")
        return false;
    }
    else {
        return true;
    }
}
/* This function will check if the regular expression is true or false, and will update the tip div */
function checkRegexp(tips, o, regexp, n, tips) {
    if (!(regexp.test(o.val()))) {
        o.addClass("alert-danger");
        updateTips(tips, n);
        return false;
    }
    else {
        return true;
    }
}
/* This async function will load all itens */
fetchAllItemAsync = () => {
    paginationIndex = 1,
    paginationItemPerIndex = 3,
    total_item = 0;
    $("#itemContent").html("<img src='img/loader.gif' />");
    $("#itemPagination").html("<img src='img/loader.gif' />");
    $.post("ajax/contar.php",
    { },
    (data, status) => {
        if(status == "success"){
            try {
                var r = JSON.parse(data),
                    data = r.data;
                total_item = data.total;
                if(total_item > 0){
                    paginationGroup = Math.ceil(total_item/paginationItemPerIndex);
                }
                // Create the pagination
                paginationCreate();
            } catch (error) {
                console.log(error)
            }
            
        }
        else{
            console.log(error)
        }
    });
}
/* This function will perfome the pagination create action */
paginationCreate = () => {
    var htmlCreated = '<nav><ul class="pagination justify-content-center"><li class="page-item"><a class="page-link" href="javascript:paginationPrev()">Previous</a></li>';
    for(var i = 1; i <= paginationGroup; i++){
        if(i == paginationIndex)
            htmlCreated += '<li class="page-item active"><a class="page-link" href="javascript:paginationUpdate(' + i + ')">' + i + '</a></li>';
        else
            htmlCreated += '<li class="page-item"><a class="page-link" href="javascript:paginationUpdate(' + i + ')">' + i + '</a></li>';
    }
    htmlCreated += '<li class="page-item"><a class="page-link" href="javascript:paginationNext()">Next</a></li></ul></nav>';
    $("#itemPagination").html(htmlCreated);
    paginationUpdate(paginationIndex);
}
/* This function will perfome the pagination prev action */
paginationPrev = () => {
    if(paginationIndex > 1)
        paginationIndex--;
    paginationUpdate(paginationIndex);
}
/* This function will perfome the pagination next action */
paginationNext = () => {
    if(paginationIndex < paginationGroup)
        paginationIndex++;
    paginationUpdate(paginationIndex);
}
/* This function will perfome the pagination update action */
paginationUpdate = (num) => {
    paginationIndex = num;
    var htmlCreated = '<nav><ul class="pagination justify-content-center"><li class="page-item"><a class="page-link" href="javascript:paginationPrev()">Previous</a></li>';
    for(var i = 1; i <= paginationGroup; i++){
        if(i == paginationIndex)
            htmlCreated += '<li class="page-item active"><a class="page-link" href="javascript:paginationUpdate(' + i + ')">' + i + '</a></li>';
        else
            htmlCreated += '<li class="page-item"><a class="page-link" href="javascript:paginationUpdate(' + i + ')">' + i + '</a></li>';
    }
    htmlCreated += '<li class="page-item"><a class="page-link" href="javascript:paginationNext()">Next</a></li></ul></nav>';
    $("#itemPagination").html(htmlCreated);
    loadItemPerGroupAsync();
}
/* This async function will load and show all itens per pagination group in card */
loadItemPerGroupAsync = () => {
    $.post("ajax/mostrar.php",
    { 
        offset: paginationIndex,
        limit: paginationItemPerIndex
    },
    (data, status) => {
        if(status == "success"){
            try {
                var r = JSON.parse(data),
                    itens = r.data,
                    htmlCreated = '';
                switch(itens.length){
                    case 3:
                        $.each(itens, (i, item) => {
                            var item = new Item(item[0], item[1], item[2]);
                            htmlCreated += "<div class='card mb-4 box-shadow'>";
                            htmlCreated += "<div class='card-header'>";
                            htmlCreated += "    <h3 class='my-0 font-weight-normal'>" + item.getNome() + "</h4>";
                            htmlCreated += "</div>";
                            htmlCreated += "<div class='card-body'>";
                            htmlCreated += item.getFicheiro() + "<br />";
                            htmlCreated += "    <a class='btn btn-warning' href='javascript:modificar(" + item.getId() + ", \"" + item.getNome() + "\");' role='button'><i class='fas fa-edit'></i></a>";
                            htmlCreated += "    <a class='btn btn-danger' href='javascript:eliminar(" + item.getId() + ")' role='button'><i class='fas fa-trash-alt'></i></a>";
                            htmlCreated += "</div>";
                            htmlCreated += "</div>";
                        });
                        break;
                    case 2:
                        $.each(itens, (i, item) => {
                            var item = new Item(item[0], item[1], item[2]);
                            htmlCreated += "<div class='card mb-4 box-shadow'>";
                            htmlCreated += "<div class='card-header'>";
                            htmlCreated += "    <h3 class='my-0 font-weight-normal'>" + item.getNome() + "</h4>";
                            htmlCreated += "</div>";
                            htmlCreated += "<div class='card-body'>";
                            htmlCreated += item.getFicheiro() + "<br />";
                            htmlCreated += "    <a class='btn btn-warning' href='javascript:modificar(" + item.getId() + ", \"" + item.getNome() + "\");' role='button'><i class='fas fa-edit'></i></a>";
                            htmlCreated += "    <a class='btn btn-danger' href='javascript:eliminar(" + item.getId() + ")' role='button'><i class='fas fa-trash-alt'></i></a>";
                            htmlCreated += "</div>";
                            htmlCreated += "</div>";
                        });
                        htmlCreated += "<div class='card mb-4 box-shadow'></div>";
                        break;
                    case 1:
                        $.each(itens, (i, item) => {
                            var item = new Item(item[0], item[1], item[2]);
                            htmlCreated += "<div class='card mb-4 box-shadow'>";
                            htmlCreated += "<div class='card-header'>";
                            htmlCreated += "    <h3 class='my-0 font-weight-normal'>" + item.getNome() + "</h4>";
                            htmlCreated += "</div>";
                            htmlCreated += "<div class='card-body'>";
                            htmlCreated += item.getFicheiro() + "<br />";
                            htmlCreated += "    <a class='btn btn-warning' href='javascript:modificar(" + item.getId() + ", \"" + item.getNome() + "\");' role='button'><i class='fas fa-edit'></i></a>";
                            htmlCreated += "    <a class='btn btn-danger' href='javascript:eliminar(" + item.getId() + ")' role='button'><i class='fas fa-trash-alt'></i></a>";
                            htmlCreated += "</div>";
                            htmlCreated += "</div>";
                        });
                        htmlCreated += "<div class='card mb-4 box-shadow'></div>";
                        htmlCreated += "<div class='card mb-4 box-shadow'</div>";
                        break;
                }
                $("#itemContent").html(htmlCreated);
            } catch (error) {
                console.log(error)
            }
            
        }
        else{
            console.log(error)
        }
    });
}
function adicionar() {
    var titulo_add = $("#titulo_add"),
        bValid = true,
        tips = $("#adicionar_state");
    tips.addClass("alert-light");
    if (titulo_add.val() == "") {
        tips.addClass("alert alert-danger");
        updateTips(tips, "O nome não deve ser vazio.");
        titulo_add.focus();
    }
    else {
        bValid = bValid && checkLength(tips, titulo_add, "nome", 3, 30, tips);
        if (bValid) {
            adicionarAsync();
        }
    }
}
function adicionarAsync() {
    var nome = $("#titulo_add").val(),
        foto = $("#foto_add").prop('files')[0],
        tips = $("#adicionar_state");
    if(foto == undefined){
        tips.removeClass("alert-light");
        tips.addClass("alert-danger");
        updateTips(tips, "Deves primeiramente selecionar uma foto!");
        return;
    }
    var formData = new FormData();
    formData.append('nome', nome);
    formData.append('file', foto);
    tips.addClass("alert-light");
    tips.html("<img src='img/loader.gif' />");
    $.ajax({
        type: 'POST',
        url: 'ajax/adicionar.php',
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        success: function(data){
            var r = JSON.parse(data),
                result = r.data;
            if (result.result > 0) {
                tips.removeClass("alert-light");
                tips.addClass("alert-success");
                tips.html("<p>Adição com exito!</p>");
                setTimeout(function () {
                    $('#addModal').modal('hide');
                    clear_form();
                    fetchAllItemAsync();
                }, 100);
            }
            else {
                tips.removeClass("alert-light");
                tips.addClass("alert-danger");
                tips.html("<p>Adição falhada!</p>");
            }
        }
    });
}
function modificar(id, nome) {
    $("#id_upd").val(id);
    $("#titulo_upd").val(nome);
    var tips = $("#modificar_state");
    tips.addClass("alert-light");
    $("#updModal").modal('show');
}
function modificarAsync() {
    var id   = $("#id_upd").val(),
        nome = $("#titulo_upd").val(),
        foto = $("#foto_upd").prop('files')[0],
        tips = $("#modificar_state");
    var formData = new FormData();
        formData.append('id', id);
        formData.append('nome', nome);
        formData.append('file', foto);
    tips.addClass("alert-light");
    tips.html("<img src='img/loader.gif' />");
    $.ajax({
        type: 'POST',
        url: 'ajax/modificar.php',
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        success: function(data){
            var r = JSON.parse(data),
                result = r.data;
            if (result.result > 0) {
                tips.removeClass("alert-light");
                tips.addClass("alert-success");
                tips.html("<p>Alteração com exito!</p>");
                setTimeout(function () {
                    $('#updModal').modal('hide');
                    clear_form();
                    fetchAllItemAsync();
                }, 100);
            }
            else {
                tips.removeClass("alert-light");
                tips.addClass("alert-danger");
                tips.html("<p>Alteração falhada!</p>");
            }
        }
    });
}
function eliminar(id) {
    $("#delModalBody").html("<p>Deseja eliminar este registo?</p><input id='id_del' type='hidden' /><div id='eliminar_state' role='alert'></div >");
    $("#id_del").val(id);
    var tips = $("#eliminar_state");
    tips.addClass("alert-light");
    $("#delModal").modal('show');
}
function eliminarAsync() {
    var id = $("#id_del").val(),
        tips = $("#eliminar_state");
    var formData = new FormData();
    formData.append('id', id);
    tips.addClass("alert-light");
    tips.html("<img src='img/loader.gif' />");
    $.ajax({
        type: 'POST',
        url: 'ajax/eliminar.php',
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        success: function(data){
            var r = JSON.parse(data),
                result = r.data;
            if (result.result > 0) {
                tips.removeClass("alert-light");
                tips.addClass("alert-success");
                tips.html("<p>Eliminação com exito!</p>");
                setTimeout(function () {
                    $('#delModal').modal('hide');
                    clear_form();
                    fetchAllItemAsync();
                }, 100);
            }
            else {
                tips.removeClass("alert-light");
                tips.addClass("alert-danger");
                tips.html("<p>Eliminação falhada!</p>");
            }
        }
    }, "json");
}
function clear_form() {
    /* Insert */
    $("#titulo_add").val("");
    $("#adicionar_state").removeClass("alert-success");
    $("#adicionar_state").addClass("alert-light");
    $("#adicionar_state").html("");
    /* Update */
    $("#titulo_upd").val("");
    $("#modificar_state").removeClass("alert-success");
    $("#modificar_state").addClass("alert-light");
    $("#modificar_state").html("");
    /* Remove */
    $("#id_del").val("");
    $("#eliminar_state").removeClass("alert-success");
    $("#eliminar_state").addClass("alert-light");
    $("#eliminar_state").html("");
}