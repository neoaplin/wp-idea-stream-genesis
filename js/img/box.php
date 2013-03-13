<?php
$admin = dirname( __FILE__ ) ;
$admin = substr( $admin , 0 , strpos( $admin , "wp-content" ) ) ;
require_once( $admin . 'wp-admin/admin.php' ) ;


wp_enqueue_style( 'global' );
wp_enqueue_style( 'wp-admin' );
wp_enqueue_style( 'colors' );
wp_enqueue_style( 'media' );


$max_width_option = intval(get_option('_ideastream_image_width'));
$max_width = empty( $max_width_option ) ? 300 : $max_width_option;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php _e('Add a photo', 'wp-idea-stream');?></title>
	<meta name="generator" content="TextMate http://macromates.com/">
	<meta name="author" content="imath">
	<!-- Date: 2012-02-17 -->
	<style>
		table.wp_idea_stream_image_editor{
			padding:5px;
			margin-bottom:10px;
			border:solid 1px #E2E2E2;
			width:100%;
		}
		table.wp_idea_stream_image_editor td{
			text-align:center;
		}
		table.wp-idea-stream-media-container{
			width:100%;
		}
		table.wp-idea-stream-media-container label{
			font-weight:bold;
		}
	</style>
	<?php do_action('admin_print_styles');?>
	<?php wp_print_scripts('jquery')?>
	<script type="text/javascript" src="<?php echo get_option( 'siteurl' ) ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
</head>
<body style="min-width:90%!important;width:90%;height:90%">
		
		<div id="photo-url">
			<p>
				<label><?php _e('Url to your image', 'wp-idea-stream');?></label>
				<input type="text" name="imageLink" id="imageLink" style="width:98%" value="http://">
			</p>
			<div id="hidepreview" style="display:none">
				<img src="<?php echo WP_IDEA_STREAM_PLUGIN_URL_IMG;?>/ed-bg.gif" id="originalimage">
			</div>
			<div id="showpreview"></div>
			<p>
				<label><?php _e('Text replacement for your picture', 'wp-idea-stream');?></label>
				<input type="text" name="imageAlt" id="imageAlt" style="width:98%">
			</p>
			<div id="info">
				<label><?php _e('Image original height', 'wp-idea-stream');?></label> <input type="text" id="ht" readonly><br/>
				<label><?php _e('Image original width', 'wp-idea-stream');?></label> <input type="text" id="wt" readonly>
			</div>
			<p>
				<label><?php _e('Width in pixels for your picture (only numbers)', 'wp-idea-stream');?></label><br/>
				<small><?php printf( __('Max width authorized by admin is %s px', 'wp-idea-stream'), $max_width);?></small><br/>
				<input type="text" name="imageWidth" id="imageWidth" style="width:50%" value="<?php echo $max_width;?>">
			</p>
			<table style="width:98%">
				<tr><td>
					<table class="wp_idea_stream_image_editor">
						<tr><th colspan="4"><?php _e('Image alignment', 'wp-idea-stream');?></th></tr>
						<tr>
							<td>
								<input type="radio" name="img_align" value="alignnone" checked><?php _e('None', 'wp-idea-stream');?>
							</td>
							<td>
								<input type="radio" name="img_align" value="alignleft"><?php _e('Left', 'wp-idea-stream');?>
							</td>
							<td>
								<input type="radio" name="img_align" value="alignright"><?php _e('Right', 'wp-idea-stream');?>
							</td>
							<td>
								<input type="radio" name="img_align" value="aligncenter"><?php _e('Center', 'wp-idea-stream');?>
							</td>
						</tr>
					</table>
				</td></tr>
			</table>
			<p>
				<input type="button" value="<?php _e('Add Picture', 'wp-idea-stream');?>" id="addImage" class="button">
				<input type="button" value="<?php _e('Cancel', 'wp-idea-stream');?>" id="cancelImage" class="button">
			</p>
		</div>
	
	<script type="text/javascript">
	
	jQuery(document).ready(function($){
		
		$("#imageLink").blur(function(){
			$("#showpreview").html('<img src="'+$(this).val()+'" width="150px" id="imageprev">');
			$("#originalimage").attr('src', $(this).val());
		})
		$('#originalimage').bind('load readystatechange', function(e) {

			if(this.src == "<?php echo WP_IDEA_STREAM_PLUGIN_URL_IMG;?>/ed-bg.gif")
				return false;

			if (this.complete || (this.readyState == 'complete' && e.type == 'readystatechange')) {
				$("#ht").val(this.height);
				$('#wt').val(this.width);

				if(this.height > this.width){
					$('#showpreview img').attr('height','150px');
					ratio = 150 / this.height;
					$('#showpreview img').attr('width', ratio * this.width +'px');
				}
			}
		});
		
		$("#cancelImage").click(function(){ tinyMCEPopup.close(); });
		
		$("#addImage").click(function(){
			
			var testimage = $("#imageLink").val();
			var testalt = $("#imageAlt").val();
			var testwidth = parseInt( $("#imageWidth").val() );
			
			if( testimage.substring(0,7) != "http://") {
				alert("<?php _e('You must add a well formed url to your picture beginning by http://', 'wp-idea-stream');?>");
				$("#imageLink").focus();
				return false;
			}
			
			if( testimage.substring(7, testimage.length).indexOf("http://")!=-1 ){
				alert("<?php _e('You must add a well formed url to your picture with only one reference to http://', 'wp-idea-stream');?>");
				$("#imageLink").focus();
				return false;
			}
			
			if(testimage.length <= 7){
				alert("<?php _e('Please add the url of your picture', 'wp-idea-stream');?>");
				$("#imageLink").focus();
				return false;
			}
			
			if(!testalt)
				testalt = 'image';
			
			if(!testwidth || testwidth > <?php echo $max_width;?> )
				testwidth = <?php echo $max_width;?>;
			
			tinyMCEPopup.editor.execCommand('mceInsertContent', false, '<img src="'+testimage+'" width="'+testwidth+'px" class="'+$("input[name=img_align]:checked").val()+'" alt="'+testalt+'">' ) ;
			
			tinyMCEPopup.close();
		});
	});
	
	</script>
</body>
</html>
