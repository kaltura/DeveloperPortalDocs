---
layout: page
title: Tracking Kaltura Video Player States and Events on Android Devices
subcat: Android Version 3.0
weight: 292
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/playkit-android)

This article describes the steps required for registering to Kaltura Video Player events and states on Android devices, which will enable you to track the events and their current status.

## Registering to Kaltura Video Player Events and States  

Implement the following to register:

```
private void setPlayerListeners() {
    playerKit.addEventListener(new PKEvent.Listener() {
         @Override
         public void onEvent(PKEvent event) {
             log.v("addEventListener " + event.eventType());
             log.v("Player Total duration => " + playerKit.getDuration());
             Enum receivedEventType = event.eventType();
             if (event instanceof PlayerEvent) {
                 switch (((PlayerEvent) event).type) {
                     case CAN_PLAY:
                         showOrHideContentLoaderProgress(false);
                         setUpdateProgressTask(true);
                         break;
                     case PLAY:
                         changePlayPauseControllerState(PLAY_STATE);
                         break;
                     case PLAYING:
                         PLAYBACK_STATE = PLAY_STATE;
                         onPlayerPlay();
                        break;
                     case PAUSE:
                         PLAYBACK_STATE = PAUSE_STATE;
                         break;
                     case SEEKING:
                         break;
                     case SEEKED:
                         handlePlayerControlOnSeek(false);
                         break;
                     case ENDED:
                         PLAYBACK_STATE = PAUSE_STATE;
                         onPlayerEnd();
                         break;
                     case TRACKS_AVAILABLE:
                         PKTracks tracks = ((PlayerEvent.TracksAvailable)event).getPKTracks();
                         mPlayerTrackInfo = tracks;
                         break;
                     case ERROR:
                         String errorMsg = "Player error occurred.";
                         break;
                 }
             }
         }

     }, PlayerEvent.Type.PLAY,
        PlayerEvent.Type.PAUSE, 
        PlayerEvent.Type.CAN_PLAY, 
        PlayerEvent.Type.SEEKING, 
        PlayerEvent.Type.SEEKED,
        PlayerEvent.Type.PLAYING,
        PlayerEvent.Type.ENDED, 
        PlayerEvent.Type.TRACKS_AVAILABLE, 
        PlayerEvent.Type.ERROR);
```

## Kaltura Video Player Supported Events  

The Kaltura Video Player supports the following events:

```
        STATE_CHANGED,
        CAN_PLAY,          // Sent when enough data is available that the media can be played, at least for a couple of frames. This corresponds to the HAVE_ENOUGH_DATA readyState.
        DURATION_CHANGE,   //  The metadata has loaded or changed, indicating a change in duration of the media. This is sent, for example, when the media has loaded enough that the duration is known.
        ENDED,             //  Sent when playback completes.
        ERROR,             //  Sent when an error occurs. The element's error attribute contains more information. See Error handling for details.
        LOADED_METADATA,   //  The media's metadata has finished loading; all attributes now contain as much useful information as they're going to.
        PAUSE,             //  Sent when playback is paused.
        PLAY,              //  Sent when playback of the media starts after having been paused; that is, when playback is resumed after a prior pause event.
        PLAYING,           //  Sent when the media begins to play (either for the first time, after having been paused, or after ending and then restarting).
        SEEKED,            //  Sent when a seek operation completes.
        SEEKING,           //  Sent when a seek operation begins.
        TRACKS_AVAILABLE,  // Sent when track info is available.
        REPLAY,            //Sent when replay happened.
        PLAYBACK_PARAMS,   // Sent event that notify about changes in the playback parameters. When bitrate of the video or audio track changes or new media loaded. Holds the PlaybackParamsInfo.java object with relevant data.
        VOLUME_CHANGED     // Sent when volume is changed.
```


## Registering to the Kaltura Video Player State Change Listener  

To be able to track changes in the player's state, register to the state change listener as follows:

```
playerKit.addStateChangeListener(new PKEvent.Listener() {
        @Override
        public void onEvent(PKEvent event) {

            PlayerEvent.StateChanged stateChanged = (PlayerEvent.StateChanged) event;
            log.v("addStateChangeListener " + event.eventType() + " = " + stateChanged.newState);
            switch (stateChanged.newState){
                case IDLE:
                    log.d("StateChange Idle");
                    break;
                case LOADING:
                    log.d("StateChange Loading");
                    break;
                case READY:
                    log.d("StateChange Ready");
                    mPlayerControlsView.setProgressBarVisibility(false);
                    break;
                case BUFFERING:
                    log.e("StateChange Buffering");
                    mPlayerControlsView.setProgressBarVisibility(true);
                    break;
            }

        }
    });
    
```

## Kaltura Video Player States  

The Kaltura Video Player state can be one of the following states:

```
IDLE, 
LOADING, 
READY, 
BUFFERING
```
