---
layout: page
title: Configuring the Player to use TVPAPI Stats Plugin in Android Devices
subcat: Android
weight: 293
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios)


This article describes the steps required to use TVPAPI Stats Plugin in Android devices.

## Enabling the plugin for the Kaltura Player  

To enable the Plugin in Android devices for the Kaltura Player do the following steps:

Register the Plugin inside your app:

```
PlayKitManager.registerPlugins(TVPAPIAnalyticsPlugin.factory);
```

## Configuring the plugin config object  

To configure the Plugin, add the following configuration to your `pluginConfig`:

```
private void configureTVPAPIPlugin(PlayerConfig pluginConfig) {
        JsonObject phoenixConfigEntry = new JsonObject();
        phoenixConfigEntry.addProperty("fileId", "fileId");
        phoenixConfigEntry.addProperty("baseUrl", "base url");
        phoenixConfigEntry.addProperty("timerInterval", timer value for HIT events - in millisecondes);//Default value - 30000
        phoenixConfigEntry.add("initObj", initObj); // must be a valid initObj of TVPAPI
```

## Setting the plugin config to the Plugin

In order for the Plugin to start loading, you need to set
the plugin config you created -

```
PlayerConfig config = new PlayerConfig();
PlayerConfig.Plugins plugins = config.plugins;
plugins.setPluginConfig("TVPAPIAnalytics" , converterPlugin.toJson()); 
```

## Supported events in the plugin
TVPAPI action Types{

 MediaHit, //outputs every interval time
 
 MediaMark //Outputs in the following events - {PLAY,STOP,PAUSE,FIRST_PLAY,LOAD,FINISH,BITRATE_CHANGE,ERROR}
}

