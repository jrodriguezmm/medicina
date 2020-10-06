<?php
/*-------------------------------------------------------------------------
# mod_improved_ajax_login - Improved AJAX Login and Register
# -------------------------------------------------------------------------
# @ author    Balint Polgarfi
# @ copyright Copyright (c) 2012-2019 Offlajn.com  All Rights Reserved.
# @ license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# @ website   http://www.offlajn.com
-------------------------------------------------------------------------*/
?><?php defined('_JEXEC') or die('Restricted access'); ?>

.strongFields {
	display: block;
	opacity: 0;
	overflow: hidden;
	height: 6px;
	position: absolute;
	margin; 0 0 -3px;
	left: 50%;
	margin-top: 4px;
	-webkit-transform: translateX(-50%);
	-moz-transform: translateX(-50%);
	transform: translateX(-50%);
	-webkit-transition: opacity 0.3s ease-out;
	-moz-transition: opacity 0.3s ease-out;
	transition: opacity 0.3s ease-out;
}
.strongFields .strongField.empty {
	background: #e8ecef;
}
.strongField.empty,
.strongField {
	display: block;
	background: #4CB906;
	width: 6px;
	height: 6px;
	margin-right: 3px;
	border-radius: 50%;
	float: left;
	-webkit-transition: background 0.5s ease-out;
	-moz-transition: background 0.5s ease-out;
	transition: background 0.5s ease-out;
}
.strongFields[data-level="0"] .strongField:not(.empty),
.strongFields[data-level="1"] .strongField:not(.empty) {
	background-color: #f20d42;
}
.strongFields[data-level="2"] .strongField:not(.empty),
.strongFields[data-level="3"] .strongField:not(.empty) {
	background-color: #f8c000;
}
.strongFields[data-level="4"] .strongField:not(.empty),
.strongFields[data-level="5"] .strongField:not(.empty) {
	background-color: #5dd900;
}
.ial-input-wrapper input:focus ~ .strongFields {
	opacity: 1;
}

.loginWndInside {
	position: relative;
	display: inline-block;
	background-color: <?php echo $popupcomb[0]?>;
	border: <?php echo $popupcomb[3]?>px solid <?php echo $popupcomb[2]?>;
	border-radius: <?php echo $popupcomb[5] ?>px;
	overflow: hidden;
	<?php if (preg_match('/\.(jpg|jpeg|png|gif)$/', $popupbg)): ?>
	background-image: linear-gradient(<?php echo $popupcomb[0]?>, <?php echo $popupcomb[0]?>), url('<?php echo rtrim(JURI::root(true), '/').preg_replace('~.*(/modules/)~', '$1', $popupbg) ?>');
	background-size: cover;
	background-position: <?php echo $bgposition ?>;
	<?php endif; ?>
}

.loginH3 {
	margin-top: 14px;
	<?php $fonts->printFont('titlefont', 'Text');?>
}

.ial-input-wrapper input:focus ~ .ial-load,
.ial-input-wrapper .ial-load {
	position: absolute;
	width: 100%;
	height: 3px;
	left: 0;
	bottom: -3px;
	background: <?php echo $btncomb[0] ?>;
	-webkit-transform-origin: 0 0;
	-moz-transform-origin: 0 0;
	transform-origin: 0 0;
	-webkit-transform: scaleX(0);
	-moz-transform: scaleX(0);
	transform: scaleX(0);
	-webkit-transition: transform 8s cubic-bezier(.19, 1, .22, 1);
	-moz-transition: transform 8s cubic-bezier(.19, 1, .22, 1);
	transition: transform 8s cubic-bezier(.19, 1, .22, 1);
}
.ial-input-wrapper .ial-load.ial-active {
	-webkit-transform: scaleX(0.8);
	-moz-transform: scaleX(0.8);
	transform: scaleX(0.8);
}
.ial-input-wrapper .ial-correct ~ .ial-load {
	-webkit-transition: transform 1s, opacity 1s;
	-moz-transition: transform 1s, opacity 1s;
	transition: transform 1s, opacity 1s;
	-webkit-transform: scaleX(1);
	-moz-transform: scaleX(1);
	transform: scaleX(1);
	opacity: 0;
}

