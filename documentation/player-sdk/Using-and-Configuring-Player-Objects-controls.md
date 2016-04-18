---
layout: page
title: Using and Configuring Player Objects, Native vs HTML5 controls
---

One of the key features of the player-sdk is the ability to use html/css UI which can work on all platforms [iOS/Android/Web].
As a developer you can choose if you want to work with the default skin, develop your own skin or develop native controls and user our player as playback engine with non-ui plugins.
In this document we'll show key configuration keys for the html5/css UI, how to add/remove plugins from the player from the embed code and how to eliminate the UI and add native controls to the player.
This document is relevent for both iOS and Android developers.

## Basic - how to configure a plugin 
Plugin - any UI element on the player like Play/Volume/Caption... or non-ui logic like Analytics or Monetization.
In order to add configuration we use the addConfigKey function, First parameter takes the key name and second the value.
```Objective-c
[config addConfigKey:@"loadingSpinner.plugin" withValue:@"false"];
```

```Java
config.addConfig("loadingSpinner.plugin", "false");
```

If we want to change/add a plugin the key will start with the plugin name, dot and the plugin attribute.
Every plugin include the plugin attirbute which needed in order to enable or disable it.
In this example we disabled the loadingSpinner plugin.

TODO - reference to the plugins doc of the player.

.

## How to remove the html5 UI

## Events & Notification you'll need for Native UI

## Setting player properties at runtime

