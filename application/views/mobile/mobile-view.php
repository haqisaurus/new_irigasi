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
    <script id="mobile-datepicker" src="http://cdn.rawgit.com/arschmitz/jquery-mobile-datepicker-wrapper/v0.1.1/jquery.mobile.datepicker.js"></script>
    <!-- backbone template -->
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
                    </tr>
                </thead>
                <tbody>
                    <%
                    _.each(data, function(val, key) {
                        
                        %>
                            <tr>
                                <th><%= ( key + 1) %></th>
                                <td><%= val.date %></td>
                                <td><%= val.right %> <sub>lt/det</sub>
                                </td>
                                <td><%= val.left %> <sub>lt/det</sub>
                                </td>
                                <td><%= val.limpas %> <sub>lt/det</sub>
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
                <input id="date" type="text" data-role="date" data-inline="true" data-date-format="yy-mm-dd">
            </div>
            <div class="ui-field-contain">
                <label for="right">Debit Kanan</label>
                <input type="number" step="0.01" name="right" id="right">
            </div>
            <div class="ui-field-contain">
                <label for="left">Debit Kiri</label>
                <input type="number" step="0.01" name="left" id="left">
            </div>
            <div class="ui-field-contain">
                <label for="limpas">Limpas</label>
                <input type="number" step="0.01" name="limpas" id="limpas">
            </div>
            <a class="ui-btn ui-icon-plus ui-btn-icon-left" id="btn-save">Simpan</a>
        </div>
    </script>
    <script type="text/template" id="home">
        <div data-role="header" data-position="fixed" data-theme="b">
            <h3>Juru</h3>
        </div>
        <div role="main" class="ui-content">
            <h1 is="gk-text" style="text-align: center; margin-top: 100px;">Menu Juru</h1>
            <a class="ui-btn ui-btn-icon-left ui-icon-plus" href="#add-water">Input Data</a>
            <a class="ui-btn ui-icon-search ui-btn-icon-left" href="#list-water">Cari</a>
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
    <div data-role="dialog" id="popupDialog">
            <div role="main" class="ui-content" style="text-align: center;">
                    <h3 class="ui-title">Akun yang anda masukan tidak terdaftar!!!</h3>
                    <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" id="close-dialog" data-rel="back">OK</a>
            </div>
    </div>

    
</body>

</html>