.loginBtn .ial-load {
	position: absolute;
	top: 50%;
	left: 50%;
	margin: -4px -18px;
	-webkit-transform: translateY(-100px);
	-moz-transform: translateY(-100px);
	transform: translateY(-100px);
	-webkit-transition: transform 0.3s;
	-moz-transition: transform 0.3s;
	transition: transform 0.3s;
}
.loginBtn .ial-load i,
.loginBtn .ial-load::before,
.loginBtn .ial-load::after {
	content: '';
	display: block;
	float: left;
	width: 8px;
	height: 8px;
	margin: 0 2px;
	background: #<?php echo $btnfont['Text']['color'] ?>;
	border-radius: 50%;
	animation: pulse 1.8s infinite ease-in-out;
}
.loginBtn .ial-load i {
	animation-delay: -0.16s;
}
.loginBtn .ial-load::before {
	animation-delay: -0.32s;
}
.loginBtn .ial-load.ial-active {
	-webkit-transform: none;
	-moz-transform: none;
	transform: none;
}
.loginBtn span {
	-webkit-transform: none;
	-moz-transform: none;
	transform: none;
	-webkit-transition: transform 0.3s;
	-moz-transition: transform 0.3s;
	transition: transform 0.3s;
}
.loginBtn .ial-load.ial-active ~ span {
	-webkit-transform: translateY(100px);
	-moz-transform: translateY(100px);
	transform: translateY(100px);
}

@keyframes pulse {
	0%, 80%, 100% {
		transform: scale(0);
	}
	40% {
		transform: scale(1);
	}
}

a.logBtn.selectBtn:hover {
	background-color: transparent;
}
.selectBtn .loginBtn {
	white-space: nowrap;
}
.btnIco {
	display: block;
	float: left;
	background: transparent no-repeat 1px center;
	width: 22px;
}

.ial-socials {
	background: <?php echo $socialbg?>;
	text-align: center;
	margin-left: 0 !important;
	margin-right: 0 !important;
	padding: 15px <?php echo $popupcomb[1]+10?>px;
}
.socialIco-wrapper {
	display: inline-block;
	padding: 5px;
}
.ial-oauths::after {
	content: '';
	display: block;
	height: 0;
	clear: both;
}
.ial-oauths .socialIco-wrapper {
	padding: 0;
}
.ial-col1 .socialIco-wrapper,
.ial-col2 .socialIco-wrapper {
	width: 40%;
}
.ial-col3 .socialIco-wrapper {
	width: 28%;
}

.ial-socials.ial-col5{
	padding: 15px 0px;
}

.ial-socials .socialIco {
	position: relative;
	cursor: pointer;
	text-align: center;
	margin: 0;
	padding: 10px 20px 10px 20px;
	border: none;
	border-radius: 25px;
	height: 18px;
	line-height: 19px;
	overflow: hidden;
	box-sizing: content-box;
}

.socialIco svg {
	width: 18px;
	height: 18px;
	color: inherit;
	fill: currentColor;
}
.socialIco[data-oauth=google] svg {
	margin-top: 2px;
	width: 22px;
}
.socialIco[data-oauth=facebook] {
	background-color: #3145b8;
}
.socialIco[data-oauth=facebook]:hover {
 background-color: #394fcc;
}
.socialIco[data-oauth=google] {
	background-color: #ea4335;
}
.socialIco[data-oauth=google]:hover {
	background-color: #f84738;
}
.socialIco[data-oauth=twitter] {
	background-color: #0091ea;
}
.socialIco[data-oauth=twitter]:hover {
	background-color: #039efc;
}
.socialIco[data-oauth=windows] {
	background-color: #00b6f0;
}
.socialIco[data-oauth=windows]:hover {
	background-color: #00bffc;
}
.socialIco[data-oauth=linkedin] {
	background-color: #007ebb;
}
.socialIco[data-oauth=linkedin]:hover {
	background-color: #038bce;
}
.socialIco[data-oauth=vk] {
	background-color: #4a76a8;
}
.socialIco[data-oauth=vk]:hover {
	background-color: #5687bf;
}

.ial-window ::selection {
	background-color: <?php echo $btncomb[0] ?>;
	color: <?php echo $txtcomb[0] ?>;
}
.ial-window ::-moz-selection {
	background-color: <?php echo $btncomb[0] ?>;
	color: <?php echo $txtcomb[0] ?>;
}

