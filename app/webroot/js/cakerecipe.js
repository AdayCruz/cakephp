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