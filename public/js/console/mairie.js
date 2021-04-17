
$(document).ready(function () {

});
var app = new Vue({
    el: '#content',
    data: function () {
        return {
            e_name: '',
            e_localisation: '',
            e_phone: '',
            e_email: '',
            e_picture: '',
            e_commune: '',
        }
    },
    methods: {
        store() {
            // loader_s();
            // upload file
            // const formData = new FormData();

            btnsend_loader_show('submitbtn')
            this.e_name = '';
            this.e_localisation = '';
            this.e_phone = '';
            this.e_email = '';
            this.e_picture = '';
            this.e_commune = '';
            progress_show();
            var config = {
                onUploadProgress: function (progressEvent) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    progress_counter(percentCompleted);
                }
            };

            var frmCreate = $("#frmCreate");
            let formData = new FormData(frmCreate[0]);


            formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
            axios.post($("#store").val(), formData, config, {}).then((response) => {
                btnsend_loader_hide('submitbtn')
                progress_hide();

                if (response.data.success === true) {
                    $("#defaultModal").modal('hide')
                    frmCreate[0].reset();
                    $('#mairie_id').val("");
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
                    if (error.response.data.errors.name) {
                        this.e_name = error.response.data.errors.name[0];
                    }
                    if (error.response.data.errors.localisation) {
                        this.e_localisation = error.response.data.errors.localisation[0];
                    }
                    if (error.response.data.errors.phone) {
                        this.e_phone = error.response.data.errors.phone[0];
                    }
                    if (error.response.data.errors.email) {
                        this.e_email = error.response.data.errors.email[0];
                    }
                    if (error.response.data.errors.picture) {
                        this.e_picture = error.response.data.errors.picture[0];
                    }
                    if (error.response.data.errors.commune) {
                        this.e_commune = error.response.data.errors.commune[0];
                    }


                }

            })
        },
        storeService() {
            btnsend_loader_show('submitbtn')

            progress_show();
            var config = {
                onUploadProgress: function (progressEvent) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    progress_counter(percentCompleted);
                }
            };

            var frmCreate = $("#frmCreateService");
            let formData = new FormData(frmCreate[0]);


            formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
            axios.post($("#storeService").val(), formData, config, {}).then((response) => {
                btnsend_loader_hide('submitbtn')
                progress_hide();

                if (response.data.success === true) {

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
                    if (error.response.data.errors.name) {
                        this.e_name = error.response.data.errors.name[0];
                    }
                    if (error.response.data.errors.localisation) {
                        this.e_localisation = error.response.data.errors.localisation[0];
                    }
                    if (error.response.data.errors.phone) {
                        this.e_phone = error.response.data.errors.phone[0];
                    }
                    if (error.response.data.errors.email) {
                        this.e_email = error.response.data.errors.email[0];
                    }
                    if (error.response.data.errors.picture) {
                        this.e_picture = error.response.data.errors.picture[0];
                    }
                    if (error.response.data.errors.commune) {
                        this.e_commune = error.response.data.errors.commune[0];
                    }


                }

            })
        },

    },
    mounted() {



    }
})


function optionsFormatter(id, row) {
    var options = "";
    //var permissionUrl = "mairie/" + id + "/permission";
    var edit = "";
    var detail = "mairie/" + id + "/detail";

    edit =  '<li style=\'cursor: pointer\'><a  onclick="javascript:updateRows(\'' + id + '\');"> <i class="fa fa-pencil-alt green-text"></i> Modifier</a></li>\n';

    options = " <div class=\"btn-group btn-group-sm\">\n" +
        " <button type=\"button\" class=\"btn btn-sm btn-default dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
        "  Actions <span class=\"caret\"></span>\n" +
        "  </button>\n" +
        " <ul class=\"dropdown-menu right-menu\">\n" +
        " <li><a href="+detail+"> Detail <i class='fa fa-arrow-right blue-text'></i></a></li>\n" +
          edit +
        " <li><a onclick=\"javascript:showDeleteConfirmMessage(" + id + ");\"><i class='fa fa-times red-text'></i> Supprimer</a></li>\n" +
        "  </ul>\n" +
        "</div>"
    // options += "  <button type=\"button\" class=\"btn shadow-small btn-default btn-xs \"> <i class='fa fa-lock-open text-info'></i> Permissions</button>"
    // options += "  <button type=\"button\" class=\"btn shadow-small  btn-default btn-xs \"> <i class='fa fa-lock-open text-success'></i> Modifier</button>"
    // options += "  <button type=\"button\" class=\"btn shadow-small btn-default btn-xs waves-effect\"> <i class='fa fa-lock-open text-warning'></i> Supprimer</button>"
    //
    return options;
}

function imageFormatter(id,row){

    var publicPath = public_path + "/storage/" + row.picture;
    var image = "<img src="+ publicPath + " width='70' class='\img-thumbnail\' />";

    return image;

}

function updateRows(id){

    let formData = new FormData();

    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    formData.append("id", id)


            axios.post($("#edit").val(), formData).then((response) => {
                progress_hide();
                console.log(response.data)
                if (response.data.success === true) {
                    var row = response.data.data;
                    console.log(row)
                   $("#mairie_id").val(row.id);
                   console.log(row.id);
                    $("#name").val(row.nom);
                    $("#localisation").val(row.localisation);
                    $("#phone").val(row.phone);
                    $("#email").val(row.email);
                    var publicPath = $("#app").attr("home-url") + "/storage/" + row.picture;
                    $(".imgpreview").attr('src',publicPath);

                    $("#commune").val(row.commune_id);
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
