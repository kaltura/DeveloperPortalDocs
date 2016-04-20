---
layout: page
title: Player Plugin Overview
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios)
[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios)

# Player Plugin Overview 

This guide provides an overview of plugins for the Kaltura player. 

## Introduction
A plugin for the Kaltura player uses a combination of HTML, JavaScript and/or CSS to somehow customize the player. In other words, anything you can do in a web page, you can do in a plugin.

At a high level, a plugin integrates with the player by listening and emitting events.

Broadly, plugins can be developed to:

* Modify default behavior
* Add functionality
* Customize appearance

## Kaltura plugins
The following are Kaltura supplied plugins:
[Kaltura Player Plugins](https://vpaas.kaltura.com/documentation/player-sdk/Player-Plugins-in-the-SDK-Supported-plugins#sthash.3a8Dft10.dpbs)

### How to enable/create a plugin?

##### Use of a pre-written plugin

If we want to change/add a plugin the key will start with the plugin name, dot and the plugin attribute.

Every plugin includes the plugin attirbute which needed in order to enable or disable it.

In order to add plugin we use the addConfigKey ([iOS](https://github.com/kaltura/player-sdk-native-ios/blob/master/KALTURAPlayerSDK/KPPlayerConfig.h#L57) , [Android](https://github.com/kaltura/player-sdk-native-android/blob/master/playerSDK/src/main/java/com/kaltura/playersdk/KPPlayerConfig.java#L86)) function, First parameter takes the key name and second the value.

In this example we disabled the loadingSpinner plugin:

```
// objective_c
[config addConfigKey:@"loadingSpinner.plugin" withValue:@"false"];
```
```
// Java
config.addConfig("loadingSpinner.plugin", "false");
```

##### Custom plugin creation

To create custome plugin follow:
[Create Custom Plugin Doc](https://vpaas.kaltura.com/documentation/media-player/Player-Plugins#sthash.gtmiiI7F.dpbs)

### How to detect if configured plugins are loaded?

##### Open:
[Accessing the iOS player API Base Methods](https://vpaas.kaltura.com/documentation/player-sdk/Kaltura-iOS-player-API-Base-Methods#sthash.ObDzzCgb.spB9h8rA.dpbs)

##### Focus On: 
* "Receiving Notification when the Player API Is Ready"

### How to get notified about any player plugin related callbacks?

##### Open:
[Accessing the iOS player API Base Methods](https://vpaas.kaltura.com/documentation/player-sdk/Kaltura-iOS-player-API-Base-Methods#sthash.ObDzzCgb.spB9h8rA.dpbs)

##### Focus On: 
* addKPlayerEventListener