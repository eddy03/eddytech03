var centerLatLng, zoom, title, strokeColor, strokeOpacity, strokeWeight, fillColor, fillOpacity, path;

$(document).ready(function() {
    settingUp();
    constructMaps();
});

$('#addPointing').click(function() {
   var latlng = $("#latlng").clone();
   $("#latlngDIV").append(latlng);
});

$("#forms").submit(function(e) {
    loadData();
    constructMaps();
    return false;
});

settingUp = function() {    
    centerLatLng = new Array('3.067618', '101.499016');
    zoom = 15;
    title = "Subject goes here!";
    strokeColor = "000000";
    strokeOpacity = 0.9;
    strokeWeight = 1;
    fillColor = "000000";
    fillOpacity = 0.25;    
    path = new Array(
        new Array('3.06976', '101.491764'),
        new Array('3.064211', '101.491849'),
        new Array('3.063354', '101.494467'),
        new Array('3.062946', '101.498501'),
        new Array('3.062764', '101.503823'),
        new Array('3.063332', '101.508672'),        
        new Array('3.069117', '101.507127'),
        new Array('3.070403', '101.504166'),
        new Array('3.073274', '101.50099'),
        new Array('3.074431', '101.498201'),
        new Array('3.071774', '101.495969'),
        new Array('3.06946', '101.494167'),        
        new Array('3.06976', '101.491764')
    );
};

loadData = function() {
    strokeColor = "#" + $("#strokeColor").val();
    strokeOpacity = $("#strokeOpacity").val();
    strokeWeight = $("#strokeWeight").val();
    fillColor = "#" + $("#fillColor").val();
    fillOpacity = $("#fillOpacity").val();
    centerLatLng = new Array( $("#Clat").val().toString(), $("#Clng").val().toString() );
    zoom = parseInt($("#zoom").val());
    title = $("#subject").val();
    
    if(!isNaN(zoom)) {
        zoom = 15;
    }
    
    constructPathArray();
};

constructPathArray = function() {
    var latitude = new Array();
    var longitude = new Array();
    var index;
    
    $("input.latitude").each(function(i) {
        latitude[i] = this.value;
    });
    
    $("input.longitude").each(function(i) {
        longitude[i] = this.value;
    });
    
    if(latitude.length > 1) {
        path = new Array();
    
        for(index = 0; index < latitude.length; index++) {        
            path.push(new Array( latitude[index].toString(), longitude[index].toString() ));
        }
    }
};

constructMaps = function() {    
    $("#gist").gmap3('destroy').gmap3({
        map: {
            options: {
                center: centerLatLng,
                zoom: zoom
            }
        },
        infowindow:{
            latLng: centerLatLng,
            options: {
                content: title
            }
        },
        polygon: {
            options: {
                strokeColor: strokeColor,
                strokeOpacity: strokeOpacity,
                strokeWeight: strokeWeight,
                fillColor: fillColor,
                fillOpacity: fillOpacity,
                paths: path
            }
        }
    });
};