<?php
/**
 * Joomla! POWr Icon
*
* @version 1.4
* @author POWr.io
* @package POWr
* @subpackage powr
* @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class plgButtonPowrIcon extends JPlugin{
   public function onDisplay($name){
      $jsCode = "
        function uniqueLabel(){
                    return 'xxxxxxxx_'.replace(/[x]/g, function(c) {
                        var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
                        return v.toString(16);
                    }) + new Date().getTime();
        }
        jQuery(document).on('click','.powrBtn',function(el){
          //jQuery(document).append(powrModal);
          console.log('POWr Button Clicked');
          if( jQuery(el.target).hasClass('powrBtn') || jQuery(el.target).hasClass('powrIconText') ){
                jQuery('#powrPluginsWrapper').fadeIn();
          }
          return false;
        });
        jQuery(document).on('click','.powrPlugin',function(){
          console.log('POWr Plugin');
          jQuery('#powrPluginsWrapper').fadeIn(); //Show modal
          var slug = jQuery(this).data('slug'); //Slug for app
          var shortcode = '[powr-'+slug+' id=\"'+uniqueLabel()+'\"]';
          jInsertEditorText(shortcode,'$name');
          jQuery('#powrPluginsWrapper').fadeOut();
        });
        jQuery(document).on('click','.powrClose',function(){
          console.log('POWr Close');
          jQuery('#powrPluginsWrapper').fadeOut();
        });
        button_html = \"" . str_replace("\n","","
            <span class='powrIconText'>POWr Plugin</span>
            <style>
            @-webkit-keyframes ani_glow {
            0%{ text-shadow:0 0 10px #f3e8b6; }
            50%{ text-shadow:0 0 5px #cc4f4d;}
            100%{ text-shadow:0 0 10px #f3e8b6;}
            }
            @keyframes ani_glow {
            0%{ text-shadow:0 0 10px #f3e8b6; }
            50%{ text-shadow:0 0 5px #cc4f4d; }
            100%{ text-shadow:0 0 10px #f3e8b6; }
            }
            .powrIconText{
            -webkit-animation: ani_glow 2s linear infinite;
            animation: ani_glow 2s linear infinite;
            }
                .icon-powr{
                  background-image: url(//s3-us-west-1.amazonaws.com/powr/powr_logos/16x16.gif);
            width: 16px;
            height: 16px;
            position: relative;
            background-size: contain;
            background-repeat: no-repeat;
            vertical-align: top;
            }
            #powrPluginsWrapper {
            position: fixed;
            top: 15%;
            left: 25%;
            width: 50%;
            background: white;
            z-index: 99999999;
            margin: 0 auto;
            min-height: 150px;
            max-height: 60%;
            padding: 15px;
            box-shadow: 4px 5px 20px gray;
            cursor: default;
            overflow: auto;
            -webkit-animation: none;
            animation: none;

            }
            #powrPluginsWrapper .powrHeader{
            font-size: 20px;
            margin-bottom: 10px;
            }
            #powrPluginsWrapper .powrClose{
            position:absolute;
            top: 8px;
            right: 10px;
            color: gray;
            cursor:pointer;
            }
            #powrPluginsWrapper	.powrPlugin{
            float: left;
            width: 128px;
            padding 10px;
            margin: 10px 10px 5px 10px;
            border-radius: 3px;
            text-align:center;
            cursor:pointer;
            position:relative;
            }
            #powrPluginsWrapper .category {
            float: left;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            text-align: left;
            margin-top: 10px;
            }
            #powrPluginsWrapper	.powrPluginImage{
            width: 100%
            box-shadow: 3px 3px 10px #c0c0c0;
            margin-bottom: 5px;
            }
            #powrPluginsWrapper	.powrPluginTitle{
            font-size: 12px;
            font-weight: bold;
            display: block;
            height: 20px;
            }
            #powrPluginsWrapper	.powrPluginDescription{
            position: absolute;
            top: 0;
            left: 0;
            font-size: 11px;
            font-weight: 200;
            line-height: 1.2;
            opacity: 0;
            -webkit-transition: all 0.6s;
            transition: all 0.6s;
            background: rgba(255, 255, 255, 0.85);
            padding: 5px 2px;
            height: 100%;
            width: 100%;
            white-space: normal;
            }
            #powrPluginsWrapper	.powrPluginDescription:hover{
            opacity: 1;
            }
            </style>
            <div id='powrPluginsWrapper' style='display:none;'>
                <div class='powrHeader'>Select POWr Plugin</div>
                <span class='powrClose'>X</span>
                <div class='category'>Popular</div><div class='powrPlugin' data-slug='form-builder'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/formBuilder.svg'>
    <span class='powrPluginTitle'>Form Builder</span>
    <span class='powrPluginDescription'>Create any type of form and customize it to match your site.</span>
    </div><div class='powrPlugin' data-slug='social-feed'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/socialFeed.svg'>
    <span class='powrPluginTitle'>Social Feed</span>
    <span class='powrPluginDescription'>Get more Likes and Followers with automatic social streaming</span>
    </div><div class='powrPlugin' data-slug='countdown-timer'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/countdownTimer.svg'>
    <span class='powrPluginTitle'>Countdown Timer</span>
    <span class='powrPluginDescription'>Create a sense of urgency to drive sales or conversions</span>
    </div><div class='powrPlugin' data-slug='media-gallery'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/mediaGallery.svg'>
    <span class='powrPluginTitle'>Media Gallery</span>
    <span class='powrPluginDescription'>Showcase articles, images, videos, and more!</span>
    </div><div class='powrPlugin' data-slug='paypal-button'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/paypalButton.svg'>
    <span class='powrPluginTitle'>PayPal Button</span>
    <span class='powrPluginDescription'>Get paid instantly with a custom PayPal Button</span>
    </div><div class='powrPlugin' data-slug='multi-slider'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/multiSlider.svg'>
    <span class='powrPluginTitle'>Multi Slider</span>
    <span class='powrPluginDescription'>Capture more eyeballs with images, videos, and banners</span>
    </div><div class='powrPlugin' data-slug='popup'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/popup.svg'>
    <span class='powrPluginTitle'>Popup</span>
    <span class='powrPluginDescription'>Capture contacts and promote offers with custom popups</span>
    </div><div class='powrPlugin' data-slug='faq'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/faq.svg'>
    <span class='powrPluginTitle'>FAQ</span>
    <span class='powrPluginDescription'>Answer questions in advance with custom FAQs</span>
    </div><div class='category'>Forms & Surveys</div><div class='powrPlugin' data-slug='form-builder'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/formBuilder.svg'>
    <span class='powrPluginTitle'>Form Builder</span>
    <span class='powrPluginDescription'>Create any type of form and customize it to match your site.</span>
    </div><div class='powrPlugin' data-slug='poll'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/poll.svg'>
    <span class='powrPluginTitle'>Poll</span>
    <span class='powrPluginDescription'>Learn more about your users with a custom poll!</span>
    </div><div class='powrPlugin' data-slug='survey'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/survey.svg'>
    <span class='powrPluginTitle'>Survey</span>
    <span class='powrPluginDescription'>Collect honest feedback with custom surveys</span>
    </div><div class='powrPlugin' data-slug='contact-form'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/contactForm.svg'>
    <span class='powrPluginTitle'>Contact Form</span>
    <span class='powrPluginDescription'>Capture contact info with a simple form</span>
    </div><div class='powrPlugin' data-slug='order-form'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/orderForm.svg'>
    <span class='powrPluginTitle'>Order Form</span>
    <span class='powrPluginDescription'>Sell anything on any site.</span>
    </div><div class='powrPlugin' data-slug='mailing-list'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/mailingList.svg'>
    <span class='powrPluginTitle'>Mailing List</span>
    <span class='powrPluginDescription'>Grow your mailing list with zero effort</span>
    </div><div class='category'>Galleries and Sliders</div><div class='powrPlugin' data-slug='event-gallery'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/eventGallery.svg'>
    <span class='powrPluginTitle'>Event Gallery</span>
    <span class='powrPluginDescription'>Showcase upcoming events in a beautiful Pinterest-style gallery!</span>
    </div><div class='powrPlugin' data-slug='media-gallery'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/mediaGallery.svg'>
    <span class='powrPluginTitle'>Media Gallery</span>
    <span class='powrPluginDescription'>Showcase articles, images, videos, and more!</span>
    </div><div class='powrPlugin' data-slug='multi-slider'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/multiSlider.svg'>
    <span class='powrPluginTitle'>Multi Slider</span>
    <span class='powrPluginDescription'>Capture more eyeballs with images, videos, and banners</span>
    </div><div class='powrPlugin' data-slug='banner-slider'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/bannerSlider.svg'>
    <span class='powrPluginTitle'>Banner Slider</span>
    <span class='powrPluginDescription'>Beautiful sliding banners for images and video.</span>
    </div><div class='powrPlugin' data-slug='flickr-gallery'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/flickrGallery.svg'>
    <span class='powrPluginTitle'>Flickr Gallery</span>
    <span class='powrPluginDescription'>Get more Flickr followers with a custom gallery</span>
    </div><div class='powrPlugin' data-slug='image-slider'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/imageSlider.svg'>
    <span class='powrPluginTitle'>Image Slider</span>
    <span class='powrPluginDescription'>A beautiful, responsive slider for images and photos!</span>
    </div><div class='powrPlugin' data-slug='photo-gallery'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/photoGallery.svg'>
    <span class='powrPluginTitle'>Photo Gallery</span>
    <span class='powrPluginDescription'>A Pinterest-style gallery for unlimited images!</span>
    </div><div class='powrPlugin' data-slug='vimeo-gallery'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/vimeoGallery.svg'>
    <span class='powrPluginTitle'>Vimeo Gallery</span>
    <span class='powrPluginDescription'>Get more views on Vimeo with embeddable playlists</span>
    </div><div class='powrPlugin' data-slug='event-slider'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/eventSlider.svg'>
    <span class='powrPluginTitle'>Event Slider</span>
    <span class='powrPluginDescription'>Showcase upcoming events with images and videos in this responsive slider!</span>
    </div><div class='powrPlugin' data-slug='video-gallery'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/videoGallery.svg'>
    <span class='powrPluginTitle'>Video Gallery</span>
    <span class='powrPluginDescription'>Showcase YouTube and Vimeo videos in a beautiful gallery!</span>
    </div><div class='powrPlugin' data-slug='video-slider'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/videoSlider.svg'>
    <span class='powrPluginTitle'>Video Slider</span>
    <span class='powrPluginDescription'>A simple slideshow for YouTube and Vimeo videos!</span>
    </div><div class='powrPlugin' data-slug='microblog'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/microblog.svg'>
    <span class='powrPluginTitle'>Microblog</span>
    <span class='powrPluginDescription'>Showcase articles, images, videos, and more!</span>
    </div><div class='powrPlugin' data-slug='youtube-gallery'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/youtubeGallery.svg'>
    <span class='powrPluginTitle'>YouTube Gallery</span>
    <span class='powrPluginDescription'>Grow your audience with an embeddable YouTube gallery</span>
    </div><div class='category'>Social Media</div><div class='powrPlugin' data-slug='tumblr-feed'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/tumblrFeed.svg'>
    <span class='powrPluginTitle'>Tumblr Feed</span>
    <span class='powrPluginDescription'>Display multiple tumblr accounts in a single feed!</span>
    </div><div class='powrPlugin' data-slug='comments'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/comments.svg'>
    <span class='powrPluginTitle'>Comments</span>
    <span class='powrPluginDescription'>Build a community of visitors or shoppers</span>
    </div><div class='powrPlugin' data-slug='social-feed'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/socialFeed.svg'>
    <span class='powrPluginTitle'>Social Feed</span>
    <span class='powrPluginDescription'>Get more Likes and Followers with automatic social streaming</span>
    </div><div class='powrPlugin' data-slug='rss-feed'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/rssFeed.svg'>
    <span class='powrPluginTitle'>RSS Feed</span>
    <span class='powrPluginDescription'>Combine and display content from multiple RSS feeds!</span>
    </div><div class='powrPlugin' data-slug='reviews'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/reviews.svg'>
    <span class='powrPluginTitle'>Reviews</span>
    <span class='powrPluginDescription'>Collect and display social proof with visitor reviews</span>
    </div><div class='powrPlugin' data-slug='flickr-gallery'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/flickrGallery.svg'>
    <span class='powrPluginTitle'>Flickr Gallery</span>
    <span class='powrPluginDescription'>Get more Flickr followers with a custom gallery</span>
    </div><div class='powrPlugin' data-slug='facebook-feed'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/facebookFeed.svg'>
    <span class='powrPluginTitle'>Facebook Feed</span>
    <span class='powrPluginDescription'>Get more Likes on Facebook with an automatic FB feed</span>
    </div><div class='powrPlugin' data-slug='vimeo-gallery'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/vimeoGallery.svg'>
    <span class='powrPluginTitle'>Vimeo Gallery</span>
    <span class='powrPluginDescription'>Get more views on Vimeo with embeddable playlists</span>
    </div><div class='powrPlugin' data-slug='twitter-feed'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/twitterFeed.svg'>
    <span class='powrPluginTitle'>Twitter Feed</span>
    <span class='powrPluginDescription'>Get more followers, favorites, and retweets on Twitter</span>
    </div><div class='powrPlugin' data-slug='pinterest-feed'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/pinterestFeed.svg'>
    <span class='powrPluginTitle'>Pinterest Feed</span>
    <span class='powrPluginDescription'>Get more pins with an automatic Pinterest feed</span>
    </div><div class='powrPlugin' data-slug='instagram-feed'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/instagramFeed.svg'>
    <span class='powrPluginTitle'>Instagram Feed</span>
    <span class='powrPluginDescription'>Get more Instagram followers with an embedded gallery</span>
    </div><div class='powrPlugin' data-slug='youtube-gallery'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/youtubeGallery.svg'>
    <span class='powrPluginTitle'>YouTube Gallery</span>
    <span class='powrPluginDescription'>Grow your audience with an embeddable YouTube gallery</span>
    </div><div class='powrPlugin' data-slug='social-media-icons'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/socialMediaIcons.svg'>
    <span class='powrPluginTitle'>Social Media Icons</span>
    <span class='powrPluginDescription'>Grow your social media following with linked icons</span>
    </div><div class='category'>eCommerce</div><div class='powrPlugin' data-slug='ecommerce'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/ecommerce.svg'>
    <span class='powrPluginTitle'>Ecommerce</span>
    <span class='powrPluginDescription'>Sell more products, downloads, or subscriptions instantly</span>
    </div><div class='powrPlugin' data-slug='digital-download'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/digitalDownload.svg'>
    <span class='powrPluginTitle'>Digital Download</span>
    <span class='powrPluginDescription'>Sell music, videos, ebooks, and more!</span>
    </div><div class='powrPlugin' data-slug='price-table'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/priceTable.svg'>
    <span class='powrPluginTitle'>Price Table</span>
    <span class='powrPluginDescription'>Sell more with side-by-side pricing tables</span>
    </div><div class='powrPlugin' data-slug='paypal-button'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/paypalButton.svg'>
    <span class='powrPluginTitle'>PayPal Button</span>
    <span class='powrPluginDescription'>Get paid instantly with a custom PayPal Button</span>
    </div><div class='powrPlugin' data-slug='order-form'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/orderForm.svg'>
    <span class='powrPluginTitle'>Order Form</span>
    <span class='powrPluginDescription'>Sell anything on any site.</span>
    </div><div class='powrPlugin' data-slug='plan-comparison'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/planComparison.svg'>
    <span class='powrPluginTitle'>Plan Comparison</span>
    <span class='powrPluginDescription'>Display and sell products, plans, and services in a side-by-side comparison! </span>
    </div><div class='category'>POWr Tools</div><div class='powrPlugin' data-slug='tabs'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/tabs.svg'>
    <span class='powrPluginTitle'>Tabs</span>
    <span class='powrPluginDescription'>Help visitors navigate your site and content</span>
    </div><div class='powrPlugin' data-slug='comments'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/comments.svg'>
    <span class='powrPluginTitle'>Comments</span>
    <span class='powrPluginDescription'>Build a community of visitors or shoppers</span>
    </div><div class='powrPlugin' data-slug='countdown-timer'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/countdownTimer.svg'>
    <span class='powrPluginTitle'>Countdown Timer</span>
    <span class='powrPluginDescription'>Create a sense of urgency to drive sales or conversions</span>
    </div><div class='powrPlugin' data-slug='weather'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/weather.svg'>
    <span class='powrPluginTitle'>Weather</span>
    <span class='powrPluginDescription'>Track and display a real-time forecast for any location!</span>
    </div><div class='powrPlugin' data-slug='map'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/map.svg'>
    <span class='powrPluginTitle'>Map</span>
    <span class='powrPluginDescription'>Get more visitors with a custom map</span>
    </div><div class='powrPlugin' data-slug='file-embed'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/fileEmbed.svg'>
    <span class='powrPluginTitle'>File Embed</span>
    <span class='powrPluginDescription'>Embed PDFs and almost any other files in your website!</span>
    </div><div class='powrPlugin' data-slug='menu'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/menu.svg'>
    <span class='powrPluginTitle'>Menu</span>
    <span class='powrPluginDescription'>Create a stunning restaurant menu in minutes</span>
    </div><div class='powrPlugin' data-slug='reviews'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/reviews.svg'>
    <span class='powrPluginTitle'>Reviews</span>
    <span class='powrPluginDescription'>Collect and display social proof with visitor reviews</span>
    </div><div class='powrPlugin' data-slug='count-up-timer'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/countUpTimer.svg'>
    <span class='powrPluginTitle'>Count Up Timer</span>
    <span class='powrPluginDescription'>Count up from any time, date, or number.</span>
    </div><div class='powrPlugin' data-slug='about-us'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/aboutUs.svg'>
    <span class='powrPluginTitle'>About Us</span>
    <span class='powrPluginDescription'>Build visitor trust with a professional profile</span>
    </div><div class='powrPlugin' data-slug='holiday-countdown'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/holidayCountdown.svg'>
    <span class='powrPluginTitle'>Holiday Countdown</span>
    <span class='powrPluginDescription'>Count down to any holiday, birthday, or special event!</span>
    </div><div class='powrPlugin' data-slug='job-board'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/jobBoard.svg'>
    <span class='powrPluginTitle'>Job Board</span>
    <span class='powrPluginDescription'>Post Jobs and hire fast</span>
    </div><div class='powrPlugin' data-slug='notification-bar'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/notificationBar.svg'>
    <span class='powrPluginTitle'>Notification Bar</span>
    <span class='powrPluginDescription'>Engage and direct your visitors with an effective & customizable Notification Bar.</span>
    </div><div class='powrPlugin' data-slug='popup'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/popup.svg'>
    <span class='powrPluginTitle'>Popup</span>
    <span class='powrPluginDescription'>Capture contacts and promote offers with custom popups</span>
    </div><div class='powrPlugin' data-slug='chat'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/chat.svg'>
    <span class='powrPluginTitle'>Chat</span>
    <span class='powrPluginDescription'>Easily provide live customer support with Facebook Messenger from your website.</span>
    </div><div class='powrPlugin' data-slug='faq'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/faq.svg'>
    <span class='powrPluginTitle'>FAQ</span>
    <span class='powrPluginDescription'>Answer questions in advance with custom FAQs</span>
    </div><div class='powrPlugin' data-slug='music-player'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/musicPlayer.svg'>
    <span class='powrPluginTitle'>Music Player</span>
    <span class='powrPluginDescription'>Embed audio tracks in any website</span>
    </div><div class='powrPlugin' data-slug='graph'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/graph.svg'>
    <span class='powrPluginTitle'>Graph</span>
    <span class='powrPluginDescription'>Graphs and charts for any website!</span>
    </div><div class='powrPlugin' data-slug='button'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/button.svg'>
    <span class='powrPluginTitle'>Button</span>
    <span class='powrPluginDescription'>Custom buttons for links, downloads, promotions, or social accounts.</span>
    </div><div class='powrPlugin' data-slug='resume'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/resume.svg'>
    <span class='powrPluginTitle'>Resume</span>
    <span class='powrPluginDescription'>Create, customize, and display your resume or CV!</span>
    </div><div class='powrPlugin' data-slug='hit-counter'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/hitCounter.svg'>
    <span class='powrPluginTitle'>Hit Counter</span>
    <span class='powrPluginDescription'>Track and display visits for any page!</span>
    </div><div class='category'>Image Manipulation</div><div class='powrPlugin' data-slug='photo-watermark'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/photoWatermark.svg'>
    <span class='powrPluginTitle'>Photo Watermark</span>
    <span class='powrPluginDescription'>Add a watermark to a single image.</span>
    </div><div class='powrPlugin' data-slug='photo-filter'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/photoFilter.svg'>
    <span class='powrPluginTitle'>Photo Filter</span>
    <span class='powrPluginDescription'>Photoshop-style filters for any image!</span>
    </div><div class='powrPlugin' data-slug='photo-editor'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/photoEditor.svg'>
    <span class='powrPluginTitle'>Photo Editor</span>
    <span class='powrPluginDescription'>Edit, filter, and resize any image!</span>
    </div><div class='powrPlugin' data-slug='image-resizer'>
    <img class='powrPluginImage' src='//powr.s3-us-west-1.amazonaws.com/plugin_icons_svg/imageResizer.svg'>
    <span class='powrPluginTitle'>Image Resizer</span>
    <span class='powrPluginDescription'>Adjust the size, shape, and filter for a single image.</span>
    </div>
            </div>")."\";

function loadPowrButton(){
  if( jQuery('.icon-powr').length==0){
    setTimeout(function(){
      loadPowrButton();
    },250)
    return;
  }
  jQuery('.icon-powr').parents('button').toggleClass('btn powrBtn',true);
  if( jQuery('.icon-powr').siblings('span').length > 0){ //Tinymce
    jQuery('.icon-powr').siblings('span').html( jQuery.parseHTML(button_html) );
  }else{
    jQuery('.powrBtn').append( jQuery.parseHTML(button_html) );
  }
}
loadPowrButton();
";
      $doc = JFactory::getDocument();
      $doc->addScriptDeclaration($jsCode);
          $button = new JObject();
      $button->modal = false;
      $button->class = 'btn powrBtn';
      $button->title = 'POWr Button';
      $button->text = 'POWr Plugins';
      $button->name = 'powr'; //Makes an icon-powr class
      $button->link = '#';
      return $button;
    }
}
?>