---
layout: page
title: Adding the genericOSMF Plugin to the KDP
---

<a href="http://www.opensourcemediaframework.com/" target="_blank">Adobe OSMF</a> is the Open Source Media Framework on which Kaltura's Flash Player, aka KDP3 is based of. This article explains how to prepare native <a href="http://www.adobe.com/devnet/flash/articles/mastering-osmf-pt3.html" target="_blank">OSMF plugins</a> to be loaded by KDP3. To learn more about KDP Plugins and how to create custom KDP plugins see: <a href="{{site.url}}/documentation/Knowledge/how-create-kdp-plugins.html" target="_blank">How to Create KDP Plugins</a>.

To add the OSMF plugin, use the GenericOSMFPlugin which is a KDP-plugin used to load the OSMF plugin.<img src="../../assets/980.img">

 

You can add the genericOSMF plugin to a player in one the following ways:

1.  [Add a genericOSMF plugin into the uiconf XML (adds an XML node to the uiConf XML][1]).   
    The configuration of the player (the uiconf) holds the genericOSMF plugin and also contains the path to the OSMF swf file (the OSMF plugin)

2.  [Add a genericOSMF plugin via flashvars. ][2]The embedded player does not have the genericOSMF by default and is loaded per specific embed code.

 [1]: #uiconf_XML
 [2]: #via_flashvars

This article describes how to implement both ways, however you will need to decide what your preferred method is according to your business case's needs.

# <a name="uiconf_XML"></a>Adding a genericOSMF plugin into the uiconf XML

Adding the next XML node to the player, at the top part of it (where most of the non-visual plugins are located)  makes the player load the genericOSMF plugin that loads the OSMF plugin from <http://www.whatever.com/plugins/myOsmfPlugin.swf>

<pre class="brush: xml;fontsize: 100; first-line: 1; ">&lt;Plugin id="genericOSMF" 
	width="0" height="0"  
	loadingPolicy="preInitialize" asyncInit="true"
	pluginURL="http://www.whatever.com/plugins/myOsmfPlugin.swf" /&gt;</pre>

The plugin does not require width and height values, so they are set to 0.  The plugin should load at the inital loading phase of the player and have the player wait for the plugin to register the OSMF code. When the initial content  is played using the OSMF plugin, the asyncInit and loadingPolicy should be set with their according values<span style="color: #000000;">.</span>

# <a name="via_flashvars"></a>Adding a genericOSMF plugin via flashvars

The folowing flashvars string is the equivalent of placing the XML node described above, right after the statistics plugin.

<pre><span style="font-family: 'courier new', courier;">genericOSMF.plugin=true&genericOSMF.relativeTo=statistics&genericOSMF.position=after&genericOSMF.width=0&genericOSMF.height=0&genericOSMF.loadingPolicy=preInitialize&genericOSMF.asyncInit=true&genericOSMF.pluginURL=http://www.whatever.com/plugins/myOsmfPlugin.swf</span></pre>

<span>The KDP </span>has a mechanism that knows how  to 'inject' an XML node to the uiconf XML configuration from flashvars. There are 2 additional attributes that control the position of these node injections. Other than these attributes all the other attributes are the same and use the sytax described to implement  adding the plugin.

 

# Playback

After making sure that the OSMF plugin is loaded into the player you should provide content to play. We reccomment integration with Kaltura, so that Kaltura entries return files that will be played through the plugin, or with a direct URL assignment. This article shows how to pass a URL to the player and does not describe the integration process, 

#   
Set up the Video URL

After you set up the plugin you will need to  load the video URL to the player. Usually this happens automatically when you grab an embed code from the KMC, however, using these processes you will need to inject the video URL directly to the player by detaching the Kaltura entry id (if it is in the embed code). This action is different for the different embed types:

1.  For legacy embed – find the URL for the player and remove the /entry_id/XXXXX from it.   
    For example, if the url for the player is:  
    [http://cdnapi.kaltura.com/index.php/kwidget/cache\_st/1360005066/wid/\_27017/uiconf\_id/11776282/entry\_id/1_ow1nsnlp][3]   
    change it to:  
    [http://cdnapi.kaltura.com/index.php/kwidget/cache\_st/1360005066/wid/\_27017/uiconf_id/11776282][4]  
    wherever the URL appears in the embed.
2.  For dynamic embed – delete the entry_id parameter from the configuration and remove the comma behind (if necessary).  
    For example: remove the following line from a grabbed dynamic embed:   
    "entry\_id": "1\_ow1nsnlp"

 [3]: http://cdnapi.kaltura.com/index.php/kwidget/cache_st/1360005066/wid/_27017/uiconf_id/11776282/entry_id/1_ow1nsnlp
 [4]: http://cdnapi.kaltura.com/index.php/kwidget/cache_st/1360005066/wid/_27017/uiconf_id/11776282

Now, that the player has no content, you can add the URL using two additional flashvars. One flashvar notifies the player that the video should come from an external URL instead of a Kaltura Entry, and  the other flashvar points to the actual URL.

For example:

<pre>sourceType=url&entryId=http://YOURURL</pre>

 <span style="font-size: 2em;">Example</span>

The following example shows how to add the plugin with flashvars with legacy embed and dynamic embed:  
<http://projects.kaltura.com/demos/hls/osmf.html>
