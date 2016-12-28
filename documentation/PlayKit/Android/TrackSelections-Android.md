
---
layout: page
title: Track Selection
subcat: Android
weight: 291
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/playkit-android)

##About this feature.

If you want to change the video/audio quality, or captions language it is obvious that you should use tracks. In our SDK you can do it in a few very simple steps. All you need is to listen to the event, receive 
the tracks data object and populate your views with it. When the desired track was selected, just send us the selected track id and we will do the work. Lets take a close look on how exactly you can do it.

##Listening to the event.

If you dont know how to listen to the player events, please follow [this link.](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/PlayerStatesAndEvents-Android.md)
In order to receive tracks all you need is to subscribe to the event called ***TRACKS_AVAILABLE***.

```
//Subscribe to TRACKS_AVAILABLE event.
 player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                //Cast event to PlayerEvent.TracksAvailable
                PlayerEvent.TracksAvailable tracksAvailable = (PlayerEvent.TracksAvailable) event;
                //Get the tracks data object.
                tracks = tracksAvailable.getPKTracks();
                //Populate your views using tracks.
             	populateViews(tracks);
            }
        }, PlayerEvent.Type.TRACKS_AVAILABLE);
```

## PKTracks structure
PKTracks object consist from 3 lists. vide

