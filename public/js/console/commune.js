var sticky = new Sticky('[data-sticky]', {});


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
        console.log('Add Artist Mounted.');


    }
})


function optionsFormatter(id, row) {
    var options = "";
    // var permissionUrl = "commune/" + id + "/permission";
    var edit = "";

    var name = row.name?row.name.replace(/'/g, "\\'"):"";

    edit =  '<li><a  onclick="javascript:updateRows(\'' + id + '\',\''+name+'\');"> <i class="fa fa-pencil-alt green-text"></i> Modifier</a></li>\n';

    options = " <div class=\"btn-group btn-group-sm\">\n" +
        " <button type=\"button\" class=\"btn btn-sm btn-default dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
        "  Actions <span class=\"caret\"></span>\n" +
        "  </button>\n" +
        " <ul class=\"dropdown-menu right-menu\">\n" +
        // " <li><a href=\"javascript:void(0);\"> <i class='fa fa-lock-open blue-text'></i> Permission</a></li>\n" +
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
function updateRows(id,name){
    console.log(name)
    $("#commune_id").val(id);
    $("#name").val(name);
}
