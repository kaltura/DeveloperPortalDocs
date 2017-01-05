---
layout: page
title: Configuring the Phoenix Stats Plugin on Android Devices
subcat: Android
weight: 292
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios)


This article describes the steps required for configuring the Kaltura Video Player to use the Phoenix Stats Plugin on Android devices as well as the supported plugin events. This will enable you to obtain important statistical information about usage.

## Register the Phoenix Stats Plugin inside your Application  

Register the Phoenix Stats Plugin inside your application as follows:

```
PlayKitManager.registerPlugins(PhoenixAnalyticsPlugin.factory);
```

## Configure the Plugin Configuration Object for the Phoenix Stats Plugin  

To configure the Phoenix Stats Plugin, add the following configuration to your `pluginConfig` file as follows:

```
private void configurePhoenixPlugin(PlayerConfig pluginConfig) {
        JsonObject phoenixConfigEntry = new JsonObject();
        phoenixConfigEntry.addProperty("fileId", "fileId");
        phoenixConfigEntry.addProperty("partnerId", "partner id");
        phoenixConfigEntry.addProperty("baseUrl", "base url");
        phoenixConfigEntry.addProperty("ks", ks); 
        phoenixConfigEntry.addProperty("timerInterval", timer value for HIT events - in millisecondes);//Default value - 30000
```

## Set the Plugin Configuration to the Phoenix Stats Plugin  

For the  Phoenix Stats Plugin to start loading, you'll need to set the plugin configuration you created as follows:

```
PlayerConfig config = new PlayerConfig();
PlayerConfig.Plugins plugins = config.plugins;
plugins.setPluginConfig("PhoenixAnalytics" , phoenixConfigEntry.toJson()); 
```

## Phoenix Stats Plugin Supported Events  

The following events are supported by the Phoenix Stats Plugin:

 HIT, //outputs every interval time
 
 PLAY, 
 
 STOP,
 
 PAUSE,
 
 FIRST_PLAY,
 
 LOAD,
 
 FINISH,
 
 BITRATE_CHANGE,
 
 ERROR


## Concurrency Handler  

To receive concurrency events from the Phoenix Stats Plugin, you'll need to add a listener to the following event:

```
messageBus.listen(new PKEvent.Listener() {
                        @Override
                        public void onEvent(PKEvent event) {
                            if (event instanceof OttEvent){
                                \\Handle concurrency events
                            }
                        }
                    }, OttEvent.OttEventType.Concurrency);
                    
```


