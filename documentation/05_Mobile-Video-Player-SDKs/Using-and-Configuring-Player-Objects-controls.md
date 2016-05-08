---
layout: page
title: Using and Configuring Player Objects, Native vs HTML5 controls
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) [![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios)

One of the key features of the Player-SDK is the ability to use the HTML/CSS UI, which can work on all platforms [iOS/ Android/ Web].

As a developer you can choose if you want to:

* Work with the default skin  
* Develop your own skin
* Develop native controls  

In this document you'll learn how to:

* Configure keys for the html5/css UI
* Add/remove plugins from the player embed code  
* Attach custom plugins
* Eliminate the UI and add native controls from the player

**Note:** Before getting started, we recommend you read the following article on Player configuration:
[Kaltura Media Player Configuration](https://github.com/kaltura/DeveloperPortalDocs/blob/master/documentation/04_Web-Video-Player/Player-Configuration.md) and verify that at this stage, you should have your Player configured via KMC.

## How to Work with the Kaltura Player API
The following article provides a detailed explanation on [accessing the iOS Player API base methods] (https://github.com/kaltura/DeveloperPortalDocs/blob/master/documentation/05_Mobile-Video-Player-SDKs/Kaltura-iOS-player-API-Base-Methods.md).


## Using the Kaltura Player Plugin
To learm about the Kaltura Player plugin and how it helps you to customize your Player, refer to the [Player Plugin Overview]( https://github.com/kaltura/DeveloperPortalDocs/blob/master/documentation/05_Mobile-Video-Player-SDKs/Player-Plugin-Overview.md).


## How to Remove html5 UI Controls
Use these commands to remove the html5 UI controls

    [config addConfigKey:@"controlBarContainer.plugin" withValue:@"false"];
    [config addConfigKey:@"topBarContainer.plugin" withValue:@"false"];
    [config addConfigKey:@"largePlayBtn.plugin" withValue:@"false"];
    
## How to Disable the HTML Spinner and Control it with a Custom Spinner
To disable the HTML spinner and control it with a customer spinner, you will need to follow these configuration steps:

Configurations:

To disable the HTML spinner: disable "loadingSpinner.plugin" plugin

```
[config addConfigKey:@"loadingSpinner.plugin" withValue:@"false"];
```
To start a buffering event: "onAddPlayerSpinner"

```
[self.player addKPlayerEventListener:@"onAddPlayerSpinner" eventID:@"onAddPlayerSpinner" handler:^(NSString  
 *eventName, NSString *params) {
        //your code
    }];
```

To stop a buffering event: "onRemovePlayerSpinner"

```
[self.player addKPlayerEventListener:@"onRemovePlayerSpinner" eventID:@"onRemovePlayerSpinner" 
 handler:^(NSString *eventName, NSString *params) {
        //your code
    }];
```