.ial-arrow-b,
.ial-arrow-l,
.ial-arrow-r {
	display: block;
	position: absolute;
	top: <?php echo $smalltext/2+$btnpadcomb[0]-4?>px;
	width: 0;
	height: 0;
	border: 5px transparent solid;
	border-left-width: 0;
	border-right-width: 6px;
}
.ial-arrow-l {
	left: -5px;
	border-right-color: <?php echo $errorcomb[0]?>;
}
.ial-arrow-r {
	right: -5px;
	border-width: 5px 0 5px 6px;
	border-left-color: <?php echo $errorcomb[0]?>;
}
.ial-arrow-b {
	left: 9px;
	top: -5px;
	border-width: 0 5px 6px;
	border-bottom-color: <?php echo $errorcomb[0]?>;
}
.inf .ial-arrow-l {
	border-right-color: <?php echo $hintcomb[0]?>;
}
.inf .ial-arrow-r {
	border-left-color: <?php echo $hintcomb[0]?>;
}
.inf .ial-arrow-b {
	border-bottom-color: <?php echo $hintcomb[0]?>;
}
.ial-msg {
	visibility: hidden;
	z-index: 10000;
	position: absolute;
	border-radius: 4px;
	box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
}
.ial-msg.err {
	border: none;
	background: <?php echo $errorcomb[0] ?>;
	border-radius: <?php echo $popupcomb[5]?>px;
}
.ial-msg.inf {
	border: none;
	background: <?php echo $hintcomb[0] ?>;
	border-radius: <?php echo $popupcomb[5]?>px;
}
span.ial-inf,
span.ial-err {
	display: block;
	position: relative;
	text-align: left;
	max-width: 360px;
	padding: 12px;
	text-decoration: none;
	color: <?php echo $errorcomb[1] ?>;
	cursor: default;
	font-size: <?php echo $smalltext+0 ?>px;
	line-height: normal;
}
span.ial-inf {
	color: <?php echo $hintcomb[1] ?>;
}
div.ial-icon-err,
div.ial-icon-inf,
.ial-msg .red,
.ial-form ~ .ial-socials br {
	display: none;
}
.socialIco,
.loginBtn span,
.loginBtn {
	<?php $fonts->printFont('btnfont', 'Text'); ?>
}
.loginBtn span,
.loginBtn {
	display: inline-block;
}

.loginBtn::-moz-focus-inner {
	border:0;
	padding:0;
}
.loginBtn {
	position: relative;
	cursor: pointer;
	text-align: center;
	margin: 0;
	padding: <?php echo $btnpadcomb[0]+0?>px <?php echo $btnpadcomb[1]+0?>px <?php echo $btnpadcomb[2]+0?>px <?php echo $btnpadcomb[3]+0?>px;
	border: none;
	border-radius: <?php echo $btncomb[2]?>px;
	overflow: hidden;
}

.loginBtn,
.loginBtn:hover:active {
	background: <?php echo $btncomb[0] ?>;
}

.loginBtn:hover {
	background-color: <?php echo $btncomb[1]?>;
}
.ial-select::before {
	background: transparent;
}
.ial-select:hover::before {
	background: transparent;
}

.ial-window,
.ial-usermenu {
	top: -10000px;
	margin: 0;
	position: absolute;
	z-index: 10000;
}
.ial-usermenu .loginWndInside {
	box-sizing: border-box;
	background: none;
	background-color: #fff;
}
.ial-usermenu .loginLst a {
	color: #636363;
}

.loginWndInside form {
	overflow: hidden;
	padding: <?php echo $popupcomb[1]+0 ?>px <?php echo $popupcomb[1]+0 ?>px 0;
	box-sizing: content-box;
}

.ial-window .ial-close {
	position: absolute;
	right: 3px;
	top: 3px;
	width: 30px;
	height: 30px;
	margin: 0;
	padding: 0;
	line-height: 0;
	cursor: pointer;
	z-index:10;
}
.ial-window .ial-close::after,
.ial-window .ial-close::before {
	content: '';
	position: absolute;
	left: 7px;
	top: 14px;
	width: 16px;
	height: 3px;
	background: #<?php echo $textfont['Text']['color']?>;
	-webkit-transform: rotate(45deg);
	-moz-transform: rotate(45deg);
	transform: rotate(45deg);
	-webkit-transition: background-color .3s;
	-moz-transition: background-color .3s;
	transition: background-color .3s;
}
.ial-window .ial-close::before {
	-webkit-transform: rotate(-45deg);
	-moz-transform: rotate(-45deg);
	transform: rotate(-45deg);
}
.ial-window .ial-close:hover::before,
.ial-window .ial-close:hover::after {
	background-color: <?php echo $btncomb[1] ?>;
}

