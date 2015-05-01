<?php
include("api.php");
?>
<html>
<head>
	<title>
		API Call to Server
	</title>
	<script src="jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('a[href=#]').click(function() {
				var content = $(this).html();
				var splitContent = content.split('&nbsp;');
			var dataString = {"id" : splitContent[0]};//'id='+splitContent[0];
			var url = "http://api.vickythegme.com/api/1/players/get.json";
			$.ajax({
				url: url,
				type  : 'GET',
				data : dataString,
				contentType: "application/json",
				jsonpCallback : 'callback',
				jsonp : 'callback',
				dataType: 'jsonp',
				success: function (response) {
					var data = JSON.stringify(response);
					var parseData = $.parseJSON(data);
					console.log(parseData);
					$(".getContent").html("Loading..");
					setTimeout(function() {
						$(".getContent").html("");
						timeOut(parseData, splitContent);
					}, 3000);
				},
				error: function (xhr, status, error) {
					console.log(status + '; ' + error);
				}
			});
		});
});
function timeOut(parseData, splitContent) {
	for (var i = 0; i < parseData.length; i++) {
		$(".getHeader").html("Team Players for"+splitContent[1]);
		$(".getContent").append("<tr><td>"+parseData[i].firstname+"</td><td>"+parseData[i].lastname+"</td><td><img src='"+parseData[i].imageuri+"' width='50' height='50'></td></tr>");
	};
}
</script>
</head>
<body>
	<div class="container">
		<table>
			<thead>
				<tr>
					<td>List of Teams</td>
				</tr>
			</thead>
			<tbody>
				<?php
				$obj = new Api;
				$teamResult = $obj -> getTeam();
				$json_output = json_decode($teamResult);
				for ($i=0; $i < count($json_output); $i++) { 
					echo "<tr>";
					echo "<td><a href='#'>".$json_output[$i] ->id."&nbsp;";
					echo " ".$json_output[$i] ->name."</a></td>";
					echo "<td><img src='".$json_output[$i] ->logouri."' width='75' height='75' /></td>";
					echo "</tr></a>";
				}
				?>
			</tbody>
		</table>
		<table >
			<caption class="getHeader">Team Players</caption>
			<thead>
				<tr>
					<th>Firstname</th>
					<th>Lastname</th>
					<th>Image</th>
				</tr>
			</thead>
			<tbody class="getContent">
				
			</tbody>
		</table>

	</div>
</body>
</html>
