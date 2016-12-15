---
layout: page
title: Player States and Events for Android
subcat: Android
weight: 292
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/playkit-android)


This article describes the steps required to use Phoenix Stats Plugin in Android devices.

## Enabling the plugin for the Kaltura Player  

To enable the Plugin in Android devices for the Kaltura Player do the following steps:

Register the Plugin inside your app:

```
PlayKitManager.registerPlugins(PhoenixAnalyticsPlugin.factory);
```

## Configuring the plugin config object  

To configure the Plugin, add the following configuration to your `pluginConfig`:

```
private void configurePhoenixPlugin(PlayerConfig pluginConfig) {
        JsonObject phoenixConfigEntry = new JsonObject();
        phoenixConfigEntry.addProperty("fileId", "fileId");
        phoenixConfigEntry.addProperty("partnerId", "partner id");
        phoenixConfigEntry.addProperty("baseUrl", "base url");
        phoenixConfigEntry.addProperty("ks", ks); 
        phoenixConfigEntry.addProperty("timerInterval", timer value for HIT events - in millisecondes);//Default value - 30000
```

## Setting the plugin config to the Plugin

In order for the Plugin to start loading, you need to set
the plugin config you created -

```
PlayerConfig config = new PlayerConfig();
PlayerConfig.Plugins plugins = config.plugins;
plugins.setPluginConfig("PhoenixAnalytics" , converterPlugin.toJson()); 
```

## Supported events in the plugin
PhoenixActionType{
 HIT, //outputs every interval time
 
 PLAY, 
 
 STOP,
 
 PAUSE,
 
 FIRST_PLAY,
 
 LOAD,
 
 FINISH,
 
 BITRATE_CHANGE,
 
 ERROR

}



