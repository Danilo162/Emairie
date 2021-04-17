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
                console.log(response.data)
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

// your custom ajax request here
function ajaxRequest(params) {
    var url = "{{ route('console.role.index') }}"
    $.get(url + '?' + $.param(params.data)).then(function (res) {
        params.success(res)
    })
}
function optionsFormatter(id, row, index) {
    var options = "";
    var permissionUrl = "role/" + id + "/permission";
    var permissionDelegation = "role/" + id + "/delegation";
    var edit = "";
    var name = row.name?row.name.replace(/'/g, "\\'"):"";
    var comment = row.comment?row.comment.replace(/'/g, "\\'"):"";


    // edit =  '<li style=\'cursor: pointer\'><a  onclick="javascript:updateRows(\'' + id + '\',\''+name+'\',\''+comment+'\');"> <i class="fa fa-pencil-alt green-text"></i> Modifier</a></li>\n';

    var permissionLink = "";
    var permissionDeletegationLink = "";

        edit =  '<li style=\'cursor: pointer\'><a  onclick="javascript:updateRows(\'' + id + '\',\''+name+'\',\''+comment+'\');"> <i class="fa fa-pencil-alt green-text"></i> Modifier</a></li>\n';
    permissionLink =" <li style='cursor: pointer'><a href=\""+permissionUrl+"\"> <i class='fa fa-lock-open blue-text'></i> Permission</a></li>\n";
    permissionDeletegationLink =" <li style='cursor: pointer'><a href=\""+permissionDelegation+"\"> <i class='fa fa-lock-open blue-text'></i> Permission</a></li>\n";


     var deleteOrUpdate ="";
     if(id>5){
         deleteOrUpdate =         edit +
             " <li><a onclick=\"javascript:showDeleteConfirmMessage(" + id + ");\"><i class='fa fa-times red-text'></i> Supprimer</a></li>\n" ;
     }
    options = " <div class=\"btn-group btn-group-sm\">\n" +
        " <button type=\"button\" class=\"btn btn-sm btn-default dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
        "  Actions <span class=\"caret\"></span>\n" +
        "  </button>\n" +
        " <ul class=\"dropdown-menu right-menu\">\n" +
        permissionLink+
        " <li role=\"separator\" class=\"divider\"></li>\n" +
        deleteOrUpdate+
        "  </ul>\n" +
        "</div>"

    return options;
}

function updateRows(id,name,comment){
    $("#id").val(id);
    $("#name").val(name);
    $("#commentaire").val(comment);
}



