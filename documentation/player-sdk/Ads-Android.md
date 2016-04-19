---
layout: page
title: Using Google Ads in Android
---

#Configure the player for using Ads

Add to your `KPPlayerConfig` these:

```
config.addConfig("doubleClick.plugin", "true");
config.addConfig("doubleClick.adTagUrl", "your ad tag URL");
```

And that's it you are ready to use ads.

#Listening to Ad's events

If you should listen to ad's events you can use:

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