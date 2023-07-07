<?php
		
			global $app_list_strings;
	  	   $stream_html .='<head>
	<script type="text/javascript" src="custom/modules/Alerts/js/edit.js"></script>
	</script>
	<script type="text/javascript" src="cache/include/javascript/sugar_grp_yui_widgets.js"></script>
	</script>
</head> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	   <div class="container" style="width:700px; height: 200px;"><form> <h5>Please Select a reason</h5><br><select style="width:300px; name="reason_exception" id="reason_exception" title="" required="required">';
	  $stream_html .=	get_select_options_with_id($app_list_strings['exception_details_c_dom'],'""');
	 $stream_html .='</select><textarea id="custom_added_details" name="custom_added_details" rows="4" cols="60" title="" tabindex="0" style="width:80%; display:none;" spellcheck="false" >
	      please write your deatils here
	   </textarea>
       <input title="Submit" accesskey="a" class="button primary" id="Submit_exp" onclick="Submit_exception() " type="submit" name="button" value="Submit" id="SAVE" style="float:right; border-radius:20px; "></form></div>';   	
 	echo $stream_html;
      die;
