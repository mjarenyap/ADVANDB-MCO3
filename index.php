<!DOCTYPE html>
<html>
    <head>
        <title>Machine Project 3</title>
        <link href="css/main-dashboard.css" rel="stylesheet" type="text/css" />
        <link href="css/buttons.css" rel="stylesheet" type="text/css" />
        <link href="css/table.css" rel="stylesheet" type="text/css" />
        <link href="css/modal.css" rel="stylesheet" type="text/css" />
        <link href="css/status-tips.css" rel="stylesheet" type="text/css" />
        <link href="css/create-page.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="js/sidebar-nav.js" type="text/javascript"></script>
        <script src="js/modal.js" type="text/javascript"></script>
        <script src="js/data-table.js" type="text/javascript"></script>

        <?php include 'service/fetcher.php' ?>
    </head>
    <body>
        <!-- Modal Feature -->
        <section id="modal-overlay">
            <img src="icons/close.svg" class="close" />
            <div class="modal-box" id="confirm-box">
                <div class="prompt">
                    <h4>Are you sure you want to delete the selected data?</h4>
                    <p>NOTE: This action cannot be undone</p>
                </div>
                <div class="button-flex-wrapper">
                    <button class="plain-text grey cancel">Deselect all</button>
                    <button class="plain-text confirm">Confirm</button>
                </div>
            </div>
            
            <div class="modal-box" id="info-box">
                <h3>Data information</h3>
                <p>
                    <b>Country code: </b>
                    <span id="info-countryCode">PHI</span>
                </p>
                <p>
                    <b>Series code: </b>
                    <span id="info-seriesCode">EMP.ML.SEN.ASD</span>
                </p>
                <p>
                    <b>Year: </b>
                    <span id="info-year">2010</span>
                </p>
                <p>
                    <b>Data: </b>
                    <span id="info-data">4.9</span>
                </p>
                <input type="hidden" id="info-id"/>
                <div class="button-flex-wrapper">
                    <button class="plain-text grey cancel">Cancel</button>
                    <button class="plain-text form-trigger">Edit</button>
                </div>
            </div>
            
            <section id="adding-section">
                <div class="content-wrapper">
                    <h3 id="form-heading">Add a new data</h3>
                    <form id="add-form" onsubmit="return false;">
                        <!-- dropdown for the country -->
                        <div>
                            <p>Country name</p>
                            <select id="form-country" name="country">
                                <?php populateCountryDropdown(); ?>
                            </select>
                        </div>

                        <!-- dropdown for the series name -->
                        <div>
                            <p>Series Name</p>
                            <select id="form-series" name="series">
                                <?php populateSeriesDropdown(); ?>
                            </select>
                        </div>

                        <!-- dropdown for the year -->
                        <div>
                            <p>Year</p>
                            <select id="form-year" name="year">
                                <?php populateYearDropdown(); ?>
                            </select>
                        </div>

                        <!-- input number for the data -->
                        <div>
                            <p>Data</p>
                            <input type="number" step="0.01" placeholder="type your data here..." id="form-data" name="data"/>
                        </div>
                        
                        <!-- hidden input for the id -->
                        <input type="hidden" id="form-id" name="id" />

                        <!-- hidden input for the query type -->
                        <input type="hidden" id="form-type" name="type" />

                        <input type="button" value="SUBMIT" id="data-submit" />
                    </form>
                    <button class="plain-text grey" id="discard">discard & go back</button>
                </div>
            </section>
        </section>
        
        
        
        <!-- This is the sidebar nav containing the regions -->
        <nav>
            <div id="machine-identity">
                <center>
                    <img src="icons/collaboration.svg" />
                </center>
                <h4>Machine Project 3</h4>
                <p class="node">Node 1 Machine</p>
            </div>
            <h5 class="group-title">Regions</h5>
            <!-- TODO fetch the list of regions from the database -->
            <ul>
                <?php populateRegionList(); ?>
            </ul>
        </nav>
        
        
        
        <!-- This is the main dashboard -->
        <section id="main-dashboard">
            <header>
                <div>
                    <h4>Distributed Database Management System</h4>
                </div>
                <div>
                    <button class="form-trigger">
                        <img src="icons/plus-button-blue.svg" />
                        new data
                    </button>
                </div>
            </header>
            
            <!-- status banners -->
            <!--
            <section class="status-tip success">Save successful!</section>
            <section class="status-tip error">Failed to save changes.</section>
            <section class="status-tip in-progress">Updating...</section>
            -->
            
            <section class="content-wrapper">
                <div class="flex-wrapper">
                    <div class="main">
                        <div class="content-wrapper">
                            <div class="flex-wrapper">
                                <h4>Active Data Table</h4>
                                <div id="data-options">
                                    <button class="plain-text grey" id="select-cancel">Cancel</button>
                                    <button class="plain-text red" id="delete-data">
                                        <img src="icons/remove.svg" />
                                        Delete
                                    </button>
                                </div>
                            </div>
                            
                            <!--
                            Attributes:

                            id
                            country-code
                            series-code
                            year
                            data
                            -->
                            <table class="data-table" id="main-table">
                                <tr class="headers">
                                    <th><input type="checkbox" id="select-all" /></th>
                                    <th>Country Code</th>
                                    <th>Series Code</th>
                                    <th>Year</th>
                                    <th>Data</th>
                                </tr>
                                <!-- TODO replace this DUMMY DATA with actual data -->
                                <?php
                                foreach($_GET as $key => $value) {
                                    if ($key == "region") {
                                        $region = $value;
                                        break;
                                    }
                                }
                                if (isset($region)) {
                                    populateDataTableFilterRegion($region);
                                }
                                else {
                                    populateDataTable();
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                    <!--
                    <div class="sidebar">
                        <div class="content-wrapper">
                            <h4>Recent Activity</h4>
                        </div>
                        <br/>
                        <div class="content-wrapper">
                            <h4>Action Log</h4>
                        </div>
                    </div>
                    -->
                </div>
            </section>
        </section>
    </body>
</html>