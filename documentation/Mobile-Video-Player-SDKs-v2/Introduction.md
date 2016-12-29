---
layout: page
title: Kaltura Mobile SDK Introduction
weight: 100
---

The Kaltura Mobile SDKs for iOS and Android provide the framework and tools to help you easily embed the [Kaltura Video Player](http://player.kaltura.com/) into native environments in your iOS or Android applications, without having to build a Player UI, plugins, or capabilities from scratch. 

The SDK is essentially a native (i.e., Java or ObjectiveC-based code) wrapper that loads the same Kaltura Video Player inside a WebView. The Kaltura Video Player that is loaded into your native mobile application is essentially the **same** player that includes all of the customizations, themes, and plugins that are used on your website or web application. When the Kaltura Video Player loads into your native application, it ( dz -what is it - the player technolocy ? the application?)  automatically (seamlessly) decides which is the best playback engine to leverage for playback (e.g., the native Media API of the device, a DRM provider’s API, etc.). This seamless behavior simplifies how you, the developer, build mobile video applications, by saving you the need to address video playback optimization, security, or (dz -ensuring the UI consistency) worry about maintaining the same UI across devices and platforms.

The Kaltura Vidoe Player SDK for iOS and Android supports:  

* DRM  
* IMA (DFP)  
* Chromecast  
* AirPlay  
* Offline Mode (including DRM)  
* PIP

and more...

## The Mobile SDK's Architecture Overview  
The Kaltura Video Player's architecture is designed to allow for a seamless integration experience, enabling you to connect mutltiple playback engines and platforms. The Kaltura Video Player wraps the playback engine with the same interface and events, thereby allowing the same plugin code to work across multiple platforms, including iOS, Android, and web.  

Each platform supports different types of streaming capabilites and DRMs. The Kaltura Video Player's technology determines the best streaming delivery method and DRM as needed. Plugins can be used with or without the UI, and can work cross-platform. Some plugins require native support, such as Chromecast, DRM and ads. The Kaltura Video Player-SDK provides the DRM, Chromecast, and ads features out-of-the-box.  

The Kaltura Video Player exposes APIs - both basic APIs and common - for all platforms. If you are an iOS developer and you have already worked with AVFoundation, you should expect the same API as if you used the native player API.  

The Player API supports sending notifications to the Kaltura Video Player, listening to events, and evaulating properties. 

Each Kaltura Video Video Player configuration includes the UICONF object, which includes the player configuration and indicates which plugins should be loaded. Every componenet of the layer is designed as a plugin.  

## The Kaltura Video Player Architecture

The following diagram visualizes the Kaltura Video Player architecture, and highlights its flexibility and robust capabilities across platforms and devices: 

![Kaltura Video Player Architecture Diagram](https://knowledge.kaltura.com/sites/default/files/styles/large/public/kaltura-player-toolkit.png)

As the diagram above illustrates, you can leverage native components for [iOS](https://github.com/kaltura/player-sdk-native-ios/) and [Android](https://github.com/kaltura/player-sdk-native-android) in conjunction with HTML5 runtime and Adobe Flash or Microsoft Silverlight plugins, to transcend platform limitations across devices and browsers, while delivering the full Kaltura Video Player v2 Toolkit experience. 

## When Should You Use Native Mobile SDKs?

What are the advantages of using native mobile SDKs? Here is a feature list that explains the advantages of using the Kaltura Video Player Toolkit in native environments:

| Player Feature | iOS WebView | iOS Native |Android WebView | Android Native |  
|:-------------  |:----------  |:---------- |:-------------- |:-------------- |  
|CSS skin      | Not supported on iPhone  | Supported  | Supported | Supported |  
|JS Plugins    | Supported                | Supported  | Supported | Supported |  
|Apple HLS Playback[AES] | Supported | Supported  | Broken support across fragmented | Supported |  
|MPEG-Dash |Unsupported | Supported via partners software players | Supported, with consistent experience across android versions | Supported |  
|AutoPlay     | Not supported  | Supported  | Not supported  | Supported |  
|Chromecast     | Not supported  | Supported  | supported  | Supported |  
|DRM     | Not supported  | Supported  | Not supported  | Supported |  
|Ads     | Supported without dual buffer | Supported  | Supported without dual buffer   | Supported |  

## Player Version Managment  

The Mobile Video Player SDKs are native iOS and Android wrapper libraries for the [Kaltura Web Video Player Library](https://vpaas.kaltura.com/documentation/04_Web-Video-Player/Player-Configuration.html).  
We recommend using the latest version of both the Kaltura Web Video Player and the native Mobile Player SDKs.  

* You can upgrade the version of your Kaltura Web Video Player by using the [Player Studio](https://knowledge.kaltura.com/node/1148#Updating the Player) and clicking **Upgrade**.  
* To get the latest version of the Mobile Player SDK, always refer to the latest SDK tag on the github repository ([iOS SDK](https://github.com/kaltura/player-sdk-native-ios), [Android SDK](https://github.com/kaltura/player-sdk-native-android)).


