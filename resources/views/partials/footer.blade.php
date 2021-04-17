<!-- Jquery Core Js -->


<!-- Bootstrap Core Js -->
<script src="{{asset('bootstrap-3.3.7/js/bootstrap.min.js')}}"></script>

<!-- Slimscroll Plugin Js -->
<script src="{{asset('plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{asset('plugins/node-waves/waves.js')}}"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="{{asset('plugins/jquery-countto/jquery.countTo.js')}}"></script>

<!-- Morris Plugin Js -->
<script src="{{asset('plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('plugins/morrisjs/morris.js')}}"></script>

<!-- Bootstrap Colorpicker Js -->
<script src="{{asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script>

<!-- Dropzone Plugin Js -->
<script src="{{asset('plugins/dropzone/dropzone.js')}}"></script>

<!-- Input Mask Plugin Js -->
<script src="{{asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>

<!-- Multi Select Plugin Js -->
<script src="{{asset('plugins/multi-select/js/jquery.multi-select.js')}}"></script>

<!-- Jquery Spinner Plugin Js -->
<script src="{{asset('plugins/jquery-spinner/js/jquery.spinner.js')}}"></script>

<!-- Bootstrap Tags Input Plugin Js -->
<script src="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>

{{--<!-- noUISlider Plugin Js -->--}}
{{--<script src="{{asset('plugins/nouislider/nouislider.js')}}"></script>--}}

{{--<!-- ChartJs -->--}}
{{--<script src="{{asset('plugins/chartjs/Chart.bundle.js')}}"></script>--}}

{{--<!-- Flot Charts Plugin Js -->--}}
{{--<script src="{{asset('plugins/flot-charts/jquery.flot.js')}}"></script>--}}
{{--<script src="{{asset('plugins/flot-charts/jquery.flot.resize.js')}}"></script>--}}
{{--<script src="{{asset('plugins/flot-charts/jquery.flot.pie.js')}}"></script>--}}
{{--<script src="{{asset('plugins/flot-charts/jquery.flot.categories.js')}}"></script>--}}
{{--<script src="{{asset('plugins/flot-charts/jquery.flot.time.js')}}"></script>--}}

{{--<!-- Sparkline Chart Plugin Js -->--}}
{{--<script src="{{asset('plugins/jquery-sparkline/jquery.sparkline.js')}}"></script>--}}

<!-- Custom Js -->
<script src="{{asset('js/admin.js')}}"></script>
{{--    <script src="{{asset('js/pages/index.js')}}"></script>--}}
{{--<script src="{{asset('js/pages/forms/advanced-form-elements.js')}}"></script>--}}
{{--<!--   <script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script>-->--}}

<!-- Demo Js -->
<script src="{{asset('js/demo.js')}}"></script>

<!-- Jquery DataTable Plugin Js -->
{{--<script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>-->--}}
{{--<script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>-->--}}




{{--    <script src="{{asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>--}}
{{--    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>--}}
{{--<script src="{{asset('plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>--}}
{{--<script src="{{asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>--}}
{{--<script src="{{asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>--}}
{{--<script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>--}}
{{--<script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>--}}


<script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('js/pages/ui/notifications.js')}}"></script>
<script src="{{asset('js/pages/ui/tooltips-popovers.js')}}"></script>
<script>
    function progress_show(){

        var progressContent =  $("#progress_bar_content");
        progressContent.css('display','block');
    }
    function progress_counter(counter){

        var progressBar = $("#progress_bar");
        progressBar.addClass('progress-bar-success')
        progressBar.removeClass('progress-bar-danger')
        progressBar.attr('aria-valuenow',counter)
        progressBar.html(counter+'%');
        progressBar.css('width',counter+'%');
    }
   function progress_hide(type=null){
    var progressContent =  $("#progress_bar_content");
       var progressBar = $("#progress_bar");

       if(type){
           progressBar.removeClass('progress-bar-success')
           progressBar.addClass('progress-bar-danger')
       }
       setTimeout(function (){
           progressContent.hide();
           progressBar.addClass('progress-bar-success')
       },3000)
    }

    function rep_success(text){
        showNotification("alert-success", text, "bottom", "right", "", "");

    }
    function rep_error(text){
        showNotification("alert-danger", text, "bottom", "right", "", "");

    }

    function showDeleteConfirmMessage(id){

    swal({
        title: "Confirmation",
        text: "Etes vous sûr de bien vouloir effectuer cette suppression ?",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Continuer",
        cancelButtonText: "Annuler",
        closeOnConfirm: false
    }, function (response) {
        var data = "id=" + id +"&_token="+ $('meta[name="csrf-token"]').attr('content');
        if(response) {
            $.ajax({
                type: "POST",
                url: $("#destroy").val(),
                cache: false,
                dataType: "json",
                timeout: 10000,
                data: data,
                success: function (reponse) {

                    $('#table').bootstrapTable('refresh');

                    swal({
                            // title: 'Suppression reussie',
                            // text: "La ligne a bien été supprimée",
                            type: 'success',
                            timer: 3000
                        }
                    );

                },
                error: function (error) {
                    swal("Echec de suppression", "La suppression a echouée, veuillez réessayer.", "error");
                    console.log("Erreur : " + error);
                }
            });
        }
    });
    }

    $(function () {

        setInterval(checkSession, 1000 * 60 * 120);
        setInterval(updateToken, 1000 * 60 * 5);

        function checkSession(){
            $.get('{{route('console.check-session')}}').done(function(data){
                if(data.success==true){
                    location.reload();
                }
            });
        }
        function updateToken(){
            $.get('{{route('console.csrf')}}').done(function(data){
                $('[name="csrf_token"]').attr('content', data);
            });
        }

        //Masked Input ============================================================================================================================
        var $demoMaskedInput = $('#content');
        $demoMaskedInput.find('.phone-number').inputmask('99-99-99-99', { placeholder: '__-__-__-__' });
        $demoMaskedInput.find('.amount').inputmask('999 999 999 999', { placeholder: '' });
        $demoMaskedInput.find('.email-adress').inputmask({ alias: "email" });

    })
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var fsize = input.files[0].size; //get file size
            //Allowed file size is less than 1  MB (1048576)
            console.log(fsize);
            if (fsize > 1048576) {
                alert("Image trop grande");
                // $("#registerPhoto").val("");
                // $(".errorimage").html("<blank><b class='is_color_red fsize-0'>Image trop grande ( taille maximun inferieure ou égale à 1 MO)</b></blank>");
                // $('#blah').attr('src', $("#homUrl").val()+"/public/info/error.png");
                return false

            }else {

                reader.onload = function(e) {
                    $('#imgdiv').css('display','block');
                    $('.imgpreview').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    }

    $("#picture").change(function() {

        readURL(this);
    });

    function frmCreateReset(frm){
        $("#"+frm)[0].reset();

        $(".imgpreview").attr("src","")
    }
    function btnsend_loader_show(btn){
        $("."+btn).attr("disabled", true);
        $("."+btn).html("Enregistrement en cours...");
    }
    function btnsend_loader_hide(btn){
        $("."+btn).attr("disabled", false);
        $("."+btn).html("Enregistrer");
    }
    function isNumeric(str) {
        if (typeof str != "string") return false // we only process strings!
        return !isNaN(str) && // use type coercion to parse the _entirety_ of the string (`parseFloat` alone does not do this)...
            !isNaN(parseFloat(str)) // ...and ensure strings of whitespace fail
    }
    function convertToIn(val){
        if(isNumeric(val)){
            return parseInt(val);
        }else {
            return "";
        }
    }
</script>

@include('flashy::message')
</body>

</html>
