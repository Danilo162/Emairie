
$(document).ready(function () {
    $('#type').on("change", function () {
        // $('#table').bootstrapTable('refresh');
        var id = $(this).val();

        $('#tableService').bootstrapTable('refresh', {
            query: {
                type: $("#type").val(),

            }
        });

    })
});

var app = new Vue({
    el: '#content',
    data: function () {
        return {
            e_name: '',
        }
    },

    methods: {
        store() {
            // loader_s();
            // upload file
            // const formData = new FormData();
            this.e_name = ''
            progress_show();
            var config = {
                onUploadProgress: function (progressEvent) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    progress_counter(percentCompleted);
                }
            };
            // document.getElementById("frmCreate")
            var frmCreate = $("#frmCreate");
            let formData = new FormData(frmCreate[0]);

            formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
            axios.post($("#store").val(), formData, config, {}).then((response) => {
                progress_hide();

                if (response.data.success === true) {
                    frmCreate[0].reset();
                    rep_success(response.data.message)
                    $('#table').bootstrapTable('refresh');
                } else {
                    rep_error(response.data.message)
                }

            }).catch(error => {
                progress_hide(1);
                // rep_error(error.data.message)
                //
                if (error.response.data.errors) {
                    if (error.response.data.errors.name) {
                        this.e_name = error.response.data.errors.name[0];
                    }

                }

            })
        },

        testFunction: function (event) {
            console.log('test clicked')
        }
    },
    mounted() {


    }
})

function optionsFormatter(id, row) {
    var options = "";
    var detail = "agent/" + id + "/detail";
    var accepte = "";
    var rejete = "";

    accepte =  '<li style=\'cursor: pointer\'><a  onclick="javascript:showConfirmMessage(\'' + id + '\',\'EN TRAITEMENT\',\'#42A5F5\');"> <i class="fa fa-align-justify blue-text"></i> Mettre en traitement</a></li>\n';
    rejete =  '<li style=\'cursor: pointer\'><a  onclick="javascript:showConfirmMessage(\'' + id + '\',\'REJETEE\',\'#c62828\');"> <i class="fa fa-times red-text"></i> Réjeter</a></li>\n';
    cloturer =  '<li style=\'cursor: pointer\'><a  onclick="javascript:showConfirmMessage(\'' + id + '\',\'TRAITEE\',\'#2E7D32\');"> <i class="fa fa-check-double green-text"></i> Clôturer</a></li>\n';

    var linkDetail = " <li><a href="+detail+"> Detail <i class='fa fa-arrow-right blue-text'></i></a></li>";

    var allBtn = "";
    if(row.status=="ATTENTE"){
        allBtn += accepte;
        allBtn += rejete;
    }
    if(row.status=="EN TRAITEMENT"){
        allBtn += cloturer;
     /*   allBtn += detail;*/
    }
    if(row.status=="TRAITEE"){
        allBtn += linkDetail;
    }

    options = " <div class=\"btn-group btn-group-sm\">\n" +
        " <button type=\"button\" class=\"btn btn-sm btn-default dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
        "  Actions <span class=\"caret\"></span>\n" +
        "  </button>\n" +
        " <ul class=\"dropdown-menu right-menu\">\n" +

        " <li class=\"divider\"></li>\n" +
        allBtn +
        "  </ul>\n" +
        "</div>"

    return options;
}



function showConfirmMessage(id,status,color){

    swal({
        title: "Confirmation ("+status+")",
        text: "Etes vous sûr de bien vouloir effectuer cette opération ?",
        showCancelButton: true,
        confirmButtonColor: color,
     /*   confirmButtonColor: "#000000",*/
        confirmButtonText: "Continuer",
        cancelButtonText: "Annuler",
        closeOnConfirm: false
    }, function (response) {
        var data = "id=" + id +"&status=" + status +"&_token="+ $('meta[name="csrf-token"]').attr('content');
        if(response) {
            $.ajax({
                type: "POST",
                url: $("#confirme").val(),
                cache: false,
                dataType: "json",
                timeout: 10000,
                data: data,
                success: function (reponse) {
                    $('#tableService').bootstrapTable('refresh');
                    swal({
                            title: 'Opération reussie',
                             /*text: "La ligne a bien été supprimée",*/
                            type: 'success',
                            timer: 3000
                        }
                    );

                },
                error: function (error) {
                    swal("Echec ", "L'opération a echouée, veuillez réessayer.", "error");
                    console.log("Erreur : " + error);
                }
            });
        }
    });
}
function updateRows(id,name){
    console.log(name)
    $("#typetaxe_id").val(id);
    $("#name").val(name);
}
