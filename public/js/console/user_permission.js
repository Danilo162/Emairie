$(document).ready(function (){
    getInfos()
})

var app = new Vue({
    el: '#content',
    data: function () {
        return {
            e_permission: '',
            e_firstname: '',
            e_lastname: '',
            e_phone: '',
            e_email: '',
            e_picture: '',
            e_mairie: '',
            e_job: '',
            e_role: '',
            e_mot_de_passe: '',
            e_nouveau_mot_de_passe: '',
            e_confirmer_mot_de_passe: '',

        }
    },
    methods: {
        store() {
            this.e_permission = ''
            progress_show();
            var config = {
                onUploadProgress: function (progressEvent) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    progress_counter(percentCompleted);
                }
            };

            var frmCreate = $("#frmCreateDelegation");
            let formData = new FormData(frmCreate[0]);

            formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
            axios.post($("#store_delegation").val(), formData, config, {}).then((response) => {
                progress_hide();

                if (response.data.success === true) {

                    rep_success(response.data.message)
                    $('#tableDelegues').bootstrapTable('refresh');
                    $('#tableDeleguesDispo').bootstrapTable('refresh');
                } else {
                    rep_error(response.data.message)
                }

            }).catch(error => {
                progress_hide(1);
                // rep_error(error.data.message)
                //
                if (error.response.data.errors) {
                    if (error.response.data.errors.permission) {
                        this.e_permission = error.response.data.errors.permission[0];

                    }

                }

            })
        },
        storeSetting() {
            this.e_permission = ''
            progress_show();
            var config = {
                onUploadProgress: function (progressEvent) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    progress_counter(percentCompleted);
                }
            };

            var frmCreate = $("#frmCreateSetting");
            let formData = new FormData(frmCreate[0]);

            formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
            axios.post($("#settingStore").val(), formData, config, {}).then((response) => {
                progress_hide();

                if (response.data.success === true) {

                    rep_success(response.data.message)
                   /* location.reload();*/
                } else {
                    rep_error(response.data.message)
                }

            }).catch(error => {
                progress_hide(1);
                // rep_error(error.data.message)
                //
                if (error.response.data.errors) {
                    if (error.response.data.errors.permission) {
                        this.e_permission = error.response.data.errors.permission[0];

                    }

                }

            })
        },
        storeSettingSigntaure() {
            this.e_permission = ''
            progress_show();
            var config = {
                onUploadProgress: function (progressEvent) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    progress_counter(percentCompleted);
                }
            };

            var frmCreate = $("#frmCreateSettingSigntaure");
            let formData = new FormData(frmCreate[0]);

            formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
            axios.post($("#settingStore").val(), formData, config, {}).then((response) => {
                progress_hide();

                if (response.data.success === true) {

                    rep_success(response.data.message)
                    location.reload();
                } else {
                    rep_error(response.data.message)
                }

            }).catch(error => {
                progress_hide(1);
                // rep_error(error.data.message)
                //
                if (error.response.data.errors) {
                    if (error.response.data.errors.permission) {
                        this.e_permission = error.response.data.errors.permission[0];

                    }

                }

            })
        },
        edit() {
            btnsend_loader_show('submitbtn')
            this.e_firstname = '',
                this.e_lastname = '',
                this.e_phone = '',
                this.e_email = '',
                this.e_picture = '',
                this.e_mairie = '',
                this.e_job = ''
            this.e_role = ''
            progress_show();
            var config = {
                onUploadProgress: function (progressEvent) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    progress_counter(percentCompleted);
                }
            };
            // document.getElementById("frmCreate")
            var frmCreate = $("#frmCreateAgent");
            let formData = new FormData(frmCreate[0]);


            formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
            axios.post($("#storeAgent").val(), formData, config, {}).then((response) => {
                btnsend_loader_hide('submitbtn')
                progress_hide();
                console.log(response.data)
                if (response.data.success === true) {

                    $("#defaultModal").modal('hide')
                    rep_success(response.data.message)
                    getInfos()
                 ;
                } else {
                    rep_error(response.data.message)
                }
            }).catch(error => {
                btnsend_loader_hide('submitbtn')
                progress_hide(1);
                // rep_error(error.data.message)
                // ON RECUPERE LES ERREURS QUI DOIVENT ÊTRES AFFICHEES DANS LA VUE
                if (error.response.data.errors) {
                    if (error.response.data.errors.firstname) {
                        this.e_firstname = error.response.data.errors.firstname[0];
                    }
                    if (error.response.data.errors.lastname) {
                        this.e_lastname = error.response.data.errors.lastname[0];
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
                    if (error.response.data.errors.mairie) {
                        this.e_mairie = error.response.data.errors.mairie[0];
                    }
                    if (error.response.data.errors.job) {
                        this.e_job = error.response.data.errors.job[0];
                    }
                    if (error.response.data.errors.role) {
                        this.e_role = error.response.data.errors.role[0];
                    }

                }

            })
        },
        changePass() {
            btnsend_loader_show('submitbtn')
                // this.e_mot_de_passe = '',
                // this.e_nouveau_mot_de_passe = '',
                // this.e_confirmer_mot_de_passe = '';

            progress_show();
            var config = {
                onUploadProgress: function (progressEvent) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    progress_counter(percentCompleted);
                }
            };
            // document.getElementById("frmCreate")
            var frmCreate = $("#frmCreatePass");
            let formData = new FormData(frmCreate[0]);

            formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
            axios.post($("#changepass").val(), formData, config, {}).then((response) => {
                btnsend_loader_hide('submitbtn')
                progress_hide();

                if (response.data.success === true) {
                    $("#passwordModal").modal('hide')
                    rep_success(response.data.message)
                    frmCreate[0].reset();
                } else {
                    rep_error(response.data.message)
                }
            }).catch(error => {
                btnsend_loader_hide('submitbtn')
                progress_hide(1);

                // rep_error(error.data.message)
                // ON RECUPERE LES ERREURS QUI DOIVENT ÊTRES AFFICHEES DANS LA VUE
                if (error.response.data.errors) {
                    if (error.response.data.errors.mot_de_passe) {
                        this.e_mot_de_passe = error.response.data.errors.mot_de_passe[0];
                    }
                    if (error.response.data.errors.nouveau_mot_de_passe) {
                        this.e_nouveau_mot_de_passe = error.response.data.errors.nouveau_mot_de_passe[0];
                    }
                    if (error.response.data.errors.confirmer_mot_de_passe) {
                        this.e_confirmer_mot_de_passe = error.response.data.errors.confirmer_mot_de_passe[0];

                    }


                }

            })
        },
    },
    mounted() {
        // $("#select-all").on("change",function (){
        //     var checked = $(this).is(':checked');
        //     if(this.checked){
        //         $(':checkbox').each(function (){
        //             this.checked = true;
        //             console.log(checked)
        //         });
        //     }else {
        //         $(':checkbox').each(function (){
        //             this.checked = false;
        //         });
        //     }
        // })
    }


})
function optionsFormatterAdd(id, row) {
    options = "<button onclick=\"javascript:addPermission("+id+");\" class='btn btn-sm btn-default no-shadow'><i class=\"fa fa-arrow-left blue-text\"></i> Ajouter</button>";
    return options;
}
function optionsFormatterRemove(id, row) {
    options = "<button onclick=\"javascript:removePermission("+id+");\" class='btn btn-sm btn-default no-shadow'> Retirer <i class=\"fa fa-arrow-right red-text\"></i></button>";
    return options;
}

