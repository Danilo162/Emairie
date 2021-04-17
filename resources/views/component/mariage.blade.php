@include('component.style')
<style>

.container{
    width: 80%;
    margin: 0 auto;
  /*  background-color: #cce2ff;*/
    color: rgba(0,0,0,.87);
    padding: 8px 60px;
}

.shadow-lg {
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
}
@page {
    margin: 80px 25px 70px 50px;
}

footer {
    position: fixed;
    bottom: -60px;
    left: 0px;
    right: 0px;
    height: 50px;

    text-align: center;
    line-height: 35px;
}
.font-Arial{
    font-family: "Arial";
}
.font-Newtimes{
    font-family: "Times New Roman";
}
.b{
    font-weight: 600;
}
.align-left{
    text-align: center;
}
.table-user-information > tbody > tr {
    border-top: .01px solid rgba(221, 221, 221, 0.6);
}
.table-user-information > tbody > tr:first-child {
    border-top: 0;

}
.table-user-information > tbody > tr {
    /*background: #fff;*/
    background: #fff;
}
.table-user-information > tbody > tr:nth-child(odd) {

    background: #eae6e0;
}
.table-user-information > tbody > tr > td {
    border-top: 0;
}
.c-orange{
    color: orange;
}
.c-blue-light{
    color: #16aaff;
} .c-blue{
      color: #16aaff;
  }
.b-blue-light{
    background: #16aaff;
    color: white;
}
.col8{
    display: inline-block;
    float: left;
    width: 66.66667%;
}.col4{
     display: inline-block;
     float: left;
     width: 33.333333%;
 }
.row{
    display: inline-block;
}
body{
    font-size: 12px;
}

/* Profile Content */
.profile-content {
    padding: 20px;
    background: #fff;
    min-height: 460px;
}
.td-title{
    font-size: 12px;
    font-weight: 600;
    width: 40%
}
.td-title_{
    font-size: 13px;
    font-weight: 600;

}

.td-title {
    font-size: 12px;
    font-weight: 600;
    width: 40%;
}
.bg-grey-tr{
    background-color: #d6d8db;
    padding: 8px;
}

.table-bordered {
    border: 1px solid #dee2e6;
}
.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
}
table {
    border-collapse: collapse;
}
.table-secondary, .table-secondary > td, .table-secondary > th {
    background-color: #d6d8db;
    font-size: 12px;
}
.txt-align-center {
    text-align: center;
}
.table-bordered thead td, .table-bordered thead th {
    border-bottom-width: 2px;
}
.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
    border-bottom-width: 2px;
}
.table-secondary tbody + tbody, .table-secondary td, .table-secondary th, .table-secondary thead th {
    border-color: #b3b7bb;
    border-bottom-color: rgb(179, 183, 187);
}
.table-secondary, .table-secondary > td, .table-secondary > th {
    background-color: #d6d8db;
}
.table-bordered td, .table-bordered th {
    border: 1px solid #dee2e6;
    border-top-color: rgb(222, 226, 230);
    border-right-color: rgb(222, 226, 230);
    border-bottom-color: rgb(222, 226, 230);
    border-bottom-style: solid;
    border-bottom-width: 1px;
    border-left-color: rgb(222, 226, 230);
}
.table td, .table th {
    padding: .75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}
th {
    text-align: inherit;
}
.table-bordered td, .table-bordered th {
    border: 1px solid #dee2e6;
}
.table td, .table th {
    padding: .75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}
.td-title {
    font-size: 12px;
    font-weight: 600;
    width: 40%;
}
.txt-upper{
    text-transform: uppercase;
}

    .bg-blue{
        background-color: #adc5f3 !important;
    }
    .w30 {
        width: 30%
    }
 .w20{
        width: 20%
    }
.w15{
        width: 15%
    }
    td{
        font-family: Calibri !important;
        font-weight: 600 !important;
        font-size: 12px;

    }

.select2-container--default .select2-selection--single {
    height: 38px;
}
input[type="text"], input[type="password"], input[type="email"], textarea {
    height: 30px;
    color: #000;
    font-size: 15px;
    padding: 0px 20px;
    outline: none !important;
    font-weight: 600;
    border-radius: 0 !important;
}
/*   table td {
       position: relative;
   }

   table td input {
       position: absolute;
       display: block;
       top:0;
       left:0;
       margin: 0;
       height: 100%;
       width: 100%;
       border: none;
       padding: 10px;
       box-sizing: border-box;
   }*/
td {
    position: relative;
}

td input[type="text"], td textarea {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    resize: none;
    height: 100%;
    /* for full width without spacing */
    width: 100%;
    border: none;
    font-size: 10px !important;
}

.table td{

    padding: .31rem;
    vertical-align: middle;
}
</style>

