
    <link href="<?php echo site_url('application/views/css/daterangepicker-bs3.css'); ?>" rel="stylesheet" />   
    <script src="<?php echo site_url('application/views/js/daterangepicker.js'); ?>"></script>
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
		  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="icon_grid-3x3"></i> Report Transaction Detail</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?php echo site_url()?>">Home</a></li>
						<li><i class="icon_grid-3x3"></i>Report Transaction</li>
						<li>Transaction Detail</li>
					</ol>
				</div>
			</div>
              <!-- page start-->
              <div class="row">
				  
						  
                              <form class="form-horizontal " method="post">
                  <div class="col-lg-12">
					<!--h3 class="box-title" style="margin-top:0;width:30%;">Sort Date
					<br />
					<input name="sort" id="datesort" class="daterange form-control" style="float:left;width:180px;margin-right:5px;" placeholder="Sort Date" />&nbsp;
					<button type="submit" class="btn btn-primary" style="float:left"> <i class="icon_document"></i></button-->
					</h3>
					<br />
					<div style="clear:both"></div>
	<?php echo __get_error_msg(); ?>
                      <section class="panel">
                          <header class="panel-heading">
                              Transaction Detail
                          </header>
                      <section class="panel">
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
          <th>Created By</th>
          <th>Created Date</th>
          <th>Updated By</th>
          <th>Updated Date</th>
          <th>Billing By</th>
          <th>Billing Date</th>
          <th>Updated Billing By</th>
          <th>Updated Billing Date</th>
          
                                </tr>
                              </thead>
                              <tbody>
								  <tr>
									  <td><?php echo __get_email($transaction[0] -> wcreateby);?></td>
									  <td><?php echo __get_date(strtotime($transaction[0] -> wcdate),3);?></td>
									  <td><?php echo __get_email($transaction[0] -> wupdateby);?></td>
									  <td><?php echo __get_date(strtotime($transaction[0] -> wudate),3);?></td>
									  <td><?php echo __get_email($transaction[0] -> bcreateby);?></td>
									  <td><?php echo __get_date(strtotime($transaction[0] -> bcdate),3);?></td>
									  <td><?php echo __get_email($transaction[0] -> bupdateby);?></td>
									  <td><?php echo __get_date(strtotime($transaction[0] -> budate),3);?></td>
								  </tr>
                              </tbody>
								</table>
							</div>
							</section>
							<hr style="border:1px solid #ddd" />
                      <section class="panel">
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
          <th>Date</th>
          <th>Customer Name</th>
          <th>Person</th>
          <th>Menu</th>
          <th>Qty</th>
          <th>Harga</th>
		  <th>Disc</th>
          <th>Total</th>
          <th>Status</th>
          
                                </tr>
                              </thead>
                              <tbody>
		  <?php
$tgl = 0;
$totalqty = 0;
$total = 0;
$total2 = 0;
		  foreach($transaction as $k => $v) :
		  ?>
                                        <tr>
<td>
<?php
$wall=$v -> wqty *($v -> wharga- ($v -> wharga*$v -> wdisc/100));
$date = date('Y-m-d',strtotime($v -> wdate));
if($tgl <> $date){
	$tgl = $date;
	echo __get_date(strtotime($tgl),1);
}
?></td>
          <td><?php echo $v -> wname; ?></td>
          <td><?php echo $v -> person; ?></td>
          <td><?php echo $v -> mname; ?></td>
          <td><?php echo $v -> wqty; ?></td>
          <td><?php echo __get_rupiah($v -> wharga,1); ?></td>
		  <td><?php echo $v -> wdisc; ?>%</td>
			<td><?php echo __get_rupiah($wall,1); ?></td>
			<td><?php echo ($v -> wstatus == 2 ? 'Cancel' : 'Approved'); ?></td>
										</tr>
        <?php
        $total += $v -> wharga * $v -> wqty;
        $total2 += $wall;
        $totalqty += $v -> wqty;
        endforeach; ?>
                              </tbody>
                              <tfoot>
                              <tr><td></td><td></td><td>Total</td><td><?php echo $totalqty; ?></td><td><?php echo __get_rupiah($total,1); ?></td><td></td><td><?php echo __get_rupiah($total2,1); ?></td><td></td></tr>
                              </tfoot>
                            </table>
                          </div>
                      </section>
                  </div>
                  </form>
              </div>

<script type='text/javascript'>//<![CDATA[
$(function(){
	$('#datesort').daterangepicker();
});
</script>
