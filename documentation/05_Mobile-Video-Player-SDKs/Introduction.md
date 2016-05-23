---
layout: page
title: Introduction
weight: 100
---

The Kaltura Mobile SDKs for iOS and Android provide the framework and tools to help you easily embed the [Kaltura Video Player](http://player.kaltura.com/) into native environments in your iOS or Android applications without having to build player UI, plugins, or capabilities from scratch. The same web media player, easily customized via HTML5, CSS and JS, along with your plugins and themes loaded natively in your application, and seamlessly switching playback engines based on the best available device media APIs.

The Kaltura Player SDK for iOS and Android supports:  

* DRM  
* IMA (DFP)  
* Chromecast  
* AirPlay  
* Offline Mode (including DRM)  
* PIP

and more...

# Video Mobile SDKs Architecture Overview  
The Kaltura Player's architecture is designed to allow for a seamless integration experience, enabling you to connect mutltiple playback engines and platforms. The Player wraps the playback engine with the same interface and events, thereby allowing the same plugin code to work across multiple platforms, including iOS, Android, and web.  

Each platform supports different types of streaming capabilites and DRMs, allowing the Player to choose the best streaming technologies and DRM as needed. Plugins can be used with or without the UI, and can work crossplatform. Some plugins require native support, such as Chromecast, DRM and ads. The Player-SDK provides the DRM, Chromecast, and ads features out-of-the-box.  

The Player expose APIs - both basic API and common - for all platforms. If you are an iOS developer and you have already worked with AVFoundation, you should expect the same API as if you used the native player API.  

The Player API supports sending notifications to the Player, listening to events, and evaulating properties. 

Each Player configuration includes the UICONF object, which includes the Player configuration and indicates which plugins should be loaded. Every componenet of the Player is designed as a plugin.  

### Kaltura Player v2 Toolkit Architecture Diagram  

The following diagram visualizes the architecture of Kaltura Player, and highlights its flexibility and robust capabilities across platforms and devices: 

![Kaltura Media Player Architecture Diagram](https://knowledge.kaltura.com/sites/default/files/styles/large/public/kaltura-player-toolkit.png)

As the diagram above illustrates, you can leverage native components for [iOS](https://github.com/kaltura/player-sdk-native-ios/) and [Android](https://github.com/kaltura/player-sdk-native-android) in conjunction with the HTML5 runtime and Adobe flash or Microsoft Silverlight plugins, to transcend platform limitations across devices and browsers, while delivering the full Player v2 Toolkit experience. 

### Why Native?
What are the advantages of using native? Here is a feature list that will help explain the advantages of using the Kaltura Player Toolkit in native environments:

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

## Version Managment  

The Mobile Player SDKs are native iOS and Android wrapper libraries for the [Web Video Player library](https://vpaas.kaltura.com/documentation/04_Web-Video-Player/Player-Configuration.html).  
We recommend that you will always use the latest version of both the Web Video Player and the native Mobile Player SDKs.  

* You can upgrade the version of your Web Video Player by using the [Player Studio](https://knowledge.kaltura.com/node/1148#Updating the Player) and clicking upgrade.  
* To get the latest version of the Mobile Player SDK, always refer to the latest SDK tag on the github repository ([iOS SDK](https://github.com/kaltura/player-sdk-native-ios), [Android SDK](https://github.com/kaltura/player-sdk-native-android)).


