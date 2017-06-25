<?php require "Database.php";?>

<!-- Modal -->
<div class="modal fade" id="converterBtn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img src="http://localhost/quickbet/images/logo2.png" class="modal-logo" alt="">
                <h3 class="modal-title" id="exampleModalLabel">Quick Bet Online Convertor</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div id="errors">

                    </div>


                    <!--form starts-->
                    <form method="post" id="myform">

                        <div class="form-group row">
                            <label for="example-text-input" class="sr-only">Odds</label>


                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></div>
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
                    <button type="button" class="btn btn-outline-success" data-backdrop="static" id="ajax-submit"
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
<script src ="vendor/jquery/myscript.js"></script>

</body>

</html>
