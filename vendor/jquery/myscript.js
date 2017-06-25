/***
 * This is a function that refresh the inputs
 */
function refresh() {
    document.getElementById("eu").placeholder="";
    document.getElementById("us").placeholder="";
    document.getElementById("uk").placeholder="";
    document.getElementById("name").placeholder="";

}

/***
 * This function collects all the values of
 * users inputs
 * @returns {string}
 */
function gatherFormData() {
    var form = document.getElementById("myform");
    var inputs = form.getElementsByTagName('input');
    var array = [];
    for (var i = 0; i < inputs.length; i++) {
        var inputNameValue = inputs[i].name + "=" + inputs[i].value;
        array.push(inputNameValue);

    }

    return array.join('&')
}

/***
 * This is the main function that ajax calls happen
 */
function converter() {

    var data = gatherFormData();

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "convert-process.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var myObj = JSON.parse(xhr.responseText);
            console.log(myObj);
            if(myObj.hasOwnProperty('errors') && myObj.errors.length>0){
                for(var i=0;i<myObj.errors.length;i++){
                    document.getElementById("errors").innerHTML=myObj.errors[i];
                }

            }else{
                document.getElementById("eu").placeholder="result:"+myObj.EU;
                document.getElementById("us").placeholder="result:"+myObj.US;
                document.getElementById("uk").placeholder="result:"+myObj.UK;

            }
        }
    };
    xhr.send(data);

}
