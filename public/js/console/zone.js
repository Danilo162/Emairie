var sticky = new Sticky('[data-sticky]', {});


var app = new Vue({
    el: '#container',
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


function imageFormatter(id,row){
    var publicPath = public_path+ "/storage/" + row.picture;
    var image = "<img src="+ publicPath + " width='70' class='\img-thumbnail\' />";
    return image;
}


function optionsFormatter(id, row) {
    var options = "";
    var detailUrl = "zone/" + id + "/detail";
    var edit = "";

    var name = row.name?row.name.replace(/'/g, "\\'"):"";

    edit =  '<li><a  onclick="javascript:updateRows(\'' + id + '\',\''+name+'\');"> <i class="fa fa-pencil-alt green-text"></i> Modifier</a></li>\n';

    options = " <div class=\"btn-group btn-group-sm\">\n" +
        " <button type=\"button\" class=\"btn btn-sm btn-default dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
        "  Actions <span class=\"caret\"></span>\n" +
        "  </button>\n" +
        " <ul class=\"dropdown-menu right-menu\">\n" +
        " <li><a href=\""+detailUrl+"\"> <i class='fa fa-spin blue-text'></i> Detail </a></li>\n" +
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
function commerceModal(){
    $("#defaultModal").modal("show");
    $("#defaultModal .modal-dialog").css("display","block !important");
}

function agentModal(){
    $("#defaultModalAgent").modal("show");
    $("#defaultModalAgent .modal-dialog").css("display","block !important");

}


function optionsFormatterAdd(id, row) {
    options = "<button onclick=\"javascript:attachCommerceToZone("+id+");\" class='btn  waves-effect btn-sm no-shadow' title='Ajouter'  type='button'><i class=\"fa fa-plus blue-text\"></i> </button>";
    return options;
}
function optionsFormatterAddAgent(id, row) {
    options = "<button onclick=\"javascript:attachAgentToZone("+id+");\" class='btn  waves-effect btn-sm no-shadow' title='Ajouter'  type='button'><i class=\"fa fa-plus blue-text\"></i> </button>";
    return options;
}
function optionsFormatterRemove(id, row) {
    options = "<button onclick=\"javascript:dettachCommerceToZone("+id+");\" class='btn btn-sm btn-default no-shadow' title='Retirer' type='button'> <i class=\"fa fa-times red-text\"></i></button>";
    return options;
}
function optionsFormatterRemoveAgents(id, row) {
    options = "<button onclick=\"javascript:dettachAgentToZone("+id+");\" class='btn btn-sm btn-default no-shadow' title='Retirer' type='button'> <i class=\"fa fa-times red-text\"></i></button>";
    return options;
}

function attachCommerceToZone(id){
    var zone = $("#zone").val();

    progress_show();
    var config = {
        onUploadProgress: function (progressEvent) {
            var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
            progress_counter(percentCompleted);
        }
    };


    let formData = new FormData();

    formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
    formData.append('zone', zone)
    formData.append('id', id)
    console.log(formData);

    axios.post($("#attache_zone").val(), formData, config, {}).then((response) => {
        progress_hide();

        if (response.data.success === true) {

            $('#tableCommerceDispo').bootstrapTable('refresh');
            $('#tableCommerceSelect').bootstrapTable('refresh');
            rep_success(response.data.message)

        } else {
            rep_error(response.data.message)
        }

    }).catch(error => {

        progress_hide(1);
        // rep_error(error.data.message)
        //
        if (error.response.data.errors) {

        }

    })

}
function attachAgentToZone(id){
    var zone = $("#zone").val();

    progress_show();
    var config = {
        onUploadProgress: function (progressEvent) {
            var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
            progress_counter(percentCompleted);
        }
    };


    let formData = new FormData();

    formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
    formData.append('zone', zone)
    formData.append('id', id)
    console.log(formData);

    axios.post($("#attach_agent_to_zone").val(), formData, config, {}).then((response) => {
        progress_hide();

        if (response.data.success === true) {

            $('#tableAgentDispo').bootstrapTable('refresh');
            $('#tableAgentSelected').bootstrapTable('refresh');
            rep_success(response.data.message)

        } else {
            rep_error(response.data.message)
        }

    }).catch(error => {

        progress_hide(1);
        // rep_error(error.data.message)
        //
        if (error.response.data.errors) {

        }

    })

}
function dettachCommerceToZone(id){
    // console.log(id);
    // destroy_delegation

    swal({
        title: "Confirmation",
        text: "Etes vous sûr de bien vouloir retirer ce commerce ?",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Continuer",
        cancelButtonText: "Annuler",
        closeOnConfirm: false
    }, function (response) {
        progress_show();
        var config = {
            onUploadProgress: function (progressEvent) {
                var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                progress_counter(percentCompleted);
            }
        };
        // var frmCreate = $("#frmCreateDelegation");
        let formData = new FormData();

        formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
        formData.append('commerce', id)
        console.log(formData);

        axios.post($("#dettach_tozone").val(), formData, config, {}).then((response) => {
            progress_hide();

            if (response.data.success === true) {
                $('#tableCommerceDispo').bootstrapTable('refresh');
                $('#tableCommerceSelect').bootstrapTable('refresh');
                rep_success(response.data.message)

                swal({
                        title: 'Suppression reussie',
                        text: "La ligne a bien été supprimée",
                        type: 'success',
                        timer: 2000
                    }
                );


            } else {
                rep_error(response.data.message)
            }

        }).catch(error => {
            progress_hide(1);
            // rep_error(error.data.message)
            //


        })
    })
}
function dettachAgentToZone(id){
    // console.log(id);
    // destroy_delegation

    swal({
        title: "Confirmation",
        text: "Etes vous sûr de bien vouloir retirer cet agent ?",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Continuer",
        cancelButtonText: "Annuler",
        closeOnConfirm: false
    }, function (response) {
        progress_show();
        var config = {
            onUploadProgress: function (progressEvent) {
                var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                progress_counter(percentCompleted);
            }
        };
        // var frmCreate = $("#frmCreateDelegation");
        let formData = new FormData();

        formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
        formData.append('commerce', id)
        console.log(formData);

        axios.post($("#dettach_tozone").val(), formData, config, {}).then((response) => {
            progress_hide();

            if (response.data.success === true) {
                $('#tableCommerceDispo').bootstrapTable('refresh');
                $('#tableCommerceSelect').bootstrapTable('refresh');
                rep_success(response.data.message)

                swal({
                        title: 'Suppression reussie',
                        text: "La ligne a bien été supprimée",
                        type: 'success',
                        timer: 2000
                    }
                );


            } else {
                rep_error(response.data.message)
            }

        }).catch(error => {
            progress_hide(1);
            // rep_error(error.data.message)
            //


        })
    })
}



function updateRows(id,name){
    console.log(name)
    $("#zone_id").val(id);
    $("#name").val(name);
}
