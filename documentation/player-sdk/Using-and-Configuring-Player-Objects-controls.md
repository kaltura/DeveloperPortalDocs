---
layout: page
title: Using and Configuring Player Objects, Native vs HTML5 controls
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) [![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios)

One of the key features of the player-sdk is the ability to use html/css UI which can work on all platforms [iOS/ Android/ Web].

As a developer you can choose if you want:

* Work with the default skin  
* Develop your own skin
* Develop native controls  

In this document we'll show:

* Configuration keys for the html5/css UI
* How to add/remove plugins from the player embed code  
* Attaching custom plugins
* How to eliminate the UI and add native controls to the player

Before starting you should read the follwoing:
[Kaltura Media Player Configuration] (https://vpaas.kaltura.com/documentation/media-player/Player-Configuration)

Now at this step you already configured your player via KMC.

## How to work with kaltura player API?
[Accessing the iOS player API Base Methods](https://vpaas.kaltura.com/documentation/player-sdk/Kaltura-iOS-player-API-Base-Methods#sthash.ObDzzCgb.spB9h8rA.dpbs)


## What is Kaltura Player Plugin? and How It Helps me To Customize My Player?
[Player Plugin Overview](https://vpaas.kaltura.com/documentation/player-sdk/Player-Plugin-Overview#sthash.avrM8Tj7.MuWspf6K.dpbs)


## How to remove the html5 UI Controls?

    [config addConfigKey:@"controlBarContainer.plugin" withValue:@"false"];
    [config addConfigKey:@"topBarContainer.plugin" withValue:@"false"];
    [config addConfigKey:@"largePlayBtn.plugin" withValue:@"false"];
    
## How to Disable HTML Spinner & Control it with custom spinner?

Configurations:

For disabling HTML spinner: disable "loadingSpinner.plugin" plugin

```
[config addConfigKey:@"loadingSpinner.plugin" withValue:@"false"];
```
Start Buffering event: "onAddPlayerSpinner"

```
[self.player addKPlayerEventListener:@"onAddPlayerSpinner" eventID:@"onAddPlayerSpinner" handler:^(NSString  
 *eventName, NSString *params) {
        //your code
    }];
```

Stop Buffering event: "onRemovePlayerSpinner"

```
[self.player addKPlayerEventListener:@"onRemovePlayerSpinner" eventID:@"onRemovePlayerSpinner" 
 handler:^(NSString *eventName, NSString *params) {
        //your code
    }];
```

