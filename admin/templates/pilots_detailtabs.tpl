<div id="wrapper">
<h3><?php echo $pilotinfo->firstname . ' ' . $pilotinfo->lastname; ?></h3>
<div id="dialogresult"></div>
<div id="tabcontainer" style="float: left; width: 100%">
	<ul>
		<li><a href="#pilotdetails"><span>Pilot Details</span></a></li>
		<li><a href="#pilotgroups" id="pilotgroupslink"><span>Pilot Groups</span></a></li>
		<li><a href="#awards"><span>Pilot Awards</span></a></li>
		<li><a href="#pireps"><span>View PIREPs</span></a></li>
		<li><a href="#resetpass"><span>Pilot Options</span></a></li>
	</ul>
	<br />
	<div id="pilotdetails">
		<?php Template::Show('pilots_details.tpl'); ?>
	</div>
	<div id="pilotgroups">
		<?php 
		?>
	</div>
	<div id="awards">
	<?php Template::Show('pilots_awards.tpl'); 
		  Template::Show('pilots_addawards.tpl');
	?>
	</div>
	<div id="pireps">
		<?php Template::Show('pireps_list.tpl'); ?>
	</div>
	<div id="resetpass">
		<?php Template::Show('pilots_options.tpl'); ?>
	</div>
</div>
</div>

<script type="text/javascript">
$("#tabcontainer").tabs();
$("#pilotgroupslink").bind('click', function(e) {
    $.get("<?php echo adminaction('/pilotadmin/pilotgrouptab/'.$pilotinfo->pilotid);?>", function(d){
        $("#pilotgroups").html(d);
    })    
})
</script>