<div class="container shadow-lg">
    <br>
    <div class="field" style="font-family: 'Edwardian Script ITC';font-size: 30px;font-weight: 500">
        République démocratique du Congo
    </div>
    <br>
    <br>
    <div class="ui grid stackable" style="">

        <div class="two column row">
            <div class="column" >
                <img src="{{asset('images/logo.png')}}" alt="" style="height: 100px"><br>
                VILLE DE KISNHASA<br/>
                COMMUNE DE LA GOMBE<br/>
                <p style="text-decoration: underline">SERVICE DE L'ETAT CIVIL</p>
            </div>
            <div class="column"  >
               <div class="field" style="text-align: left">
                   <b style="font-size: 25px">PROJET DE MARIAGE</b>
                   <br>
                   <b style="text-decoration: underline;font-size: 16px">N O Et.civ/	IB034h/0912019</b>
                   <br>
                   <br>
                   <b>
                       DATE DE L.A PIBLICATION :
                       <br>
                       DATE DE LA CEREMONIE    :
                   </b>
               </div>
            </div>
        </div>

    </div>

    <br>
    <br>
    <form action="" class="ui form">
    <table class="table responsive-table table-bordered" >
        <tbody>
        <tr class="bg-blue" style="">
            <td class="w30 ">
                REGIMES MATRIMONIAUX
            </td>
            <td class="w15">
                AGENT TRAITANT

            </td>
            <td class="w15">

            </td>
            <td class="w20">
                AYANT DROIT COUTUMIER
            </td>
            <td class="w20">

            </td>
        </tr>
        <tr >
            <td >
              <div class="field">
                  <div class="inline fields">
                      <div class="fourteen wide field">
                          SEPARATION DES BIENS
                      </div>
                      <div class="two wide field">
                          <input type="checkbox" name="regime">
                      </div>
                  </div>
              </div>

            </td>
            <td rowspan="2">
                NOM ET
                POST NOM

            </td>
            <td rowspan="2">
                <input class="txt-upper " type="text" value="">
            </td>
            <td >
                NOM, POSTNOM ET PRENOM
            </td>
            <td >
                <input class="txt-upper " type="text" value="">
            </td>
        </tr>
        <tr >
            <td >
                <div class="field">
                    <div class="inline fields">
                        <div class="fourteen wide field">
                            COMMUNINAUTE REDUITE AUX ACQUETS
                        </div>
                        <div class="two wide field">
                            <input type="checkbox" name="regime">
                        </div>
                    </div>
                </div>
            </td>
            <td>
                LIEU ET DATE DE NAISSANCE

            </td>
            <td>
                <input class="txt-upper " type="text" value="">
            </td>
        </tr>
        <tr >
            <td >
                <div class="field">
                    <div class="inline fields">
                        <div class="fourteen wide field">
                            COMMUNAUTE UNIVERSELLE
                        </div>
                        <div class="two wide field">
                            <input type="checkbox" name="regime">
                        </div>
                    </div>
                </div>
            </td>
            <td rowspan="2">
                SIGNATURE ET DATE
            </td>
            <td rowspan="2">
                <input class="txt-upper " type="text" value="">
            </td>
            <td >
                PROFESSION
            </td>
            <td >
                <input class="txt-upper " type="text" value="">
            </td>
        </tr>
        <tr >
            <td  class="bg-blue" style="height: 35px">
&nbsp;
            </td>
            <td>
                MONTANT DE LA DOT

            </td>
            <td >
                <input class="txt-upper " type="text" value="">
            </td>
        </tr>
        </tbody>
    </table>

        <table class="table responsive-table table-bordered  " >
            <tbody>
            <tr  style="">
                <td  class="w30 bg-blue">
                    FUTUR EPOUX
                </td>
                <td class="w30 bg-blue">
                    RENSEIGNEMENT

                </td>
                <td class="w30 bg-blue">
            FUTURE EPOUSE
                </td>
            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                    NOM, POSTNOM ET PRENOM

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                   LIEU ET DATE DE NAISSANCE

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                   ETAT CIVIL

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                   PROFESSION

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                   SECTEUR

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                   TERRITOIRE

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                   PROVINCE

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                   NATIONALITE

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                   RESIDENCE A KINSHASA

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                   TELEPHONE

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>


            <tr  style="">
                <td  class="w30 bg-blue">
                   PERE DU FUTUR EPOUX
                </td>
                <td class="w30 bg-blue">


                </td>
                <td class="w30 bg-blue">
                   PERE DE LA FUTURE EPOUSE
                </td>
            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                    NOM, POSTNOM ET PRENOM

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                    LIEU ET DATE DE NAISSANCE

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                    ETAT CIVIL

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                    PROFESSION

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                    SECTEUR

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                    TERRITOIRE

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                    PROVINCE

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                    NATIONALITE

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                    RESIDENCE A KINSHASA

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                    TELEPHONE

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>

            <tr  style="">
                <td  class="w30 bg-blue">
                    MERE DU FUTUR EPOUX
                </td>
                <td class="w30 bg-blue">


                </td>
                <td class="w30 bg-blue">
                    MERE DE LA FUTURE EPOUSE
                </td>
            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                    NOM, POSTNOM ET PRENOM

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                    LIEU ET DATE DE NAISSANCE

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                    ETAT CIVIL

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                    PROFESSION

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                    SECTEUR

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                    TERRITOIRE

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                    PROVINCE

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                    NATIONALITE

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                    RESIDENCE A KINSHASA

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>
            <tr >
                <td >
                    <input class="txt-upper " type="text" value="">

                </td>
                <td >
                    TELEPHONE

                </td>
                <td >
                    <input class="txt-upper " type="text" value="">
                </td>

            </tr>

            </tbody>
        </table>

        <div class="field" style="text-align: center;padding: 10px 20%">
            <label for="" style="font-size: 16px;font-size: 14px;font-weight: 600;"> Je Jure sur l'honneur que les renseignements susmentionnés sont véridiques </label>
            <br>
            <br>
            <div class="inline fields" >
                <div class="eight wide field" style="text-align: center">
                    Nom, signature et date (Futur époux)
                </div>
                <div class="eight wide field" style="text-align: center">
                    Nom, signature et date (Future épouse)
                </div>
            </div>
        </div>

        <br>
        <br>
    </form>

</div>
