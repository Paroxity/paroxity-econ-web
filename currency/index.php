<?php

if(!defined("APP_PATH")){
	define("APP_PATH", dirname(__DIR__) . "/");
}

include APP_PATH . "includes/header.php";

if(!isConnected()){
	_home();

	return;
}

if(!db()->tableExists("currency")){
	_error("'currency' table not found in the database. Please first run the plugin and then use this site.");
	_disconnect(false);
	_home();

	return;
}

if(isset($_POST["edit_currency"])){
    if(!db()->editCurrency($_POST)){
	    _error("Unable to edit the currency.");
	    _disconnect(false);
	    _home();
    }else{
        _success("Currency edited successfully!");

        ?>

        <script>
            clear_currency_modal();
        </script>

        <?php

	    unset($_POST);
	    _go("currency");
    }

	return;
}

?>

<div id="content">
    <div id="scrollableContent">
        <div id="paddingContent">
            <div class="container">
                <div class="card" id="TableSorterCard" style="border-style: none;background-color: transparent;">
                    <div class="card-header py-3">
                        <div class="row table-topper align-items-center">
                            <div class="col-12 col-sm-5 col-md-6 text-left" style="margin: 0px;padding: 5px 15px;padding-right: 0px;padding-left: 0px;">
                                <h3 class="text-left content-title" style="color: rgb(195, 7, 63);">Currencies</h3>
                            </div>
                            <div class="col-12 col-sm-7 col-md-6 text-right" style="padding-right: 0px;padding-left: 0px;">
                                <button class="btn btn-primary btn-sm" id="add-currency-btn" type="button" style="margin: 2px;" data-toggle="modal" data-target="#currency-modal" onclick="add_currency_btn();">Add Currency</button>
                                <button class="btn btn-warning btn-sm" id="zoom_in" type="button" zoomclick="ChangeZoomLevel(-10);" style="margin: 2px;"><i class="fa fa-search-plus"></i></button>
                                <button class="btn btn-warning btn-sm" id="zoom_out" type="button" zoomclick="ChangeZoomLevel(-10);" style="margin: 2px;"><i class="fa fa-search-minus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table tablesorter" id="ipi-table">
                        <thead id="table-style">
                        <tr>
                            <th class="text-center filter-false sorter-false" id="ipi-table-cell">ID</th>
                            <th class="text-center" id="ipi-table-cell" style="font-family: Blinker, sans-serif;">Name</th>
                            <th class="text-center filter-false sorter-false" id="ipi-table-cell" style="font-family: Blinker, sans-serif;">Symbol</th>
                            <th class="text-center filter-false sorter-false" id="ipi-table-cell" style="font-family: Blinker, sans-serif;">Symbol<br>Position</th>
                            <th class="text-center filter-false" id="ipi-table-cell" style="font-family: Blinker, sans-serif;">Starting<br>Amount</th>
                            <th class="text-center filter-false" id="ipi-table-cell" style="font-family: Blinker, sans-serif;">Maximum<br>Amount</th>
                            <th class="text-center filter-false sorter-false" id="ipi-table-cell" style="font-family: Blinker, sans-serif;">Action</th>
                        </tr>
                        </thead>
                        <tbody class="text-center table-body" id="table-style">

						<?php
						foreach(db()->getCurrencies() as $currency):
							echo "<tr>";
							echo "<td>" . $currency["id"] . "</td>";
							echo "<td>" . $currency["name"] . "</td>";
							echo "<td>" . $currency["symbol"] . "</td>";
							echo "<td>" . $currency["symbol_position"] . "</td>";
							echo "<td>" . $currency["starting_amount"] . "</td>";
							echo "<td>" . $currency["maximum_amount"] . "</td>";
							echo "<td class='text-center'>";
							?>

                            <button class="btn btn-success action-btn-edit" type="button" data-toggle="modal" data-target="#currency-modal" name="edit" value="<?php echo $currency["id"]; ?>" onclick="edit_or_delete_btn(this, <?php echo htmlentities(json_encode($currency)); ?>);"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-danger" type="button" style="margin: 2px;" data-target="#delete-confirm-modal" data-toggle="modal" name="delete" value="<?php echo $currency["id"]; ?>" onclick="edit_or_delete_btn(this, <?php echo htmlentities(json_encode($currency)); ?>);"><i class="fas fa-trash"></i></button>

							<?php
							echo "</td></tr>";
						endforeach;
						?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="custom-modal" class="custom-modal">
    <div class="modal fade" role="dialog" tabindex="-1" id="delete-confirm-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-color: #1A1A1D;">
                <div class="modal-header" style="background: #1a1a1d;border-color: #ffffff;">
                    <h4 class="modal-title" style="color: rgb(255,255,255);">Confirm Currency Delete</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body border-0" style="background: #1a1a1d;">
                    <p style="color: rgb(255,255,255);">Are you sure you want to delete this currency?&nbsp;<br>Deleting the currency will also delete any references to this currency as well.<br><br><strong>WARNING:</strong>&nbsp;This action is irreversible!</p>
                </div>
                <div class="modal-footer" style="background: #1a1a1d;">
                    <a class="btn btn-light" role="button" id="currency-delete-confirm-btn" data-dismiss="modal" href="#" name="currency-delete-confirm">Confirm</a>
                    <button class="btn btn-warning" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div role="dialog" tabindex="-1" class="modal fade" id="currency-modal">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content" style="background-color: #1A1A1D;">
                <div class="modal-header" style="background: #1a1a1d;border-color: #ffffff;">
                    <h4 class="modal-title" id="currency-modal-title" style="color: rgb(255,255,255);">_ Currency</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body border-0" style="background: #1a1a1d;">
                    <form method="POST" name="add-currency" action="index.php">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="text-dark input-group-text"><i class="fa fa-sitemap fa-fw"></i></span></div>
                                <input type="text" class="form-control" id="currency-modal-id" placeholder="ID" required name="id"/>
                                <div class="input-group-append"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="text-dark input-group-text"><i class="fas fa-user fa-fw"></i></span></div>
                                <input type="text" class="form-control" id="currency-modal-name" placeholder="Name" required name="name"/>
                                <div class="input-group-append"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="text-dark input-group-text"><i class="fas fa-user fa-fw"></i></span></div>
                                <input type="text" class="form-control" id="currency-modal-symbol" placeholder="Symbol" required name="symbol"/>
                                <div class="input-group-append"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="text-dark input-group-text"><i class="fas fa-user fa-fw"></i></span></div>
                                <input type="text" class="form-control" id="currency-modal-st-amt" placeholder="Starting amount" required name="starting_amount" inputmode="numeric"/>
                                <div class="input-group-append"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="text-dark input-group-text"><i class="fas fa-database fa-fw"></i></span></div>
                                <input type="text" class="form-control" id="currency-modal-max-amt" placeholder="Maximum amount" required name="maximum_amount" inputmode="numeric"/>
                                <div class="input-group-append"></div>
                            </div>
                        </div>
                        <div class="form-group"><select class="custom-select" id="currency-modal-symbol-pos" name="symbol_position" required>
                                <option value="start" selected>Start - Before currency</option>
                                <option value="end">End - After currency</option>
                            </select></div>
                        <hr style="background: var(--light);"/>
                        <div class="form-group text-right">
                            <button class="btn btn-outline-dark btn-lg text-white" style="width: 100%;" type="submit" id="currency-modal-submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include APP_PATH . "includes/footer.php"; ?>
