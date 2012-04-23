<style type="text/css">
#nearby_feelings_map { width: 100%; height: 600px; border: 1px solid red; }
</style>
<h1>Nearby Feelings</h1>

<div id="nearby_feelings_map">


</div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="<?= $this_module_assets ?>js/jquery.ui.map.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	var distance = 10;

	/// Get Geo
	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(showNearbyMap, nearbyMapError);	
	}	

	/* Geo Location */
	function showNearbyMap(position)
	{
		$('#nearby_feelings_map').gmap().bind('init', function()
		{ 		
			$.oauthAjax(
			{
				oauth 		: user_data,		
				url			: base_url + 'api/emoome/get_nearby_feelings/lat/' + position.coords.latitude + '/lon/' + position.coords.longitude + '/distance/' + distance,
				type		: 'GET',
				dataType	: 'json',
			  	success		: function(result)
			  	{							  	
					console.log(result.feelings)
					
					$.each(result.feelings, function(i, feeling)
					{
						if (feeling.geo_lat != '' && feeling.geo_lon != '')
						{

							$('#nearby_feelings_map').gmap('addMarker',
							{ 
								'position': new google.maps.LatLng(feeling.geo_lat, feeling.geo_lon), 
								'bounds': true 
							}).click(function() {
								$('#nearby_feelings_map').gmap('openInfoWindow', { 'content': feeling.word }, this);
							});
					
						}
					
					});				
							
	
			  	}		
			});
		});	
	}	
	
	function nearbyMapError()
	{
		$('#content_message').notify({scroll:true,status:'error',message:'You do not geo location enabled on your browser'});
	}

});


</script>