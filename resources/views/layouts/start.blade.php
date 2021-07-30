
@if(\Auth::user())
<div id="rating-div">
    <ul onMouseOut="resetRating()">
        <?php
        $max = 0;
        if ($rate) {
            $max = $rate->rate;
        }
        for($i = 1; $i<=5; $i++) {
            $selected = "";
            if( $i <= $max) {
                $selected = "selected";
            }
        ?>
        <li class='{{$selected}}' onmouseover="highlightStar(this);" onmouseout="removeHighlight();" 
        onClick="addRating(this, {{$page->id}}, {{$i}});">&#9733;
        </li>  
        <?php }  ?>
    <ul>
</div>

<script>
var currentStart = {{$max}};
function highlightStar(obj) {
	removeHighlight();		
	$('#rating-div li').each(function(index) {
		$(this).addClass('highlight');
		if(index == $('#rating-div li').index(obj)) {
			return false;	
		}
	});
}

function removeHighlight() {
	$('#rating-div li').removeClass('selected');
	$('#rating-div li').removeClass('highlight');
}

function addRating(obj, id, rating) {
	$('#rating-div li').each(function(index) {
		$(this).addClass('selected');
		$('#rating-div #rating').val((index+1));
		if(index == $('#rating-div li').index(obj)) {
			return false;	
		}
	});
	$.ajax({
        url: "{{url('user/addRating')}}",
        data:'page_id='+id+'&rating='+rating,
        type: "POST"
	}).done(function(data) {
        currentStart = data.rating.rate;
    });
}

function resetRating() {
    $('#rating-div li').each(function(index) {
        if(index < currentStart) {
            $(this).addClass('selected');
        }
    });
}
</script>
@endif
