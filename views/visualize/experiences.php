<h1>Experiences : <?= $this->session->userdata('name') ?></h1>

<div id="user_experiences">

<div class="clear"></div>
</div>

<script type="text/javascript" src="<?= $site_assets ?>js/raphael.js"></script>
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
			$('<div />').html('loading words...').dialog(
			{
				width	: 325,
				modal	: true,
				close	: function(){$(this).remove()},
				title	: 'Related Words',
				create	: function()
				{
					$parent_dialog = $(this);
					// Do Custom Things
				},
				buttons	:
				{
					'Send':function()
					{
						var data = $('#form_name').serializeArray();
						data.push({'name':'module','value':'widgets'});
	
						 $.oauthAjax(
						 {
							oauth 	: user_data,
							url		: base_url + 'api/settings/create',
							type		: 'POST',
							dataType	: 'json',
							data		: data,
						  	success	: function(result)
						  	{							  	
								$('#content_message').notify({scroll:true,status:result.status,message:result.message});									
								$parent_dialog.dialog('close');
						  	}		
						});
					},
					'Cancel':function()
					{
						$parent_dialog.dialog('close');
					}
				}
	    	});
		//});		
	});

});
</script>