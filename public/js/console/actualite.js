var sticky = new Sticky('[data-sticky]', {});

$(document).ready(function () {
    $('.rel').on("click", function () {
        // $('#table').bootstrapTable('refresh');
        $('#table').bootstrapTable('refresh', {
            query: {limit: 1, t: 20}
        });
    })
});
var app = new Vue({
    el: '#content',
    data: function () {
        return {
            e_appel: '',
            e_resume: '',
            e_description: '',
            e_type: '',
        }
    },
    methods: {
        store() {
            btnsend_loader_show('submitbtn')

            this.e_appel = '',
            this.e_resume = '',
            this.e_description = '',
            this.e_type = ''
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
                    if (error.response.data.errors.appel) {
                        this.e_appel = error.response.data.errors.appel[0];
                    }
                    if (error.response.data.errors.resume) {
                        this.e_resume = error.response.data.errors.resume[0];
                    }

                    if (error.response.data.errors.type) {
                        this.e_type = error.response.data.errors.type[0];
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

    edit =  '<li style=\'cursor: pointer\'><a  onclick="javascript:updateRows(\'' + id + '\');"> <i class="fa fa-pencil-alt green-text"></i> Modifier</a></li>\n';

    options = " <div class=\"btn-group btn-group-sm\">\n" +
        " <button type=\"button\" class=\"btn btn-sm btn-default dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
        "  Actions <span class=\"caret\"></span>\n" +
        "  </button>\n" +
        " <ul class=\"dropdown-menu right-menu\">\n" +
        " <li><a href="+detail+"> Detail <i class='fa fa-arrow-right blue-text'></i></a></li>\n" +
        " <li mairie=\"separator\" class=\"divider\"></li>\n" +
        edit +
        " <li><a onclick=\"javascript:showDeleteConfirmMessage(" + id + ");\"><i class='fa fa-times red-text'></i> Supprimer</a></li>\n" +
        "  </ul>\n" +
        "</div>"

    return options;
}

function imageFormatter(id,row){

    var publicPath = public_path+ "/storage/" + row.picture;
    var image = "<img src="+ publicPath + " width='70' class='\img-thumbnail\' />";

    return image;

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
                    $("#actualite_id").val(row.id);

                    $("#appel").val(row.appel);
                    $("#resume").val(row.resume);
                    $("#description").val(row.description);
                    $("#source").val(row.source);
                    $("#source_link").val(row.source_link);
                    $("#type").val(row.type_actualite_id);

                    var publicPath = public_path + "storage/" + row.picture;
                    $(".imgpreview").attr('src',publicPath);

                    $("#mairie").val(row.mairie_id);
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
