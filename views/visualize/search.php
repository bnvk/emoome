<h2>How Do I Feel Between</h2>

<?= form_dropdown('start_time', range(1, 24), date('h'), 'id="start_time"') ?>
<?= form_dropdown('start_meridian', array('AM' => 'AM', 'PM' => 'PM')) ?>
&nbsp; to &nbsp;
<?= form_dropdown('end_time', range(1, 24), date('h') + 2, 'id="end_time"') ?>
<?= form_dropdown('end_meridian', array('AM' => 'AM', 'PM' => 'PM')) ?>
<button name="search" id="search">Search</button>

<script type="text/javascript">
$(document).ready(function()
{

	$('#search').bind('click', function(e)
	{
		var start_time	= $('#start_time').find('option:selected').html();
		var end_time	= $('#end_time').find('option:selected').html();
			
		$.oauthAjax(
		{
			oauth 		: user_data,		
			url			: base_url + 'api/emoome/get_emotions_range/range/time/start/' + start_time + '/end/' + end_time,
			type		: 'GET',
			dataType	: 'json',
		  	success		: function(result)
		  	{							  	
				console.log(result);							
		  	}		
		});

	});	

});
</script>