.gi-logo-cont {
	display: inline-flex;
	margin: 0 !important;
	padding: 40px 0 0;
	width: 100%;
}
.gi-logo {
	width: <?php echo $logocomb[1]?>px;
	height: <?php echo $logocomb[2]?>px;
	margin: 0 auto;
	background-position: center;
	background-repeat: no-repeat;
	background-size: <?php echo $logocomb[0] == 0 ? 'cover' : 'contain' ?>;
}
.gi-logo-cont ~ form .loginH3 {
	margin-top: 0;
}

i.ial-correct {
	width: 0px;
	height: 0px;
}

.ial-inf,
.ial-err,
.loginOr,
.smallTxt,
.forgetLnk,
.loginLst a:link,
.loginLst a:visited,
select.loginTxt,
textarea.loginTxt,
input[type=text].loginTxt,
input[type=password].loginTxt {
	<?php $fonts->printFont('textfont', 'Text') ?>
	border-radius: 0;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
}

.ial-login .gi-elem {
	text-align: center;
}

.ial-password1 .regTxt.loginTxt {
	margin-bottom: 0;
}

select.loginTxt,
textarea.loginTxt,
input[type=password].loginTxt,
input[type=text].loginTxt {
	display: block;
	width: 100%;
	height: auto !important;
	margin: 0 0 14px;
	-webkit-box-shadow:none;
	-moz-box-shadow:none;
	box-shadow:none;
	padding: <?php echo $txtpadcomb[0]+0?>px <?php echo $txtpadcomb[3]+0?>px <?php echo $txtpadcomb[2]+0?>px <?php echo $txtpadcomb[1]+0?>px;
	background: <?php echo $txtcomb[0]?>;
	border: 1px solid <?php echo $txtcomb[2] ?>;
	border-radius: <?php echo $txtcomb[4] ?>px;
	-webkit-appearance: none;
}

/* Webkit autofill hack for saved user and pass */
input[type=text].loginTxt:-webkit-autofill,
input[type=password].loginTxt:-webkit-autofill {
	-webkit-transition-delay: 9999999s;
	-webkit-transition: all 9999999s ease-out;
}

@-webkit-keyframes autofill {
	to { background-color: <?php echo $txtcomb[0]?>; }
}

select.loginTxt {
	-webkit-appearance: none;
	-moz-appearance: none;
	appearance: none;
	text-indent: 0.01px;
	text-overflow: '';
	padding: <?php echo $txtpadcomb[0]+0?>px <?php echo $txtpadcomb[1]+0?>px <?php echo $txtpadcomb[2]+0?>px 38px;
	cursor: pointer;
}
select.loginTxt::-ms-expand {
	display: none;
}
.ial-select {
	margin: 0;
	padding: 0;
	border: 0;
	position: relative;
	display: block;
}
.ial-select::before {
	content: "";
	position: absolute;
	top: 0;
	right: 0;
	width: 38px;
	height: 100%;
	transition: background-color .3s;
	pointer-events: none;
}
.userBtn .loginBtn::after,
.ial-select::after {
	content: "";
	position: absolute;
	top: 50%;
	right: 18px;
	width: 6px;
	height: 6px;
	margin-top: -6px;
	border: 3px solid #<?php echo $textfont['Text']['color']?>;
	border-left: 0;
	border-top: 0;
	box-sizing: content-box;
	pointer-events: none;
	-webkit-transform: rotate(45deg);
	-moz-transform: rotate(45deg);
	transform: rotate(45deg);
	-webkit-transition: border-color 0.3s;
	-moz-transition: border-color 0.3s;
	transition: border-color 0.3s;
}

.userBtn .loginBtn::after {
 border-color: <?php echo $hintcomb[0]?>;
}

.userBtn .loginBtn {
	padding-right: <?php echo $btnpadcomb[1]+27 ?>px;
}
.userBtn {
	line-height: 0;
}

textarea.loginTxt {
	resize: vertical;
	min-height: 111px;
}

.loginBtn,
.socialIco,
select.loginTxt,
textarea.loginTxt,
input[type=password].loginTxt,
input[type=text].loginTxt {
	-webkit-transition: background-color 0.3s ease-out;
	-moz-transition: background-color 0.3s ease-out;
	transition: background-color 0.3s ease-out;
}

select.loginTxt,
textarea.regTxt,
input[type=password].regTxt,
input[type=text].regTxt {
	margin-bottom: 4px;
}
.gi-elem .ial-recaptcha {
	margin-bottom: 14px;
}
select.loginTxt option,
select.loginTxt {
	padding-left: <?php echo $txtpadcomb[1]+0?>px;
}
button.ial-submit {
	margin: 0 0 4px;
}

