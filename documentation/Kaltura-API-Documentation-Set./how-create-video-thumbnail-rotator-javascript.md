---
layout: page
title: How To Create a Video Thumbnail Rotator in JavaScript
---

This topic describes the steps to create a Video Thumbnail Rotator in JavaScript. The Video Thumbnail Rotator is a JS widget that provides a thumbnail slideshow preview for videos hosted on the Kaltura Server.

## How to use the Thumb Rotator  

To use the KalturaThumbRotator, include its javascript code and attach two events to each img element you want to turn into a slideshow preview:
</p>

1.  Download the ]Kaltura Video Thumbnail Rotator script[(http://knowledge.kaltura.com/sites/default/files/dl_resources/kalturaThumbRotator.zip).
2.  Next, include the JavaScript, add the following line at the </span><em style="color: #333333; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 12px; line-height: 15px;"><strong><head></strong></em><span style="color: #333333; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 12px; line-height: 15px;"> of the document:<br /></span>{% highlight javascript %}<script type="text/javascript" src="kaltura\_thumb\_rotator.js"></script>{% endhighlight %}
3.  <span style="color: #333333; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;"><span style="color: #333333; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;"><span style="font-size: 12px; line-height: 15px;">Add the <strong><img></strong> tag where you want the thumbnail to be as follows:<br /></span></span></span>{% highlight xml %}<img src="http://cdn.kaltura.com/p/309/sp/0/thumbnail/entry\_id/1\_gdmcbimk/width/120/height/90" width="120" height="90" onmouseover="KalturaThumbRotator.start(this)" onmouseout="KalturaThumbRotator.end(this)">{% endhighlight %}
4.  <span style="color: #333333; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 12px; line-height: 15px;">Change the width and height parameters in the thumbnail URL as well as the img tag attributes to suit the dimensions you want the thumbnail to be.</span>

 

<p class="mce-heading-2">
  The JavaScript API
</p>

KalturaThumbRotator provide two actions

*   `KalturaThumbRotator.start(this)` - Cancels the current running preview and starts a new one. 
*   `KalturaThumbRotator.end(this)` - Cancels the current running preview and restores the original thumbnail.

 

You can adjust the following settings in the Kaltura Thumb Rotator js file:

*   slices - The number of thumbnails to pull for the video (default is 16).
*   frameRate - The frame rate in milliseconds for changing thumbnails (time to wait between thumbnail replacemnet, default is 1000ms).