function addPermission(id){
    var ag_t = $("#ag_t").val();
    this.e_permission = ''
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
    formData.append('ag_t', ag_t)
    formData.append('p_ms', id)
    console.log(formData);

    axios.post($("#store_delegation").val(), formData, config, {}).then((response) => {
        progress_hide();

        if (response.data.success === true) {

            $('#tableDelegues').bootstrapTable('refresh');
            $('#tableDeleguesDispo').bootstrapTable('refresh');
            rep_success(response.data.message)

        } else {
            rep_error(response.data.message)
        }

    }).catch(error => {
        progress_hide(1);
        // rep_error(error.data.message)
        //
        if (error.response.data.errors) {
            if (error.response.data.errors.permission) {
                this.e_permission = error.response.data.errors.permission[0];

            }

        }

    })

}
function removePermission(id){
    // console.log(id);
    // destroy_delegation

    var ag_t = $("#ag_t").val();
    this.e_permission = ''
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
    formData.append('ag_t', ag_t)
    formData.append('p_ms', id)
    console.log(formData);

    axios.post($("#destroy_delegation").val(), formData, config, {}).then((response) => {
        progress_hide();

        if (response.data.success === true) {
            $('#tableDelegues').bootstrapTable('refresh');
            $('#tableDeleguesDispo').bootstrapTable('refresh');
            rep_success(response.data.message)

        } else {
            rep_error(response.data.message)
        }

    }).catch(error => {
        progress_hide(1);
        // rep_error(error.data.message)
        //
        if (error.response.data.errors) {
            if (error.response.data.errors.permission) {
                this.e_permission = error.response.data.errors.permission[0];

            }

        }

    })

}
function getInfos(){
    // console.log(id);
    // destroy_delegation

    var ag_t = $("#ag_t").val();
    $("#infoList").html("<div class=\"preloader pl-size-md\">\n" +
        "                                    <div class=\"spinner-layer\">\n" +
        "           <div class=\"circle-clipper left\">\n" +
        "                                            <div class=\"circle\"></div>\n" +
        "                                        </div>\n" +
        "                                        <div class=\"circle-clipper right\">\n" +
        "                                            <div class=\"circle\"></div>\n" +
        "                                        </div>\n" +
        "                                    </div>\n" +
        "                                </div>")
    let formData = new FormData();

    formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
    formData.append('ag_t', ag_t)

    console.log(formData);

    axios.post($("#agent_info").val(), formData).then((response) => {
            $("#infoList").html(response.data)

    }).catch(error => {

    })

}

function formatName(id,row){
    // name
    return " <div class='col-lg-12'>  <div data-toggle=\"tooltip\" data-placement=\"top\" title=\""+row.comment+"\" data-original-title=\""+row.comment+"\" >"+row.name+"</div></div>  "
}

function editModal(){
    $("#defaultModal").modal("show");
}
function passwordModal(){
    $("#frmCreatePass")[0].reset();
    $("#passwordModal").modal("show");
}
