@extends('layouts.dashboard')

@section('title')
    Travel
@endsection

@section('css')
    <link type="text/css" rel="stylesheet" href="{{asset('/wick/dist/wickedpicker.min.css')}}" />
    <link type="text/css" rel="stylesheet" href="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.css" />
    <link type="text/css" rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css" />
@endsection

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Travel
                        <small class="txt_title">
                            Create new
                        </small>
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                <form class="ajaxForm travel" enctype="multipart/form-data" data-name="travel" action="{{route('travel.postdata')}}" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <input id="id" name="id" class="cls" type="hidden">
                        <input id="lat" name="lat" type="hidden">
                        <input id="lng" name="lng" type="hidden">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="cls form-control" name="name" id="name" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="cls form-control" name="description" id="description" placeholder="Enter description">
                        </div>
                        <div class="form-group">
                            <label for="phone">Choice the countries</label>
                            <div class="input-group mb-3">
                                <input class="form-control" name="countries_search" id="countries_search">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="button" id="btn_countries_search">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <select class="cls form-control" name="countries_id" id="countries_id">
                                <option value="">Choice the countries</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="avatar">Image</label>
                            <input type="file" class="cls form-control" name="img" id="img">
                            <br>
                            <img style="width: 200px;height: 200px;" class="avatar_view d-none img-thumbnail" >
                        </div>
                        <div class="form-group">
                            <label for="paragraph">Body</label>
                            <textarea rows="4" name="cbody" class="form-control sumernote m-input" type="text" id="cbody"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="resultDiv"></div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="street">Street:</label>
                                <input class="form-control" name="street" id="street" placeholder="street">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="street">City:</label>
                                <input class="form-control" name="city" id="city" placeholder="city">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="street">State:</label>
                                <input class="form-control" name="state" id="state" placeholder="state">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="street">Zip:</label>
                                <input class="form-control" name="Zip" id="Zip" placeholder="Zip">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Country">Country:</label>
                                <div class="select" >
                                    <select class="form-control" id="Country" name="Country" onkeypress="searchKeyPress(event);" tabindex="5" title="Country">
                                        <option value="AF">Afghanistan</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AS">American Samoa</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AI">Anguilla</option>
                                        <option value="AG">Antigua and Barbuda</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AW">Aruba</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaijan</option>
                                        <option value="BS">Bahamas</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BB">Barbados</option>
                                        <option value="BY">Belarus</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BZ">Belize</option>
                                        <option value="BJ">Benin</option>
                                        <option value="BM">Bermuda</option>
                                        <option value="BT">Bhutan</option>
                                        <option value="BO">Bolivia</option>
                                        <option value="BA">Bosnia and Herzegovina</option>
                                        <option value="BW">Botswana</option>
                                        <option value="BV">Bouvet Island</option>
                                        <option value="BR">Brazil</option>
                                        <option value="IO">British Indian Ocean Territory</option>
                                        <option value="VG">British Virgin Islands</option>
                                        <option value="BN">Brunei</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="BF">Burkina Faso</option>
                                        <option value="BI">Burundi</option>
                                        <option value="KH">Cambodia</option>
                                        <option value="CM">Cameroon</option>
                                        <option value="CA">Canada</option>
                                        <option value="CV">Cape Verde</option>
                                        <option value="KY">Cayman Islands</option>
                                        <option value="CF">Central African Republic</option>
                                        <option value="TD">Chad</option>
                                        <option value="CL">Chile</option>
                                        <option value="CN">China</option>
                                        <option value="CX">Christmas Island</option>
                                        <option value="CC">Cocos (Keeling) Islands</option>
                                        <option value="CO">Colombia</option>
                                        <option value="CG">Congo</option>
                                        <option value="CD">Congo - Democratic Republic of</option>
                                        <option value="CK">Cook Islands</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="CI">Cote d'Ivoire</option>
                                        <option value="HR">Croatia</option>
                                        <option value="CU">Cuba</option>
                                        <option value="CY">Cyprus</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="DK">Denmark</option>
                                        <option value="DJ">Djibouti</option>
                                        <option value="DM">Dominica</option>
                                        <option value="DO">Dominican Republic</option>
                                        <option value="TP">East Timor</option>
                                        <option value="EC">Ecuador</option>
                                        <option value="EG">Egypt</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="GQ">Equitorial Guinea</option>
                                        <option value="ER">Eritrea</option>
                                        <option value="EE">Estonia</option>
                                        <option value="ET">Ethiopia</option>
                                        <option value="FK">Falkland Islands (Islas Malvinas)</option>
                                        <option value="FO">Faroe Islands</option>
                                        <option value="FJ">Fiji</option>
                                        <option value="FI">Finland</option>
                                        <option value="FR">France</option>
                                        <option value="GF">French Guyana</option>
                                        <option value="PF">French Polynesia</option>
                                        <option value="TF">French Southern and Antarctic Lands</option>
                                        <option value="GA">Gabon</option>
                                        <option value="GM">Gambia</option>
                                        <option value="GZ">Gaza Strip</option>
                                        <option value="GE">Georgia</option>
                                        <option value="DE">Germany</option>
                                        <option value="GH">Ghana</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GR">Greece</option>
                                        <option value="GL">Greenland</option>
                                        <option value="GD">Grenada</option>
                                        <option value="GP">Guadeloupe</option>
                                        <option value="GU">Guam</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="GN">Guinea</option>
                                        <option value="GW">Guinea-Bissau</option>
                                        <option value="GY">Guyana</option>
                                        <option value="HT">Haiti</option>
                                        <option value="HM">Heard Island and McDonald Islands</option>
                                        <option value="VA">Holy See (Vatican City)</option>
                                        <option value="HN">Honduras</option>
                                        <option value="HK">Hong Kong</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IR">Iran</option>
                                        <option value="IQ">Iraq</option>
                                        <option value="IE">Ireland</option>
                                        <option selected="selected" value="IL">Israel</option>
                                        <option value="IT">Italy</option>
                                        <option value="JM">Jamaica</option>
                                        <option value="JP">Japan</option>
                                        <option value="JO">Jordan</option>
                                        <option value="KZ">Kazakhstan</option>
                                        <option value="KE">Kenya</option>
                                        <option value="KI">Kiribati</option>
                                        <option value="KW">Kuwait</option>
                                        <option value="KG">Kyrgyzstan</option>
                                        <option value="LA">Laos</option>
                                        <option value="LV">Latvia</option>
                                        <option value="LB">Lebanon</option>
                                        <option value="LS">Lesotho</option>
                                        <option value="LR">Liberia</option>
                                        <option value="LY">Libya</option>
                                        <option value="LI">Liechtenstein</option>
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="MO">Macau</option>
                                        <option value="MK">Macedonia - The Former Yugoslav Republic of</option>
                                        <option value="MG">Madagascar</option>
                                        <option value="MW">Malawi</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="MV">Maldives</option>
                                        <option value="ML">Mali</option>
                                        <option value="MT">Malta</option>
                                        <option value="MH">Marshall Islands</option>
                                        <option value="MQ">Martinique</option>
                                        <option value="MR">Mauritania</option>
                                        <option value="MU">Mauritius</option>
                                        <option value="YT">Mayotte</option>
                                        <option value="MX">Mexico</option>
                                        <option value="FM">Micronesia - Federated States of</option>
                                        <option value="MD">Moldova</option>
                                        <option value="MC">Monaco</option>
                                        <option value="MN">Mongolia</option>
                                        <option value="ME">Montenegro</option>
                                        <option value="MS">Montserrat</option>
                                        <option value="MA">Morocco</option>
                                        <option value="MZ">Mozambique</option>
                                        <option value="MM">Myanmar</option>
                                        <option value="NA">Namibia</option>
                                        <option value="NR">Naura</option>
                                        <option value="NP">Nepal</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="AN">Netherlands Antilles</option>
                                        <option value="NC">New Caledonia</option>
                                        <option value="NZ">New Zealand</option>
                                        <option value="NI">Nicaragua</option>
                                        <option value="NE">Niger</option>
                                        <option value="NG">Nigeria</option>
                                        <option value="NU">Niue</option>
                                        <option value="NF">Norfolk Island</option>
                                        <option value="KP">North Korea</option>
                                        <option value="MP">Northern Mariana Islands</option>
                                        <option value="NO">Norway</option>
                                        <option value="OM">Oman</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="PW">Palau</option>
                                        <option value="PA">Panama</option>
                                        <option value="PG">Papua New Guinea</option>
                                        <option value="PY">Paraguay</option>
                                        <option value="PE">Peru</option>
                                        <option value="PH">Philippines</option>
                                        <option value="PN">Pitcairn Islands</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="QA">Qatar</option>
                                        <option value="RE">Reunion</option>
                                        <option value="RO">Romania</option>
                                        <option value="RU">Russia</option>
                                        <option value="RW">Rwanda</option>
                                        <option value="SH">Saint Helena</option>
                                        <option value="KN">Saint Kitts and Nevis</option>
                                        <option value="LC">Saint Lucia</option>
                                        <option value="PM">Saint Pierre and Miquelon</option>
                                        <option value="VC">Saint Vincent and the Grenadines</option>
                                        <option value="WS">Samoa</option>
                                        <option value="SM">San Marino</option>
                                        <option value="ST">Sao Tome and Principe</option>
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SN">Senegal</option>
                                        <option value="RS">Serbia</option>
                                        <option value="SC">Seychelles</option>
                                        <option value="SL">Sierra Leone</option>
                                        <option value="SG">Singapore</option>
                                        <option value="SK">Slovakia</option>
                                        <option value="SI">Slovenia</option>
                                        <option value="SB">Solomon Islands</option>
                                        <option value="SO">Somalia</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="GS">South Georgia and the South Sandwich Islands</option>
                                        <option value="KR">South Korea</option>
                                        <option value="ES">Spain</option>
                                        <option value="LK">Sri Lanka</option>
                                        <option value="SD">Sudan</option>
                                        <option value="SR">Suriname</option>
                                        <option value="SJ">Svalbard</option>
                                        <option value="SZ">Swaziland</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="SY">Syria</option>
                                        <option value="TW">Taiwan</option>
                                        <option value="TJ">Tajikistan</option>
                                        <option value="TZ">Tanzania</option>
                                        <option value="TH">Thailand</option>
                                        <option value="TG">Togo</option>
                                        <option value="TK">Tokelau</option>
                                        <option value="TO">Tonga</option>
                                        <option value="TT">Trinidad and Tobago</option>
                                        <option value="TN">Tunisia</option>
                                        <option value="TR">Turkey</option>
                                        <option value="TM">Turkmenistan</option>
                                        <option value="TC">Turks and Caicos Islands</option>
                                        <option value="TV">Tuvalu</option>
                                        <option value="UG">Uganda</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="GB">United Kingdom</option>
                                        <option value="US">United States</option>
                                        <option value="VI">United States Virgin Islands</option>
                                        <option value="UY">Uruguay</option>
                                        <option value="UZ">Uzbekistan</option>
                                        <option value="VU">Vanuatu</option>
                                        <option value="VE">Venezuela</option>
                                        <option value="VN">Vietnam</option>
                                        <option value="WF">Wallis and Futuna</option>
                                        <option value="PS">West Bank</option>
                                        <option value="EH">Western Sahara</option>
                                        <option value="YE">Yemen</option>
                                        <option value="ZM">Zambia</option>
                                        <option value="ZW">Zimbabwe</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Country">Serach:</label>
                                <br>
                                <a id="btnGC" onclick="popInfo()" class="btnSearchMaps btn btn-outline-primary">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                            <div id="map" style="width: 100%; height: 530px;"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="button_action" id="button_action" value="insert">
                        <a href="{{route('travel.index')}}" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-load">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('js')

    <script type="text/javascript">

        $(document).ready(function() {

            Countries();

            $('#btn_countries_search').click(function () {
                var v = $('#countries_search').val();
                Countries(v);
            });

            $('#btn_countries').change(function () {
                var v = $(this).val();
                Countries(v);
            });

            var current_edit = getUrlParameter('id');
            if(current_edit != null){
                CreateOrEdit(current_edit);
            }
            else{
                $('.txt_title').html('Create new');
                $('title').html('Create new travel | Dashboard');
            }

        });

        var Countries = function (search) {
            $.ajax({
                url:"{{ route('travel.countries') }}" ,
                method:"get",
                data:{
                    search : search,
                },
                dataType:"json",
                success:function(result)
                {
                    $('#countries_id').html();
                    if(result.success.length){
                        for (var i = 0; i < result.success.length ; i++){
                            $('#countries_id').append('<option value="'+ result.success[i].id +'">'+ result.success[i].name +'</option>');
                        }
                    }
                }
            });
        };

        var CreateOrEdit = function (x) {
            $.ajax({
                url:"{{route('travel.getdataid')}}" + "/" + x,
                method:"get",
                dataType:"json",
                success:function(result)
                {
                    $('.txt_title').html('Edit now : ' +result.success.name);
                    $('title').html('Edit now : ' +result.success.name + ' | Dashboard');
                    $('#id').val(result.success.id);
                    $('#name').val(result.success.name);
                    $('#description').val(result.success.description);
                    $('#countries_id').val(result.success.countries_id);
                    $('#lat').val(result.success.lat);
                    $('#lng').val(result.success.log);
                    $('#user_id').val(result.success.user_id);
                    $('#button_action').val('edit');
                    $('#cbody').summernote('code',result.success.body);
                    Countries(result.success.countries_id);
                    $('.avatar_view').removeClass('d-none');
                    $('.avatar_view').attr('src', geturlphoto() + result.success.avatar);
                }
            });
        }

    </script>

    <script src="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>
    <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-map.js?key=AGOhffFThjmdsZ8FaBkOAp53iSIBh8R0"></script>
    <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-geocoding.js?key=AGOhffFThjmdsZ8FaBkOAp53iSIBh8R0"></script>
    <script type="text/javascript">
        if (!String.prototype.startsWith) {
            String.prototype.startsWith = function (str) {
                return this.lastIndexOf(str, 0) === 0;
            };
        }

        var mapLayer = MQ.mapLayer();
        var mapLeaflet;

        if($('#button_action').val() == 'edit'){
            var latLng = new L.LatLng($('#lat').val(), $('#lng').val());
        }
        else{
            var latLng = new L.LatLng(31.508029, 34.438325);
        }

        showLL(latLng, '');

        var map = L.map('map', {
            layers: mapLayer,
            center: latLng,
            zoom: 12
        }).on('click', function (e) {
            addMarker(e);
        });

        L.control.layers({
            'Map': mapLayer,
            'Dark': MQ.darkLayer(),
            'Light': MQ.lightLayer(),
            'Satellite': MQ.satelliteLayer()
        }).addTo(map);

        var mapQuestMarker = L.icon({
            iconUrl: MQ.mapConfig.getConfig("imagePath") + 'poi.png',
            iconRetinaUrl: MQ.mapConfig.getConfig("imagePath") + 'poi@2x.png',
            iconSize: [36, 35],
            iconAnchor: [15, 35],
            popupAnchor: [-1, -30]
        });

        var popup = L.marker(latLng, { icon: mapQuestMarker, draggable: true }).addTo(map);

        popup.on('dragend', function (event) {
            var marker = event.target;
            var position = marker.getLatLng().wrap();
            showLL(position, 'USER_DEFINED');
        });

        function roundNumber(num, dec) {
            return Math.round(num * Math.pow(10, dec)) / Math.pow(10, dec);
        }

        function popInfo() {
            street = $('#street').val();
            city = $('#city').val();
            state = $('#state').val();
            postal = $('#zip').val();
            Country = $('#Country').val();

            if (document.getElementById("Country").value == "") {
                Country = "US";
            } else {
                Country = document.getElementById("Country").value;
            }
            simpleGeocode();
        }

        function clearMap() {
            document.getElementById('resultDiv').innerHTML = strResult;
            document.getElementById("street").value = "";
            document.getElementById("city").value = "";
            document.getElementById("state").value = "";
            document.getElementById("zip").value = "";
        }

        function addMarker(e) {
            popup.setLatLng(e.latlng);
            showLL(e.latlng.wrap(), 'USER_DEFINED');
        }

        function simpleGeocode() {
            var geocode = MQ.geocode()
                .search({
                    'street': street,
                    'city': city,
                    'state': state,
                    'postalCode': postal,
                    'adminArea1': Country
                })
                .on('success', function (e) {
                    var best = e.result.best;
                    var latlng = best.latlng;

                    var quality = best.geocodeQualityCode;

                    map.setView(latlng, getZoomFromResultCode(quality));

                    popup.setLatLng(latlng);

                    showLL(latlng, quality);
                });
        }

        function getZoomFromResultCode(resultCode) {
            var zoom = 12;
            if (resultCode.startsWith("P") || resultCode.startsWith("L") || resultCode.startsWith("B")
                || resultCode.startsWith("I")) {
                zoom = 15;
            } else if (resultCode.startsWith("Z") || resultCode.startsWith("A5")) {
                zoom = 12;
            } else if (resultCode.startsWith("A4")) {
                zoom = 9;
            } else if (resultCode.startsWith("A3")) {
                zoom = 5;
            } else if (resultCode.startsWith("A1")) {
                zoom = 2;
            }

            return zoom;
        }

        function showLL(ll, quality) {
            strResult = "<div class='mapTitle'><span class='latitude'>Latitude:</span> " + roundNumber(ll.lat, 6) + "<span class='longitude'>, Longitude:</span> " + roundNumber(ll.lng, 6) + "<span class='quality'>, Quality: </span>" + quality + "</div>";
            document.getElementById('resultDiv').innerHTML = strResult;
            $('#lat').val(roundNumber(ll.lat, 6));
            $('#lng').val(roundNumber(ll.lng, 6));
        }

        function searchKeyPress(e) {
            if (window.event) {
                e = window.event;
            }
            if (e.keyCode == 13) {
                document.getElementById('btnGC').click();
            }
        }
    </script>

@endsection



