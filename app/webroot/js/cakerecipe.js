/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function storeData (name, id){
    if (typeof(Storage) !== "undefined") {
        localStorage.setItem(name, id);
    } else {
        alert ("Sorry, your browser does not support Web Storage...");
    }
}

function deleteData (){
    if (typeof(Storage) !== "undefined") {
        localStorage.clear();
    } else {
        alert ("Sorry, your browser does not support Web Storage...");
    }
}

function toggleRecipe(){
    $("#recipediv").toggle();
}

$(document).bind("mobileinit", function(){
    $.mobile.ajaxLinksEnabled = false;
});

$( document ).ready(function() {
    $('#PostSellable').removeAttr('checked');
    $('#confirmSubmit').click(function () {
        return confirm('¿Está seguro de realizar esta operación?');
    });
    if (typeof(Storage) !== "undefined") {
        var page = "/cakephp/cakebases/select";
        var baseid = localStorage.getItem('baseid');
        if ( baseid === null ) {
            baseid = 0;
        }else {
            page = "/cakephp/fillings/select";
        }
        var fillingid = localStorage.getItem('fillingid');
        if ( fillingid === null ) {
            fillingid = 0;
        }else {
            page = "/cakephp/coatings/select";
        }
        var coatingid = localStorage.getItem('coatingid');
        if ( coatingid === null ) {
            coatingid = 0;
        }else {
            page = "/cakephp/orders/process";
        }
        $("#selectcakem").attr("href", page+"/"+baseid+"/"+fillingid+"/"+coatingid);
        $("#selectcake").attr("href", page+"/"+baseid+"/"+fillingid+"/"+coatingid);
    } else {
        alert ("Sorry, your browser does not support Web Storage...");
    }
});
