<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>OP Irigasi</title>

    <!-- JQuery Mobile -->
    <link href="<?php echo base_url('assets/mobile/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/mobile/jquery.mobile-1.4.5/jquery.mobile.theme-1.4.5.min.css'); ?>" rel="stylesheet">
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  
    <link rel="stylesheet" href="http://cdn.rawgit.com/arschmitz/jquery-mobile-datepicker-wrapper/v0.1.1/jquery.mobile.datepicker.css">
    <!-- jQuery -->
    <script src="<?php echo base_url('assets/integrated/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
    <script>
        $(document).bind("mobileinit", function () {
            $.mobile.ajaxEnabled = false;
            $.mobile.linkBindingEnabled = false;
            $.mobile.hashListeningEnabled = false;
            $.mobile.pushStateEnabled = false;
            // Remove page from DOM when it's being replaced
            $('div[data-role="page"]').on('pagehide', function (event, ui) {
                $(event.currentTarget).remove();
            });
        });
    </script>
    <script src="<?php echo base_url('assets/mobile/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js'); ?>"></script>
    <script src="http://cdn.rawgit.com/jquery/jquery-ui/1.10.4/ui/jquery.ui.datepicker.js"></script>
    <!-- l<script id="mobile-datepicker" src="http://cdn.rawgit.com/arschmitz/jquery-mobile-datepicker-wrapper/v0.1.1/jquery.mobile.datepicker.js"></script> -->
    <!-- backbone template -->
    <script type="text/template" id="edit">
        <div data-role="header" data-position="fixed" data-theme="b">
            <h3>Input Debit</h3>
            <a class="ui-btn ui-btn-left ui-btn-icon-left ui-icon-carat-l back" href="#home" data-rel="back">Back</a>
        </div>
        <div role="main" class="ui-content" is="content">
            <div class="ui-field-contain">
                    
                <label for="region-id">Daerah Irigasi</label>
                <select id="region-id">
                <%
                    _.each(data.regions, function(region, key) {
                        %>
                        <option value="<%= region.id %>"><%= region.region_name %></option>
                        <%
                    }); 
                %>
                </select>
            </div>
            <div class="ui-field-contain">
                <label for="date">Tanggal</label>
                <input id="date" type="text" data-role="date" data-inline="true" data-date-format="yy-mm-dd" value="<%= data.water[0].date %>">
            </div>
            <div class="ui-field-contain">
                <label for="right">Debit Kanan</label>
                <input type="number" step="0.01" name="right" id="right" value="<%= data.water[0].right %>">
            </div>
            <div class="ui-field-contain">
                <label for="left">Debit Kiri</label>
                <input type="number" step="0.01" name="left" id="left" value="<%= data.water[0].left %>">
            </div>
            <div class="ui-field-contain">
                <label for="limpas">Limpas</label>
                <input type="number" step="0.01" name="limpas" id="limpas" value="<%= data.water[0].limpas %>">
            </div>
            <input type="hidden" name="id" id="id" value="<%= data.water[0].id %>">
            <a class="ui-btn ui-icon-plus ui-btn-icon-left" id="btn-update">Update</a>
        </div>
    </script>
    <script type="text/template" id="search">
        <div data-role="header" data-position="fixed" data-theme="b">
            <h3>Cari</h3>
            <a class="ui-btn ui-btn-left ui-icon-carat-l ui-btn-icon-left back" href="#list-water" data-rel="back">Back</a>
        </div>
        <div role="main" class="ui-content" is="content">
            <h1 is="gk-text">Cari Data</h1>
            <hr>
            <select id="region">
                <%
                    _.each(regions, function(val, key) {
                        %>
                        <option value="<%= val.id %>"><%= val.region_name %></option>
                        <%
                    }); 
                %>
            </select>
            <div class="ui-grid-a" style="height:95px">
                <div class="ui-block-a" style="height:100%">
                    <select id="year">
                        <%
                            _.each(years, function(val, key) {
                                %>
                                <option value="<%= val.tahun %>"><%= val.tahun %></option>
                                <%
                            }); 
                        %>
                    </select>
                </div>
                <div class="ui-block-b" style="height:100%">
                    <select id="month">
                        <%
                            _.each(months, function(val, key) {
                                %>
                                <option value="<%= key %>"><%= val %></option>
                                <%
                            }); 
                        %>
                    </select>
                </div>
            </div>
            <a class="ui-btn ui-icon-search ui-btn-icon-left" id="search-button">Cari</a>
        </div>
    </script>
    <script type="text/template" id="list">
        <div data-role="header" data-position="fixed" data-theme="b">
            <h3>Data Debit</h3>
            <a class="ui-btn ui-btn-left ui-btn-icon-left ui-icon-carat-l back" href="#home" data-rel="back">Back</a>
            <a class="ui-btn ui-btn-right ui-icon-search ui-btn-icon-right" href="#search-water">Cari</a>
        </div>
        <div role="main" class="ui-content" is="content">
            <h1 is="gk-text" style="text-align:center;">Data <%= date %></h1>
            
            <table data-role="table" data-mode="reflow" class="ui-responsive ui-shadow gk-decorate table-stroke table-stripe" id="gk-1219wOmS" is="jqm-table">
                <thead>
                    <tr>
                        <th data-priority="1">No</th>
                        <th data-priority="1">Tanggal</th>
                        <th data-priority="1">Kanan</th>
                        <th data-priority="1">Kiri</th>
                        <th data-priority="1">Limpas</th>
                        <th data-priority="1"></th>
                        
                    </tr>
                </thead>
                <tbody>
                    <%
                    _.each(data, function(val, key) {
                        
                        %>
                            <tr>
                                <th><%= ( key + 1) %></th>
                                <td><%= val.date %></td>
                                <td>
                                    <%= val.right %> <sub>lt/det</sub>
                                </td>
                                <td>
                                    <%= val.left %> <sub>lt/det</sub>
                                </td>
                                <td>
                                    <%= val.limpas %> <sub>lt/det</sub>
                                </td>
                                <td>
                                    <a href="#delete-water/<%= val.id %>" data-role="button" data-mini="true" data-icon="delete" data-theme="b" data-inline="true">Delete</a>
                                    <a href="#edit-water/<%= val.id %>" data-role="button" data-mini="true" data-icon="info" data-inline="true">&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>
                                </td>
                            </tr>
                        <%
                    })
                    %>
                </tbody>
            </table>
            <br>
        </div>
    </script>
    <script type="text/template" id="create">
        <div data-role="header" data-position="fixed" data-theme="b">
            <h3>Input Debit</h3>
            <a class="ui-btn ui-btn-left ui-btn-icon-left ui-icon-carat-l back" href="#home" data-rel="back">Back</a>
        </div>
        <div role="main" class="ui-content" is="content">
            <div class="ui-field-contain">
                    
                <label for="region-id">Daerah Irigasi</label>
                <select id="region-id">
                <%
                    _.each(data, function(val, key) {
                        %>
                        <option value="<%= val.id %>"><%= val.region_name %></option>
                        <%
                    }); 
                %>
                </select>
            </div>
            <div class="ui-field-contain">
                <label for="date">Tanggal</label>
                <input id="date" type="text" data-role="date" data-inline="true" data-date-format="yy-mm-dd" value="<?php echo date('Y-m-d') ?>">
            </div>
            <div class="ui-field-contain">
                <label for="right">Debit Kanan</label>
                <input type="number" step="0.01" name="right" id="right" value="0">
            </div>
            <div class="ui-field-contain">
                <label for="left">Debit Kiri</label>
                <input type="number" step="0.01" name="left" id="left" value="0">
            </div>
            <div class="ui-field-contain">
                <label for="limpas">Limpas</label>
                <input type="number" step="0.01" name="limpas" id="limpas"  value="0">
            </div>
            <a class="ui-btn ui-icon-plus ui-btn-icon-left" id="btn-save">Simpan</a>
        </div>
    </script>
    <script type="text/template" id="home">
        <div data-role="header" data-position="fixed" data-theme="b">
            <h3>Juru</h3>
            <a class="ui-btn ui-btn-right ui-icon-delete ui-btn-icon-right" href="<?php echo site_url('logout') ?>">Logout</a>
            
        </div>
        <div role="main" class="ui-content">
            <h1 is="gk-text" style="text-align: center; margin-top: 100px;">Menu Juru</h1>
            <a class="ui-btn ui-btn-icon-left ui-icon-plus" href="#add-water">Input Data Debit</a>
            <a class="ui-btn ui-icon-search ui-btn-icon-left" href="#list-water">Cari Data Debit</a>
            <br>
            <a class="ui-btn ui-btn-icon-left ui-icon-plus" href="#allocation" >Alokasi Air</a>
            <a class="ui-btn ui-icon-search ui-btn-icon-left" href="#list-allocation">Daftar Alokasi</a>
        </div>
    </script>
    <script type="text/template" id="allocation">
        <div data-role="header" data-position="fixed" data-theme="b">
            <h3>Input Debit</h3>
            <a class="ui-btn ui-btn-left ui-btn-icon-left ui-icon-carat-l back" href="#home" data-rel="back">Back</a>
        </div>
        <div role="main" class="ui-content" is="content">
            <div class="ui-field-contain">
                <label for="periode">Periode</label>
                <select id="periode" name="periode">
                <%
                    var today = new Date();
                    if(today.getDate() < 16) {
                        var now = ((today.getMonth() + 1) * 2) - 1;
                    } else {
                        var now = ((today.getMonth() + 1) * 2);
                    }

                    _.each(data.months, function(val, key) {
                        var selected = (key+1 == now) ? 'selected' : '';
                        %>
                        <option <%= selected %> value="<%= key %>"><%= val %></option>
                        <%
                    }); 
                %>
                </select>
            </div>
            <div class="ui-field-contain">
                    
                <label for="region-id">Daerah Irigasi</label>
                <select id="region-id" name="region-id">
                <%
                    _.each(data.regions, function(val, key) {
                        %>
                        <option value="<%= val.id %>"><%= val.region_name %></option>
                        <%
                    }); 
                %>
                </select>
            </div>
            <div class="ui-field-contain">
                <label for="growth">Padi Fase Pertumbuhan</label>
                <input type="number" step="0.01" name="growth" id="growth" value="0">
            </div>
            <div class="ui-field-contain">
                <label for="mature">Padi Fase Pemasakan</label>
                <input type="number" step="0.01" name="mature" id="mature" value="0">
            </div>
            <div class="ui-field-contain">
                <label for="haravest">Padi Fase Panen</label>
                <input type="number" step="0.01" name="harvest" id="harvest"  value="0">
            </div>
            <div class="ui-field-contain">
                <label for="palawija">Palawija</label>
                <input type="number" step="0.01" name="palawija" id="palawija"  value="0">
            </div>
            <div class="ui-field-contain">
                <label for="sugar">Tebu</label>
                <input type="number" step="0.01" name="sugar" id="sugar"  value="0">
            </div>
            <div class="ui-field-contain">
                <label for="bero">Bero</label>
                <input type="number" step="0.01" name="bero" id="bero"  value="0">
            </div>
            <input type="hidden" id="total-wide" value="<%= data.totalWide %>">
            <a class="ui-btn ui-icon-plus ui-btn-icon-left" id="btn-save">Simpan</a>
        </div>
    </script>
    <script type="text/template" id="allocation-result">
        <div data-role="header" data-position="fixed" data-theme="b">
            <h3>Daerah Alokasi</h3>
            <a class="ui-btn ui-btn-left ui-btn-icon-left ui-icon-carat-l back" href="#home" data-rel="back">Back</a>
        </div>
        <div role="main" class="ui-content" is="content">
            <h1 is="gk-text" style="text-align:center;">Alokasi Air <%= date %></h1>
            
        </div>
    </script>
    <script type="text/template" id="list-allocation">
        <div data-role="header" data-position="fixed" data-theme="b">
            <h3>Daerah Alokasi</h3>
            <a class="ui-btn ui-btn-left ui-btn-icon-left ui-icon-carat-l back" href="#home" data-rel="back">Back</a>
        </div>
        <div role="main" class="ui-content" is="content">
            
              
            <ul data-role="listview">
                <%
                _.each(data, function(val, key) {
                    
                    %>
                         
                        <li>
                            <a href="#allocation-region/<%= val.id %>"  data-theme="b" data-inline="true"><%= val.region_name %></a>
                            
                        </li>
                    <%
                })
                %>
            </ul>
            <br>
        </div>
    </script>
    <script type="text/template" id="allocation-region">
        <div data-role="header" data-position="fixed" data-theme="b">
            <h3>Data Periode Alokasi</h3>
            <a class="ui-btn ui-btn-left ui-btn-icon-left ui-icon-carat-l back" href="#list-allocation" data-rel="back">Back</a>
        </div>
        <div role="main" class="ui-content" is="content">
            
              
            <ul data-role="listview">
                <%
                var months = ['Januari 1', 
                        'Januari 2', 
                        'Februari 1', 
                        'Februari 2', 
                        'Maret 1', 
                        'Maret 2', 
                        'April 1', 
                        'April 2', 
                        'Mei 1', 
                        'Mei 2', 
                        'Juni 1',
                        'Juni 2',
                        'Juli 1',
                        'Juli 2',
                        'Agustus 1',
                        'Agustus 2',
                        'September 1',
                        'September 2',
                        'Oktober 1',
                        'Oktober 2',
                        'November 1',
                        'November 2',
                        'Desember 1',
                        'Desember 2'
                        ];

                _.each(data, function(val, key) {
                    
                    %>
                         
                        <li>
                            <button data-id="<%= val.id %>"  data-theme="b" data-inline="true">Periode <%= months[val.periode] %></button>
                            
                        </li>
                    <%
                })
                %>
            </ul>
            <br>
        </div>
    </script>
    <!-- My custom engine -->
    <script src="<?php echo base_url('assets/mobile/underscore-min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/mobile/backbone-min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/mobile/juru.js'); ?>"></script>

</head>

<body>
    <input type="hidden" id="site-url" value="<?php echo site_url(); ?>">
    <div id="content"></div>
    <!-- popup dialog -->
    <div data-role="dialog" id="popupDialog" class="hidden" style="position: relative: width: 100%; height: 100%; display: none;">
        <div style="position: relative: width: 100%; height: 100%;">
            <img src="http://www.arabianbusiness.com/skins/ab.main/gfx/loading_spinner.gif" alt="loader" style="position: absolute; top: 0; right:0; bottom: 0; left: 0: margin: auto; width: 20px; height: 20px;">    
        </div>
            <!-- <div role="main" class="ui-content" style="text-align: center;">
                    <h3 class="ui-title">Akun yang anda masukan tidak terdaftar!!!</h3>
                    <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" id="close-dialog" data-rel="back">OK</a>
            </div> -->
    </div>

    
</body>

</html>
