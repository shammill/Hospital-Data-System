<div class="pull-left form-inline">  
	<h3 id="calendar-month">Month</h3>
	<div class="btn-group">
		<button class="btn btn-primary" data-calendar-nav="prev"><< Prev</button>
		<button class="btn" data-calendar-nav="today">Today</button>
		<button class="btn btn-primary" data-calendar-nav="next">Next >></button>
	</div>
	<div class="btn-group">
		<button class="btn btn-warning" data-calendar-view="year">Year</button>
		<button class="btn btn-warning active" data-calendar-view="month">Month</button>
		<button class="btn btn-warning" data-calendar-view="week">Week</button>
		<button class="btn btn-warning" data-calendar-view="day">Day</button>
	</div>
</div>
<hr style="clear:both;padding:1em;"/>
<div id="calendar"></div>
<script>
$(document).ready(function(){
	var calendar = $("#calendar").calendar({
		tmpl_path: "/calendar/tmpls/",
		events_source: "<?php echo $CAL_events_file; ?>",
		classes: {
			months: {
				general: 'label'
			}
		},  
		onAfterViewLoad: function(view) {
			$('#calendar-month').text(this.getTitle());
			$('.btn-group button').removeClass('active');
			$('button[data-calendar-view="' + view + '"]').addClass('active');
		}		
        
	});    	
	$('.btn-group button[data-calendar-nav]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.navigate($this.data('calendar-nav'));
		});
	});
	$('.btn-group button[data-calendar-view]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.view($this.data('calendar-view'));
		});
	}); 
})
</script>
