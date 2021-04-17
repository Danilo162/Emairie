
$(document).ready(function () {
    $('#quartier,#commune,#zone,#etat_taxe').on("change", function () {
        // $('#table').bootstrapTable('refresh');
        var id = $(this).val();


        $('#table').bootstrapTable('refresh', {
            query: {
                commune: convertToIn($("#commune").val()),
                quartier: convertToIn($("#quartier").val()),
                zone: convertToIn($("#zone").val()),
                etat_taxe: $("#etat_taxe").val(),

            }
        });

    })
});
var app = new Vue({
    el: '#content',
    data: function () {
        return {
            e_raison_social: '',
            e_administred: '',
            e_commune: '',
            e_description: '',
            e_picture: '',
            e_quartier: '',
            e_type: '',
            e_detail_localisation: '',
            e_type_commerce: '',
        }
    },
    methods: {
        store() {
            btnsend_loader_show('submitbtn')

            this.e_raison_social = '',
            this.e_administred = '',
            this.e_commune = '',
            this.e_description = '',
            this.e_picture = '',
            this.e_quartier = '',
            this.e_type = '',
            this.e_detail_localisation = ''
            this.e_type_commerce = ''
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
                btnsend_loader_hide('submitbtn')
                progress_hide();
                console.log(response.data)
                if (response.data.success === true) {
                    $("#defaultModal").modal('hide')
                    frmCreate[0].reset();
                    $('#quartier_id').val("");
                    rep_success(response.data.message)
                    $('#table').bootstrapTable('refresh');
                } else {
                    rep_error(response.data.message)
                }

            }).catch(error => {
                btnsend_loader_hide('submitbtn')
                progress_hide(1);
                // rep_error(error.data.message)
                // ON RECUPERE LES ERREURS QUI DOIVENT ÊTRES AFFICHEES DANS LA VUE
                if (error.response.data.errors) {
                    if (error.response.data.errors.raison_social) {
                        this.e_raison_social = error.response.data.errors.raison_social[0];
                    }
                    if (error.response.data.errors.administred) {
                        this.e_administred = error.response.data.errors.administred[0];
                    } if (error.response.data.errors.type) {
                        this.e_type = error.response.data.errors.type[0];
                    }
                    if (error.response.data.errors.commune) {
                        this.e_commune = error.response.data.errors.commune[0];
                    }
                    if (error.response.data.errors.description) {
                        this.e_description = error.response.data.errors.description[0];
                    }
                    if (error.response.data.errors.picture) {
                        this.e_picture = error.response.data.errors.picture[0];
                    }
                    if (error.response.data.errors.quartier) {
                        this.e_quartier = error.response.data.errors.quartier[0];
                    }
                    if (error.response.data.errors.detail_localisation) {
                        this.e_detail_localisation = error.response.data.errors.detail_localisation[0];
                    }
                    if (error.response.data.errors.type_commerce) {
                        this.e_type_commerce = error.response.data.errors.type_commerce[0];
                    }

                }

            })
        },

    },
    mounted() {
      ;


    }
})

function optionsFormatter(id, row) {
    var options = "";
    var detail = "agent/" + id + "/detail";
    var edit = "";

    // edit =  '<li style=\'cursor: pointer\'><a  onclick="javascript:updateRows(\'' + id + '\');"> <i class="fa fa-pencil-alt green-text"></i> Modifier</a></li>\n';
    //
    // options = " <div class=\"btn-group btn-group-sm\">\n" +
    //     " <button type=\"button\" class=\"btn btn-sm btn-default dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
    //     "  Actions <span class=\"caret\"></span>\n" +
    //     "  </button>\n" +
    //     " <ul class=\"dropdown-menu right-menu\">\n" +
    //     " <li><a href="+detail+"> Detail <i class='fa fa-arrow-right blue-text'></i></a></li>\n" +
    //     " <li quartier=\"separator\" class=\"divider\"></li>\n" +
    //     edit +
    //     " <li><a onclick=\"javascript:showDeleteConfirmMessage(" + id + ");\"><i class='fa fa-times red-text'></i> Supprimer</a></li>\n" +
    //     "  </ul>\n" +
    //     "</div>"

    return options;
}
function optionsFormatterDetail(id, row) {

    var detail = "commerce/" + id + "/detail";

    options = "<a href='"+detail+"' class='btn  waves-effect btn-sm no-shadow' title='Detail'  type='button'><i class=\"fa fa-arrow-alt-circle-right blue-text\"></i> </a>";
    return options;
}

function imageFormatter(id,row){

    var publicPath = public_path+ "/storage/" + row.picture;
    var image = "<img src="+ publicPath + " width='40' class='\img-thumbnail\' />";

    return image;

}
function identifierFormatter(id,row){
    var identifier = row.identifier?row.identifier:"";
    return "<span class='red-text'> "+identifier+" </span>";

}

function updateRows(id){

    let formData = new FormData();

    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    formData.append("id", id)

     const param = new URLSearchParams();
     param.append('_token', $('meta[name="csrf-token"]').attr('content'));
     param.append("id", id)

            axios.post($("#edit").val(), formData).then((response) => {
                progress_hide();
                console.log(response.data)
                if (response.data.success === true) {
                    var row = response.data.data;
                    console.log(row)
                    $("#agent_id").val(row.id);
                    console.log(row.id);
                    $("#raison_social").val(row.raison_social);
                    $("#administred").val(row.administred);
                    $("#commune").val(row.commune);
                    $("#description").val(row.description);
                    $("#type_commerce").val(row.type_commerce_id);

                    var publicPath = $("#app").attr("home-url") + "/storage/" + row.picture;
                    $(".imgpreview").attr('src',publicPath);

                    $("#quartier").val(row.quartier_id);
                    $("#detail_localisation").val(row.detail_localisation);
                    $("#defaultModal").modal("show");
                } else {
                    rep_error(response.data.message)
                }

            }).catch(error => {
                progress_hide(1);
                // rep_error(error.data.message)
                // ON RECUPERE LES ERREURS QUI DOIVENT ÊTRES AFFICHEES DANS LA VUE
                console.log(error);

            })
}


