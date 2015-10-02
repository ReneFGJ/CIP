<script src="jquery.js" type="text/javascript"></script>
<script src="main.js" type="text/javascript"></script>
<style>
	#screenshot {
		position: absolute;
		border: 2px solid #ccc;
		background: #333;
		padding: 5px;
		display: none;
		color: #fff;
		height: auto;
		border-radius: 10px;
	}
</style>

</div>

<div id="toTop" style="display: none;">
	^ Voltar ao topo
</div>
<!-- Tooltipi do mapa  -->
<script type="text/javascript" src="./Simple Tooltips w  CSS & jQuery   Tutorial by Soh Tanaka_files/jquery.min.js"></script>
<script type="text/javascript">
	this.screenshotPreview = function() {
		/* CONFIG */
		xOffset = 10;
		yOffset = 30;
		/* END CONFIG */
		$("a.screenshot").hover(function(e) {
			this.t = this.title;
			this.title = "";
			var c = (this.t != "") ? "<br/>" + this.t : "";
			$("body").append("<p id='screenshot'><img src='" + this.rel + "' alt='url preview' />" + c + "</p>");
			$("#screenshot").css("top", (e.pageY - xOffset) + "px").css("left", (e.pageX + yOffset) + "px").fadeIn("fast");
		}, function() {
			this.title = this.t;
			$("#screenshot").remove();
		});
		$("a.screenshot").mousemove(function(e) {
			$("#screenshot").css("top", (e.pageY - xOffset) + "px").css("left", (e.pageX + yOffset) + "px");
		});
	};

</script>
<script type="text/javascript">
	// starting the script on page load
	$(document).ready(function() {
		screenshotPreview();
	});

</script>