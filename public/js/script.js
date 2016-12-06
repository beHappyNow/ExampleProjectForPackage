/**
 * Created by behappy on 11.10.16.
 */
$(document).on('ready', function(){
    //Request setting for passing the CSRF test
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if( new RegExp('localities\/\\d*\/edit').test(window.location.pathname) ){
        var latVal = $('input[name="latitude"]').val();
        var lonVal = $('input[name="longitude"]').val();
        fetchClosestWS(latVal,lonVal);
    }

    $('input[name="latitude"], input[name="longitude"], input[name="population"]').on('keypress', isNumber);
    $('input[name="latitude"], input[name="longitude"]').on('change', function(e){
        var latVal = $('input[name="latitude"]').val();
        var lonVal = $('input[name="longitude"]').val();

        if (checkReadyForAjax(latVal,lonVal)) {
            fetchClosestWS(latVal,lonVal);
        }
    });

    selectActiveNavElement();

});

function isNumber(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
    if (key.length == 0) return;
    var regex = /^[0-9.,\b]+$/;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

function checkReadyForAjax(latVal,lonVal){
    var returnValue = false;
    if (latVal.length > 2 && lonVal.length > 2) {
        returnValue = true;
    }
    return returnValue;
}

function fetchClosestWS(latVal,lonVal){
    $.ajax({
        url: "/list_of_closest",
        type: "POST",
        data: { lat: latVal, lon: lonVal},
        success: function(d){
            var elems = JSON.parse(d);
            var closest = $('select option:first')[0].outerHTML;
            var html = closest;

            if (elems.length) {

                for (var i = 0; i < elems.length; i++) {
                    html += "<option value='" + elems[i]['id'] + "'> " + elems[i]['name'] + " : distance - " + elems[i]['distance'] + "</option>";
                }
                $('select[name="ws"]').html(html);
            } else {
                html += "<option value='-1' disabled='disabled'>There aren't weather stations in radius of 100 km</option>";
                html += "<option value='-1' disabled='disabled'>Please, choose the '--Closest--' option</option>";

                $('select[name="ws"]').html(html);
            }
            getSelected();
        }
    });
}

function getSelected(){
    if(new RegExp('localities\/\\d*\/edit').test(window.location.pathname)){
        $('select[name="ws"] option').each(function(i, val){
            if($(val).val() == ws_id){
                $('select[name="ws"] option[selected]').removeAttr('selected');
                $(val).attr('selected','selected');
            }
        })
    }
}

function selectActiveNavElement(){
    var controller = window.location.pathname.split('/')[1];
    if (controller == 'localities') {
        $('.nav.navbar-nav li[class="active"]').removeClass('active');
        $('.nav.navbar-nav li[class="localities"]').addClass('active');
    }
    if (controller == 'weatherstations') {
        $('.nav.navbar-nav li[class="active"]').removeClass('active');
        $('.nav.navbar-nav li[class="weatherstations"]').addClass('active');
    }
}