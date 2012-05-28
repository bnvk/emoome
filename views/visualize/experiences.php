<h1>Visualize : Experiences</h1>

<div id="user_experiences">

<div class="clear"></div>
</div>

<script type="text/javascript" src="<?= $this_module_assets ?>js/raphael.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	$.oauthAjax(
	{
		oauth 		: user_data,
		url			: base_url + 'api/emoome/get_logs_user/id/<?= $this->session->userdata('user_id') ?>',
		type		: 'GET',
		dataType	: 'json',
	  	success		: function(result)
	  	{	
	  		if (result.status == 'success')
	  	  	{
	  	  		result.logs.reverse();
	  	  	
		  		$.each(result.logs, function(key, value)
		  		{
					var action_words = '';
					
		  			for (var link in result.words)
		  			{
		  				if (result.words[link].log_id == value.log_id)
		  				{	  				
		  					action_words += '<a class="related_words" href="' + result.words[link].stem + '">' + result.words[link].word + '</a><br>';
		  				}
					}
		  				  			
		  			var action_data = '<div class="log_column">' + value.action + '<p>' + action_words + '</p> <p>' + mysqlDateParser(value.created_at).date('short') + '</p></div>';
		  			
		  			$('#user_experiences').prepend(action_data);
		  		});	
	  		}											
	  	}		
	});

	$('.related_words').live('click', function(e)
	{
		e.preventDefault();
		//$.get(base_url + 'emoome/dialogs/related_words',function(partial_html)
		//{
		//});		
	});

});
</script>