.loginTxt::-webkit-input-placeholder {opacity: 1;}
.loginTxt:-ms-input-placeholder {opacity: 1;}
.loginTxt::-moz-placeholder {opacity: 1;}
.loginTxt::placeholder {opacity: 1;}
.loginTxt:focus::-webkit-input-placeholder {opacity: 0.5;}
.loginTxt:focus:-ms-input-placeholder {opacity: 0.5;}
.loginTxt:focus::-moz-placeholder {opacity: 0.5;}
.loginTxt:focus::placeholder {opacity: 0.5;}

.ial-input-wrapper .loginTxt::-webkit-input-placeholder,
.ial-input-wrapper .loginTxt:focus::-webkit-input-placeholder {opacity: 0;}
.ial-input-wrapper .loginTxt:-ms-input-placeholder,
.ial-input-wrapper .loginTxt:focus:-ms-input-placeholder {opacity: 0;}
.ial-input-wrapper .loginTxt::-moz-placeholder,
.ial-input-wrapper .loginTxt:focus::-moz-placeholder {opacity: 0;}
.ial-input-wrapper .loginTxt::placeholder,
.ial-input-wrapper .loginTxt:focus::placeholder {opacity: 0;}

textarea.loginTxt:hover,
textarea.loginTxt:focus,
input[type=password].loginTxt:hover,
input[type=text].loginTxt:hover,
input[type=password].loginTxt:focus,
input[type=text].loginTxt:focus {
	background-color: <?php echo $txtcomb[1]?>;
}

.ial-select:hover::before {
	background-color: transparent;
}
.ial-submit {
	display: inline-block;
	width: 75%;
}

form[name=ialRegister] .ial-submit{
	width: 100%;
  margin-top: 10px;
}

form[name=ialLogin] .ial-check-lbl{
	margin-top: 8px;
}
.ial-check-lbl,
.forgetLnk:link,
.forgetLnk:visited {
	cursor: pointer;
	font-size: <?php echo (float)$smalltext ?>px;
	font-weight: normal;
	margin-top: 4px;
}
.smallTxt {
	display: inline-block;
	margin-bottom: <?php echo ($txtcomb[2]-40)/2>0? round(($txtcomb[2]-40)/2)+1 : 1 ?>px;
	font-size: <?php echo (float)$smalltext ?>px;
	font-weight: normal;
}
a.forgetLnk:link {
	padding: 0;
	margin-left: 10px;
	background: none;
}
.forgetDiv {
	margin: 10px 0;
}
.forgetDiv .forgetLnk:link {
	margin: 0;
	line-height: 20px;
}
a.forgetLnk:hover {
	background-color: transparent;
	text-decoration: underline;
}
.ial-checkbox {
	display: inline-block;
	position: relative;
	vertical-align: middle;
	margin-bottom: -3px;
	border-radius: 30px;
	width: 36px;
	height: 22px;
	cursor: pointer;
	transition: background 0.3s ease-out;
	background-color: #e8ecef;
	margin-right:3px;
	margin-top: -2px;
}
.ial-checkbox::after {
	content: "";
	position: absolute;
	background: #ffffff;
	border-radius: 50%;
	top: 2px;
	left: 2px;
	width: 18px;
	height: 18px;
	box-shadow: 0 1px 1px 1px rgba(0, 0, 0, 0.2);
	transition: all 0.3s ease-out;
}

.ial-checkbox.ial-active {
	background: #4CB906;
}
.ial-checkbox.ial-active::after {
	left: 16px;
}
.ial-check-lbl {
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}
.ial-check-lbl[for=keepSigned] {
	display: block;
}
.ial-check-lbl[for=keepSigned] .ial-checkbox {
	display: inline-block;
	vertical-align: top;
	float: none;
}
.loginLst {
	padding: 0;
	margin: 0;
	list-style: circle inside;
}
.loginLst a:link,
.loginLst a:visited {
	display: block;
	padding: <?php echo $btnpadcomb[0]+0?>px <?php echo $btnpadcomb[1]+0?>px <?php echo $btnpadcomb[2]+0?>px <?php echo $btnpadcomb[3]+0?>px;
	text-align: left;
	-webkit-box-shadow: 0px 1px 0px rgba(0,0,0,0.09);
	-moz-box-shadow: 0px 1px 0px rgba(0,0,0,0.09);
	box-shadow: 0px 1px 0px rgba(0,0,0,0.09);
	-webkit-transition: color 0.3s;
	-moz-transition: color 0.3s;
	transition: color 0.3s;
}
.forgetLnk:link,
.forgetLnk:visited,
.forgetLnk:hover,
.loginLst a.active,
.loginLst a:hover {
	<?php $fonts->printFont('textfont', 'Hover') ?>
}
.passStrongness,
.regRequired .red,
.smallTxt.req::after {
	color: #<?php echo $textfont['Hover']['color'] ?>;
	content: " *";
}
.regRequired {
	display: block;
	margin: 0px;
}

