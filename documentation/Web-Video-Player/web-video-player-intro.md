temp
---
layout: page
title: Introduction to Kaltura's Web Player
weight: 401
---


## Overview  

Kaltura's Web Player leads the industry in flexibility, ease of customization, plug-in offerings and loading speed (most players display in 1 second or less). All features are supported for both HTML5 and Flash with the same configuration, which makes feature intergration across platforms simple and easy. 

{% onebox http://cdnapi.kaltura.com/p/243342/sp/24334200/embedIframeJs/uiconf_id/20540612/partner_id/243342?iframeembed=true&playerId=kaltura_player&entry_id=1_sf5ovm7u&flashvars[streamerType]=auto %}

<iframe src="http://cdnapi.kaltura.com/p/243342/sp/24334200/embedIframeJs/uiconf_id/20540612/partner_id/243342?iframeembed=true&playerId=kaltura_player&entry_id=1_sf5ovm7u&flashvars[streamerType]=auto" width="560" height="395" allowfullscreen webkitallowfullscreen mozAllowFullScreen frameborder="0"></iframe>

The easiest way to use Kaltura's Web Player is to build a player using [Kaltura's Universal Studio](https://knowledge.kaltura.com/node/1148), which provides a user-friendly UI for building and customizing the player. 

Here are some of the key advantages of the Kaltura Web Player:

### Easy to Implement  

Our lightweight embed codes enable you to add videos to your website quickly and easily.

### Easy to Integrate  

Our multi-platform support ensures easy integration for iOS and Android player components on both mobile devices and tables, providing maximum flexibility, while the player architecture enables you to reuse plugins and configurations across platforms.

### Customizable  

The player is easily customized, enabling you to configure skins once using standard HTML / CSS. In addition, you can create customized cross-browser/cross-device players in the Kaltura Player Studio from a variety of easy-to-configure player templates.

### Built-in Advertising and Analytics  

The player’s built-in advertising and analytics provides support for a wide range of video ad formats and integrated plugins. In addition, the related videos experience includes an enhanced related video interface, flexible options for related video fulfillment, and events for tracking conversion and retainment.

### Universal Digital Rights Management (DRM)  

Our Universal DRM module enables media companies, content rights owners and OTT providers to stream premium content without needing to worry about which browser, device or platform is being used. 

### Advanced Live Broadcast Streaming and DRM  

Kaltura's Web Player is designed to ensure seamless integration of advanced live broadcasts streaming and DRM.

To learn more, visit [Kaltura's Player site](http://player.kaltura.com/docs/).


## Embedding Video on Your Website  

Adding video on your website is a great way to interact with your audience. To add videos, you'll need to embed them into your website using Kaltura's embedding capabilities.

### Preparing Your Videos  

First thing's first: prepare and customize your video (although you can customize the video after you embed it, using the Universal Player Studio), then upload it.

### Generate an Embed Code  

The embed code is simply a piece of code that you can use to add content to your site. To generate an embed code, copy the embed code for the video (or the URL) by choosing the Embed button and copying the iframe code. If you're using KMC, use the **Preview & Embed** function from the *Select Action* list. Then, click **Copy** to copy the code, or select the URL and copy it.

### Embed Code Types  

Which kinds of embedding can you use? Kaltura's Player supports these embed code types:

* **Dynamic:** Dynamic embed has many benefits over object tag or Flash library rewrites; it's fast, doesn't have to wait for DOM, and ready to output the Flash or HTML5 player. This embed is also clean, uses json embed config for flashvars and params dynamic, better supports dynamic html5 and flash embed methods, responsive web design, and css inheritance.
* **Auto:** This type of embed is best for sites where SEO is already covered by other data in the page. This concise Auto embed code is good for quickly getting a player or widget onto the page without any runtime customisations.
* **Thumbnail:** The thumbnail embed method takes the same arguments as "kWidget.embed".This embed will pass all configurations to the kWidget embed when the user "clicks" the play button. The player context menu can be disabled by setting the "EmbedPlayer.DisableContextMenu" UIVar to true.
* **Responsive:** This embed ensures that the video ratio on the screen responds to sizing changes. The minimal RWD self contained maintains a 16/9 ratio, even when you resize the browser window.
* **Native callout:** This embed supports replacing the player "play button" with a callout to the native player, for Mobile Devices.
* **Reference Id:** The reference ID is used for setting a custom ID for Kaltura entry.
* **kWidget playlist:** kWidgets make it easy to embed playlists, by simply passing along playlist plugin configuration as flashvars.

To learn more about how to embed videos, read [this](http://player.kaltura.com/docs/PlayerRules) article.
