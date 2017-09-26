<!DOCTYPE html>
<html>
<head>
	
  <meta charset="UTF-8">
  <title>Auto-Acknowledgment Email Designer - Desk.com Toolbox</title>
  
  	<!-- DESK ICON -->
  	<link rel="icon" type="image/vnd.microsoft.icon" href="https://cdn.desk.com/assets/favicon-6996d629d8eda6554da097789a549459.ico">
    <link rel="icon" type="image/png" href="https://cdn.desk.com/assets/favicon-e35d809f46f88708acdeb9c8408472ff.png">
  	
  	<!-- LOAD IN NORMALIZE CSS -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  	
  	<!-- LOAD IN FONT -->
  	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700" rel="stylesheet">
  	
  	<!-- TOOLBOX MASTER CSS -->
  	<link rel="stylesheet" href="https://s3.amazonaws.com/desk-wow/toolbox/tool.css">
  	
  	<!-- LOAD IN ICONS -->
  	<script src="https://use.fontawesome.com/1ef7e78827.js"></script>
  	
  	<!-- LOAD IN JQUERY -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  
    <!-- COLOR PICKER JS AND CSS -->
    <link rel="stylesheet" media="screen" type="text/css" href="colorpicker/css/colorpicker.css" />
    <script type="text/javascript" src="colorpicker/js/colorpicker.js"></script>
    
    <!-- IMG UPLOAD CSS -->
    <link rel="stylesheet" media="screen" type="text/css" href="imgur/css/imgur.min.css" />
    
    <!-- PIN ELEMENTS 
    <script type="text/javascript" src="pin.js"></script>
    -->
    
    <!-- LOAD IN TOOLBAR -->		
    <link rel="stylesheet" media="screen" type="text/css" href="toolbar/jquery.toolbar.css" />		
    <script type="text/javascript" src="toolbar/jquery.toolbar.min.js"></script>
    
    	
    <script>		
      jQuery(document).ready(function($) {	
        
        // ENABLE SIDEBAR HIDING
        if(window.location.href.indexOf("internal") > -1) {
          $('div.left ul').show();
        } else {
          $('div.left ul').hide();
          $('div.logo a').removeAttr("href");
        }
        
        
        // HIDE ELEMENTS
        $('#output-wrapper').hide();
        $('.status').hide();
        $('.subject-bar').hide();
        $('#imgUrl').hide();
        $('.align-toolbar').hide();
        $('#output-copied').hide();
        $('.warning-box').hide();
        $('.imgur-box').hide();
        $('.case-id').hide();
        
        
        // SET GRAVATAR DEFAULT VALUES
        $('.gravatar-storage').attr('value', "<!-- AVATAR START -->\r\n    <td class=\"email-body-avatar\" style=\"margin: 0;padding: 0;border-collapse: separate;border-spacing: 0;width: 95px;height: 80px;text-align: right;\">\r\n      <img src=\"{{ case.user.email | gravatar_url: gravatar_unknown_user, ssl }}\" style=\"border-radius: 50px;width: 50px;height: 50px;min-height: 50px;max-height: 50px;\"\/>\r\n    <\/td>\r\n    <!-- AVATAR END -->");
        $('.gravatar-cust-storage').attr('value', "<!-- AVATAR START -->\r\n    <td class=\"email-body-avatar\" style=\"margin: 0;padding: 0;border-collapse: separate;border-spacing: 0;width: 95px;height: 80px;text-align: right;\">\r\n      <img src=\"{{ case.customer.email | gravatar_url: gravatar_unknown_user, ssl }}\" style=\"border-radius: 50px;width: 50px;height: 50px;min-height: 50px;max-height: 50px;\"\/>\r\n    <\/td>\r\n    <!-- AVATAR END ->>");
        
          
        // SET DATE IN LIVE PREVIEW  
        $('.date-format').on('change', function() {
          
          var dateString = $('.date-format').val();
          
          if (dateString == '%b %d, %Y %I:%M %p') {
            $('.date').text('Jan 30, 2017 14:12 PM');
          } else if (dateString == '%m/%e/%y %I:%M %p') {
            $('.date').text('1/30/17 14:12 PM');
          } else if (dateString == '%e/%m/%y %I:%M %p') {
            $('.date').text('30/1/17 14:12 PM');
          } else {
            $('.date').text('Oops! Something broke.');
          }
        });
        
        
        // IMAGE ALIGNMENT AND SIZE TOOLS 		
        $('.align-left').on('click', function( event ) {		
					event.preventDefault();		
					leftAlign = 'left';		
          $('.aa-logo-center').parent().attr('align', leftAlign);		
          $('.logo-align-storage').attr('value', leftAlign);		
				});		
        		
        $('.align-right').on('click', function( event ) {		
					event.preventDefault();		
					rightAlign = 'right';		
          $('.aa-logo-center').parent().attr('align', rightAlign);		
          $('.logo-align-storage').attr('value', rightAlign);		
				});		
						
				$('.align-center').on('click', function( event ) {		
					event.preventDefault();		
					centerAlign = 'center';		
          $('.aa-logo-center').parent().attr('align', centerAlign);		
          $('.logo-align-storage').attr('value', centerAlign);		
				});		
        		
        $('.btn-toolbar').toolbar({		
        	content: '#logo-align',		
        	position: 'right',		
        	style: 'primary'		
        });
        
        $('.logo-small').on('click', function( event ) {		
					event.preventDefault();		
					logoSmall = '50px';		
          $('.aa-logo-center img').css('max-width', logoSmall);		
          $('.logo-size-storage').attr('value', logoSmall);		
				});
				
				$('.logo-medium').on('click', function( event ) {		
					event.preventDefault();		
					logoMedium = '150px';		
          $('.aa-logo-center img').css('max-width', logoMedium);		
          $('.logo-size-storage').attr('value', logoMedium);		
				});
				
				$('.logo-large').on('click', function( event ) {		
					event.preventDefault();		
					logoLarge = '300px';		
          $('.aa-logo-center img').css('max-width', logoLarge);		
          $('.logo-size-storage').attr('value', logoLarge);		
				});
        
        
        // REMOVE LOGO FROM THE THEME
				$('.delete-logo').on('click', function( event ) {		
					event.preventDefault();		
            $('.status').fadeOut('fast');
            $('.align-toolbar').fadeOut('fast');
  				  $('#imgUrl').fadeOut('fast', function(){
							$('.dropzone').slideDown('slow');
							$('.subject-bar').slideUp('slow');
							$('#imgUrl').val('https://i.imgur.com/y7a583b.png');
							$('.aa-logo-center img:last-child').remove();
            });
				});
				
				
        // REMOVE AND SHOW GRAVATAR IMAGES
        $('#remove-gravatar').click( function() {
            var toggleWidth = $(".email-body-avatar").width() == 95 ? "20px" : "95px";
            $(".email-body-avatar img").toggle();
            $('.email-body-avatar').animate({ width: toggleWidth }, 'fast');
            if ($('#remove-gravatar').is(':checked')) {
              
            $('.gravatar-storage').attr('value', "<!-- AVATAR START -->\r\n    <td class=\"email-body-avatar\" style=\"margin: 0;padding: 0;border-collapse: separate;border-spacing: 0;width: 20px;height: 80px;text-align: right;\">\r\n   \r\n    <\/td>\r\n    <!-- AVATAR END -->");
            $('.gravatar-cust-storage').attr('value', "<!-- AVATAR START -->\r\n    <td class=\"email-body-avatar\" style=\"margin: 0;padding: 0;border-collapse: separate;border-spacing: 0;width: 20px;height: 80px;text-align: right;\">\r\n      \r\n    <\/td>\r\n    <!-- AVATAR END ->>");
            } else {
            $('.gravatar-storage').attr('value', "<!-- AVATAR START -->\r\n    <td class=\"email-body-avatar\" style=\"margin: 0;padding: 0;border-collapse: separate;border-spacing: 0;width: 95px;height: 80px;text-align: right;\">\r\n      <img src=\"{{ case.user.email | gravatar_url: gravatar_unknown_user, ssl }}\" style=\"border-radius: 50px;width: 50px;height: 50px;min-height: 50px;max-height: 50px;\"\/>\r\n    <\/td>\r\n    <!-- AVATAR END -->");
            $('.gravatar-cust-storage').attr('value', "<!-- AVATAR START -->\r\n    <td class=\"email-body-avatar\" style=\"margin: 0;padding: 0;border-collapse: separate;border-spacing: 0;width: 95px;height: 80px;text-align: right;\">\r\n      <img src=\"{{ case.customer.email | gravatar_url: gravatar_unknown_user, ssl }}\" style=\"border-radius: 50px;width: 50px;height: 50px;min-height: 50px;max-height: 50px;\"\/>\r\n    <\/td>\r\n    <!-- AVATAR END ->>");
            }
          });
          
          // SHOW AND REMOVE CASE ID
          $('#remove-caseid').click( function() {
            $('.case-id').fadeToggle('fast');
            if ($('#remove-caseid').is(':checked')) {
            $('.caseid-storage').attr('value', "       <!-- CASE ID AREA -->\r\n        <div class=\"case-id\" style=\"margin-top:10px; text-align: center;\">Case ID: {{case.id}}<\/div>\r\n        <!-- CASE ID AREA END -->\r\n\r\n");
            } else {
            $('.caseid-storage').attr('value', "");
            }
          });	
      		
      });		
    </script>
    
    <!-- APP SPECIFIC STYLES -->
    <style>
      .app-col {
        float: left;
        min-width: 200px;
        max-width: 500px;
        width: 350px;
        margin-right: 25px;
        box-shadow: 2px 0px 8px #fafafa;
        margin-top: -25px;
        padding-right: 20px;
        border-right: 1px solid #eaeaea;
        padding-top: 24px;
        background: #ffffff;
        margin-bottom: -25px;
        padding-left: 25px;
        margin-left: -25px;
      }
      
      .browser-window .previewHeader {
        width: 100%;
        font-size: 11px;
        padding-left: 10px;
        padding-top: 10px;
        padding-bottom: 10px;
        background: #fff;
      }
      
      .from {
        width: 50px;
        float: left;
        border-bottom: 1px solid #e9e9e9;
        font-size: 11px;
        padding-left: 0px;
        padding-top: 10px;
        padding-bottom: 10px;
        background: #e6e6e6;
      }
      
      .browser-window:hover {
        right: 40px;
        -webkit-transform: rotate(-0.5deg);
        -moz-transform: rotate(-0.5deg);
        -o-transform: rotate(-0.5deg);
        -webkit-transition: all 100ms linear;
        -webkit-transition: all 100ms linear; 
      }
      
      .browser-window {
        text-align: left;
        width: 930px;
        height: 500px;
        display: inline-block;
        border-radius: 5px;
        background-color: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.12);
      	box-shadow: 0 1px 5px rgba(0, 0, 0, 0.09);
        position: fixed;
        left: 480px;
        -webkit-transition: all 100ms linear;
        -webkit-transition: all 100ms linear;
      }
      
      #output-wrapper {
        position: absolute;
        top: 50%;
        margin-top: -200px;
        right: 50%;
        margin-right: -400px;
        width: 800px;
        padding: 20px;
        z-index: 9999;
        box-shadow: 0 1px 5px rgba(0, 0, 0, 0.09);
        border-radius: 3px;
        background: #2D3338;
        transition: all .3s ease;
      }
      
      #output {
        	width: 100%; 
        	background:rgba(245, 242, 240, 0.78); 
        	color: #064b69; 
        	text-shadow: 0px 1px 0px rgba(255, 255, 255, 0.29); 
        	height: 185px; 
        	box-shadow: none!important; 
        	border: none; 
        	border-radius: 3px;
        	line-height: 1.8em;
      	}
      
      /* Tiny */
      @media (min-width: 300px) {
	
      	.browser-window {
      		right: -500px;
      	}
      	
      	#output {
        	width: 100%; 
        	background:rgba(245, 242, 240, 0.78); 
        	color: #07a;
        	height: 185px; 
        	box-shadow: none!important; 
        	border: none; 
        	border-radius: 3px;
      	}
	
      }
      
      /* Less Wide */
      @media (min-width: 736px) {
	
      	.browser-window {
      		right: -300px;
      	}
      	
        #output {
        	width: 100%; 
        	background:rgba(245, 242, 240, 0.78); 
        	color: #07a;
        	height: 185px; 
        	box-shadow: none!important; 
        	border: none; 
        	border-radius: 3px;
      	}
	
      }
      
      
      /* Widest */
      @media (min-width: 1100px) {
	
      	.browser-window {
      		right: 30px;
      	}
      	
      	#output {
        	width: 100%; 
        	background:rgba(245, 242, 240, 0.78); 
        	color: #07a;
        	height: 185px; 
        	box-shadow: none!important; 
        	border: none; 
        	border-radius: 3px;
      	}
	
      }
      
      /* Widest 2 */
      @media (min-width: 1720px) {
	
      	.browser-window {
      		right: 100px;
      	}
      	
      	#output {
        	width: 825px; 
        	background:rgba(245, 242, 240, 0.78); 
        	color: #07a;
        	height: 185px; 
        	box-shadow: none!important; 
        	border: none; 
        	border-radius: 3px;
      	}
      	
      	.browser-window:hover {
          right: 100px;
          -webkit-transform: rotate(-0.5deg);
          -moz-transform: rotate(-0.5deg);
          -o-transform: rotate(-0.5deg);
          -webkit-transition: all 100ms linear;
          -webkit-transition: all 100ms linear; 
        }
	
      }
      
      .browser-window .top-bar {
        height: 30px;
        border-radius: 5px 5px 0 0;
        border-top: thin solid #eaeae9;
        border-bottom: thin solid #dfdfde;
        background: linear-gradient(#e7e7e6, #e2e2e1);
      }
      
      .browser-window .circle {
        height: 8px;
        width: 8px;
        display: inline-block;
        border-radius: 50%;
        background-color: white;
        margin-right: 5px;
      }
      
      .browser-window .circles {
        margin: 5px 11px;
      }
      
      .browser-window .content {
        margin: 0;
        width: 100%;
        display: inline-block;
        border-radius: 0 0 5px 5px;
        
        border-top: 1px solid #e6e6e6;
      }
      
      .browser-window .dev-tools {
        width: 100%;
        min-height: 50%;
        margin: 0;
        padding: 0;
      }
      
      .browser-window .dev-tools .bar {
        margin-top: -4px;
        border-top: thin solid #e7e7e6;
        border-bottom: thin solid #e7e7e6;
        color: #e7e7e6;
      }
      .browser-window .dev-tools .bar .dev-bar-content {
        padding: 10px;
        float: left;
      }
      .browser-window .dev-tools .bar .close {
        float: right;
        border-left: thin solid #e7e7e6;
        padding: 10px;
      }
      
      .browser-window .dev-tools .content .html {
        height: 100%;
        width: 69%;
        border-right: thin solid #e7e7e6;
      }
      .browser-window .dev-tools .content .css {
        float: right;
        height: 100%;
        width: 30%;
      }
      
      .imgur-box {
      	width: 100%;
      	background: #f7f7f7;
      	border-radius: 3px;
      	overflow: hidden;
      	display: block;
      	margin-bottom: 20px;
      	margin-top:10px;
      }
      
      .imgur-box h3 {
      	padding: 0;
      	margin: 0;
      	color: #46402a;
      	background-color: #e0e0e0;
      }
      
      .imgur-content {
      	padding: 20px;
      	font-size: 14px;
      	color: #494949;
      	overflow: hidden;
      }
      
      .imgur-content ul li a {
        font-size: 14px!important;
      }
      
      .imgur-content ul li a:visited {
        font-size: 14px;
      }
      
      .imgur-content ul {
      	padding-bottom: 0px;
      	margin-bottom: 0px;
      	margin-top: 0px;
      	margin-left: 20px;
      }
      
      .imgur-content li {
      	padding-bottom: 10px;
      	list-style: 
      }
      
      .imgur-content li:last-child {
      	padding-bottom: 0px;
      }
      
      .clear {
        clear: both;
      } 
    
      
      .select-style {
        border: 1px solid #ccc;
        width: 100%;
        border-radius: 2px;
        overflow: hidden;
        background: #fafafa no-repeat 90% 50%;
        margin-top: 10px;
        margin-bottom: 15px;
        padding-top: 9px;
        padding-bottom: 9px;
        box-shadow: inset 0 1px 2px rgba(161, 179, 183, 0.3);
        border-bottom: 1px solid #DDDDDD;
      }

      .select-style select {
          padding: 5px;
          padding-left: 10px;
          width: 90%;
          border: none;
          box-shadow: none;
          background: transparent;
          background-image: none;
          -webkit-appearance: none;
          -moz-appearance: none;
      }

      .select-style select:focus {
          outline: none;
      }
      
      .select-style:after {
        font-family: FontAwesome;
        content: "\f0d7";
        display: inline-block;
        padding-right: 3px;
        vertical-align: middle;
        float: right;
        padding: 0;
        margin: 0;
        padding-right: 10px;
        padding-top: 5px;
      }
      
    </style>
  
</head>

<body>
	
	<!-- SIDEBAR STARTS -->
	<div class="left">
		  
		<!-- JS BUNDLE LOADS LAUNCHBAR HERE -->
		  
	</div>
	<!-- SIDEBAR ENDS -->
  
	<!-- RIGHT SIDE CONTENT -->
	<div class="right">
		
		<!-- CONTENT SECTION HEADER -->
		<div class="header">
			<div class="app-logo"></div>
			<h1>
				<!-- SET PAGE HEADING ICON -->
				<span class="fa-stack fa-lg green">
					<i class="fa fa-tint fa-stack-1x "></i>
				</span>
				<!-- SET PAGE HEADING TEXT -->
				Auto-Acknowledgment Theme Editor
			</h1>
		</div>
		<!-- CONTENT SECTION HEADER END -->
		
		<!-- MAIN BODY CONTENT -->
		<div class="main">
  		
  		  <div class='browser-window' id="backgroundColor">
			  
			  <div class='top-bar'>
			    <div class='circles'>
            <div class="circle circle-red"></div>
            <div class="circle circle-yellow"></div>
            <div class="circle circle-green"></div>
            <div style="width:100px; height:8px; display:inline-block; margin-left:350px; font-size:13px; color: #848484; text-shadow: 0 1px rgba(255, 255, 255, 0.57);">Live Preview</div>
	        </div>
        </div>
        
        <div class='previewHeader'>To: Your Customer &rarr; <strong>customer@email.com</strong> </div>
        
        <div class='content' id="textColor" style="overflow-y: scroll; height:436px;">
          <!-- LOAD IN EMAIL THEME -->
          <?php require('themes/aatheme.php'); ?>
          <!-- LOAD IN EMAIL THEME -->
        </div>
        
        <div class='clear'></div>
      </div>
      
      <div class="app-col">
        
        <form>
          
        <label>Upload Your Company Logo<span class="imgur-box-open" style="font-size: 16px; cursor: help; margin-top: 5; color: #96c3df;"> <i class="fa fa-question-circle" aria-hidden="true"></i></span></label>
        
        <!-- IMGUR UPLOAD DETAILS -->
        <div class="imgur-box">
					<h3>
						<span class="fa-stack fa-lg">
							<i class="fa fa-file-image-o fa-stack-1x "></i>
						</span>
						Important Note.
						<span class="fa-stack fa-lg" style="float: right; font-size: 14px; color: #a2a2a2; padding-top: 11px; margin-right: 10px; cursor: pointer; cursor: hand;">
							<i class="fa fa-times fa-stack-1x imgur-box-close"></i>
						</span>
					</h3>
					<div class="imgur-content">
						<ul class="fa-ul" style="font-weight: 300;">
              <li><i class="fa-li fa fa-exclamation"></i>Images will be uploaded to Imgur. Which is a third-party image hosting service.</li>
              <li><i class="fa-li fa fa-exclamation"></i>Anyone with the generated image link will be able to view your logo.</li>
              <li><i class="fa-li fa fa-exclamation"></i>By uploading using this tool, you agree to Imgur's <a href="http://imgur.com/tos" target="_blank">Terms of Service</a>.</li>
						</ul>
					</div>
				</div>
				<!-- IMGUR UPLOAD DETAILS END -->
        
        <div class="dropzone"></div>
        
        
        <input autocomplete="off" class="input-text" name="imgUrl" id="imgUrl" type="text" style="margin-top:-1px; border-top: none!important;">
          <div id="logo-align" class="hidden">		
            <!--<a href="#" class="align-left"><i class="fa fa-align-left"></i></a>		
            <a href="#" class="align-center"><i class="fa fa-align-center"></i></a>		
            <a href="#" class="align-right"><i class="fa fa-align-right"></i></a>-->
            <a href="#" class="logo-small"><i class="fa fa-picture-o" aria-hidden="true" style="font-size: 12px;"></i></a>
            <a href="#" class="logo-medium"><i class="fa fa-picture-o" aria-hidden="true" style="font-size: 16px;"></i></a>
            <a href="#" class="logo-large"><i class="fa fa-picture-o" aria-hidden="true" style="font-size: 20px;"></i></a>
            <a href="#" class="delete-logo"><i class="fa fa-trash-o"></i></a>		
          </div>		
          <div class="btn-toolbar btn-toolbar-primary align-toolbar">		
            <i class="fa fa-cog"></i>    		
          </div>		
          
        <!-- HIDDEN INPUT FIELDS -->		
        <input class="logo-align-storage hidden" value="center" type="text"/>
        <input class="logo-size-storage hidden" value="300px" type="text"/>
        <input class="gravatar-storage hidden" value="gravatar" type="text"/>
        <input class="gravatar-cust-storage hidden" value="cust-gravatar" type="text"/>
        <input class="caseid-storage hidden" value="" type="text"/>
        <input class="remove-header-storage hidden" value="" type="text"/>
        <!-- HIDDEN INPUT FIELDS END -->
        
        <!--
        <p>
          <input type="checkbox" id="remove-header-text" name="item[]" value="gravatar">
          <label for="remove-header-text"><span></span>Remove Header Text</label>
        </p>
        -->
        
        <!--
        <label>Pick A Date Format</label>
        <div class="select-style">
        <select style="color: #3e3e3e; font-weight: 200;" class="date-format">
          <option value="%b %d, %Y %I:%M %p" class="long-date">Longer Style - MMM DD, YYYY</option>
          <option value="%m/%e/%y %I:%M %p" class="us-date">Short US Style - MM/DD/YY</option>
          <option value="%e/%m/%y %I:%M %p" class="uk-date">Short UK Style - DD/MM/YY</option>
        </select>
        </div>
        -->
        
        
        
        <label for="bg-color">Main Background Color
          <input autocomplete="off" class="input-text" name="bg-color" id="bg-color" value="fbfbfb" type="text">
        </label>
        
        <label for="box-color">Box Background Color
          <input autocomplete="off" class="input-text" name="box-color" id="box-color" value="ffffff" type="text">
        </label>
        
        <label for="hr-color">Borders & Horizontal Line Color
          <input autocomplete="off" class="input-text" name="hr-color" id="hr-color" value="e9e9e9" type="text">
        </label>
      
        <label for="head-color">Header Font Color
          <input autocomplete="off" class="input-text" name="head-color" id="head-color" value="999999" type="text">
        </label>
        
        <label for="text-color">Box Font Color
          <input autocomplete="off" class="input-text" name="text-color" id="text-color" value="565656" type="text">
        </label>
        
        
        </form>
        
        <!-- GENERATE CODE BUTTON -->
        <div class="form-button" style="text-align: center;">
  					<a href="#"><input class="generate-code" id="submit" type="submit" value="Generate Code"></a>
  		  </div>
        <!-- GENERATE CODE BUTTON END -->
        
        
        <!-- OUTPUT WRAPPER STARTS --->
        <div id="output-wrapper">
          
          <p style="color: #a2a2a2; margin-top: 0; margin-bottom: 0;">Auto-Acknowledgement Theme Code <span><i class="fa fa-times fa-stack-1x close-output-wrapper" style="text-align: right; padding-right: 20px;"></i></span></p>
           
          <!-- OUTPUT CODE LOADS HERE -->  
          <textarea id="output">Edit color fields to generate code...
          </textarea>
          <!-- OUTPUT CODE LOADS HERE END -->
      
          
          <!-- COPY CODE BUTTON -->
  				<div class="form-button" style="text-align: center;">
    				<i class="fa fa-check" aria-hidden="true" id="output-copied" style="color: #009CDF;"></i>
  					<a href="#"><input class="btn" data-clipboard-target="#output" type="submit" name="submit" id="submit" value="Copy to Clipboard"></a>
  				</div>
  				<!-- COPY CODE BUTTON END -->
          
          <!-- INSTALL INSTRUCTIONS BOX -->
  				<div class="warning-box">
  					<h3>
  						<span class="fa-stack fa-lg">
  							<i class="fa fa-code fa-stack-1x "></i>
  						</span>
  						Now you have successfully customized and copied the code above.
  					</h3>
  					<div class="warning-content">
  						<ul class="fa-ul" style="font-weight: 300;">
                <li><i class="fa-li fa fa-check"></i>Go into Admin &rarr; Channels &rarr; Emails &rarr; Auto-Acknowledgement &rarr; and click Add Theme.</li>
                <li><i class="fa-li fa fa-check"></i>Remove all the code from the HTML section, then paste the code on your clipboard into the HTML section.</li>
                <li><i class="fa-li fa fa-check"></i>Set this new Theme to be the Default via your <a style="font-size: 16px;" href="https://support.desk.com/customer/portal/articles/1374-sending-auto-acknowledgements?b_id=6346">Auto-Acknowledgement Rules</a></li>
  						</ul>
  					</div>
  				</div>
  				<!-- INSTALL INSTRUCTIONS BOX END -->
  				
        </div>
        <!-- OUTPUT WRAPPER ENDS --->
        
      </div>
			
		</div>
		
		<!-- MAIN BODY CONTENT END -->
	
	</div>
	<!-- RIGHT SIDE CONTENT END -->
	
	
	<!-- FOOTER JS SCRIPTS -->
		
		
		<!-- LOAD IN LAUNCHBAR JS -->
		<script src="https://desk-toolbox.herokuapp.com/sidebar.js"></script>
		
		<!-- COLOR PICKER -->
		<script>
      
      $('#bg-color').ColorPicker({
          color: '#fbfbfb',
          livePreview: true,
          onShow: function (colpkr) {
          $(colpkr).fadeIn(100);
          return false;
	      },
        onHide: function (colpkr) {
          $(colpkr).fadeOut(100);
          return false;
	      },
        onChange: function (hsb, hex, rgb, el) {
          $(el).val(hex);
          $('#bg-color').val(hex);
          $('#bg-color').css('backgroundColor', '#' + hex);
          $(".aa-wrapper").css("background-color", '#' + hex);
          $(".browser-window").css("background-color", '#' + hex); 
	      },
	      onSubmit: function(hsb, hex, rgb, el) {
          $(el).val(hex);
          $(el).ColorPickerHide();
	      }
      });
      
      $('#box-color').ColorPicker({
          color: '#ffffff',
          livePreview: true,
          onShow: function (colpkr) {
          $(colpkr).fadeIn(100);
          return false;
	      },
        onHide: function (colpkr) {
          $(colpkr).fadeOut(100);
          return false;
	      },
        onChange: function (hsb, hex, rgb, el) {
          $(el).val(hex);
          $('#box-color').val(hex);
          $('#box-color').css('backgroundColor', '#' + hex);
          $(".one-column").css("background-color", '#' + hex); 
	      },
	      onSubmit: function(hsb, hex, rgb, el) {
          $(el).val(hex);
          $(el).ColorPickerHide();
	      }
      }); 
      
      $('#text-color').ColorPicker({
          color: '#565656',
          onShow: function (colpkr) {
          $(colpkr).fadeIn(100);
          return false;
	      },
        onHide: function (colpkr) {
          $(colpkr).fadeOut(100);
          return false;
	      },
        onChange: function (hsb, hex, rgb, el) {
          $(el).val(hex);
          $('#text-color').val(hex);
          $(".aa-snippet-color").css("color", '#' + hex);
          $("#text-color").css("background-color", '#' + hex);
	      },
	      onSubmit: function(hsb, hex, rgb, el) {
          $(el).val(hex);
          $(el).ColorPickerHide();
	      }
      });
      
      $('#head-color').ColorPicker({
          color: '#999999',
          onShow: function (colpkr) {
          $(colpkr).fadeIn(100);
          return false;
	      },
	      onBeforeShow: function () {
          $(this).ColorPickerSetColor(this.value);
	      },
        onHide: function (colpkr) {
          $(colpkr).fadeOut(100);
          return false;
	      },
        onChange: function (hsb, hex, rgb, el) {
          $(el).val(hex);
          $('#head-color').val(hex);
          $('.aa-header-font').css('color', '#' + hex);
          $("#head-color").css("background-color", '#' + hex);         
	      },
	      onSubmit: function(hsb, hex, rgb, el) {
          $(el).val(hex);
          $(el).ColorPickerHide();  
	      }
      });
      
      
      
      $('#hr-color').ColorPicker({
          color: '#e9e9e9',
          onShow: function (colpkr) {
          $(colpkr).fadeIn(100);
          return false;
	      },
	      onBeforeShow: function () {
          $(this).ColorPickerSetColor(this.value);
	      },
        onHide: function (colpkr) {
          $(colpkr).fadeOut(100);
          return false;
	      },
        onChange: function (hsb, hex, rgb, el) {
          $(el).val(hex);
          $('#hr-color').val(hex);
          $('.border').css('background-color', '#' + hex);
          $("#hr-color").css("background-color", '#' + hex);
        },
	      onSubmit: function(hsb, hex, rgb, el) {
          $(el).val(hex);
          $(el).ColorPickerHide(); 
	      }
      });
      
      
      </script>
      
      
      <!-- COPY OUTPUT TO CLIPBOARD -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.6.0/clipboard.min.js"></script>
      
      <!-- GENERATE CODE AND MORE -->
      <script>
        
        $('.generate-code').on('click', function(e){
          e.preventDefault();
          $('.loading-image').hide();
          $(document.body).addClass('busy');
          $('#output-wrapper').fadeToggle('fast');
          
          // VARIABLES THAT PULL THE CURRENT FIELD VALUES AND PUT THEM INTO A STRING
          headColor = $("#head-color").val();
          textColor = $("#text-color").val();
          bgColor = $("#bg-color").val();
          boxColor = $("#box-color").val();
          imgUrl = $("#imgUrl").val();
          hrColor = $("#hr-color").val();
          logoAlign = $('.logo-align-storage').val();
          logoSize = $('.logo-size-storage').val();
          gravatar = $(".gravatar-storage").val();
          gravatarCust = $(".gravatar-cust-storage").val();
          caseID = $(".caseid-storage").val();
          dateFormat = $(".date-format").val();
          string = 'body';
          yeah = "<!DOCTYPE html PUBLIC \"-\/\/W3C\/\/DTD XHTML 1.0 Transitional\/\/EN\" \"http:\/\/www.w3.org\/TR\/xhtml1\/DTD\/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http:\/\/www.w3.org\/1999\/xhtml\">\r\n\t<head>\r\n    <meta http-equiv=\"Content-Type\" content=\"text\/html; charset=utf-8\" \/>\r\n\t\t<style type=\"text\/css\">\r\nbody {\r\n  margin: 0;\r\n  mso-line-height-rule: exactly;\r\n  padding: 0;\r\n  min-width: 100%;\r\n}\r\ntable {\r\n  border-collapse: collapse;\r\n  border-spacing: 0;\r\n}\r\ntd {\r\n  padding: 0;\r\n  vertical-align: top;\r\n}\r\n.spacer,\r\n.border {\r\n  font-size: 1px;\r\n  line-height: 1px;\r\n}\r\n.spacer {\r\n  width: 100%;\r\n}\r\nimg {\r\n  border: 0;\r\n  -ms-interpolation-mode: bicubic;\r\n}\r\n.image {\r\n  font-size: 12px;\r\n  Margin-bottom: 24px;\r\n  mso-line-height-rule: at-least;\r\n}\r\n.image img {\r\n  display: block;\r\n}\r\n.aa-logo {\r\n  mso-line-height-rule: at-least;\r\n}\r\n.aa-logo img {\r\n  display: block;\r\n}\r\nstrong {\r\n  font-weight: bold;\r\n}\r\nh1,\r\nh2,\r\nh3,\r\np,\r\nol,\r\nul,\r\nli {\r\n  Margin-top: 0;\r\n  border-bottom: none!important;\r\n}\r\nol,\r\nul,\r\nli {\r\n  padding-left: 0;\r\n}\r\nblockquote {\r\n  Margin-top: 0;\r\n  Margin-right: 0;\r\n  Margin-bottom: 0;\r\n  padding-right: 0;\r\n}\r\n.column-top {\r\n  font-size: 32px;\r\n  line-height: 32px;\r\n}\r\n.column-bottom {\r\n  font-size: 8px;\r\n  line-height: 8px;\r\n}\r\n.column {\r\n  text-align: left;\r\n}\r\n.aa-contents {\r\n  table-layout: fixed;\r\n  width: 100%;\r\n}\r\n.padded {\r\n  padding-left: 32px;\r\n  padding-right: 32px;\r\n  word-break: break-word;\r\n  word-wrap: break-word;\r\n}\r\n.aa-wrapper {\r\n  display: table;\r\n  table-layout: fixed;\r\n  width: 100%;\r\n  min-width: 620px;\r\n  -webkit-text-size-adjust: 100%;\r\n  -ms-text-size-adjust: 100%;\r\n}\r\ntable.aa-wrapper {\r\n  table-layout: fixed;\r\n}\r\n.one-column,\r\n.two-column,\r\n.three-col {\r\n  Margin-left: auto;\r\n  Margin-right: auto;\r\n  width: 600px;\r\n}\r\n.centered {\r\n  Margin-left: auto;\r\n  Margin-right: auto;\r\n}\r\n\r\n@media only screen and (min-width: 0) {\r\n  .aa-wrapper {\r\n    text-rendering: optimizeLegibility;\r\n  }\r\n}\r\n@media only screen and (max-width: 620px) {\r\n  [class=aa-wrapper] {\r\n    min-width: 318px !important;\r\n    width: 100% !important;\r\n  }\r\n  [class=aa-wrapper] .one-column,\r\n  [class=aa-wrapper] .two-column,\r\n  [class=aa-wrapper] .three-col {\r\n    width: 318px !important;\r\n  }\r\n  [class=aa-wrapper] .column,\r\n  [class=aa-wrapper] .gutter {\r\n    display: block;\r\n    float: left;\r\n    width: 318px !important;\r\n  }\r\n  [class=aa-wrapper] .padded {\r\n    padding-left: 32px !important;\r\n    padding-right: 32px !important;\r\n  }\r\n  [class=aa-wrapper] .block {\r\n    display: block !important;\r\n  }\r\n  [class=aa-wrapper] .hide {\r\n    display: none !important;\r\n  }\r\n  [class=aa-wrapper] .image {\r\n    margin-bottom: 24px !important;\r\n  }\r\n  [class=aa-wrapper] .image img {\r\n    height: auto !important;\r\n    width: 100% !important;\r\n  }\r\n}\r\n.aa-wrapper h1 {\r\n  font-weight: 700;\r\n}\r\n.aa-wrapper h2 {\r\n  font-style: italic;\r\n  font-weight: normal;\r\n}\r\n.aa-wrapper h3 {\r\n  font-weight: normal;\r\n}\r\n.one-column blockquote,\r\n.two-column blockquote,\r\n.three-col blockquote {\r\n  font-style: italic;\r\n}\r\n.one-column-feature h1 {\r\n  font-weight: normal;\r\n}\r\n.one-column-feature h2 {\r\n  font-style: normal;\r\n  font-weight: bold;\r\n}\r\n.one-column-feature h3 {\r\n  font-style: italic;\r\n}\r\ntd.border {\r\n  width: 1px;\r\n}\r\ntr.border {\r\n  background-color: #"+hrColor+";\r\n  height: 1px;\r\n}\r\ntr.border td {\r\n  line-height: 1px;\r\n}\r\n.one-column,\r\n.two-column,\r\n.three-col,\r\n.one-column-feature {\r\n  background-color: #"+boxColor+";\r\n  font-size: 14px;\r\n  table-layout: fixed;\r\n}\r\n.one-column,\r\n.two-column,\r\n.three-col,\r\n.one-column-feature,\r\n.aa-preaa-header,\r\n.aa-header,\r\n.footer {\r\n  Margin-left: auto;\r\n  Margin-right: auto;\r\n}\r\n.aa-preaa-header table {\r\n  width: 602px;\r\n}\r\n.aa-preaa-header .aa-title,\r\n.aa-preaa-header .webversion {\r\n  padding-top: 10px;\r\n  padding-bottom: 12px;\r\n  font-size: 12px;\r\n  line-height: 21px;\r\n}\r\n.aa-preaa-header .aa-title {\r\n  text-align: left;\r\n}\r\n.aa-preaa-header .webversion {\r\n  text-align: right;\r\n  width: 300px;\r\n}\r\n.aa-header {\r\n  width: 602px;\r\n}\r\n.aa-header .aa-logo {\r\n  padding: 32px 0;\r\n}\r\n.aa-header .aa-logo div {\r\n  font-size: 26px;\r\n  font-weight: 700;\r\n  letter-spacing: -0.02em;\r\n  line-height: 32px;\r\n}\r\n.aa-header .aa-logo div a {\r\n  text-decoration: none;\r\n}\r\n.aa-header .aa-logo div.aa-logo-center {\r\n  text-align: center;\r\n}\r\n.aa-header .aa-logo div.aa-logo-center img {\r\n  Margin-left: auto;\r\n  Margin-right: auto;\r\n}\r\n.gmail {\r\n  width: 650px;\r\n  min-width: 650px;\r\n}\r\n.gmail td {\r\n  font-size: 1px;\r\n  line-height: 1px;\r\n}\r\n.aa-wrapper a {\r\n  text-decoration: underline;\r\n  transition: all .2s;\r\n}\r\n.aa-wrapper h1 {\r\n  font-size: 36px;\r\n  Margin-bottom: 18px;\r\n}\r\n.aa-wrapper h2 {\r\n  font-size: 26px;\r\n  line-height: 32px;\r\n  Margin-bottom: 20px;\r\n}\r\n.aa-wrapper h3 {\r\n  font-size: 18px;\r\n  line-height: 22px;\r\n  Margin-bottom: 16px;\r\n}\r\n.aa-wrapper h1 a,\r\n.aa-wrapper h2 a,\r\n.aa-wrapper h3 a {\r\n  text-decoration: none;\r\n}\r\n.one-column blockquote,\r\n.two-column blockquote,\r\n.three-col blockquote {\r\n  font-size: 14px;\r\n  border-left: 2px solid #e9e9e9;\r\n  Margin-left: 0;\r\n  padding-left: 16px;\r\n}\r\ntable.divider {\r\n  width: 100%;\r\n}\r\n.divider .inner {\r\n  padding-bottom: 24px;\r\n}\r\n.divider table {\r\n  background-color: #e9e9e9;\r\n  font-size: 2px;\r\n  line-height: 2px;\r\n  width: 60px;\r\n}\r\n.aa-wrapper .gray {\r\n  background-color: #f7f7f7;\r\n}\r\n.aa-wrapper .gray blockquote {\r\n  border-left-color: #dddddd;\r\n}\r\n.aa-wrapper .gray .divider table {\r\n  background-color: #dddddd;\r\n}\r\n.padded .image {\r\n  font-size: 0;\r\n}\r\n.image-frame {\r\n  padding: 8px;\r\n}\r\n.image-background {\r\n  display: inline-block;\r\n  font-size: 12px;\r\n}\r\n.btn {\r\n  Margin-bottom: 24px;\r\n  padding: 2px;\r\n}\r\n.btn a {\r\n  border: 1px solid #ffffff;\r\n  display: inline-block;\r\n  font-size: 13px;\r\n  font-weight: bold;\r\n  line-height: 15px;\r\n  outline-style: solid;\r\n  outline-width: 2px;\r\n  padding: 10px 30px;\r\n  text-align: center;\r\n  text-decoration: none !important;\r\n}\r\n\r\n.one-column-feature .column-top {\r\n  font-size: 36px;\r\n  line-height: 36px;\r\n}\r\n.one-column-feature .column-bottom {\r\n  font-size: 4px;\r\n  line-height: 4px;\r\n}\r\n.one-column-feature .column {\r\n  text-align: center;\r\n  width: 600px;\r\n}\r\n.one-column-feature .image {\r\n  Margin-bottom: 32px;\r\n}\r\n.one-column-feature .column table:nth-last-child(2) td h1:last-child,\r\n.one-column-feature .column table:nth-last-child(2) td h2:last-child,\r\n.one-column-feature .column table:nth-last-child(2) td h3:last-child,\r\n.one-column-feature .column table:nth-last-child(2) td p:last-child,\r\n.one-column-feature .column table:nth-last-child(2) td ol:last-child,\r\n.one-column-feature .column table:nth-last-child(2) td ul:last-child {\r\n  Margin-bottom: 32px;\r\n}\r\n.one-column-feature h1,\r\n.one-column-feature h2,\r\n.one-column-feature h3 {\r\n  text-align: center;\r\n}\r\n.one-column-feature h1 {\r\n  font-size: 52px;\r\n  Margin-bottom: 22px;\r\n}\r\n.one-column-feature h2 {\r\n  font-size: 42px;\r\n  Margin-bottom: 20px;\r\n}\r\n.one-column-feature h3 {\r\n  font-size: 32px;\r\n  line-height: 42px;\r\n  Margin-bottom: 20px;\r\n}\r\n.one-column-feature p,\r\n.one-column-feature ol,\r\n.one-column-feature ul {\r\n  font-size: 21px;\r\n  line-height: 32px;\r\n  Margin-bottom: 32px;\r\n}\r\n.one-column-feature p a,\r\n.one-column-feature ol a,\r\n.one-column-feature ul a {\r\n  text-decoration: none;\r\n}\r\n.one-column-feature p {\r\n  text-align: center;\r\n}\r\n.one-column-feature ol,\r\n.one-column-feature ul {\r\n  Margin-left: 40px;\r\n  text-align: left;\r\n}\r\n.one-column-feature li {\r\n  padding-left: 3px;\r\n}\r\n.one-column-feature .btn {\r\n  Margin-bottom: 32px;\r\n  text-align: center;\r\n}\r\n.one-column-feature .divider .inner {\r\n  padding-bottom: 32px;\r\n}\r\n.one-column-feature blockquote {\r\n  border-bottom: 2px solid #e9e9e9;\r\n  border-left-color: #ffffff;\r\n  border-left-width: 0;\r\n  border-left-style: none;\r\n  border-top: 2px solid #e9e9e9;\r\n  Margin-bottom: 32px;\r\n  Margin-left: 0;\r\n  padding-bottom: 42px;\r\n  padding-left: 0;\r\n  padding-top: 42px;\r\n  position: relative;\r\n}\r\n.one-column-feature blockquote:before,\r\n.one-column-feature blockquote:after {\r\n  background: -moz-linear-gradient(left, #ffffff 25%, #e9e9e9 25%, #e9e9e9 75%, #ffffff 75%);\r\n  background: -webkit-gradient(linear, left top, right top, color-stop(25%, #ffffff), color-stop(25%, #e9e9e9), color-stop(75%, #e9e9e9), color-stop(75%, #ffffff));\r\n  background: -webkit-linear-gradient(left, #ffffff 25%, #e9e9e9 25%, #e9e9e9 75%, #ffffff 75%);\r\n  background: -o-linear-gradient(left, #ffffff 25%, #e9e9e9 25%, #e9e9e9 75%, #ffffff 75%);\r\n  background: -ms-linear-gradient(left, #ffffff 25%, #e9e9e9 25%, #e9e9e9 75%, #ffffff 75%);\r\n  background: linear-gradient(to right, #ffffff 25%, #e9e9e9 25%, #e9e9e9 75%, #ffffff 75%);\r\n  content: \'\';\r\n  display: block;\r\n  height: 2px;\r\n  left: 0;\r\n  outline: 1px solid #ffffff;\r\n  position: absolute;\r\n  right: 0;\r\n}\r\n.one-column-feature blockquote:before {\r\n  top: -2px;\r\n}\r\n.one-column-feature blockquote:after {\r\n  bottom: -2px;\r\n}\r\n.one-column-feature blockquote p,\r\n.one-column-feature blockquote ol,\r\n.one-column-feature blockquote ul {\r\n  font-size: 42px;\r\n  line-height: 48px;\r\n  Margin-bottom: 48px;\r\n}\r\n.one-column-feature blockquote p:last-child,\r\n.one-column-feature blockquote ol:last-child,\r\n.one-column-feature blockquote ul:last-child {\r\n  Margin-bottom: 0 !important;\r\n}\r\n.footer {\r\n  width: 602px;\r\n}\r\n.footer .padded {\r\n  font-size: 12px;\r\n  line-height: 20px;\r\n}\r\n\r\n@media only screen and (max-width: 651px) {\r\n  .gmail {\r\n    display: none !important;\r\n  }\r\n}\r\n@media only screen and (max-width: 620px) {\r\n  [class=aa-wrapper] .one-column .column:last-child table:nth-last-child(2) td h1:last-child,\r\n  [class=aa-wrapper] .two-column .column:last-child table:nth-last-child(2) td h1:last-child,\r\n  [class=aa-wrapper] .three-col .column:last-child table:nth-last-child(2) td h1:last-child,\r\n  [class=aa-wrapper] .one-column-feature .column:last-child table:nth-last-child(2) td h1:last-child,\r\n  [class=aa-wrapper] .one-column .column:last-child table:nth-last-child(2) td h2:last-child,\r\n  [class=aa-wrapper] .two-column .column:last-child table:nth-last-child(2) td h2:last-child,\r\n  [class=aa-wrapper] .three-col .column:last-child table:nth-last-child(2) td h2:last-child,\r\n  [class=aa-wrapper] .one-column-feature .column:last-child table:nth-last-child(2) td h2:last-child,\r\n  [class=aa-wrapper] .one-column .column:last-child table:nth-last-child(2) td h3:last-child,\r\n  [class=aa-wrapper] .two-column .column:last-child table:nth-last-child(2) td h3:last-child,\r\n  [class=aa-wrapper] .three-col .column:last-child table:nth-last-child(2) td h3:last-child,\r\n  [class=aa-wrapper] .one-column-feature .column:last-child table:nth-last-child(2) td h3:last-child,\r\n  [class=aa-wrapper] .one-column .column:last-child table:nth-last-child(2) td p:last-child,\r\n  [class=aa-wrapper] .two-column .column:last-child table:nth-last-child(2) td p:last-child,\r\n  [class=aa-wrapper] .three-col .column:last-child table:nth-last-child(2) td p:last-child,\r\n  [class=aa-wrapper] .one-column-feature .column:last-child table:nth-last-child(2) td p:last-child,\r\n  [class=aa-wrapper] .one-column .column:last-child table:nth-last-child(2) td ol:last-child,\r\n  [class=aa-wrapper] .two-column .column:last-child table:nth-last-child(2) td ol:last-child,\r\n  [class=aa-wrapper] .three-col .column:last-child table:nth-last-child(2) td ol:last-child,\r\n  [class=aa-wrapper] .one-column-feature .column:last-child table:nth-last-child(2) td ol:last-child,\r\n  [class=aa-wrapper] .one-column .column:last-child table:nth-last-child(2) td ul:last-child,\r\n  [class=aa-wrapper] .two-column .column:last-child table:nth-last-child(2) td ul:last-child,\r\n  [class=aa-wrapper] .three-col .column:last-child table:nth-last-child(2) td ul:last-child,\r\n  [class=aa-wrapper] .one-column-feature .column:last-child table:nth-last-child(2) td ul:last-child {\r\n    Margin-bottom: 24px !important;\r\n  }\r\n  [class=aa-wrapper] .address,\r\n  [class=aa-wrapper] .subscription {\r\n    display: block;\r\n    float: left;\r\n    width: 318px !important;\r\n    text-align: center !important;\r\n  }\r\n  [class=aa-wrapper] .address {\r\n    padding-bottom: 0 !important;\r\n  }\r\n  [class=aa-wrapper] .subscription {\r\n    padding-top: 0 !important;\r\n  }\r\n  [class=aa-wrapper] h1 {\r\n    font-size: 36px !important;\r\n    line-height: 42px !important;\r\n    Margin-bottom: 18px !important;\r\n  }\r\n  [class=aa-wrapper] h2 {\r\n    font-size: 26px !important;\r\n    line-height: 32px !important;\r\n    Margin-bottom: 20px !important;\r\n  }\r\n  [class=aa-wrapper] h3 {\r\n    font-size: 18px !important;\r\n    line-height: 22px !important;\r\n    Margin-bottom: 16px !important;\r\n  }\r\n  [class=aa-wrapper] p,\r\n  [class=aa-wrapper] ol,\r\n  [class=aa-wrapper] ul {\r\n    font-size: 16px !important;\r\n    line-height: 24px !important;\r\n    Margin-bottom: 24px !important;\r\n  }\r\n  [class=aa-wrapper] ol,\r\n  [class=aa-wrapper] ul {\r\n    Margin-left: 18px !important;\r\n  }\r\n  [class=aa-wrapper] li {\r\n    padding-left: 2px !important;\r\n  }\r\n  [class=aa-wrapper] blockquote {\r\n    padding-left: 16px !important;\r\n  }\r\n  [class=aa-wrapper] .two-column .column:nth-child(n + 3) {\r\n    border-top: 1px solid #e9e9e9;\r\n  }\r\n  [class=aa-wrapper] .btn {\r\n    margin-bottom: 24px !important;\r\n  }\r\n  [class=aa-wrapper] .btn a {\r\n    display: block !important;\r\n    font-size: 13px !important;\r\n    font-weight: bold !important;\r\n    line-height: 15px !important;\r\n    padding: 10px 30px !important;\r\n  }\r\n  [class=aa-wrapper] .column-bottom {\r\n    font-size: 8px !important;\r\n    line-height: 8px !important;\r\n  }\r\n  [class=aa-wrapper] .first .column-bottom,\r\n  [class=aa-wrapper] .three-col .second .column-bottom {\r\n    display: none;\r\n  }\r\n  [class=aa-wrapper] .second .column-top,\r\n  [class=aa-wrapper] .third .column-top {\r\n    display: none;\r\n  }\r\n  [class=aa-wrapper] .image-frame {\r\n    padding: 4px !important;\r\n  }\r\n  [class=aa-wrapper] .aa-header .aa-logo {\r\n    padding-left: 10px !important;\r\n    padding-right: 10px !important;\r\n  }\r\n  [class=aa-wrapper] .aa-header .aa-logo div {\r\n    font-size: 26px !important;\r\n    line-height: 32px !important;\r\n  }\r\n  [class=aa-wrapper] .aa-header .aa-logo div img {\r\n    display: inline-block !important;\r\n    max-width: 280px !important;\r\n    height: auto !important;\r\n  }\r\n  [class=aa-wrapper] table.border,\r\n  [class=aa-wrapper] .aa-header,\r\n  [class=aa-wrapper] .webversion,\r\n  [class=aa-wrapper] .footer {\r\n    width: 320px !important;\r\n  }\r\n  [class=aa-wrapper] .aa-preaa-header .webversion,\r\n  [class=aa-wrapper] .aa-header .aa-logo a {\r\n    text-align: center !important;\r\n  }\r\n  [class=aa-wrapper] .aa-preaa-header table,\r\n  [class=aa-wrapper] .border td {\r\n    width: 318px !important;\r\n  }\r\n  [class=aa-wrapper] .border td.border {\r\n    width: 1px !important;\r\n  }\r\n  [class=aa-wrapper] .image .border td {\r\n    width: auto !important;\r\n  }\r\n  [class=aa-wrapper] .aa-title {\r\n    display: none;\r\n  }\r\n  [class=aa-wrapper] .footer .padded {\r\n    text-align: center !important;\r\n  }\r\n  [class=aa-wrapper] .footer .subscription .padded {\r\n    padding-top: 20px !important;\r\n  }\r\n  [class=aa-wrapper] .footer .social-link {\r\n    display: block !important;\r\n  }\r\n  [class=aa-wrapper] .footer .social-link table {\r\n    margin: 0 auto 10px !important;\r\n  }\r\n  [class=aa-wrapper] .footer .divider {\r\n    display: none !important;\r\n  }\r\n  [class=aa-wrapper] .one-column-feature .btn {\r\n    margin-bottom: 28px !important;\r\n  }\r\n  [class=aa-wrapper] .one-column-feature .image {\r\n    margin-bottom: 28px !important;\r\n  }\r\n  [class=aa-wrapper] .one-column-feature .divider .inner {\r\n    padding-bottom: 28px !important;\r\n  }\r\n  [class=aa-wrapper] .one-column-feature h1 {\r\n    font-size: 42px !important;\r\n    line-height: 48px !important;\r\n    margin-bottom: 20px !important;\r\n  }\r\n  [class=aa-wrapper] .one-column-feature h2 {\r\n    font-size: 32px !important;\r\n    line-height: 36px !important;\r\n    margin-bottom: 18px !important;\r\n  }\r\n  [class=aa-wrapper] .one-column-feature h3 {\r\n    font-size: 26px !important;\r\n    line-height: 32px !important;\r\n    margin-bottom: 20px !important;\r\n  }\r\n  [class=aa-wrapper] .one-column-feature p,\r\n  [class=aa-wrapper] .one-column-feature ol,\r\n  [class=aa-wrapper] .one-column-feature ul {\r\n    font-size: 20px !important;\r\n    line-height: 28px !important;\r\n    margin-bottom: 28px !important;\r\n  }\r\n  [class=aa-wrapper] .one-column-feature blockquote {\r\n    font-size: 18px !important;\r\n    line-height: 26px !important;\r\n    margin-bottom: 28px !important;\r\n    padding-bottom: 26px !important;\r\n    padding-left: 0 !important;\r\n    padding-top: 26px !important;\r\n  }\r\n  [class=aa-wrapper] .one-column-feature blockquote p,\r\n  [class=aa-wrapper] .one-column-feature blockquote ol,\r\n  [class=aa-wrapper] .one-column-feature blockquote ul {\r\n    font-size: 26px !important;\r\n    line-height: 32px !important;\r\n  }\r\n  [class=aa-wrapper] .one-column-feature blockquote p:last-child,\r\n  [class=aa-wrapper] .one-column-feature blockquote ol:last-child,\r\n  [class=aa-wrapper] .one-column-feature blockquote ul:last-child {\r\n    margin-bottom: 0 !important;\r\n  }\r\n  [class=aa-wrapper] .one-column-feature .column table:last-of-type h1:last-child,\r\n  [class=aa-wrapper] .one-column-feature .column table:last-of-type h2:last-child,\r\n  [class=aa-wrapper] .one-column-feature .column table:last-of-type h3:last-child {\r\n    margin-bottom: 28px !important;\r\n  }\r\n}\r\n@media only screen and (max-width: 320px) {\r\n  [class=aa-wrapper] td.border {\r\n    display: none;\r\n  }\r\n  [class=aa-wrapper] table.border,\r\n  [class=aa-wrapper] .aa-header,\r\n  [class=aa-wrapper] .webversion,\r\n  [class=aa-wrapper] .footer {\r\n    width: 318px !important;\r\n  }\r\n}\r\n<\/style>\r\n\t\t\t\r\n\t\t\t<!--[if gte mso 9]>\r\n\t\t\t\t<style>\r\n\t\t\t\t\t.column-top {\r\n\t\t\t\t\t\tmso-line-height-rule: exactly !important;\r\n\t\t\t\t\t}\r\n\t\t\t\t<\/style>\r\n\t\t\t<![endif]-->\r\n\t\t\t\r\n\t\t<meta name=\"robots\" content=\"noindex,nofollow\" \/>\r\n\t<\/head>\r\n\r\n  <body style=\"margin: 0;mso-line-height-rule: exactly;padding: 0;min-width: 100%;background-color: #fbfbfb\">\r\n  \t\r\n  \t<!-- INLINE STYLESHEET -->\r\n  \t<style type=\"text\/css\">\r\n  \t\tbody,.aa-wrapper,.emb-editor-canvas{background-color:#"+bgColor+"}.border{background-color:#"+hrColor+"}h1{color:#565656}.aa-wrapper h1{}.aa-wrapper h1{font-family:sans-serif}\r\n  \t\t@media only screen and (min-width: 0){.aa-wrapper h1{font-family:Avenir,sans-serif !important}}h1{}.one-column h1{line-height:42px}.two-column h1{line-height:32px}.three-col h1{line-height:26px}.aa-wrapper .one-column-feature h1{line-height:58px}\r\n  \t\t@media only screen and (max-width: 620px){h1{line-height:42px !important}}h2{color:#555}.aa-wrapper h2{}.aa-wrapper h2{font-family:Georgia,serif}h2{}.one-column h2{line-height:32px}.two-column h2{line-height:26px}.three-col h2{line-height:22px}.aa-wrapper .one-column-feature h2{line-height:52px}\r\n  \t\t@media only screen and (max-width: 620px){h2{line-height:32px !important}}h3{color:#555}.aa-wrapper h3{}.aa-wrapper h3{font-family:Georgia,serif}h3{}.one-column h3{line-height:26px}.two-column h3{line-height:22px}.three-col \r\n  h3{line-height:20px}.aa-wrapper .one-column-feature h3{line-height:42px}\r\n    @media only screen and (max-width: 620px){h3{line-height:26px !important}}p,ol,ul{color:#565656}.aa-wrapper p,.aa-wrapper ol,.aa-wrapper ul{}.aa-wrapper p,.aa-wrapper ol,.aa-wrapper ul{font-family:Georgia,serif}p,ol,ul{}.one-column p,.one-column ol,.one-column ul{line-height:25px;Margin-bottom:25px}.two-column p,.two-column ol,.two-column ul{line-height:23px;Margin-bottom:23px}.three-col p,.three-col ol,.three-col ul{line-height:21px;Margin-bottom:21px}.aa-wrapper .one-column-feature p,.aa-wrapper .one-column-feature ol,.aa-wrapper .one-column-feature ul{line-height:32px}.one-column-feature blockquote p,.one-column-feature blockquote ol,.one-column-feature blockquote ul{line-height:50px}\r\n    @media only screen and (max-width: 620px){p,ol,ul{line-height:25px !important;Margin-bottom:25px !important}}.image{color:#565656}.image{font-family:Georgia,serif}.aa-wrapper a{color:#41637e}.aa-wrapper \r\n  a:hover{color:#30495c !important}.aa-wrapper .aa-logo div{color:#41637e}.aa-wrapper .aa-logo div{font-family:sans-serif}  \r\n    @media only screen and (min-width: 0){.aa-wrapper .aa-logo div{font-family:Avenir,sans-serif !important}}.aa-wrapper .aa-logo div a{color:#41637e}.aa-wrapper .aa-logo div a:hover{color:#41637e !important}.aa-wrapper .one-column-feature p a,.aa-wrapper .one-column-feature ol a,.aa-wrapper .one-column-feature ul a{border-bottom:1px solid #41637e}.aa-wrapper .one-column-feature p a:hover,.aa-wrapper .one-column-feature ol a:hover,.aa-wrapper .one-column-feature ul a:hover{color:#30495c !important;border-bottom:1px solid #30495c !important}.btn a{}.aa-wrapper .btn a{}.aa-wrapper .btn a{font-family:Georgia,serif}.aa-wrapper .btn a{background-color:#41637e;color:#fff !important;outline-color:#41637e;text-shadow:0 1px 0 #3b5971}.aa-wrapper .btn a:hover{background-color:#3b5971 !important;color:#fff !important;outline-color:#3b5971 !important}.aa-preaa-header \r\n.aa-title,.aa-preaa-header .webversion,.footer .padded{color:#999}.aa-preaa-header .aa-title,.aa-preaa-header .webversion,.footer .padded{font-family:Georgia,serif}.aa-preaa-header .aa-title a,.aa-preaa-header .webversion a,.footer .padded a{color:#999}.aa-preaa-header .aa-title a:hover,.aa-preaa-header .webversion a:hover,.footer .padded a:hover{color:#737373 !important}.footer .social .divider{color:#e9e9e9}.footer .social .social-text,.footer .social a{color:#999}.aa-wrapper .footer .social .social-text,.aa-wrapper .footer .social a{}.aa-wrapper .footer .social .social-text,.aa-wrapper .footer .social a{font-family:Georgia,serif}.footer .social .social-text,.footer .social a{}.footer .social .social-text,.footer .social a{letter-spacing:0.05em}.footer .social .social-text:hover,.footer .social a:hover{color:#737373 !important}.image .border{background-color:#"+hrColor+"}.image-frame{background-color:#dadada}.image-background{background-color:#f7f7f7}\r\n  \t<\/style>\r\n  \t<!-- INLINE STYLESHEET ENDS -->\r\n    \r\n    <!-- CENTER AA CONTENT -->\r\n    <center class=\"aa-wrapper\" id=\"backgroundColor\" style=\"display: table;table-layout: fixed;width: 100%;min-width: 620px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;background-color: #"+bgColor+"; padding-bottom: 56px;\">\r\n      \r\n      <!-- GMAIL SPACER -->\r\n    \t<table class=\"gmail\" style=\"border-collapse: collapse;border-spacing: 0;width: 650px;min-width: 650px\">\r\n      \t<tbody>\r\n        \t<tr>\r\n          \t<td style=\"padding: 0;vertical-align: top;font-size: 1px;line-height: 1px;\">&nbsp;<\/td>\r\n          <\/tr>\r\n        <\/tbody>\r\n      <\/table>\r\n      <!-- GMAIL SPACER -->\r\n    \t\r\n    \t<!-- SUBJECT AND CASE ID aa-header -->\r\n      <table class=\"aa-preaa-header centered\" style=\"border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto\">\r\n        <tbody>\r\n\t        <tr>\r\n            <td style=\"padding: 0;vertical-align: top\">\r\n            \t<table style=\"border-collapse: collapse;border-spacing: 0;width: 602px\">\r\n                <tbody>\r\n                  <tr>\r\n                    <td class=\"aa-title aa-header-font\" style=\"padding: 0;vertical-align: top;padding-top: 10px;padding-bottom: 12px;font-size: 12px;line-height: 21px;text-align: left;color: #"+headColor+";font-family: sans-serif\"><strong>Re: {{case.subject}}<\/strong>\r\n                    <\/td>\r\n                \r\n                    <td class=\"webversion aa-header-font\" style=\"padding: 0;vertical-align: top;padding-top: 10px;padding-bottom: 12px;font-size: 12px;line-height: 21px;text-align: right;width: 300px;color: #"+headColor+";font-family: sans-serif\">\r\n  \t                Case ID: {{case.id}}\r\n                    <\/td>\r\n                  <\/tr>\r\n                <\/tbody>\r\n              <\/table>\r\n            <\/td>\r\n          <\/tr>\r\n        <\/tbody>\r\n      <\/table>\r\n      <!-- SUBJECT AND CASE ID aa-header ENDS -->\r\n      \r\n      <table class=\"aa-header centered\" style=\"border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto;width: 602px\">\r\n        <tbody>\r\n          <tr>\r\n            <td class=\"border\" style=\"padding: 0;vertical-align: top;font-size: 1px;line-height: 1px;width: 1px\">&nbsp;<\/td>\r\n          <\/tr>\r\n          <tr>\r\n            <td class=\"aa-logo\" style=\"padding: 32px 0;vertical-align: top;mso-line-height-rule: at-least\">\r\n              <div class=\"aa-logo-center\" style=\"font-size: 26px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: #41637e;font-family: sans-serif;text-align: center\" align=\"center\" id=\"emb-email-aa-header\">\r\n                <img style=\"border: 0;-ms-interpolation-mode: bicubic;display: block;Margin-left: auto;Margin-right: auto;max-width:"+logoSize+"\" src=\""+imgUrl+"\" alt=\"\" width=\"300\" \/>\r\n              <\/div>\r\n            <\/td>\r\n          <\/tr>\r\n        <\/tbody>\r\n      <\/table>\r\n      \r\n      <table class=\"border\" style=\"border-collapse: collapse;border-spacing: 0;font-size: 1px;line-height: 1px;background-color: #"+hrColor+";Margin-left: auto;Margin-right: auto\" width=\"602\">\r\n        <tbody>\r\n          <tr>\r\n            <td style=\"padding: 0;vertical-align: top\">&#8203;<\/td>\r\n          <\/tr>\r\n        <\/tbody>\r\n      <\/table>\r\n        \r\n      <table class=\"centered\" style=\"border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto\">\r\n        <tbody>\r\n          <tr>\r\n            <td class=\"border\" style=\"padding: 0;vertical-align: top;font-size: 1px;line-height: 1px;background-color: #"+hrColor+";width: 1px\">&#8203;<\/td>\r\n            <td style=\"padding: 0;vertical-align: top\">\r\n            \r\n            <table class=\"one-column\" style=\"border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto;width: 600px;background-color: #ffffff;font-size: 14px;table-layout: fixed\">\r\n              <tbody>\r\n                <tr>\r\n                  <td class=\"column\" style=\"padding: 0;vertical-align: top;text-align: left\">\r\n                    <div>\r\n                      <div class=\"column-top\" style=\"font-size: 32px;line-height: 32px\">&nbsp;<\/div>\r\n                    <\/div>\r\n                    \r\n                    <table class=\"aa-contents\" style=\"border-collapse: collapse;border-spacing: 0;table-layout: fixed;width: 100%\">\r\n                      <tbody>\r\n                        <tr>\r\n                          <td class=\"padded\" style=\"padding: 0;vertical-align: top;padding-left: 32px;padding-right: 32px;word-break: break-word;word-wrap: break-word\">\r\n                          \r\n                            <!-- AA CONTENT --> \r\n                            <h1 class=\"aa-snippet-color\" style=\"Margin-top: 0;color: #"+textColor+";font-weight: 700;font-size: 36px;Margin-bottom: 18px;font-family: sans-serif;line-height: 42px; padding-left: 0;\">\r\n                              We\'ve received your message and will be with you shortly.\r\n                            <\/h1>\r\n                            <p class=\"aa-snippet-color\" style=\"Margin-top: 0;color: #"+textColor+";font-family: sans-serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px\">\r\n                              {{system.snippets.auto_ack_message}}\r\n                            <\/p>\r\n                          <\/td>\r\n                        <\/tr>\r\n                      <\/tbody>\r\n                    <\/table>\r\n                      \r\n                    <div class=\"column-bottom\" style=\"font-size: 8px;line-height: 8px\">&nbsp;<\/div>\r\n                    \r\n                  <\/td>\r\n                <\/tr>\r\n                <\/tbody>\r\n              <\/table>\r\n              \r\n            <\/td>\r\n            \r\n            <td class=\"border\" style=\"padding: 0;vertical-align: top;font-size: 1px;line-height: 1px;background-color: #"+hrColor+";width: 1px\">&#8203;<\/td>\r\n          <\/tr>\r\n        <\/tbody>\r\n      <\/table>\r\n        \r\n      <table class=\"border\" style=\"border-collapse: collapse;border-spacing: 0;font-size: 1px;line-height: 1px;background-color: #"+hrColor+";Margin-left: auto;Margin-right: auto\" width=\"602\">\r\n        <tbody>\r\n          <tr>\r\n            <td style=\"padding: 0;vertical-align: top\">&#8203;<\/td>\r\n          <\/tr>\r\n        <\/tbody>\r\n      <\/table>\r\n        \r\n      <div class=\"spacer\" style=\"font-size: 1px;line-height: 32px;width: 100%\">&nbsp;<\/div>\r\n        \r\n    <\/center>\r\n    <!-- AA CENTER ENDS -->\r\n  \r\n  <\/body>\r\n<\/html>";
          
          // TAKES THE STRING ABOVE AND UPDATES THE OUTPUT VALUE
          $("#output").text(yeah);
          $('#output-copied').hide(); 
        });
        
        // CLOSES OUTPUT WRAPPER
        $('.close-output-wrapper').on('click', function(e){
          e.preventDefault();
          $('#output-wrapper').fadeOut('slow');
          $(document.body).removeClass('busy');
          $('.loading-image').show();
          $('.btn').val("Copy to Clipboard");
          $('.warning-box').slideUp('fast');
        });
        
        // OPEN AND CLOSE UPLOAD INSTRUCTIONS
        $('.imgur-box-open').click(function(){
          $('.imgur-box-open').fadeOut('fast');
          $('.imgur-box').slideToggle('fast');
        });
        
        $('.imgur-box-close').click(function(){
          $('.imgur-box-open').fadeIn('slow');
          $('.imgur-box').slideToggle('fast');
        });
        
        // STOPS PAGE FROM REFRESHING WHEN CLICKING BTN
        $('.btn').click(function(e) {
          e.preventDefault();
        });
        
        // CODE THAT CHECKS ON COPY AND RUNS FUNCTIONS WHEN SUCCESSFUL
        var clipboard = new Clipboard('.btn');
        
        clipboard.on('success', function() {
          
          $('.btn').val("Copied Successfully");
          $('#output-copied').slideDown('fast', function(){
            $('.btn').val("Copied Successfully", function(){
              $('.btn').delay(800).val("Copy to Clipboard");
            });
            
            $('.warning-box').delay(600).slideDown('slow', function() {
              $("html, body").animate({ scrollTop: $(document).height() }, "slow");
            });
          });
          
        });
        clipboard.on('error', function() {
          $('#output-copied').fadeIn('fast').text('Not Copied');
        }); 
      </script>
      
      <!-- UPLOAD IMAGE -->
      <script src="imgur/js/imgur.min.js"></script>
      
      <script>
        // CODE THAT UPLOADS IMAGE TO IMGUR AND RUNS FUNCTIONS WHEN SUCCESSFUL
        var callback = function (res) {
            if (res.success === true) {
                //console.log(res.data.link);
                
                $('.dropzone').slideUp('fast', function(){
                  $('.status').slideDown('slow', function(){
                    $('.align-toolbar').fadeIn('slow');
                  });
                });
                
                $('.subject-bar').slideDown('slow');
                $('#imgUrl').fadeIn('fast');
                
                document.querySelector('.status').classList.add('bg-success');
                document.querySelector('.status').innerHTML = '<img src="'+ res.data.link.replace('http://','https://') +'"/>';
                document.querySelector('.aa-logo-center').innerHTML = '<img src="'+ res.data.link.replace('http://','https://') +'" style="max-width:300px; height:auto;" />';
                document.querySelector('#imgUrl').classList.add('imgurl-success');
                
               
                $('#imgUrl').val(res.data.link.replace('http://','https://'));
            }
        };
        
        // IMGUR API INFO
        new Imgur({
            clientid: '5566b95d1fa2c3c',
            callback: callback
        });
        
      </script>
      
      	<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		
		  ga('create', 'UA-10299982-25', 'auto');
		  ga('send', 'pageview');
		
		</script>
	
	<!-- FOOTER JS END -->

</body>
</html>