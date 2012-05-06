<style type="text/css">
#nearby_feelings_map { width: 100%; height: 600px; }
</style>

<h1>Nearby Feelings</h1>
<div id="nearby_feelings_map"></div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="<?= $this_module_assets ?>js/jquery.ui.map.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	var distance = 50;

	/* GMaps Docs
	https://code.google.com/p/jquery-ui-map/wiki/jquery_ui_map_v_3_api
	https://code.google.com/p/jquery-ui-map/wiki/jquery_ui_map_v_3_sample_code
	https://code.google.com/p/jquery-ui-map/wiki/jquery_ui_map_v_3_tutorial
	*/

	/// Get Geo
	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(showNearbyMap, nearbyMapError);	
	}

	/* Geo Location */
	function showNearbyMap(position)
	{
		console.log(position);
	
		$('#nearby_feelings_map').gmap({
			'center': position.coords.latitude + ', ' + position.coords.longitude
		}).bind('init', function(){});		
		
	
		$.oauthAjax(
		{
			oauth 		: user_data,		
			url			: base_url + 'api/emoome/get_nearby_feelings/lat/' + position.coords.latitude + '/lon/' + position.coords.longitude + '/distance/' + distance,
			type		: 'GET',
			dataType	: 'json',
		  	success		: function(result)
		  	{							  	
				if (result.status = 'success')
				{
					$.each(result.feelings, function(i, feeling)
					{
						if (feeling.geo_lat != '' && feeling.geo_lon != '')
						{
							console.log(feeling);
						
							$('#nearby_feelings_map').gmap('addMarker',
							{ 
								'position': new google.maps.LatLng(feeling.geo_lat, feeling.geo_lon), 
								'bounds': true
							}).click(function()
							{
								var this_content = '<b>' + feeling.word.toUpperCase() + '</b> ' + feeling.action;
							
								$('#nearby_feelings_map').gmap('openInfoWindow', { 'content': this_content }, this);
							});
						
						}
					});	
				}
				else
				{
					$('#content_message').notify({scroll:true,status:result.status,message:result.message});	
				}		
		  	}		
		});
		
	}	
	
	function nearbyMapError()
	{
		$('#content_message').notify({scroll:true,status:'error',message:'You do not geo location enabled on your browser'});
	}

});


</script>