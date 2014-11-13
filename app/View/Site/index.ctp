<script>
	$( document ).ready(function() {
		var results = <? echo json_encode($results) ?>;
		console.log(results);
		$.ajax({
			url: "items/create",
			type: "POST",
			data: {
				results: results
			},
			success: function(response){
				var res = $.parseJSON(response);
				var success = res.success;
				var count = res.count;
				
				if(success){
					alert( 'Вставлено ' + count + ' записей' );
				} else {
					alert( 'Что-то не так!' );
				}
			}
		});
	});
</script>
