---
layout: page
title: Introduction to Kaltura's Cross-Platform Media Players
---

## Overview  

Kaltura’s flexible HTML5 and Adobe OSMF (Flash)-based media players provide media online publishing solutions that are easy to use and embed.

The Kaltura players:

*   Handle rich media such as video, audio, and image files
*   Present and play playlists
*   Enable annotations, subtitles, and accessibility features (508 compliance)
*   Provide API and plugin layers for customizing and extending the media playback experience

A wide range of plugins is available for many features, including:

*   Various streaming protocols
*   DRM and content protection
*   Social interaction and sharing
*   Advertising, commerce, and analytics

The Kaltura players provide a light-weight and robust framework for creating rich media and video-centric unified web experiences.

This document covers the following Kaltura Players:

|  Player                                 | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
|-----------------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
|  Kaltura HTML5 Video Library            |  Kaltura's HTML5 video library provides seamless cross-platform video playback, including:Fallback logic to Flash when HTML5 is not supportedComplete feature stack of flexible layout and designPlugins for analytics, access control, advertising, and moreThe Kaltura HTML5 Video Library was developed in collaboration with the Wikimedia Foundation, Mozilla, and many community contributors.To download source code and for more information, visit [player.kaltura.com](http://player.kaltura.com/docs). |
| Kaltura Dynamic Player version 3 (KDP3) | An Adobe OSMF (Flash/ActionScript 3)-based, highly flexible media player.KDP3 provides out-of-the-box media playback, in addition to:Robust layout and design capabilitiesFlash and JavaScript APIA flexible plugin mechanism to customize and extend playback, analytics, access control, advertising, and more. KDP3 is built on top of the following Open Source libraries:Adobe OSMFPureMVCYahoo! ASTRA                                                                      |
|                                         |                                                                                                                                                                                                                                                                                                                                                                             ## KDP3: Adobe Flash-based Kaltura Dynamic Media Player  

### Prerequisites  

KDP version 3 and later requires Adobe Flash Player version 10.1 and later.

### What is KDP3?  

KDP3 is an Adobe Flash-based rich media and media player widget. KDP3 can be customized and extended, and is easy to design. In summary, KDP3:

*   Is based on Adobe Flash (10.1 and above), ActionScript 3.0
*   [Adobe Open Source Media Framework (OSMF)][1]
*   [PureMVC][2] Framework
*   [Yahoo ASTRA][3] UI components

*   Has an XML-based layout engine, which allows easy and flexible customization of the layout
*   Has a mechanism based on FLA files for customizing skins, which creates endless design possibilities without writing code

 [1]: http://www.osmf.com/
 [2]: http://puremvc.org/
 [3]: http://developer.yahoo.com/flash/astra-flash/

To create your own look and feel for KDP3, refer to [Creating and Using a Player Skin](http://knowledge.kaltura.com/creating-and-using-player-skin).

### Integration and Player API  

KDP3 incorporates a robust JavaScript API that enables easy integration with applications.

To learn more about integrating KDP3, refer to the [KDP3 JavaScript API][5].

 [5]: http://www.kaltura.org/demos/kdp3/docs.html#jsapi


### Extending and Player Plugins  

To learn more about extending KDP3, refer to Creating KDP Plugins.

### Kaltura Player Studio  

Leveraging the flexible XML-based layout mechanism built into the Kaltura media players, the [Kaltura Player Studio][6] provides a WYSIWYG environment to create customized Kaltura Players. The studio does not require programming or design skills.

 [6]: http://www.kaltura.com/index.php/kmc/kmc4#studio%7CplayersList

You can use the Kaltura Player Studio to:

*   Create unlimited instances of customized Kaltura Players.
*   Add and remove components and OSMF plugins such as watermark, buttons, sharing features, and playback control elements.
*   Integrate with third-party systems, such as advertising networks and servers.
*   Customize the player's look and feel, including icons, colors, and layout.

<h1 class="mce-heading-1 mce-heading-2">
  Kaltura’s HTML5 Video Library
</h1>

<p class="mce-heading-3">
  <strong>Consistent Player Interface</strong>
</p>

Kaltura's HTML5 Media Library enables you to take advantage of the HTML5 video and audio tags with a consistent player interface across all major browsers and devices.

<p class="mce-heading-3">
  <strong>Seamless Fallback</strong>
</p>

The library supports a seamless fallback with Flash-based playback using Kaltura's Flash player or Java Cortado for browsers that do not yet feature HTML5 video and audio support.

Upon detection of the client browser, the Kaltura HTML5 Media Library chooses the right codec to use (specified in the source attributes or available from a Kaltura server) and the right player to display. Whether you share using h264, ogg-theora, or WebM, Kaltura's library ensures that all browsers play the content with the same UI.

<p class="mce-heading-3">
  <strong>Unified Look and Feel</strong>
</p>

While support for HTML5 video is growing, much of the web browser market currently is served best by the Adobe Flash plugin and an associated player. In browsers that do not support the native HTML5 media player, a base component of the Kaltura HTML5 JavaScript library cascades to an underlying Flash player. Kaltura's HTML5 video library maintains a unified look and feel between the Flash-based KDP3 Player and the HTML5 Player.

<p class="mce-heading-3">
  <strong>For More Information</strong>
</p>

For more information about HTML5, refer to [Getting Started - Navigating HTML5][7].

 [7]: http://html5video.org/wiki/Getting_Started_-_Navigating_HTML5

<p class="mce-heading-2">
  Unified Design, Layout, and Functionality across HTML5 and Flash-based Kaltura Players
</p>

<p class="mce-heading-3">
  Smart Detection Mechanism
</p>

While the major browser makers and the Open Video Alliance diligently work to bring the video and media functionalities available in the Adobe Flash platform to HTML5, there still are older platforms and devices in which HTML5 is not available.

To enhance the end-user experience, Kaltura’s HTML5 video library includes a smart detection mechanism. When a device without HTML5 support is detected, the library falls back to Flash. When Flash is not available, the library degrades to the native device media player.

You can set the library to use HTML5 or Flash as the default and to degrade according to the device being used.

<p class="mce-heading-3">
  uiConf XML: Key to Consistent Layout and Design
</p>

Switching between HTML5 and Flash-based UI s may cause functionality problems and inconsistency in design and layout. To resolve issues with switching, Kaltura’s HTML5 player can read the uiConf XML used by the KDP3 (which the Kaltura Player Studio generates) and can build a similar layout and design.

<p class="mce-heading-3">
  Plugins: Extending Functionality
</p>

Plugins to the HTML5 library extend the library functionality. Plugins provide the same feature base as the Flash-based KDP3, such as analytics, advertising, and custom branding.

<p class="mce-heading-3">
  HTML5 Technology Limitations
</p>

While Kaltura’s cutting-edge HTML5 video library has a robust and wide range of design capabilities and plugins, limitations in the underlying HTML5 technology may cause inconsistencies in functionality and design.

<p class="mce-heading-3">
  Major Differences between HTML5 and Flash Platforms
</p>

*   DRM support
*   HTML5: No cross-browser DRM solutions (expected to improve)
*   Flash: Supports cross-browser DRM solutions

*   Adaptive/HTTP Streaming
*   HTML5: Supported (except Apple iOS devices that support Apple's HTTP Live Streaming – not currently supported)
*   Flash: Supported

*   Advertising and overlays
*   HTML5: Partially supported (major issues in most mobile device implementations)
*   Flash: Supported
