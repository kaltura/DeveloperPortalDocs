---
layout: page
title: Using Google Ads in Android
---

#Configure the Player for Using Ads
To configure the Player to use ads:

Add the following to your `KPPlayerConfig`:

```
config.addConfig("doubleClick.plugin", "true");
config.addConfig("doubleClick.adTagUrl", "your ad tag URL");
```
#Listening to Ad Events
To listen to ad events, you can use the following:

todo link to the kdp api example

[List of commonly used player ad events](https://github.com/kaltura/DeveloperPortalDocs/blob/master/documentation/media-player/Kaltura-Media-Player-API.md#commonly-used-player-ad-events-ad-sequence-events)

```
mPlayer.addKPlayerEventListener("adClick", "some_id", new PlayerViewController.EventListener() {
                @Override
                public void handler(String eventName, String params) {
                    // Do your stuff here..
                }
            });
```
