function calculDateFin(){
     $("#next").prop("disabled",true);
     var date_deb = $('#date_deb').val()
     //var days = parseInt($('#duree').text())||0
     var e = document.getElementById("duree");
     var text = e.options[e.selectedIndex].text
     if(text.length>6){
          var days = parseInt(text.substring(6, 8));
     }else{
          var days = parseInt(text.substring(0, 2));
     }
     if(days<=0) return;
     if(isFinite(date_deb)) return;
     var nameList = date_deb.split('/')
     nameList[1]  = parseInt(nameList[1]) + days;
     if(nameList[1] > 12){
          nameList[2] = parseInt(nameList[2]) + 1;
          nameList[1] = parseInt(nameList[1]) - parseInt(12);
     }

     nameList[0] = parseInt(nameList[0]) - 1;
     if(nameList[0] == 0){
          nameList[1] = nameList[1] - 1;
          if(nameList[1] == 2){
               if(nameList[2] % 4 == 0 && nameList[2] % 100 != 0){
                    nameList[0] = 29;
               }else if(nameList[2] % 400 == 0){
                    nameList[0] = 29;
               }else{
                    nameList[0] = 28;
               }
          }else if(nameList[1] == 1 || nameList[1] == 3 || nameList[1] == 5 || nameList[1] == 7 || nameList[1] == 8 || nameList[1] == 10 || nameList[1] == 12){
               nameList[0] = 31;
          }else{
               nameList[0] = 30;
          }
     }

     if(nameList[1] == 2){
          if(nameList[0] >= 30){
               if(nameList[2] % 4 == 0 && nameList[2] % 100 != 0){
                    nameList[0] = 29;
               }else if(nameList[2] % 400 == 0){
                    nameList[0] = 29;
               }else{
                    nameList[0] = 28;
               }
          }
     }
     if(10 > nameList[1]){
          nameList[1] = "0" + nameList[1]
     }
     if(10 > nameList[0]){
          nameList[0] = "0"+nameList[0];
     }
     //console.log("Date en Mois"+nameList[1]);
     $('#date_fin').val(nameList.join('/'));
     $("#next").prop("disabled",false);
}
function calcul_promo(montant,remise,type)
{
     $("#next").prop("disabled",true);
     var resultat = 0;
     if(type=='prc')
     {
          resultat = Math.round(montant*remise/100)
          console.log('prc')
     }else if(type=='fix'){
          resultat = remise
     }
     $("#next").prop("disabled",false);
     return resultat
}
function calcul_tarif() {
     $("#next").prop("disabled",true);
     $.post(BASE_URL + 'api/auto/get_tarif', $("#form-tarif").serialize())
     .done(function (json) {
          console.log(json);
          var obj = JSON.parse(json) || {}
          if (obj.hasOwnProperty('prime_ttc')) {
               var livraison_tarif = parseFloat($('#livraison_tarif').val()) || ''
               var prime_ttc = parseFloat(obj.prime_ttc) || ''
               var dossier = parseFloat(obj.dossier) || ''
               var coupon_type = $('#coupon_type').val()
               var coupon_valeur = parseFloat($('#coupon_valeur').val()) || ''
               var remise = calcul_promo(prime_ttc, coupon_valeur, coupon_type)
               //teste livraison oui non
               if(!$('#livraison_1').is(':checked'))livraison_tarif = 0;

               $('#tarif').val(prime_ttc)
               $('#dossier').val(dossier)
               $('#prime_net').val(prime_ttc)
               $('#remise').val(remise)
               $('#net_paye').val(prime_ttc + dossier + livraison_tarif - remise)


               console.log('livraison' + jQuery('#livraison_options').val())
               //console.log(parseFloat(obj.prime_ttc) || '')
          }
     })
     .fail(function (jqxhr, textStatus, error) {
          var err = textStatus + ", " + error;
          console.log("Request Failed: " + err);
     });
     $("#next").prop("disabled",false);
}
function check_coupon()
{
     $("#next").prop("disabled",true);
     $.post(BASE_URL + 'api/coupons/check', $("#form-tarif").serialize())
     .done(function (json) {
          console.log(json);
          var obj = JSON.parse(json) || {}
          if (obj.hasOwnProperty('coupon_type')) {
               $('#coupon_type').val(obj.coupon_type)
               $('#coupon_valeur').val(parseFloat(obj.coupon_valeur) || '')
               $('.coupon-type').hide()
               $('.coupon-type[' + obj.coupon_type + ']').show()
               ///
               calcul_tarif()
          }
     })
     .fail(function (jqxhr, textStatus, error) {
          var err = textStatus + ", " + error;
          console.log("Request Failed: " + err);
     });
     $("#next").prop("disabled",false);
}
function set_date_fin()
{
     $("#next").prop("disabled",true);
     var date_deb  = new Date($('#date_deb').val().replace(/\//g, '-'))
     var days     = 30*parseInt($('#duree').val())
     if(days<=0) return;
     if(!isFinite(date_deb)) return;
     date_deb.setDate(date_deb.getDate() + days);
     date_deb = date_deb.toISOString().substring(0, 10).split('-')
     date_fin = date_deb[2] + '/' + date_deb[1] + '/' +date_deb[0]
     $('input[name="date_fin"]').val(date_fin)

     console.log('duree=' + date_deb + ' ' + date_fin);
     $("#next").prop("disabled",false);
}
jQuery(document).ready(function ()
{
     if (jQuery().datepicker) {
          $('.date-picker').datepicker({
               rtl: App.isRTL(),
               //orientation: "right",
               autoclose: true
          });
     }
     //hidding coupon type
     $('.coupon-type').hide()
     if(typeof $('#coupon_type').val()!=undefined)
     {
          var coupon_type = $('#coupon_type').val()||''
          if(coupon_type == 'fix' || coupon_type == 'prc')
          {
               $('.coupon-type[' + $('#coupon_type').val()+ ']').show()
          }
     }
     $('.delivery').toggleClass('required',$('#livraison_1').is(':checked'))
     // checkin coupon
     $('#coupon_code_check').on('click',function(){
          var coupon_code = $('#coupon_code').val()
          if(coupon_code.length<=0) return false;
          check_coupon();
     })
     //
     $("#modele_id").chained("#fabriquant_id");
     $('#duree').change()
     $('#puissance_fiscale_id').change()

     $('#duree').on('change', function () {
          calcul_tarif()
     })
     $('#puissance_fiscale_id').on('change', function () {
          calcul_tarif()
     })
     $('#livraison_options').on('change', function () {
          var livraison = $(this).val().split('|')
          $('#livraison_tarif_id').val(livraison[0])
          $('#livraison_tarif').val(parseFloat(livraison[1]) || '')
          calcul_tarif()
     })
     $('input[name="date_deb"]').on('change', function () {
          calculDateFin()
     })
     $('#duree').on('change', function () {
          if(parseInt($(this).val())==12){
               $('#carte_brune_1').prop('checked',true)
          } else {
               $('#carte_brune_0').prop('checked',true)
          }
          calculDateFin()
          calcul_tarif()
     })
     $('[name="carte_brune"]').on('change', function () {
          calcul_tarif()
     })
     $('[name="livraison"]').on('change', function () {
          $('.delivery').toggleClass('required',$('#livraison_1').is(':checked'))
          calcul_tarif()
     })
     $('[name="coupon"]').on('change', function () {
          calcul_tarif()
     })
     $('#coupon_code_check').on('click', function () {
          check_coupon()
     })

     $('input[name="livraison"]').on('switchChange.bootstrapSwitch', function(event, state) {
          if (state == false) {
               $(".livraison").attr('class', 'form-group livraison hide');
               document.getElementById("livraison_options").required = false;
               document.getElementById("livraison_tarif").required = false;
               document.getElementById("livraison_adresse").required = false;
          }else{
               $(".livraison").attr('class', 'form-group livraison');
               $('input[name="adresse_checker"]').val("true");
               document.getElementById("livraison_options").required = true;
               document.getElementById("livraison_tarif").required = true;
               document.getElementById("livraison_adresse").required = true;
          }
     });

     $(function () {
          $('[data-toggle="popover"]').popover()
     })

     //$("#toPrint").get(0).contentWindow.print();

})
