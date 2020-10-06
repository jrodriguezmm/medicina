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

.gi-logo-cont{
  display: inline-flex;
}

.strongFields {
  display: block;
  overflow: hidden;
  height: 3px;
  margin: 0 0 -3px;
}
.strongFields .strongField.empty {
  width: 0;
}
.strongField.empty,
.strongField {
  display: block;
  background: #<?php echo $btncomb[0] ?>;
  width: 20%;
  height: 3px;
  float: left;
  -webkit-transition: width 1s ease-out;
  -moz-transition: width 1s ease-out;
  transition: width 1s ease-out;
}

.loginWndInside {
  position: relative;
  display: inline-block;
  background-color: #<?php echo $popupcomb[0]?>;
}

.loginH3 {
  <?php $fonts->printFont('titlefont', 'Text');?>
}
.ial-login .loginH3 {
  text-align: center;
}

.ial-input-wrapper input:focus ~ .ial-load,
.ial-input-wrapper .ial-load {
  position: absolute;
  width: 100%;
  height: 3px;
  left: 0;
  bottom: -3px;
  background: #<?php echo $btncomb[0] ?>;
  transform-origin: 0 0;
  transform: scaleX(0);
  transition: transform 8s cubic-bezier(.19, 1, .22, 1);
}
.ial-input-wrapper .ial-load.ial-active {
  transform: scaleX(0.8);
}
.ial-input-wrapper .ial-correct ~ .ial-load {
  transition: transform 1s, opacity 1s;
  transform: scaleX(1);
  opacity: 0;
}

