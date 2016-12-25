---
layout: page
title: Using and Configuring Player Objects, Native vs HTML5 controls
subcat: SDK Version 2.0
weight: 130
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) [![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios)

One of the key features of the Player-SDK is the ability to use the HTML/CSS UI, which can be used on all platforms - iOS, Android and Web.

As a developer you can choose if you want to:

* Work with the default skin  
* Develop your own skin
* Develop native controls  

In this document you'll learn how to:

* Configure keys for the html5/css UI
* Add/remove plugins from the player embed code  
* Attach custom plugins
* Eliminate the UI and add native controls from the player

## Before You Begin  

Before getting started, we recommend you read the following article on [configuring the Kaltura Media Player](https://vpaas.kaltura.com/documentation/04_Web-Video-Player/Player-Configuration.html). You should also verify that you have your Player configured via KMC.

Additionally, the following article provides a detailed explanation on [accessing the iOS Player API base methods](https://vpaas.kaltura.com/documentation/05_Mobile-Video-Player-SDKs/Kaltura-iOS-player-API-Base-Methods.html).

To learm more about the Kaltura Player plugin and how it helps you to customize your Player, refer to the [Player Plugin Overview](https://vpaas.kaltura.com/documentation/05_Mobile-Video-Player-SDKs/Player-Plugin-Overview.html).


## Removing html5 UI Controls  

Use these commands to remove the html5 UI controls:

    [config addConfigKey:@"controlBarContainer.plugin" withValue:@"false"];
    [config addConfigKey:@"topBarContainer.plugin" withValue:@"false"];
    [config addConfigKey:@"largePlayBtn.plugin" withValue:@"false"];
    
## Disabling the HTML Spinner and Controlling it with a Custom Spinner  

To disable the HTML Spinner and control it with a customer spinner, you will need to follow these configuration steps:

* To disable the HTML spinner, use the disable "loadingSpinner.plugin":

```
[config addConfigKey:@"loadingSpinner.plugin" withValue:@"false"];
```
* To start a buffering event, use "onAddPlayerSpinner":

```
[self.player addKPlayerEventListener:@"onAddPlayerSpinner" eventID:@"onAddPlayerSpinner" handler:^(NSString  
 *eventName, NSString *params) {
        //your code
    }];
```

* To stop a buffering event, use "onRemovePlayerSpinner":

```
[self.player addKPlayerEventListener:@"onRemovePlayerSpinner" eventID:@"onRemovePlayerSpinner" 
 handler:^(NSString *eventName, NSString *params) {
        //your code
    }];
```

## Disabling thumbnails

We can disable the loading of assets by setting uiconf:

```
[config addConfigKey:@"EmbedPlayer.HidePosterOnStart" withValue:@"true"];
[config addConfigKey:@"scrubber.sliderPreview" withValue:@"false"];
``` 

These settings will prevent loading the thumbnails assets.
Set this on your own discretion, as it is dependent of application usage (weather it uses web component scrubber or not, or if it needs poster on start or not).

