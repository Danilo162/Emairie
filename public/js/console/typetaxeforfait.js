var sticky = new Sticky('[data-sticky]', {});


var app = new Vue({
    el: '#container',
    data: function () {
        return {
            e_montant: '',
        }
    },

    methods: {
        store() {
            // loader_s();
            // upload file
            // const formData = new FormData();
            this.e_montant = ''
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
                    if (error.response.data.errors.montant) {
                        this.e_montant = error.response.data.errors.montant[0];
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
    var edit = "";
    //
    // var amount = row.amount?row.amount.replace(/'/g, "\\'"):"";

    edit =  '<li><a  onclick="javascript:updateRows(\'' + id + '\',\''+row.amount+'\');"> <i class="fa fa-pencil-alt green-text"></i> Modifier</a></li>\n';

    options = " <div class=\"btn-group btn-group-sm\">\n" +
        " <button type=\"button\" class=\"btn btn-sm btn-default dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
        "  Actions <span class=\"caret\"></span>\n" +
        "  </button>\n" +
        " <ul class=\"dropdown-menu right-menu\">\n" +
        " <li  class=\"divider\"></li>\n" +
        edit +
        " <li><a onclick=\"javascript:showDeleteConfirmMessage(" + id + ");\"><i class='fa fa-times red-text'></i> Supprimer</a></li>\n" +
        "  </ul>\n" +
        "</div>"
    // options += "  <button type=\"button\" class=\"btn shadow-small btn-default btn-xs \"> <i class='fa fa-lock-open text-info'></i> Permission</button>"
    // options += "  <button type=\"button\" class=\"btn shadow-small  btn-default btn-xs \"> <i class='fa fa-lock-open text-success'></i> Modifier</button>"
    // options += "  <button type=\"button\" class=\"btn shadow-small btn-default btn-xs waves-effect\"> <i class='fa fa-lock-open text-warning'></i> Supprimer</button>"
    //
    return options;
}


function updateRows(id,amount){
    $("#forfait_id").val(id);
    $("#montant").val(amount);
    console.log(id,amount)
}
