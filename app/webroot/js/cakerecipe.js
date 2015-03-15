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

$(document).bind("mobileinit", function(){
    $.mobile.ajaxLinksEnabled(false);
});

$( document ).ready(function() {
    if (typeof(Storage) !== "undefined") {
        var page = "cakebases/select";
        var baseid = localStorage.getItem('baseid');
        if ( baseid === null ) {
            baseid = 0;
        }else {
            page = "fillings/select";
        }
        var fillingid = localStorage.getItem('fillingid');
        if ( fillingid === null ) {
            fillingid = 0;
        }else {
            page = "coatings/select";
        }
        var coatingid = localStorage.getItem('coatingid');
        if ( coatingid === null ) {
            coatingid = 0;
        }else {
            page = "orders/process";
        }
        $("#selectcake").attr("href", page+"/"+baseid+"/"+fillingid+"/"+coatingid);
    } else {
        alert ("Sorry, your browser does not support Web Storage...");
    }
});