.gi-elem > label[for^=ialText],
.gi-elem > label[for^=ialPass] {
	visibility: hidden;
}

.ial-input-wrapper {
	position: relative;
	margin: 0 0 4px;
}
.ial-input-wrapper input[type=text] {
	margin: 0;
}
.ial-input-wrapper label {
	position: absolute;
	top: 0;
	transform-origin: 0 0;
	transform: translateY(<?php echo $txtpadcomb[0]+0?>px);
	transition: all 0.3s;
	pointer-events: none;
	font-size: <?php echo $textfont['Text']['size']+0 ?>px;
	font-weight: <?php echo $textfont['Text']['textdecor'] ?>;
}
.smallTxt[data-attr~=label] {
	padding-left: <?php echo $txtpadcomb[1]+0?>px;
}
.smallTxt.passStrongness {
	padding-right: <?php echo $txtpadcomb[1]+0?>px;
	float: right;
}
.ial-input-wrapper textarea.ial-not-empty + label,
.ial-input-wrapper textarea:focus + label,
.ial-input-wrapper input:not([value=""]) + label,
.ial-input-wrapper input:focus + label {
	padding-left: <?php echo $txtpadcomb[1]-2?>px;
	pointer-events: all;
	font-size: <?php echo (float)$smalltext ?>px;
	font-weight: normal;
	line-height: 20px;
	-webkit-transform: translateY(-100%);
	-moz-transform: translateY(-100%);
	transform: translateY(-100%);
}
.loginLst a:last-child {
	border: 0;
	-webkit-box-shadow:none;
	-moz-box-shadow:none;
	box-shadow:none;
}
.ial-bg {
	visibility: hidden;
	position:absolute;
	background:#000;
	top:0;left:0;
	width:100%;
	height:100%;
	z-index:9999;
	opacity: 0;
}
.ial-bg.ial-active {
	visibility: visible;
	opacity: <?php echo $blackoutcomb[0]/100 ?>;
}

.ial-window .loginWndInside,
.ial-modal .loginWndInside {
	box-shadow: 0 15px 30px rgba(0, 0, 0, 0.14);
}

.ial-modal .loginWndInside::before {
	border-width: 4px;
}

.loginBtn span {
	display: inline-block;
}
.fullWidth.selectBtn,
.fullWidth.selectBtn span {
	display: block;
	margin: 34px 0 0 !important;
	text-decoration: none;
	z-index: 0;
}
form.fullWidth {
	width: 100%;
	margin: auto;
	background: #<?php echo $popupcomb[0] ?>;
	padding: 0 <?php echo $popupcomb[1]+0?>px;
}

:focus {
	outline: none !important;
}
::-moz-focus-inner {
	border: none !important;
}

#registerCaptcha {
	margin-top: 20px;
}

.correct-pipe,
.error-close{
	position: absolute;
	height: 20px;
	width: 20px;
	top: 50%;
	right: 10px;
	fill: <?php echo $errorcomb[0] ?>;
	transform: translateY(-50%) scale(0);
	transition: all 0.5s;
}
.correct-pipe {
	fill: #4cb906;
}

.ial-correct ~ .correct-pipe,
.loginTxt[data-ialerrormsg] ~ .error-close {
	-webkit-transform: translateY(-50%) scale(1);
	-moz-transform: translateY(-50%) scale(1);
	transform: translateY(-50%) scale(1);
}

.ial-file, .ial-image {
  position: relative;
}

.ial-file input[type="file"], .ial-image input[type="file"] {
 left: 0px;
 opacity: 0;
 width: 100%;
 height: 100%;
 position: absolute;
}


.ial-file input[type="text"], .ial-image input[type="text"] {
  padding-right: 35px;
}

.upload-logo {
    position: absolute;
    height: 16px;
    width: 16px;
    top: 50%;
    transform: translateY(-50%);
    right: 15px;
    transition: all 0.5s;
}

.upload-wrapper input[type="file"] {
  cursor: pointer;
}

.upload-wrapper {
  position: relative;
  color: #<?php echo $textfont['Text']['color'] ?>;
}