.loginBtn .ial-load {
  position: absolute;
  top: 50%;
  left: 50%;
  margin: -4px -18px;
  transform: translateY(-100px);
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
  transform: none;
}
.loginBtn span {
  transform: none;
  transition: transform 0.3s;
}
.loginBtn .ial-load.ial-active ~ span {
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

.ial-msg .red {
  display: none;
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

.loginBtn[data-oauth]{
  text-align: left;
}

.ial-socials {
  margin: 0 !important;
  background: #000;
}
.ial-socials.ial-col1 .socialIco {
  width: 100%;
  background-position: -30px;
  text-align: center;
  line-height: 50px;
}
.ial-socials.ial-col1 .socialIco i {
  display: inline-block;
  vertical-align: middle;
  width: 20px;
  height: 20px;
  background: inherit;
  background-position: center center;
}
.ial-socials.ial-col1 .socialIco span {
  display: inline-block;
  vertical-align: middle;
}
.ial-col2 .socialIco {
  width: 50%;
}
.ial-col3 .socialIco {
  width: calc(100% / 3);
}
.ial-col4 .socialIco {
  width: 25%;
}
.ial-col5 .socialIco {
  width: 20%;
}
.ial-col6 .socialIco {
  width: calc(100% / 6);
}
.socialIco {
  cursor: pointer;
  height: 50px;
  display: block;
  float: left;
  margin: 0;
  background-color: #<?php echo $btncomb[0] ?>;
  background-position: center;
  background-repeat: no-repeat;
  background-size: 25px;
}
.socialIco[data-oauth=facebook] {
  background-image:  url(<?php echo $themeurl?>images/social/fb.png);
}
.socialIco[data-oauth=google] {
  background-image:  url(<?php echo $themeurl?>images/social/google.png);
}
.socialIco[data-oauth=twitter] {
  background-image:  url(<?php echo $themeurl?>images/social/twitter.png);
}
.socialIco[data-oauth=windows] {
  background-image:  url(<?php echo $themeurl?>images/social/wl.png);
}
.socialIco[data-oauth=linkedin] {
  background-image: url(<?php echo $themeurl?>images/social/in.png);
}
.socialIco[data-oauth=vk] {
  background-image: url(<?php echo $themeurl?>images/social/vk.png);
}
<?php $btnRGB = implode(', ', sscanf($btncomb[0], '%02x%02x%02x')); ?>
.socialIco:nth-child(2) {
  background-color: rgba(<?php echo $btnRGB ?>, 0.9);
}
.socialIco:nth-child(3) {
  background-color: rgba(<?php echo $btnRGB ?>, 0.8);
}
.socialIco:nth-child(4) {
  background-color: rgba(<?php echo $btnRGB ?>, 0.7);
}
.socialIco:nth-child(5) {
  background-color: rgba(<?php echo $btnRGB ?>, 0.6);
}
.socialIco:nth-child(6) {
  background-color: rgba(<?php echo $btnRGB ?>, 0.5);
}
<?php $hovRGB = implode(', ', sscanf($btncomb[1], '%02x%02x%02x')); ?>
.socialIco:nth-child(2):hover {
  background-color: rgba(<?php echo $hovRGB ?>, 0.9);
}
.socialIco:nth-child(3):hover {
  background-color: rgba(<?php echo $hovRGB ?>, 0.8);
}
.socialIco:nth-child(4):hover {
  background-color: rgba(<?php echo $hovRGB ?>, 0.7);
}
.socialIco:nth-child(5):hover {
  background-color: rgba(<?php echo $hovRGB ?>, 0.6);
}
.socialIco:nth-child(6):hover {
  background-color: rgba(<?php echo $hovRGB ?>, 0.5);
}

.ial-window ::selection {
  background-color: #<?php echo $btncomb[0] ?>;
  color: #<?php echo $txtcomb[0] ?>;
}
.ial-window ::-moz-selection {
  background-color: #<?php echo $btncomb[0] ?>;
  color: #<?php echo $txtcomb[0] ?>;
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
	left: -6px;
  border-right-color:  #<?php echo $errorcomb[0]?>;
}
.ial-arrow-r {
  right: -6px;
  border-width: 5px 0 5px 6px;
  border-left-color: #<?php echo $errorcomb[0]?>;
}
.ial-arrow-b {
  left: 9px;
  top: -5px;
  border-width: 0 5px 6px;
  border-bottom-color: #<?php echo $errorcomb[0]?>;
}
.inf .ial-arrow-l {
  border-right-color: #<?php echo $hintcomb[0]?>;
}
.inf .ial-arrow-r {
  border-left-color: #<?php echo $hintcomb[0]?>;
}
.inf .ial-arrow-b {
  border-bottom-color: #<?php echo $hintcomb[0]?>;
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
  background: #<?php echo $errorcomb[0] ?>;
}
.ial-msg.inf {
  border: none;
  background: #<?php echo $hintcomb[0] ?>;
}
span.ial-inf,
span.ial-err {
  display: block;
  position: relative;
  text-align: left;
  max-width: 360px;
  padding: /*<?php echo $btnpadcomb[0]+0?>px <?php echo $btnpadcomb[0]*1.5?>*/ 10px 6px;
  text-decoration: none;
  color: #<?php echo $errorcomb[1] ?>;
  cursor: default;
  font-size: <?php echo (float)$smalltext ?>px;
  line-height: normal;
}
span.ial-inf {
  color: #<?php echo $hintcomb[1] ?>;
}
div.ial-icon-err,
div.ial-icon-inf {
  display: none;
}
.ial-col1 .socialIco,
.loginBtn span,
.loginBtn {
  display: inline-block;
  <?php $fonts->printFont('btnfont', 'Text'); ?>
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
  border-radius: 2em;
  text-transform: uppercase;
  overflow: hidden;
  box-shadow: 0 11px 6px -10px rgba(0,0,0,0.43);
}
.loginBtn,
.loginBtn:hover:active {
  background: #<?php echo $btncomb[0] ?>;
}

.socialIco:hover,
.ial-select:hover::before,
.loginBtn:hover {
  background-color: #<?php echo $btncomb[1]?>;
}

.ial-window,
.ial-usermenu {
  top: -10000px;
  margin: 0;
  position: absolute;
  z-index: 10000;
  border: 0;
  padding: <?php echo $socialpos == 'top' ? 0 : $popupcomb[3]+0 ?>px 0 0;
  background: #<?php echo $popupcomb[2] ?>;
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.37);
}
.ial-usermenu {
  margin-top: <?php echo $popupcomb[3]+0 ?>px;
}
.ial-usermenu .loginWndInside {
  box-sizing: border-box;
}

.loginWndInside form {
  overflow: hidden;
  padding: 0 <?php echo $popupcomb[1]+0 ?>px;
	box-sizing: content-box;
}

.ial-window .ial-close {
  position: absolute;
  right: -15px;
  top: -15px;
  width: 30px;
  height: 30px;
  margin: 0;
  padding: 0;
  border-radius: 50%;
  background: #<?php echo $txtcomb[0] ?>;
  box-shadow: 0 2px 4px rgba(0, 0, 0, .15);
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
  background: #<?php echo $btncomb[0] ?>;
  transform: rotate(45deg);
  transition: background-color .3s;
}
.ial-window .ial-close::before {
  transform: rotate(-45deg);
}
.ial-window .ial-close:hover::before,
.ial-window .ial-close:hover::after {
  background-color: #<?php echo $btncomb[1] ?>;
}
@media (max-width: 767px) {
  .ial-window .ial-close {
    right: 0;
    top: 0;
  }
}

.gi-logo-cont {
  margin: 0 !important;
  padding: 40px 0 0;
  width: 100%;
  height: 105px;
  background: #<?php echo $popupcomb[0] ?>;
  box-shadow: inset 0 90px #<?php echo $popupcomb[2] ?>;
}
.gi-logo {
  width: 100px;
  height: 100px;
  margin: 0 auto;
  background-color: #<?php echo $txtcomb[0] ?>;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  border-radius: 50%;
  box-shadow: 0 0 0 5px rgba(0, 0, 0, 0.1);
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
  <?php $fonts->printFont('textfont', 'Text');?>
  border-radius:0;
  -moz-box-shadow:none;
  -webkit-box-shadow:none;
  box-shadow:none;
}

.ial-login .gi-elem,
.ial-login input[type=password].loginTxt,
.ial-login input[type=text].loginTxt {
  text-align: center;
}

.ial-password1 .regTxt.loginTxt {
  margin-bottom: 0;
}
.passStrongness {
  float: right;
}

select.loginTxt,
textarea.loginTxt,
input[type=password].loginTxt,
input[type=text].loginTxt {
  display: block;
  width: 100%;
  height: auto !important;
  margin: 0 0 14px;
  padding: <?php echo $txtpadcomb[0]+0?>px <?php echo $txtpadcomb[1]+0?>px <?php echo $txtpadcomb[2]+0?>px <?php echo $txtpadcomb[3]+0?>px;
  background: #<?php echo $txtcomb[0]?>;
  border: none;
  box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 0.2);
  -webkit-animation: autofill both;
}
@-webkit-keyframes autofill {
  to { background-color: #<?php echo $txtcomb[0]?>; }
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
select.loginTxt option {
  padding-left: 5px;
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
  background: #<?php echo $txtcomb[0]?>;
  transition: background-color .3s;
  pointer-events: none;
}
.userBtn .loginBtn::after,
.ial-select::after {
  content: "";
  position: absolute;
  top: 50%;
  right: 13px;
  width: 8px;
  height: 8px;
  margin-top: -8px;
  border: 3px solid #<?php echo $btncomb[0] ?>;
  border-left: 0;
  border-top: 0;
  transform: rotate(45deg);
  transition: border-color 0.3s;
  box-sizing: content-box;
  pointer-events: none;
}
.userBtn .loginBtn::after {
  border-color: #<?php echo $txtcomb[0]?>;
}
.userBtn .loginBtn {
  padding-right: <?php echo $btnpadcomb[1]+27 ?>px;
}
.userBtn {
  line-height: 0;
}

textarea.loginTxt {
  border: none;
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
  margin-bottom: 12px;
}
select.loginTxt option,
select.loginTxt {
  padding-left: <?php echo $txtpadcomb[1]+0?>px;
}
button.ial-submit {
  margin: 0 0 4px;
}

.loginTxt::-webkit-input-placeholder {opacity: 1;}
.loginTxt:-moz-placeholder {opacity: 1;}
.loginTxt::-moz-placeholder {opacity: 1;}
.loginTxt:-ms-input-placeholder {opacity: 1;}
.loginTxt:focus::-webkit-input-placeholder {opacity: 0.5;}
.loginTxt:focus:-moz-placeholder {opacity: 0.5;}
.loginTxt:focus::-moz-placeholder {opacity: 0.5;}
.loginTxt:focus:-ms-input-placeholder {opacity: 0.5;}

.ial-input-wrapper .loginTxt::-webkit-input-placeholder,
.ial-input-wrapper .loginTxt:focus::-webkit-input-placeholder {opacity: 0;}
.ial-input-wrapper .loginTxt:-moz-placeholder,
.ial-input-wrapper .loginTxt:focus:-moz-placeholder {opacity: 0;}
.ial-input-wrapper .loginTxt::-moz-placeholder,
.ial-input-wrapper .loginTxt:focus::-moz-placeholder {opacity: 0;}
.ial-input-wrapper .loginTxt:-ms-input-placeholder,
.ial-input-wrapper .loginTxt:focus:-ms-input-placeholder {opacity: 0;}

textarea.loginTxt:hover,
textarea.loginTxt:focus,
input[type=password].loginTxt:hover,
input[type=text].loginTxt:hover,
input[type=password].loginTxt:focus,
input[type=text].loginTxt:focus,
.ial-select:hover::before {
  background-color: #<?php echo $txtcomb[1]?>;
}

.ial-submit {
  display: block;
  width: 100%;
  margin-bottom: 10px;
}

.ial-check-lbl,
.forgetLnk:link,
.forgetLnk:visited {
  cursor: pointer;
  font-size: <?php echo (float)$smalltext ?>px;
  font-weight: normal;
	margin:0;
}
.smallTxt {
  display: inline-block;
  margin-bottom: <?php echo ($txtcomb[2]-40)/2>0? round(($txtcomb[2]-40)/2)+1 : 1 ?>px;
  font-size: <?php echo (float)$smalltext ?>px;
  font-weight: normal;
  line-height: 20px;
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
  position: relative;
  display: block;
  margin: 0 4px 0 0;
  padding: 0;
  width: 20px;
  height: 20px !important;
  float: left;
  background: #<?php echo $txtcomb[0]?>;
  box-shadow: 0 3px 5px -2px rgba(0,0,0,0.2);
}
.ial-checkbox::after {
  content: '';
  position: absolute;
  left: 7px;
  top: 3px;
  width: 4px;
  height: 8px;
  border: 3px solid #<?php echo $btncomb[0] ?>;
  border-top: 0;
  border-left: 0;
  transform: rotate(45deg) scale(0);
  transition: transform 0.3s, border-color 0.3s;
}
.ial-select:hover::after,
.ial-check-lbl:hover .ial-checkbox::after {
  border-color: #<?php echo $btncomb[1] ?>;
}
.ial-checkbox.ial-active::after {
  transform: rotate(45deg) scale(0.99);
}
.ial-check-lbl {
  margin-top: 4px;
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
  padding-left: <?php echo $txtpadcomb[1]+0?>px;
  transform-origin: 0 0;
  transform: translateY(<?php echo $txtpadcomb[0]+0?>px);
  transition: all 0.3s;
  pointer-events: none;
  font-size: <?php echo $textfont['Text']['size']+0 ?>px;
  font-weight: <?php echo $textfont['Text']['textdecor'] ?>;
}
.ial-input-wrapper textarea.ial-not-empty + label,
.ial-input-wrapper textarea:focus + label,
.ial-input-wrapper input:not([value=""]) + label,
.ial-input-wrapper input:focus + label {
  padding-left: 4px;
  transform: translateY(-100%);
  pointer-events: all;
  font-size: <?php echo (float)$smalltext ?>px;
  font-weight: normal;
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

.gi-elem input {
  -webkit-appearance: initial;
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

.loginWndInside .ial-file, .ial-image {
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

.upload-wrapper input[type="file"] {
  cursor: pointer;
}


.upload-wrapper:hover {
    color: #<?php echo $btncomb[1] ?>;
}

 .upload-logo {
    position: absolute;
    height: 16px;
    width: 16px;
    top: 50%;
    transform: translateY(-50%);
    right: 10px;
    transition: all 0.5s;
}

.upload-wrapper {
  position: relative;
  color: #<?php echo $btncomb[0] ?>;
}