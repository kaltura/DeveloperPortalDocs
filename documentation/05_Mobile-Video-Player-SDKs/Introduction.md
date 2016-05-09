---
layout: page
title: Introduction
weight: 1
---

## Introduction

Welcome to the **Kaltura Video Platform**. Kaltura is the world's first Open Source Online Video Platform, providing both enterprise level commercial software and services, fully supported and maintained by Kaltura, as well as free, open-source community-supported solutions, for video publishing, management, syndication and monetization.

This wiki is the main source of documentation for **developers** working with **Kaltura iOS and Android Player SDK** project. Here you will find the information you need to get started developing your software using the SDK. The SDK provides tools to help you easily embed the {% extlink Kaltura Player http://player.kaltura.com/docs %} into native environments in your iOS or Android applications.

If this is your first time using Kaltura's Video Platform, we recommend you begin with the {% extlink Kaltura website http://corp.kaltura.com/ %}, which will help you learn more about our video technology.

## Supported Features
The Kaltura Player SDK for iOS and Android supports:  

* DRM  
* IMA (DFP)  
* Chromecast  
* AirPlay  
* Offline Mode (including DRM)  
* PIP

and more...

# Architecture Overview
The Kaltura Player's architecture is designed to allow for a seamless integration experience, enabling you to connect mutltiple playback engines and platforms.  
The kaltura Player wraps the playback engine with the same interface and events, thereby allowing the same plugin code to work across multiple platforms, including iOS, Android, and web.  

Each platform supports different types of streaming capabilites and DRMs, allowing the Player to choose the best streaming technologies and DRM as needed. Plugins can be used with or without the UI, and can work crossplatform. Some plugins require native support, such as Chromecast, DRM and ads. The Player-SDK provide the DRM, Chromecast, and ads features out-of-the-box.  

The Player expose APIs - both basic API and common - for all platforms. If you are an iOS developer and you have already worked with AVFoundation, you should expect the same API as if you used the native player API.  

The Player API supports sending notifications to the Player, listening to events, and evaulating properties.  
Each Player configuration includes the UICONF object, which includes the Player configuration and indicates which plugins should be loaded.  

Every componenet of the Player is designed as a plugin.  

### Kaltura Player v2 Toolkit Architecture Diagram

The following diagram visualizes the architecture of Kaltura Player, and highlights its flexibility and robust capabilities across platforms and devices: 

![](https://knowledge.kaltura.com/sites/default/files/styles/large/public/kaltura-player-toolkit.png)

As the diagram outlines, we can leverage native components for {% extlink iOS https://github.com/kaltura/player-sdk-native-ios/ %} and {% extlink Android https://github.com/kaltura/player-sdk-native-android %} in conjunction with the HTML5 runtime and Adobe flash or Microsoft Silverlight plugins, to transcend platform limitations across devices and browsers, while delivering the full Player v2 Toolkit experience. 

### Why Native?
What advantages are gained by using native? Here is a feature list that will help explain the advantages of using the Kaltura Player Toolkit in native environments:

              | iOS WebView              | iOS Native |Android WebView | Android Native |
------------- | -----------------        | ---------- | -------------- | ---------------|
CSS skin      | Not supported on iPhone  | Supported  | Supported | Supported
JS Plugins    | Supported                | Supported  | Supported | Supported
Apple HLS Playback[AES]| Supported            | Supported  | Broken support across fragmented | Supported
MPEG-Dash     |Unsupported|Supported via partners software players| Supported, with consistent experience across android versions | Supported
AutoPlay     | Not supported  | Supported  | Not supported  | Supported
Chromecast     | Not supported  | Supported  | supported  | Supported
DRM     | Not supported  | Supported  | Not supported  | Supported
Ads     | Supported without dual buffer | Supported  | Supported without dual buffer   | Supported


## Version Managment
To use the Player-SDK, you will need two main versions - one for the Player-SDK and one for the html5 library (lib).
The html5 lib is configured in the UICONF object; the best practice in this case is to use the latest version. You can alwayes upgrade using the version using the Player Studio.  

When using the SDK, always use the latest SDK tag.


