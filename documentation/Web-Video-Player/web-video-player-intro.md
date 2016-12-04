temp
---
layout: page
title: Introduction to Kaltura's Web Player
weight: 401
---
## Overview  

Kaltura's Web Player leads the industry in flexibility, ease of customization, plug-in offerings and loading speed (most players display in 1 second or less). All features are supported for both HTML5 and Flash with the same configuration, which makes feature integration across platforms simple and easy. 

{% onebox http://cdnapi.kaltura.com/p/243342/sp/24334200/embedIframeJs/uiconf_id/20540612/partner_id/243342?iframeembed=true&playerId=kaltura_player&entry_id=1_sf5ovm7u&flashvars[streamerType]=auto %}

<iframe src="http://cdnapi.kaltura.com/p/243342/sp/24334200/embedIframeJs/uiconf_id/20540612/partner_id/243342?iframeembed=true&playerId=kaltura_player&entry_id=1_sf5ovm7u&flashvars[streamerType]=auto" width="560" height="395" allowfullscreen webkitallowfullscreen mozAllowFullScreen frameborder="0"></iframe>

The easiest way to use Kaltura's Web Player is to build a player using [Kaltura's Universal Studio](https://knowledge.kaltura.com/node/1148), which provides a user-friendly UI for building and customizing the player. 

Here are some of the key advantages of the Kaltura Web Player:

### Multi-Platform Support  

Our HTML5 video library provides you with the most advanced mobile delivery technology stack available today. Our smart-player technology delivers the right player, stream, and advertising to the right device anywhere, with just a single embed code. 

You can extend the functionality of both Flash and HTML5 players with our Unified development API.

Check out the detailed feature chart for what features are supported in what platforms.

### Easy to Implement Video Embedding  

Adding video to your website is a great way to interact with your audience. Our lightweight embed codes enable you to add videos to your website quickly and easily; simply prepare the videos, generate the embed code, and then embed them into your website using Kaltura's embedding capabilities. 

To learn more about embedding, read [this](https://knowledge.kaltura.com/node/1148) article.

#### Embed Code Types  

Kaltura's Web Player supports the following embed code types:

* **Dynamic:** Dynamic embed has many benefits over object tag or Flash library rewrites; it's fast, doesn't have to wait for DOM, and ready to output the Flash or HTML5 player. This embed is also clean, uses json embed config for flashvars and params dynamic, better supports dynamic html5 and flash embed methods, responsive web design, and css inheritance.
* **Auto:** This type of embed is best for sites where SEO is already covered by other data in the page. This concise Auto embed code is good for quickly getting a player or widget onto the page without any runtime customizations.
* **Thumbnail:** The thumbnail embed method takes the same arguments as "kWidget.embed".This embed will pass all configurations to the kWidget embed when the user "clicks" the play button. The player context menu can be disabled by setting the "EmbedPlayer.DisableContextMenu" UIVar to true.
* **Responsive:** This embed ensures that the video ratio on the screen responds to sizing changes. The minimal RWD self contained maintains a 16/9 ratio, even when you resize the browser window.
* **Reference Id:** The reference ID is used for setting a custom ID for Kaltura entry.
* **kWidget playlist:** kWidgets make it easy to embed playlists, by simply passing along playlist plugin configuration as flashvars.

To learn more about supported embed types, read [this](http://player.kaltura.com/docs/PlayerRules) article.

### Unparalleled Robust Performance  

Our player library features an advanced resource loader developed in collaboration with Wikimedia Foundation. The resource loader supports dynamically packing of modules, features and player metadata. It minimizes, gizpis and packages, CSS, images, HTML, JavaScript, metadata, and per player features into a single non-blocking payload. This, combined with Kaltura's AutoEmbed embed code, enables the player rendering to take full advantage fetch ahead parallel JavaScript resource loading in modern browsers. This delivers fast player rendering even on sites with many other active script includes. 

This means you get best in class performance of all your features, with out the delays in traditional feature rich player build out.

### Easy to Integrate  

Our multi-platform support ensures easy integration for iOS and Android player components on both mobile devices and tables, providing maximum flexibility, while the player architecture enables you to reuse plugins and configurations across platforms.

### Customizable  

The player is easily customized, enabling you to configure skins once using standard HTML / CSS. In addition, you can create customized cross-browser/cross-device players in the Kaltura Player Studio from a variety of easy-to-configure player templates.

#### Customer Player Samples
The KDP can be modified with the Studio, with the UIconf or with the API. See examples of how our customers have themselves (or in collaboration with Kaltura) made their player unique to their brand and business.
 
### Built-in Advertising Support  

The player’s built-in advertising provides support for a wide range of video ad formats and integrated plugins. In addition, the related videos experience includes an enhanced related video interface and flexible options for related video fulfillment. Kaltura supports a wide range of video ad formats including VAST 3.0, and integrated plugins for numerous video ad networks, such as Google DoubleClick DFP,FreeWheel, Ad Tech, Eye Wonder, AdapTV, Tremor Video and more. This enables you to target viewers with ads on VOD or live videos, across multiple devices including mobile, PC’s, and set-top-boxes. 

### Enhanced Analytics Capabilities  

The player's analytics capabilities provide you with the  insight you need to manage your content, reach your audience, and optimize your workflow, as well as the ability to track conversion and retainment.
Every Kaltura account includes analytics fully integrated into the Kaltura platform. Additionally Kaltura supports integrations with numerous analytics providers such as Google Analytics, Nielsen Video Census, Nielsen Combined, Comscore and Omniture SiteCatalyst 15. 
### Advanced Live Broadcast Streaming  

Kaltura's Web Player is designed to ensure seamless integration of advanced live broadcasts streaming. To learn more, visit [Kaltura's Player site](http://player.kaltura.com/docs/).

### Universal Digital Rights Management (DRM)  

Our Universal DRM module enables media companies, content rights owners and OTT providers to stream premium content without needing to worry about which browser, device or platform is being used. 

## Basic Look and Feel of the Kaltura Web Player  

The following illustrates the basic look and feel of the Kaltura Web Player.
 
### Mouse Over Scrubber  

Thumbnails display on playhead scrubbing on mouse over.
 
### Responsive Player Layout  

* Thumb up/down rating
* Smaller players / screens keep important controls. 
 
### Improved Related Videos Experience  

* Enhanced related videos interface
* Flexible options for related video fulfillment
* Events for tracking conversion/retainment
 
### Playlists and Chapters  

Flexible HTML plugins for playlists and chapters with support for inheriting site styles
 
### Improved Adaptive Streaming Support  

* Chromeless Flash HLS
 * Supports HLS on desktop browsers for simplified live broadcast ad stitching workflows
* MPEG-DASH
 * Encrypted Media Extension support web delivery of DRM and content control
 * Multi-track audio
 * More detailed analytics on quality of services metrics

**Note:** The browsers that are projected to support MPEG DASH: IE 11 (Windows, Xbox, phone;) Chrome (Desktop & Android), Firefox (Desktop)
 
### Improved Share Interface In Player or On Page  

* Robust Configurable Share Options
 ** Support for sharing specific time offsets
 ** iframe or Flash object embed options
 ** Deep linking to specific URLs for each video: (example: myDomain.com/videos/{entryid}
  
### Improved Accessibility: 508 and WebVTT
•	Industry leading 508 support
•	508 by default – all new framework players include 508 compliant features
•	Integrated framework for making all new plugins accessible
•	Uses HTML for controls: offers more integrated accessible features than Flash players
### iOS, Android, HTML, Flash all in One
•	Maximize ROI on your distribution strategy across native apps and web views. 
•	Architecture for reusable plugins and configuration across platforms
•	Seamlessly integrate advanced live broadcasts streaming and DRM 


## About the Web Player SDK  
The Kaltura Web Player SDK enables users to lead video delivery with HTML5 and provide the fastest viewing experience on any device, while maintaining all the same features and a consistent CSS/HTML player design. Kaltura Players v2 enable delivery of HTML5 with Chromeless components for Flash, iOS and Android.
 
The key advantages of the Kaltura Players v2 are:

* High performance full featured lead with HTML5 - most players display in 1 second or less.
* Skins configured once with standard HTML / CSS
* Better support for additional platforms; iOS and Android player components.
* Support for all features across multiple platforms: See player.kaltura.com.




 



