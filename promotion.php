<?php
require_once 'php_action/db_connect.php';
require_once 'includes/header.php';
?>


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
			<li><a href="dashboard.php">Home</a></li>
			<li class="active">Promotion</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Promotion</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

			<div class="success-messages"></div> <!--/success-messages-->

				<form class="form-horizontal" id="createPromotionPackage" action="php_action/createPromotion.php" method="POST">
					<div class="form-group">
						<label for="budgetPromotion" class="col-sm-2 control-label">Budget: </label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="budgetPromotion" name="budgetPromotion" placeholder="Budget Amount" autocomplete="off" />
						</div>
					</div>
					<div class="form-group">
						<label for="SortPromotion" class="col-sm-2 control-label">Sort By: </label>
						<div class="col-sm-5">
							<select class="form-control" id="sortPromotion" name="sortPromotion">
								<option value="">~~SELECT~~</option>
								<option value="1">Product</option>
								<option value="2">Total Sale</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-primary" id="createPromotionBtn" data-loading-text="Loading..." autocomplete="off"> Create Promotion Package</button>
						</div>
					</div>
				</form>
				<!-- /get budget and sorting -->

				
				
				<table class="table" id="managePromotionTable">
					<thead>
						<tr>
							<th style="width:8%;">#</th>
							<th>Total Price</th>
							<th>List of Products</th>
							<th style="width:15%;">Status</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->
			</div>
			<!-- /panel-body -->
		</div> <!-- /panel -->
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->


<!-- edit promotion -->
<div class="modal fade" id="editPromotionModel" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<form class="form-horizontal" id="editPromotionForm" action="php_action/editPromotion.php" method="POST">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-edit"></i> Edit promotion</h4>
				</div>
				<div class="modal-body">

					<div id="edit-promotion-messages"></div>

					<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

					<div class="edit-promotion-result">
						<div class="form-group">
							<label for="editPromotionName" class="col-sm-3 control-label">promotion Name: </label>
							<label class="col-sm-1 control-label">: </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="editPromotionName" placeholder="promotion Name" name="editPromotionName" autocomplete="off">
							</div>
						</div> <!-- /form-group-->
						<div class="form-group">
							<label for="editPromotionStatus" class="col-sm-3 control-label">Status: </label>
							<label class="col-sm-1 control-label">: </label>
							<div class="col-sm-8">
								<select class="form-control" id="editPromotionStatus" name="editPromotionStatus">
									<option value="">~~SELECT~~</option>
									<option value="1">Available</option>
									<option value="2">Not Available</option>
								</select>
							</div>
						</div> <!-- /form-group-->
					</div>
					<!-- /edit promotion result -->

				</div> <!-- /modal-body -->

				<div class="modal-footer editPromotionFooter">
					<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>

					<button type="submit" class="btn btn-success" id="editPromotionBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
				</div>
				<!-- /modal-footer -->
			</form>
			<!-- /.form -->
		</div>
		<!-- /modal-content -->
	</div>
	<!-- /modal-dailog -->
</div>
<!-- /edit promotion -->


<!-- remove promotion -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove promotion</h4>
			</div>
			<div class="modal-body">
				<p>Do you really want to remove ?</p>
			</div>
			<div class="modal-footer removePromotionFooter">
				<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
				<button type="button" class="btn btn-primary" id="removePromotionBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove promotion -->


<script src="custom/js/promotions.js"></script>
<?php require_once 'includes/footer.php'; ?>