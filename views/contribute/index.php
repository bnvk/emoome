<div id="content_test" class="content_center text_center">
	
	<h1>Contribute</h1>
		
	<p>
	<a id="button_cat_feeling" class="category_button" href="<?= base_url() ?>emoome/contribute/feeling">
	  <span class="cat_link_icon" id="cat_feeling_icon"></span>
	  <span class="cat_link_text">How Do You Feel Right Now?</span>
	  <br class="clear">
	</a>
	</p>
	
	<p>
	<a id="button_cat_memory" class="category_button" href="<?= base_url() ?>emoome/contribute/memory">
	  <span class="cat_link_icon" id="cat_memory_icon"></span>
	  <span class="cat_link_text">Memory Mapper</span>
	  <br class="clear">
	</a>
	</p>
	
	<div id="blah_blah_blah"></div>

</div>


<script type="text/javascript" src="<?= $site_assets ?>js/raphael.js" charset="utf-8"></script>
<script type="text/javascript" src="<?= $site_assets ?>js/raphael-svg-import.js" charset="utf-8"></script>
<script type="text/javascript" src="<?= $site_assets ?>js/raphael-shapes.js" charset="utf-8"></script>

<script type="text/javascript">
$(document).ready(function()
{
	//$('#button_cat_feeling').svg({loadURL: 'http://localhost/application/modules/emoome/assets/icons/profile_1899.svg'});
	//$('#button_cat_memory').svg({loadURL: 'http://localhost/application/modules/emoome/assets/icons/brain_685.svg'});

	//var profile = new Raphael(document.getElementById('button_cat_feeling'), 100, 100).path(emoome_icons.profile).attr({fill: '#000000'});
	//var brain = new Raphael(document.getElementById('button_cat_memory'), 100, 100).path(emoome_icons.brain).attr({fill: '#000000'});
	
//	var c = paper.image("http://localhost/application/modules/emoome/assets/icons/brain_685.svg", 10, 10, 80, 80);

	var feelings = Raphael(document.getElementById('cat_feeling_icon'), 100, 100).importSVG(emoome_icons.profile);
	var brain = Raphael(document.getElementById('cat_memory_icon'), 100, 100).importSVG(emoome_icons.brain);



});
</script>