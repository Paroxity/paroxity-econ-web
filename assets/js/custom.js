// put the data in the modal form
function edit_or_delete_btn(btn, arr) {

    if (btn.name === "edit") {
        var title = document.getElementById("currency-modal-title");
        var id = document.getElementById("currency-modal-id");
        var name = document.getElementById("currency-modal-name");
        var symbol = document.getElementById("currency-modal-symbol");
        var st_amt = document.getElementById("currency-modal-st-amt");
        var max_amt = document.getElementById("currency-modal-max-amt");

        title.innerText = "Edit Currency";

        id.value = arr.id;
        name.value = arr.name;
        symbol.value = arr.symbol;
        st_amt.value = arr.starting_amount;
        max_amt.value = arr.maximum_amount;

        var symbol_pos = arr.symbol_position;

        if(symbol_pos === "start"){
            $("#currency-modal-symbol-pos option[value='start']").attr("selected", "selected");
            $("#currency-modal-symbol-pos option[value='end']").removeAttr("selected");
        }else{
            $("#currency-modal-symbol-pos option[value='end']").attr("selected", "selected");
            $("#currency-modal-symbol-pos option[value='start']").removeAttr("selected");
        }
    }

    /*
    $.post("post.php", {currency: arr}, function (data){
       console.log(data);
    });
    */
}


function add_currency_btn() {
    var title = document.getElementById("currency-modal-title");
    title.innerText = "Add Currency";

    document.getElementById("currency-modal-id").value = "";
    document.getElementById("currency-modal-name").value = "";
    document.getElementById("currency-modal-symbol").value = "";
    document.getElementById("currency-modal-st-amt").value = "";
    document.getElementById("currency-modal-max-amt").value = "";

    $("#currency-modal-symbol-pos option[value='start']").attr("selected", "selected");
    $("#currency-modal-symbol-pos option[value='end']").removeAttr("selected");
}