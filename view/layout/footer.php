<div id="delete_modal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<div class="icon-box">
					<i class="fa fa-times" aria-hidden="true"></i>
				</div>				
				<h4 class="modal-title">Are you sure?</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancel</button>
				<a href="#" class="delete_url"> <button type="button" class="btn btn-sm btn-danger">Delete</button></a>
			</div>
		</div>
	</div>
</div> 


<script src="//<?=ASSET ?>js/bootstrap.min.js"></script>
<script src="//<?=ASSET ?>js/bootstrap-multiselect.js"></script>
<script src="//<?=ASSET ?>js/jquery-ui.min.js"></script>
<script src="//<?=ASSET ?>js/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
<script src="//<?=ASSET ?>js/custom.validate.js"></script>
<script src="//<?=ASSET ?>js/Chart.js"></script>
<script src="//<?=ASSET ?>js/custom.js"></script>


<!--  <?php
		
foreach (get_included_files() as $key => $value) {

	if(strpos($value, 'vendor') || strpos($value, 'app/') || strpos($value, 'config/')) continue;
	$value2 = explode('/', $value);
	if(strpos($value, 'view/')){
		$value3 = explode('view/', $value);
		//print_r($value3);
	 echo '
	
	views: '.end($value3).'
	';
	}
	if(strpos($value, 'controller/')){
	 echo 'controller: '.end($value2).'
	
	';
	$cntrlr = explode('.', end($value2));}
	if(strpos($value, 'model/'))
	 echo 'model: '.end($value2).'
	';
}


		?>  -->
<script type="text/javascript">
	$('body').addClass('<?=strtolower($cntrlr[0]) ?>');
</script>

</body>

</html>

