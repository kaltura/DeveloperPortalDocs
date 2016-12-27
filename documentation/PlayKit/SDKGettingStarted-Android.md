---
layout: page
title: Integrating the Playkit SDK in Android Applications
subcat: Android
weight: 291
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/playkit-android)

This article will describe step by step integraition of the Playkit SDK in your application. 
Following this simple steps, you will be able to create your own player and start using it. So lets get started!

## Integrate the Plakit SDK into your Application Settings 

1. Clone the SDK  from https://github.com/kaltura/playkit-android and locate it next to your application code. 
2. In the setting.gradle, add the SDK projet settings as follows:
```
include ':playkit', ':playkitdemo'
```
3. In your build.gradle file, add the dependancy for the SDK:

```
 compile project(path: ':playkit')
```

## Create the player instance and start playback.
In order to create the instance of the player all you need to do is to add this line in your Activity/Fragment. Passing the [PlayerConfig](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/PlayerConfig.java) object and Android Context.

```
playerKit = PlayKitManager.loadPlayer(config, this);

```

Now, when we have an instance of the player, all we need to do in order to start the playback is to call:

```
player.play();
```
In order to pause the playback just call:

```
player.pause();
```

## More about PlayerConfig:
Here we will learn more about this object and how to create it. In general, this is a simple data object, which holds the initial configurations for the player. Like media entry we want to play and plugins we want to configure. 

[PlayerConfig](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/PlayerConfig.java) consist from two main objects. The Media and the Plugins. For now we will focus on creating the Media object. But more about Plugins you can learn in the [Plugins section](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Plugins-Android.md).

Playkit provides you with the build in [MediaProviders]()



#Build the Player Config

```
PlayerConfig config = new PlayerConfig();
config.media.setMediaEntry(mediaEntry);
config.media.setAutoPlay(true);
if (WATCHED_DURATION == -1) {
    config.media.setStartPosition(0);
} else {
    config.media.setStartPosition((long) MEDIA_WATCHED_DURATION);
}
```



## Create The PlayKitManager
```
playerKit = PlayKitManager.loadPlayer(config, this);

```

## Initializing the Player with your config 

```
if (playerKit == null) {
    playerKit = PlayKitManager.loadPlayer(config, VideoPlayerBaseActivity.this);
    final FrameLayout playerKitViewContainer = (FrameLayout) findViewById(R.id.player_root);
    ViewGroup.LayoutParams layoutParams = new ViewGroup.LayoutParams(getWindow().getDecorView().getMeasuredWidth(),
            getWindow().getDecorView().getMeasuredHeight());
   
    View playerKitView = playerKit.getView();
    playerKitView.setLayoutParams(layoutParams);
    playerKitViewContainer.addView(playerKitView);
    setPlayerListeners();
} else {
    String adTagUrl = VIOAdUtil.getCastAdTag(mVideoDetailsModel);
    playerKit.updatePluginConfig(IMAPlugin.factory.getName(), IMAConfig.AD_TAG_URL, adTagUrl);
}
playerKit.prepare(config.media);
if (config.media.isAutoPlay()) {
    playerKit.play();
}
```

## Registering to the Player Events

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

## Registering to Player State Change Listener

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
