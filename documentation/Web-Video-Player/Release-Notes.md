---
layout: page
title: Web Video Player Release Notes
weight: 402
---


| Release | Date Released   | Details |
|---------|-----------------|---------|
| 2.63    | November 19, 2017   | [Details](Release-Notes.html#release-263)|
| 2.62    | October 22, 2017   | [Details](Release-Notes.html#release-262)|
| 2.61    | September 10, 2017   | [Details](Release-Notes.html#release-261)|
| 2.61    | September 10, 2017   | [Details](Release-Notes.html#release-261)|
| 2.60.2  | August 17, 2017   | [Details](Release-Notes.html#release-2602)|
| 2.59    | July 30, 2017   | [Details](Release-Notes.html#release-259)|
| 2.58    | July 2, 2017   | [Details](Release%20Notes.md#release-258)|
| 2.56    | May 21, 2017   | [Details](Release-Notes.html#release-256)|
| 2.55    | Apr. 23, 2017   | [Details](Release-Notes.html#release-255) |
| 2.54    | Mar. 12, 2017   | [Details](Release-Notes.html#release-254) |
| 2.53.2  | Feb. 26, 2017   | [Details](Release-Notes.html#release-2532)|
| 2.53    | Feb. 12, 2017   | [Details](Release-Notes.html#release-253) |
| 2.52    | Jan. 15, 2017   | [Details](Release-Notes.html#release-252) |
| 2.51    | Dec. 27, 2016   | [Details](Release-Notes.html#release-251) |
| 2.50    | Nov. 20, 2016   | [Details](Release-Notes.html#release-250) |
| 2.49    | Nov. 6, 2016    | [Details](Release-Notes.html#release-249) |
| 2.48    | Sept 25, 2016   | [Details](Release-Notes.html#release-248) |
| 2.47    | August 29, 2016 | [Details](Release-Notes.html#release-247) |
| 2.46    | July 31, 2016   | [Details](Release-Notes.html#release-246) |
| 2.45    | July 03, 2016   | [Details](Release-Notes.html#release-245) |

## Release 2.63  

Version 2.63 was released as a maintenance version.

## Release 2.62  

* New Autoplay handling: Safari 11, released on September 19 for iOS11 and macOS, no longer supports autoplay for videos with sound. When set to autoplay, videos must now start muted, with sound enabled only upon a specific user interaction with the player itself. 

Version 2.62 of the Kaltura player includes an automatic fallback to the muted autoplay option. By default, the player will now fall back onto muted autoplay for browsers that block sound. You can also choose to fall back onto an explicit 'Play' initiation on such browsers if you do not wish to play muted videos at all (set ‘autoPlayFallbackToMute’ FlashVar to False).
* The Safari change temporarily affected the ads flow due to a bug in Google’s IMA plugin. The IMA issue was causing the first transition between a video and an advertisement to be considered as a new playback, requiring additional user interaction. This has now been fixed and the fix was incorporated in 2.62, so that ads do not require additional user interaction.
 
**Known Issues:**
* Post-sequence bumpers will require an additional play click after the video ends
* Playlists with ads  - Each video in the playlist will require an additional play click

## Release 2.61  

Changes to 360 Flashvars – Flashvar names have been changed for simplicity:
* ‘VR’ will now be called ‘enable_vr’, meaning the VR plugin s enabled and 360 videos can be watched.
* ‘vr_mode’ will now be called ‘auto_load_as_vr’, meaning the video will load in VR mode (i.e, in split screen mode compatible with a VR device)

## Release 2.60.2  

* CAP Support: The Kaltura Player now supports .CAP caption files. .CAP files can be uploaded via the APIs and via the Kaltura On-the-Fly Packager, which converts the captions to WebVTT.
* Chromecast Plugin Configuration: The Chromecast plugin can now be enabled from the Player Studio. For more information, please see [Universal Studio Information - Chromecast Plugin Configuration](https://knowledge.kaltura.com/universal-studio-information-guide#Chromecast_plugin_configuration).
* HLS.JS Upgrade: Hls.js has been upgraded to the latest version.
* Changes to keyboard shortcuts:
  * Switch views’ changed from ‘w’ to ‘x’ and allows changing the view between the different screens
  * ‘Next state’  changed from ‘q’ to ‘z’ and allows changing the video stream viewed
  * ‘Openmenu’ and ‘Closemenu’ are no longer in use and their shortcuts have been removed
* Call-to-Action Buttons: This release allows the user to add up to two brandable Call-to-Action Buttons at the end of playback, with or without related videos. Buttons defaults are defined on the player and can be overridden using entry custom metadata and embed flashvars.For more information, please see [Universal Studio Information - Call to Action Buttons](https://knowledge.kaltura.com/universal-studio-information-guide#CTA_Buttons).
* Limitations:
  * Only one custom data profile can be defined on the player. If custom data profile is used by any other plugin, CTA metadata fields should be added to the same custom data profile
  * CTA without related videos is supported on video-on-demand, audio-on-demand (if the player includes a screen display), and YouTube entries; it is not supported on image entries, in-video-quizzes, and live entries. CTA with related videos will appear on the related screen in all cases, at the end of playback.

## Release 2.59  

* Mobile Autoplay: The Kaltura Player now supports autoplay on mobile web browsers for both iOS and Android. Playback will begin muted and the sound will be turned on upon any user interaction. For more information, please see [Mobile Player Support on Kaltura Player](https://knowledge.kaltura.com/node/1900).
* VR Support on Android Devices: The Kaltura Player now supports VR headsets on Android browsers. For more information, please see [Kaltura 360 and VR Video Player Support](https://knowledge.kaltura.com/node/1813).
* Yoboura plugin upgrade: The Youbora QoE plugin has been updated to the latest version 5.4.5-1.0.0.

## Release 2.58  

* The Shaka Playback Engine has been upgraded to version 2.1.3
* The Comscore analytics plugin has been upgraded to the latest Comscore version

## Release 2.56

Version 2.56 was released as a maintenance version. We are working on Player 3.0, stay tuned!

## Release 2.55  

### What's New  

Audio tracks management – Added the option to define the default audio track. For more information, see [Defining a Default Audio Track](https://vpaas.kaltura.com/documentation/Web-Video-Player/Define-Default-Audio-Track.html).

## Release 2.54  


### What's New  

Chromecast upgrade – The Web Receiver and sender to Google’s latest SDKs (CAST V3) has been upgraded..

## Release 2.53.2  


### What's New  

360 Videos – 360 video tagging added to the 360 video ingestion process for web and mobile web. See [Kaltura 360 Video Player Support](https://knowledge.kaltura.com/node/1813) for more information.

## Release 2.53  


### What's New  

* 360 Videos – 360 videos are now supported for web and mobile web. See [Kaltura 360 Video Player Support](https://knowledge.kaltura.com/node/1813) for more information.
* Live DRM – The Player now supports Kaltura’s uDRM solution on live streams. For more information about Kaltura’s uDRM solution, see [Universal DRM (uDRM) Technical Specification](https://knowledge.kaltura.com/node/1685).
* Multi Audio Tracks – With HLS.JS adding support for multi audio tracks, this is now fully supported across all devices and browsers.
* CVAA support for mobile devices – CVAA is now supported for mobile devices. For more information see [CVAA Support within the Kaltura Player Toolkit](https://knowledge.kaltura.com/node/1760).

## Release 2.52  

Version 2.52 was released as a maintenance vesion.

## Release 2.51  


### What's New  

* Automatic Player Update – New studio players will now be updated automatically to the latest available player version. Customers will still be able to choose to keep their current player version and to update manually when they want.
* Airplay Support – Added improvements to high-definition playback on casted devices.
* Native SDK Playback Performance -  Added enhancements resulting in faster response times to play/pause calls).

## Release 2.50  

Version 2.50 was released as a maintenance vesion.

## Release 2.49  


### What's New  

* Chromecast Refactoring – Added ad support to Kaltura’s Chromecast integration.
* Airplay Support – Improvements to high definition playback on casted devices.
* Native SDK Playback Performance -  Enhancements resulting in faster response times to play/pause calls).

## Release 2.48  

### What's New  

* HLS.JS by default –HLS.JS is now the default playback engine for HLS on Chrome, IE11+ and Firefox. Older browsers will fall back to OSMF to enable HLS delivery. 
* WV Modular on Firefox - Widevime Modular DRM is now supported on Firefox.
* Offline support of FPS for iOS10, including WebVTT and audiotracks support. 

See the [Kaltura Player Capabilities Matrix](https://knowledge.kaltura.com/kaltura-player-capabilities-matrix) for information about the Kaltura Player Capabilities and support.

## Release 2.47  


### What's New  

* Offline WebVTT on Android  - WebVTT captions for offline playback are now available on Android, for Android versions 4.3 and up. See the [Kaltura Player Capabilities Matrix](https://knowledge.kaltura.com/kaltura-player-capabilities-matrix) for a full Matrix of WebVTT support.
* CVAA Compliance – The Kaltura Player is now compliant with the [Twenty-First Century Communications and Video Accessibility Act (CVAA)](https://www.fcc.gov/consumers/guides/21st-century-communications-and-video-accessibility-act-cvaa) and includes a styling editor for captions to enhance accessibility. See [CVAA Support within the Kaltura Player Toolkit](https://knowledge.kaltura.com/node/1760) for more information.
* Safari on iOS10 - Fairplay DRM on Safari is now supported on iOS10. See the [Kaltura Player Capabilities Matrix](https://knowledge.kaltura.com/kaltura-player-capabilities-matrix) for a full Matrix of DRM support.

## Release 2.46  


### What's New  

* Kaltura V2 Mobile Skin Player -The new mobile skin is designed to enable a more mobile/touch friendly user experience on Kaltura's V2 players. The new mobile skin is available to all customers and is enabled via the KMC. For more information see [Using the Kaltura V2 Player Mobile Skin](https://knowledge.kaltura.com/node/1734).
* Enhancements to the Chromecast Receiver - Additional features to Kaltura's custom receiver, including:
* New mobile skin
* Closed captions and watermarks 
* Analytics from the receiver
* Double click pre-rolls
* Audio Selector in the Kaltura v2 Player - Use to enable multiple audio tracks on the player from the Player Studio.

## Release 2.45  


### What's New  

* HLS.JS integration - Kaltura's new HLS playback engine, based on HLS.JS, replaces the OSMF plugin and improves video load time by x4 . HLS.JS can be enabled for Chrome, IE11+ and Firefox. Older browsers will fall back to OSMF to enable HLS delivery. 
* Multiple Audio Tracks - Audio tracks in multiple languages are now available for Dash, HLS and HSS. 
* Inband support for WebVTT captions on HLS - WebVTT captions can now be ingested via the KMC, enabling End to End WebVTT support from ingest to playback.
* Offline Widevine modular DRM - now supported on Android 4.3 and up
* Fairplay on Safari - Fairplay DRM is now supported on Safari for Online viewing. Offline viewing will be supported in line with Apple support in iOS10.
