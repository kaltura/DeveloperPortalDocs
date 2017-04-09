---
layout: page
title: How To Create a Video Thumbnail Rotator in JavaScript
weight: 502
---

This article describes the steps to create a Video Thumbnail Rotator in JavaScript. The Video Thumbnail Rotator is a JS widget that provides a thumbnail slideshow preview for videos hosted on the Kaltura Server.

## How to use the Thumb Rotator  

To use the KalturaThumbRotator, include its javascript code and attach two events to each img element you want to turn into a slideshow preview:

1 .  Download the [Kaltura Video Thumbnail Rotator script](http://knowledge.kaltura.com/sites/default/files/dl_resources/kalturaThumbRotator.zip).

2 .  Next, include the JavaScript, add the following line at the **head** of the document:

{% highlight javascript %}

<script type="text/javascript" src="kaltura_thumb_rotator.js"></script>

{% endhighlight %}

3 .  Add the **<img>** tag where you want the thumbnail to be as follows:

{% highlight xml %}
<img src="http://cdn.kaltura.com/p/309/sp/0/thumbnail/entry\_id/1\_gdmcbimk/width/120/height/90" width="120" height="90" onmouseover="KalturaThumbRotator.start(this)" onmouseout="KalturaThumbRotator.end(this)">
{% endhighlight %}

4 .  Change the width and height parameters in the thumbnail URL as well as the img tag attributes to suit the dimensions you want the thumbnail to be.

 
## The JavaScript API  

KalturaThumbRotator provide two actions:

* `KalturaThumbRotator.start(this)` - Cancels the current running preview and starts a new one. 
* `KalturaThumbRotator.end(this)` - Cancels the current running preview and restores the original thumbnail.


You can adjust the following settings in the Kaltura Thumb Rotator js file:

* slices - The number of thumbnails to pull for the video (default is 16).
* frameRate - The frame rate in milliseconds for changing thumbnails (time to wait between thumbnail replacemnet, default is 1000ms).
