<?php require "Database.php";

/*$analitics = Database::connect();
$analitics = Database::loadAnalitics();*/

?>


<footer>

    created by Gousopoulos Konstantinos
</footer>

<!--Modal Window Converter-->

<!-- Large modal -->


<!-- Modal -->
<div class="modal fade" id="converterBtn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Odds Convertor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div>

                        <?php echo !empty($nameError) ? $nameError . '<br>' : '' ?>
                        <?php echo !empty($valueError) ? $valueError . '<br>' : '' ?>

                    </div>


                    <!--form starts-->
                    <form method="post" id="myform">

                        <div class="form-group row">
                            <label for="example-text-input" class="sr-only">Odds</label>


                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
                                <input type="text" class="form-control" id="name" name="name"
                                >
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon">UK</div>
                                <input type="text" class="form-control" id="uk" name="uk-odd" placeholder="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon">EU</div>
                                <input type="text" class="form-control" id="eu" name="eu-odd" placeholder=""
                                >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon">US</div>
                                <input type="text" class="form-control" id="us" name="us-odd" placeholder=""
                                >
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  onclick="refresh()">Refresh</button>
                    <button type="button" class="btn btn-primary" data-backdrop="static" id="ajax-submit"
                            onclick="converter()">Submit
                    </button>
                </div>


                </form>
                <!--form endss-->


            </div>

        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/tether/tether.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<script>
    /*var uk_value = document.getElementById('uk');
     var eu_value = document.getElementById('eu');
     var us_value = document.getElementById('uu');*/


    function refresh() {
        document.getElementById("eu").placeholder="";
        document.getElementById("us").placeholder="";
        document.getElementById("uk").placeholder="";
        document.getElementById("name").placeholder="";

    }

    //gather all the values from the form
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

    function converter() {

        var data = gatherFormData();

        //console.log(JSON.stringify(data));

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "convert-process.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                //var result = xhr.responseText;
                var myObj = JSON.parse(xhr.responseText);
                console.log(myObj);
                document.getElementById("eu").placeholder="result:"+myObj.EU;
                document.getElementById("us").placeholder="result:"+myObj.US;
                document.getElementById("uk").placeholder="result:"+myObj.UK;


            }


        };
        xhr.send(data);

    }

</script>

</body>

</html>
