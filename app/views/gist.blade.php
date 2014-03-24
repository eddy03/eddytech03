<!DOCTYPE html>
<html lang="en">
    <head>
        <title>GIST Research and development</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{ HTML::style('components/bootstrap/dist/css/bootstrap.min.css') }}
        {{ HTML::style('components/font-awesome/css/font-awesome.min.css') }}
        <style>
            #gist {
                width: 100%;
                height: 500px;
            }
            .tab-content {
                padding-top: 10px;
            }
        </style>
    </head>
    <body>
        
        <div class="container">
            <div class="page-header">
                <h1>GIST Google Maps Polygon RnD</h1>
            </div>
            
            
            <div class="row">
                <div class="col-sm-4">
                    <form role="form" id="forms">
                        <div class="form-group">
                            <button class="btn btn-block btn-sm btn-primary" id="generate">Generate</button>
                        </div>
                        <div id="content">
                            <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                                <li class="active"><a href="#tab_core" data-toggle="tab">Core</a></li>
                                <li><a href="#tab_polygon" data-toggle="tab">Polygon</a></li>
                                <li><a href="#tab_path" data-toggle="tab">Path</a></li>
                            </ul>
                            <div id="my-tab-content" class="tab-content">
                                <div class="tab-pane active" id="tab_core">
                                    <div class="form-group">
                                        <label for="strokeColor">Center to</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-sm" id="Clat" value="3.067618" placeholder="Latitude" />
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-sm" id="Clng" value="101.499016" placeholder="Longitude" />
                                            </div>
                                        </div>                         
                                    </div>
                                    <div class="form-group">
                                        <label for="fillColor">Zoom level</label>
                                        <input type="text" class="form-control input-sm" id="zoom" value="15" placeholder="zoom level : 1 - 18" />                       
                                    </div>
                                    <div class="form-group">
                                        <label for="fillColor">Subject</label>
                                        <input type="text" class="form-control input-sm" id="subject" value="Subject goes here!" placeholder="Subject of the polygon" />                        
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_polygon">
                                    <div class="form-group">
                                        <label for="strokeColor">Stroke Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">#</span>
                                            <input type="text" class="form-control input-sm" id="strokeColor" value="000000" placeholder="000000" />
                                        </div>                          
                                    </div>
                                    <div class="form-group">
                                        <label for="fillColor">Fill Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">#</span>
                                            <input type="text" class="form-control input-sm" id="fillColor" value="000000" placeholder="000000" />
                                        </div>                          
                                    </div>
                                    <div class="form-group">
                                        <label for="strokeOpacity">Stroke Opacity</label>
                                        <input type="text" class="form-control input-sm" id="strokeOpacity" value="0.9" placeholder="0.9" />
                                    </div>
                                    <div class="form-group">
                                        <label for="strokeWeight">Stroke Weight</label>
                                        <input type="text" class="form-control input-sm" id="strokeWeight" value="1" placeholder="1" />                       
                                    </div>
                                    <div class="form-group">
                                        <label for="fillOpacity">Fill Opacity</label>
                                        <input type="text" class="form-control input-sm" id="fillOpacity" value="0.25" placeholder="0.25" />                       
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_path">
                                    <div class="form-group">
                                        <button class="btn btn-block btn-sm btn-success" type="button" id="addPointing">Add Pointing</button>
                                    </div>
                                    <div class="form-group" id="latlng">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-sm latitude" name="lat[]" placeholder="Latitude" />
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-sm longitude" name="lng[]" placeholder="Longitude" />
                                            </div>
                                        </div>
                                    </div>
                                    <div id="latlngDIV"></div>
                                </div>
                            </div>
                        </div>                
                    </form>
                </div>
                <div class="col-sm-8">
                    <div class="maps" id="test"></div>
                </div>
            </div>
        </div>
        
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
        {{ HTML::script('components/jquery/dist/jquery.min.js') }}
        {{ HTML::script('components/bootstrap/dist/js/bootstrap.min.js') }}
        {{ HTML::script('components/gmap3/gmap3.js') }}
        {{ HTML::script('assets/js/gist.js') }}
    </body>
</html>