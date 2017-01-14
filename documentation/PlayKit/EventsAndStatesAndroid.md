---
layout: page
title: Events and States on Android Devices
ubcat: SDK 3.0 (Beta) - Android
weight: 414
---

## Events  

### Registering to Player Events  

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
             } else if (event instanceof AdEvent) {
                 switch (((AdEvent) event).type) {
                     case LOADED:
                         showOrHideContentLoaderProgress(false);
                         break;
                     case ALL_ADS_COMPLETED:
                         break;
                     case CONTENT_PAUSE_REQUESTED:
                         break;
                     case STARTED:
                         PLAYBACK_STATE = PLAY_STATE;
                         mAdStartedEventInfo = (AdEvent.AdStartedEvent) event;
                         mAdPlayState = AD_STARTED;
                         mAdRequestStatus = AD_SERVED;
                         break;
                     case PAUSED:
                         PLAYBACK_STATE = PAUSE_STATE;
                         break;
                     case TAPPED:
                         break;
                     case COMPLETED:
                         mAdPlayState = AD_COMPLETE;
                         break;
                     case SKIPPED:
                         break;
                 }
             } else if (event instanceof AdError) {
                 switch (((AdError) event).errorType) {
                     case ADS_REQUEST_NETWORK_ERROR:
                     case INTERNAL_ERROR:
                     case VAST_MALFORMED_RESPONSE:
                     case UNKNOWN_AD_RESPONSE:
                     case VAST_LOAD_TIMEOUT:
                     case VAST_TOO_MANY_REDIRECTS:
                     case VIDEO_PLAY_ERROR:
                     case VAST_MEDIA_LOAD_TIMEOUT:
                     case VAST_LINEAR_ASSET_MISMATCH:
                     case OVERLAY_AD_PLAYING_FAILED:
                     case OVERLAY_AD_LOADING_FAILED:
                     case VAST_NONLINEAR_ASSET_MISMATCH:
                     case COMPANION_AD_LOADING_FAILED:
                     case UNKNOWN_ERROR:
                     case VAST_EMPTY_RESPONSE:
                     case FAILED_TO_REQUEST_ADS:
                     case VAST_ASSET_NOT_FOUND:
                     case INVALID_ARGUMENTS:
                     case PLAYLIST_NO_CONTENT_TRACKING:
                         playerKit.play();
                         break;
                 }
             }

             if (event instanceof PlayerEvent || receivedEventType == AdEvent.Type.PAUSED || receivedEventType == AdEvent.Type.RESUMED || receivedEventType == AdEvent.Type.STARTED) {
                 mPlayKitState = event.eventType();
             }

         }

     }, PlayerEvent.Type.PLAY, PAUSE, CAN_PLAY, PlayerEvent.Type.SEEKING, PlayerEvent.Type.SEEKED, PlayerEvent.Type.PLAYING,
            PlayerEvent.Type.ENDED, PlayerEvent.Type.TRACKS_AVAILABLE, PlayerEvent.Type.ERROR,
            AdEvent.Type.LOADED, AdEvent.Type.SKIPPED, AdEvent.Type.TAPPED, AdEvent.Type.CONTENT_PAUSE_REQUESTED, AdEvent.Type.CONTENT_RESUME_REQUESTED, AdEvent.Type.STARTED, AdEvent.Type.PAUSED, AdEvent.Type.RESUMED,
            AdEvent.Type.COMPLETED, AdEvent.Type.ALL_ADS_COMPLETED, AdError.Type.ADS_REQUEST_NETWORK_ERROR,
            AdError.Type.VAST_EMPTY_RESPONSE, AdError.Type.COMPANION_AD_LOADING_FAILED, AdError.Type.FAILED_TO_REQUEST_ADS,
            AdError.Type.INTERNAL_ERROR, AdError.Type.OVERLAY_AD_LOADING_FAILED, AdError.Type.PLAYLIST_NO_CONTENT_TRACKING,
            AdError.Type.UNKNOWN_ERROR, AdError.Type.VAST_LINEAR_ASSET_MISMATCH, AdError.Type.VAST_MALFORMED_RESPONSE,
            AdError.Type.VAST_LOAD_TIMEOUT, AdError.Type.INVALID_ARGUMENTS, AdError.Type.VAST_TOO_MANY_REDIRECTS);
}

```

### Registering to Player State Change Listeners  

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
