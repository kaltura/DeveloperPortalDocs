---
layout: page
title: Kaltura Mobile SDK Introduction
weight: 100
---

The Kaltura Mobile SDKs for iOS and Android provide the framework and tools to help you easily embed the [Kaltura Video Player](http://player.kaltura.com/) into native environments in your iOS or Android applications, without having to build a Player UI, plugins, or capabilities from scratch. 

The SDK is essentially a native (i.e., Java or ObjectiveC-based code) wrapper that loads the same Kaltura web Player inside a WebView. This means that the Player is the **same** Player - including all of all the customizations, themes, and plugins that are used on your website or web application - that is also being used in your native mobile application. When the Player loads inside your native application, it automatically (seamlessly) decides which is the best playback engine to leverage for playback (e.g., the native Media API of the device, a DRM provider’s API, etc.). This seamless behavior simplifies how you, the developer, build mobile video applications, by saving you the need to address video playback optimization, security or worry about maintaining the same UI across devices and platforms.

The Kaltura Player SDK for iOS and Android supports:  

* DRM  
* IMA (DFP)  
* Chromecast  
* AirPlay  
* Offline Mode (including DRM)  
* PIP

and more...

## The Mobile SDK's Architecture Overview  
The Kaltura Player's architecture is designed to allow for a seamless integration experience, enabling you to connect mutltiple playback engines and platforms. The Player wraps the playback engine with the same interface and events, thereby allowing the same plugin code to work across multiple platforms, including iOS, Android, and web.  

Each platform supports different types of streaming capabilites and DRMs, allowing the Player to choose the best streaming technologies and DRM as needed. Plugins can be used with or without the UI, and can work crossplatform. Some plugins require native support, such as Chromecast, DRM and ads. The Player-SDK provides the DRM, Chromecast, and ads features out-of-the-box.  

The Player expose APIs - both basic API and common - for all platforms. If you are an iOS developer and you have already worked with AVFoundation, you should expect the same API as if you used the native player API.  

The Player API supports sending notifications to the Player, listening to events, and evaulating properties. 

Each Player configuration includes the UICONF object, which includes the Player configuration and indicates which plugins should be loaded. Every componenet of the Player is designed as a plugin.  

## The Kaltura Player Architecture

The following diagram visualizes the Kaltura Player architecture, and highlights its flexibility and robust capabilities across platforms and devices: 

![Kaltura Media Player Architecture Diagram](https://knowledge.kaltura.com/sites/default/files/styles/large/public/kaltura-player-toolkit.png)

As the diagram above illustrates, you can leverage native components for [iOS](https://github.com/kaltura/player-sdk-native-ios/) and [Android](https://github.com/kaltura/player-sdk-native-android) in conjunction with HTML5 runtime and Adobe Flash or Microsoft Silverlight plugins, to transcend platform limitations across devices and browsers, while delivering the full Player v2 Toolkit experience. 

## When Should You Use Native Mobile SDKs?

What are the advantages of using native mobile SDKs? Here is a feature list that explains the advantages of using the Kaltura Player Toolkit in native environments:

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

The Mobile Video Player SDKs are native iOS and Android wrapper libraries for the [Web Video Player library](https://vpaas.kaltura.com/documentation/04_Web-Video-Player/Player-Configuration.html).  
We recommend using the latest version of both the Web Video Player and the native Mobile Player SDKs.  

* You can upgrade the version of your Web Video Player by using the [Player Studio](https://knowledge.kaltura.com/node/1148#Updating the Player) and clicking **Upgrade**.  
* To get the latest version of the Mobile Player SDK, always refer to the latest SDK tag on the github repository ([iOS SDK](https://github.com/kaltura/player-sdk-native-ios), [Android SDK](https://github.com/kaltura/player-sdk-native-android)).


